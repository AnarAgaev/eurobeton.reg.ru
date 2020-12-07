/* Калькулятор расчёта стоимости продукции
 * и добавления расчиитаного продукта в корзину
 */
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById('productCalcForm');

    if (form) {
        const btnValuePlus = form.querySelector('.value-checker__btn_plus');
        const btnValueMinus = form.querySelector('.value-checker__btn_minus');
        const value = form.querySelector('.value');
        const address = form.querySelector('.address');
        const productPricesJson = document.getElementById('productPrices');
        const productPrices = JSON.parse(productPricesJson.dataset.productPrices);
        const deliveryPricesJson = document.getElementById('deliveryPrices');
        const factories = JSON.parse(deliveryPricesJson.dataset.deliveryPrices);
        const resContainer = document.getElementById('calcResultContainerModal');
        const errCoordsContainer = document.getElementById('calcErrorCoordsContainer');
        const errRouteContainer = document.getElementById('calcErrorRouteContainer');
        const optimalFactory = document.getElementById('optimalFactory');
        let builtRout;
        let coordsFromMap;

        const editValue = (direction, curValue) => {
            let newValue = curValue === ""
                ? 0
                : direction
                    ? Number(curValue) + 1
                    : Number(curValue) - 1;

            return newValue < 0 ? 0 : newValue;
        };

        btnValuePlus.addEventListener('click', () => {
            value.value = editValue(
                true,
                value.value);
        });

        btnValueMinus.addEventListener('click', () => {
            value.value = editValue(
                false,
                value.value);
        });

        // Инициализируем Яндкс карту
        ymaps.ready(productCalcMapInit);

        function productCalcMapInit() {
            let productCalcMap = new ymaps.Map("productCalcMap",
                {
                    center: [55.907807031377885,37.54312876660157],
                    zoom: 10,
                    controls: [],
                },
                {
                    balloonMaxWidth: 250,
                }
            );

            productCalcMap.controls.add('zoomControl');
            productCalcMap.behaviors.disable('scrollZoom');

            // Обрабатываем открытие и закрытие модальной формы и очистку всех данных -- Start
            const modalCalcClose = () => {
                document.body.classList.remove("modal-open");
                modalProductCalc.classList.remove("show");
                valueInput.value = 0;
                valueInput.parentElement.parentElement.classList.remove('has__error');
                addressInput.value = '';
                addressInput.parentElement.classList.remove('has__error');
                calcResultContainerModal.classList.remove('visible');
                calcErrorCoordsContainer.classList.remove('visible');
                calcErrorRouteContainer.classList.remove('visible');

                // Чистим карту
                productCalcMap.balloon.close();
                productCalcMap.geoObjects.remove(builtRout);
                productCalcMap.setCenter([55.907807031377885,37.54312876660157], 10);
            };

            showModalProductCalc.addEventListener('click', evt => {
                document.body.classList.add("modal-open");
                modalProductCalc.classList.add("show");
            });

            btnModalCalcClose.addEventListener('click', modalCalcClose);

            modalProductCalc.addEventListener("click", evt => {
                evt.target.id === 'modalProductCalc'
                    ? modalCalcClose()
                    : false;
            });
            // Обрабатываем открытие и закрытие модальной формы и очистку всех данных -- End

            // В цикле добавляем метки на карту
            for(let i in factories) {
                productCalcMap.geoObjects.add(new ymaps.Placemark(
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
                    }),
                );
            }

            // Обработка события, возникающего при клике
            // левой кнопкой мыши в любой точке карты.
            // При возникновении такого события откроем балун.
            productCalcMap.events.add('click', evt => {
                productCalcMap.balloon.close(); // закрываем открытый балун
                const receivedCoords = evt.get('coords');

                // Показываем новый балун
                productCalcMap.balloon.open(receivedCoords, {
                    contentHeader:'Координаты места<br>доставки:',
                    contentBody:'<span>[' + [
                        receivedCoords[0].toPrecision(10),
                        receivedCoords[1].toPrecision(10)
                    ].join(', ') + ']</span>',
                    contentFooter:'<i>Координаты скопированы в поле<br>адрес доставки.</i>'
                });

                // Пушим координаты в поле Адрес доставки
                address.value = '[' + [
                    receivedCoords[0],
                    receivedCoords[1]
                ].join(',') + ']';

                // Сохраняем координаты в переменную
                // для декодирования и расчёта
                // стоимости доставки
                coordsFromMap = []; // облуляем масси при каждом клике по карте
                coordsFromMap.push(receivedCoords[0]);
                coordsFromMap.push(receivedCoords[1]);
            });

            // Скрываем хинт при открытии балуна.
            productCalcMap.events.add('balloonopen', function (e) {
                productCalcMap.hint.close();
            });

            // Обработчик отправки формы
            form.addEventListener('submit', evt => {
                evt.preventDefault();
                productCalcMap.balloon.close();
                productCalcMap.geoObjects.remove(builtRout);
                resContainer.classList.remove('visible');
                errCoordsContainer.classList.remove('visible');
                errRouteContainer.classList.remove('visible');

                // Сбрасываем ошибки на плях формы
                value.parentElement.parentElement
                    .classList
                    .remove('has__error');
                address.parentElement
                    .classList
                    .remove('has__error');

                let formValid = true;

                if (address.value === '') {
                    address.parentElement
                        .classList
                        .add('has__error');
                    address.focus();
                    formValid = false;
                }

                if (value.value === '' || value.value === '0') {
                    value.parentElement.parentElement
                        .classList
                        .add('has__error');
                    formValid = false;
                }

                if (formValid) {
                    spinner.classList.add('visible');

                    let addressValue = validCoords(address.value)
                        ? coordsFromMap
                        : address.value;

                    const myGeocoder = ymaps.geocode(addressValue);
                    myGeocoder.then(
                        response => {
                            if (!response.geoObjects.get(0)) {
                                spinner.classList.remove('visible');
                                errCoordsContainer.classList.add('visible');
                                addressInput.parentElement.classList.add('has__error');
                            }
                            else {
                                // Сбрасываем расстояния, роуты, цену доставки, цену продукта
                                // и итоговую цену у заводов для корректного пересчёта расстояний
                                for (let i in factories) {
                                    delete factories[i]['distance'];
                                    delete factories[i]['route'];
                                    delete factories[i]['deliveryPrice'];
                                    delete factories[i]['productPrice'];
                                    delete factories[i]['finalPrice'];
                                }

                                /* В цикле проходим по всем заводам и расчитываем расстояние
                                 * от каждого завода до точки поставки продукции.
                                 *
                                 * Полученный результат сохраняем в массиве завода.
                                 *
                                 * Так же в массив завода сохраняем полученный путь,
                                 * чтобы потом пушить его в карту
                                 */
                                for(let i in factories) {
                                    ymaps.route([
                                        JSON.parse(factories[i].coordinates),
                                        response.geoObjects.get(0).geometry.getCoordinates()
                                    ], {
                                        mapStateAutoApply: true,
                                    }).then(route => {
                                        // Сохраняем длинну маршрута в массив с данными заводов
                                        factories[i]['distance'] = Math.ceil(route.getLength()/1000);
                                        // Сохраняем полученный объект ROUTE чтобы потом пушить его в карту
                                        factories[i]['route'] = route;
                                        // Считаем стомиость доставки и сохраняем в переменную deliveryPrice в объект завода
                                        factories[i]['deliveryPrice'] = null;
                                        for (let key in factories[i]['prices']) {
                                            if (factories[i]['distance'] <= Number(key)) {
                                                // Рссчитываем стоимость доставки как:
                                                // цена за транспортировку куба * количество кубов
                                                // !!! Без учёта расстояния
                                                factories[i]['deliveryPrice'] = parseFloat(factories[i]['prices'][key].replace(/,/, '.')) * value.value;
                                                break;
                                            }
                                        }
                                        // Считаем стомость товара на каждом заводе и итоговую стоимость
                                        // Сохраняме полученные данные в объект завода в переменные
                                        // productPrice и finalPrice соответственно
                                        if (productPrices[i] !== '' && factories[i]['deliveryPrice'] !== null) {
                                            factories[i]['productPrice'] = parseFloat(productPrices[i].replace(/,/, '.')) * value.value;
                                            factories[i]['finalPrice'] = (factories[i]['productPrice'] + factories[i]['deliveryPrice']).toFixed(2);
                                        } else {
                                            factories[i]['productPrice'] = null;
                                            factories[i]['finalPrice'] = null;
                                        }

                                        /* Для того чтобы гарантировать что все асинхронные запрсы выполенены
                                         * и все координаты получены на каждой итерации цикла, проверяем
                                         * все заводы на наличие у них дистанции до выбранного места доставки
                                         * и если дистанция есть у всех, а токое возомжно только после того
                                         * как последний асинхронный запрос вернёт данные, определяем кротчайший
                                         * маршрут до завода и пушим его в карту
                                        */
                                        let isRequestsFinish = true;
                                        for (let i in factories) {
                                            if (!factories[i]['distance']) {
                                                isRequestsFinish = false;
                                                break;
                                            }
                                        }

                                        // Если у всех заводов посчитана дистанция
                                        // ищем на каком заводе минимальная итоговая цен
                                        // и пушум завод в карту
                                        if(isRequestsFinish) {
                                            let factoryId = null;

                                            // Определяем завод с самой низкой итогвой ценой товара
                                            // Итоговая цена = цена доставки + цена товара
                                            for (let id in factories) {
                                                if (factories[id]['distance'] && factories[id]['finalPrice']) {
                                                    factoryId = !factoryId
                                                        ? id
                                                        : factories[id]['finalPrice'] < factories[factoryId]['finalPrice']
                                                            ? id
                                                            : factoryId;
                                                }
                                            }

                                            // Определяме завод или с минмальной ценой или самый ближайшй к место доставки
                                            // Показываем пользователю минмальную цену товара с учётом доставки
                                            // или выводим сообщение что не можем доставить (слишком далеко)
                                            if (factoryId) {
                                                const name = document.getElementById('calcProductNameContainer');
                                                const price = document.getElementById('calcPriceContainer');
                                                const factoryName = document.getElementById('calcFactoryContainer');
                                                const distance = document.getElementById('calcRoutContainer');
                                                const valueProd = document.getElementById('calcValueContainer');
                                                const coords = document.getElementById('calcCoordsContainer');
                                                const deliveryPrice = document.getElementById('calcProdDeliveryPriceContainer');
                                                const productPrice = document.getElementById('calcProductPriceContainer');

                                                name.innerText = productNameController.value;
                                                price.innerText = factories[factoryId]['finalPrice'];
                                                factoryName.innerText = factories[factoryId]['name'];
                                                distance.innerText = factories[factoryId]['distance'] + ' км.';
                                                valueProd.innerHTML = value.value + ' м<sup>3</sup>';
                                                coords.innerText = address.value;
                                                deliveryPrice.innerText = factories[factoryId]['deliveryPrice'] + ' руб.';
                                                productPrice.innerText = factories[factoryId]['productPrice'] + ' руб.';

                                                // Сохраняем полученные данные в скрытые поля формы
                                                // для отправки на сервер и добавления их в переменную сессии
                                                // с данными корзины
                                                routeLength.value = factories[factoryId]['distance'];
                                                deliveryPriceController.value = factories[factoryId]['deliveryPrice'];
                                                productPriceController.value = factories[factoryId]['productPrice'];
                                                finalPrice.value = factories[factoryId]['finalPrice'];

                                                // Показываем сообщение с расчётными данными продукта
                                                resContainer.classList.add('visible');
                                            } else {
                                                // Если выбранной продукции нет ни на одном заводе
                                                // опеделяем ближайший завод к месту поставки
                                                // на котором есть данный вид продукции
                                                for(let id in factories) {
                                                    if (factories[id]['distance'] && productPrices[id] !== '') {
                                                        factoryId = !factoryId
                                                            ? id
                                                            : factories[id]['distance'] < factories[factoryId]['distance']
                                                                ? id
                                                                : factoryId;
                                                    }
                                                }

                                                // Показываем сообщение Слишком длинная доставка
                                                errRouteContainer.classList.add('visible');
                                            }

                                            spinner.classList.remove('visible');

                                            // Удаляем предыдущий маршрут с карты для
                                            // случаев пересчёта маршрута
                                            productCalcMap.geoObjects.remove(builtRout);

                                            // Сохраняем полученный маршрут в переменную,
                                            // чтобы потом была возможность удалить его с карты
                                            // Предыдущая строка кода: deliveryMap.geoObjects.remove(builtRout);
                                            builtRout = factories[factoryId].route;

                                            // Кастомизируем метку на карте
                                            const points = factories[factoryId].route.getWayPoints();
                                            points.options.set('preset', 'islands#orangeCircleDotIcon');
                                            points.get(0).options.set('visible', false);
                                            //points.get(points.getLength() - 1).options.set('hasBalloon', false);
                                            points.get(points.getLength() - 1).options.set('iconLayout', 'default#image');
                                            points.get(points.getLength() - 1).options.set('iconImageHref', '/local/templates/.default/img/mark.png');
                                            points.get(points.getLength() - 1).options.set('iconImageSize', [36, 43]);
                                            points.get(points.getLength() - 1).options.set('iconImageOffset', [-15, -35]);

                                            // Кастомизурем проложенный маршрут (цвет линии и прозрачность)
                                            factories[factoryId].route.getPaths().options.set({
                                                strokeColor: 'f1852c',
                                                opacity: 0.9,
                                            });

                                            // Добавляем маршрут на карту
                                            productCalcMap.geoObjects.add(factories[factoryId].route);

                                            // Сохраняем ID оптимального завода в скрытое поле формы
                                            optimalFactory.dataset.optimalFactoryId = JSON.stringify(factoryId);
                                            optimalFactory.value = factoryId;

                                            // console.log('productPrices:', productPrices);
                                            // console.log('factories:', factories);
                                            // console.log('factoryId:', factoryId);
                                            // console.log('optimalFactory:', factories[factoryId]);
                                            // console.log('name:', factories[factoryId]['name']);
                                            // console.log('address:', factories[factoryId]['address']);
                                            // console.log('distance:', factories[factoryId]['distance'], 'км.');
                                            // console.log('productPrices:', factories[factoryId]['productPrice'], 'руб.');
                                            // console.log('deliveryPrice:', factories[factoryId]['deliveryPrice'], 'руб.');
                                            // console.log('finalPrice:', factories[factoryId]['finalPrice'], 'руб.');
                                            // console.log('*********************************')
                                        }
                                    });
                                }
                            }
                        },
                        err => {
                            console.log(err);
                            alert("Во время работы калькулятора произошла ошибка. Попробуйте повторить попытку позже.")
                        }
                    );

                }
            });

            // Добавляем товар в $_SESSION и меняем счётчик товаров в корзине в шапке сайта
            addProductToCart.addEventListener('click', evt => {
                spinner.classList.add('visible');
                getResource(form.action, form)
                    .then(response  => {
                        console.log(response)

                        spinner.classList.remove('visible');

                        if (response['IS_ERRORS']) {
                            alert('Сообщение не отправлено. Произошла ошибка. Попробуйте немного позже.')
                        } else {
                            modalCalcClose();
                            cartItemsCounter.innerText = response['CART_ITEM_COUNT'];
                            cartItemsCounter.classList.add('items-added');

                            setTimeout(() => {
                                cartItemsCounter.classList.remove('items-added');
                            }, 4500);
                        }
                    });

            });
        }
    }
});