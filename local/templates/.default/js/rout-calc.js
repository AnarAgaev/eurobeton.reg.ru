// Калькулятор расчёта стоимости доставки
document.addEventListener("DOMContentLoaded", function () {
    const deliveryForm = document
        .getElementById('deliveryСost');

    if (deliveryForm) {
        const body = document.body;
        const btnPlus = deliveryForm.querySelector('.value-checker__btn_plus');
        const btnMinus = deliveryForm.querySelector('.value-checker__btn_minus');
        const deliveryValue = deliveryForm.querySelector('.deliveryValue');
        const deliveryAddress = deliveryForm.querySelector('.deliveryAddress');
        const modal = document.getElementById('modalCoordsError');
        const msg = document.getElementById('msgCoordsError');
        const btn = document.getElementById('btnCloseCoordsError');
        const modalLongRout = document.getElementById('modalToLongRoute');
        const msgLongRout = document.getElementById('msgToLongRoute');
        const btnLongRout = document.getElementById('btnToLongRoute');
        const resultContainer = document.getElementById('calcDeliveryResultContainer');
        let builtRout;
        let coordsFromMap = [];

        btn.addEventListener('click', function() {
            modal.classList.remove('show');
            msg.classList.remove('visible');
            body.classList.remove('modal-open');
        });

        btnLongRout.addEventListener('click', function() {
            modalLongRout.classList.remove('show');
            msgLongRout.classList.remove('visible');
            body.classList.remove('modal-open');
        });

        btnPlus.addEventListener('click', function () {
            deliveryValue.value = editValue(
                true,
                deliveryValue.value);
        });

        btnMinus.addEventListener('click', function () {
            deliveryValue.value = editValue(
                false,
                deliveryValue.value);
        });

        // Получаем координаты предприятий с сервера и сохраняем в переменной c массивом заводов
        let factories;

        // Инизицализируем Яндкс карту
        $.post("/utils/get-price.php")
            .done(function (response) {
                factories = JSON.parse(response);

                // Инизицализируем Яндкс карту на страницах с рассчётом доставки
                // только полсе того как придут координаты предприятий
                ymaps.ready(deliveryMapInit);
            });

        function deliveryMapInit() {
            const deliveryMap = new ymaps.Map("deliveryMap",
                {
                    center: [55.907807031377885,37.54312876660157],
                    zoom: 10,
                    controls: [],
                },
                {
                    balloonMaxWidth: 250,
                }
            );

            deliveryMap.controls.add('zoomControl');
            deliveryMap.behaviors.disable('scrollZoom');

            // В цикле добавляем метки на карту
            for(let i = 0; i < factories.length; i++) {
                deliveryMap.geoObjects.add(new ymaps.Placemark(
                    JSON.parse(factories[i].coordinates),
                    {
                        balloonContentHeader: factories[i].name,
                        balloonContentBody: factories[i].address
                    },
                    {
                        iconLayout: 'default#image',
                        iconImageHref: '/local/templates/.default/img/mark.png',
                        iconImageSize: [36, 43],
                        iconImageOffset: [-15, -35]
                    })
                )
            }

            // Обработка события, возникающего при клике
            // левой кнопкой мыши в любой точке карты.
            // При возникновении такого события откроем балун.
            deliveryMap.events.add('click', function (evt) {
                deliveryMap.balloon.close();
                const receivedCoords = evt.get('coords');

                // Показываем балун
                deliveryMap.balloon.open(receivedCoords, {
                    contentHeader:'Координаты места<br>доставки:',
                    contentBody:'<span>[' + [
                        receivedCoords[0].toPrecision(10),
                        receivedCoords[1].toPrecision(10)
                    ].join(', ') + ']</span>',
                    contentFooter:'<i>Координаты скопированы в поле<br>адрес доставки.</i>'
                });

                // Пушим координаты в поле Адрес доставки
                deliveryAddress.value = '[' + [
                    receivedCoords[0],
                    receivedCoords[1]
                ].join(',') + ']';

                // Сохраняем координаты в переменную
                // для декодирования и расчёта стоимости доставки
                coordsFromMap = [];
                coordsFromMap.push(receivedCoords[0]);
                coordsFromMap.push(receivedCoords[1]);
            });

            // Скрываем хинт при открытии балуна.
            deliveryMap.events.add('balloonopen', function (e) {
                deliveryMap.hint.close();
            });

            // Обработчик отправки формы
            $('#deliveryСost').submit(function (evt) {
                evt.preventDefault();

                deliveryMap.balloon.close();
                resultContainer.classList.remove('visible');

                deliveryValue.parentElement.parentElement
                    .classList
                    .remove('has__error');
                deliveryAddress.parentElement
                    .classList
                    .remove('has__error');

                let formValid = true;

                if (deliveryAddress.value === '') {
                    deliveryAddress.parentElement
                        .classList
                        .add('has__error');
                    deliveryAddress.focus();
                    formValid = false;
                }

                if (deliveryValue.value === '' || deliveryValue.value == '0') {
                    deliveryValue.parentElement.parentElement
                        .classList
                        .add('has__error');
                    formValid = false;
                }

                if (formValid) {
                    spinner.classList.add('visible');

                    let errCounter = 0;

                    /**
                     * Для того чтобы на ошибке вновь заново запускать запрос данных
                     * от сервиса Яндекс карт, обернули код в функцию и в случае ошибки
                     * вызываем её рекурсивно
                     * Считаем ошибки в переменной errCounter.
                     * Если ошибок более десяти выводим сообщение об ошибке
                     */
                    function calculate() {
                        let addressValue = validCoords(deliveryAddress.value)
                            ? coordsFromMap
                            : deliveryAddress.value;

                        const myGeocoder = ymaps.geocode(addressValue);

                        myGeocoder.then(getRouteDone, getRouteFail);
                    }
                    
                    function getRouteDone(response) {
                        if (!response.geoObjects.get(0)) {
                            spinner.classList.remove('visible');
                            modal.classList.add('show');
                            msg.classList.add('visible');
                            body.classList.add('modal-open');
                        } else {

                            // Чистим расстояния и роуты у заводов для корректного пересчёта расстояний
                            for (let i = 0; i < factories.length; i++) {
                                delete factories[i]['distance'];
                                delete factories[i]['route'];
                            }

                            /* В цикле проходим по всем заводам и расчитываем расстояние
                             * от каждого завода до точки поставки продукции.
                             *
                             * Полученный результат сохраняем в массиве завода,
                             * чтобы потом обойти все заводы и найти наименьший путь.
                             *
                             * Так же в массив завода сохраняем полученный путь,
                             * чтобы потом пушить его в карту
                             */
                            for(let i = 0; i < factories.length; i++) {
                                ymaps.route([
                                    JSON.parse(factories[i].coordinates),
                                    response.geoObjects.get(0).geometry.getCoordinates()
                                ], {
                                    mapStateAutoApply: true,
                                }).then(function (route) {
                                    // Ловим завод по которому рассчитывали маршрут
                                    const factoryID = catchFactory(route["requestPoints"][0], factories);

                                    // Сохраняем длинну маршрута в массив с данными заводов
                                    factories[factoryID]['distance'] = Math.ceil(route.getLength()/1000);

                                    // Сохраняем полученный объект ROUTE чтобы потом пушить его в карту
                                    factories[factoryID]['route'] = route;

                                    /* Для того чтобы гарантировать что все асинхронные запрсы выполенены
                                     * и все координаты получены на каждой итерации цикла, проверяем
                                     * все заводы на наличие у них дистанции до выбранного места доставки
                                     * и если дистанция есть у всех, а токое возомжно только после того
                                     * как последний асинхронный запрос вернёт данные, определяем кротчайший
                                     * маршрут до завода и пушим его в карту
                                    */
                                    let isRequestsFinish = true;
                                    for (let i = 0; i < factories.length; i++) {
                                        if (!factories[i]['distance']) {
                                            isRequestsFinish = false;
                                            break;
                                        }
                                    }

                                    // Если у всех заводов посчитана дистанция пушим наименьший маршрут в карту
                                    if(isRequestsFinish) {
                                        let distance = 9999999999;
                                        let factoryNum;
                                        let finalPrice = null;

                                        spinner.classList.remove('visible');

                                        // Определяем самый близкий завод
                                        for (let i = 0; i < factories.length; i++) {
                                            if (factories[i]['distance'] < distance) {
                                                factoryNum = i;
                                                distance = factories[i]['distance'];
                                            }
                                        }

                                        // Удаляем предыдущий маршрут с карты для случаев пересчёта маршрута
                                        deliveryMap.geoObjects.remove(builtRout);

                                        // Сохраняем полученный маршрут в переменную,
                                        // чтобы потом была возможность удалить его с карты
                                        // Предыдущая строка кода: deliveryMap.geoObjects.remove(builtRout);
                                        builtRout = factories[factoryNum].route;

                                        // Кастомизируем метки на карте
                                        const points = factories[factoryNum].route.getWayPoints();
                                        points.options.set('preset', 'islands#orangeCircleDotIcon');
                                        points.get(0).options.set('visible', false);
                                        //points.get(points.getLength() - 1).options.set('hasBalloon', false);
                                        points.get(points.getLength() - 1).options.set('iconLayout', 'default#image');
                                        points.get(points.getLength() - 1).options.set('iconImageHref', '/local/templates/.default/img/mark.png');
                                        points.get(points.getLength() - 1).options.set('iconImageSize', [36, 43]);
                                        points.get(points.getLength() - 1).options.set('iconImageOffset', [-15, -35]);

                                        // Кастомизурем проложенный маршрут (цвет линии и прозрачность)
                                        factories[factoryNum].route.getPaths().options.set({
                                            strokeColor: 'f1852c',
                                            opacity: 0.9,
                                        });

                                        // Добавляем маршрут на карту
                                        deliveryMap.geoObjects.add(factories[factoryNum].route);

                                        // Считаем сумму доставки и выводим сообщение пользователю
                                        for (let key in factories[factoryNum]['prices']) {
                                            const price = factories[factoryNum]['prices'][key];

                                            if (distance <= Number(key) && price != '') {
                                                // Рссчитываем стоимость доставки как:
                                                // расстояние * цена за транспортировку куба * количество кубов
                                                //finalPrice = distance * parseFloat(price.replace(/,/, '.')) * deliveryValue.value; // с учётом расстония
                                                finalPrice = parseFloat(price.replace(/,/, '.')) * deliveryValue.value; // без учёта расстояния
                                                break;
                                            }
                                        }

                                        // Говорим пользователю ЦЕНУ или что не можем доставить (слишком далеко)
                                        if (finalPrice) {
                                            const price = document.getElementById('calcDeliveryPriceContainer');
                                            const factory = document.getElementById('calcDeliveryFactoryContainer');
                                            const route = document.getElementById('calcDeliveryRoutContainer');
                                            const coords = document.getElementById('calcDeliveryCoordsContainer');

                                            resultContainer.classList.add('visible');
                                            price.innerText = finalPrice;
                                            factory.innerText = factories[factoryNum]['name'];
                                            route.innerText = distance + ' км.';
                                            coords.innerText = deliveryAddress.value;
                                        } else {
                                            modalLongRout.classList.add('show');
                                            msgLongRout.classList.add('visible');
                                            body.classList.add('modal-open');
                                        }

                                        // console.log('factories: ',factories);
                                        // console.log('distance: ', distance);
                                        // console.log('factoryFrom: ',factories[factoryNum]);
                                        // console.log('factoryNum: ', factoryNum);
                                        // console.log('finalPrice: ',finalPrice);
                                    }
                                });
                            }
                        }
                    }

                    function getRouteFail(err) {
                        // В случае ошибочного ответа от АПИ Яндекс карти пробуем снова до 10 раз
                        if (errCounter <= 10) {
                            calculate();
                        } else {
                            spinner.classList.remove('visible');
                            console.log(err);
                            alert("Во время работы калькулятора произошла ошибка. Попробуйте перезагрузить страницу или повторить попытку позже.");
                        }
                    }

                    // Первый запуск фунции получения данных с Яндекс карт.
                    calculate();
                }

                return false;
            });
        }
    }
});