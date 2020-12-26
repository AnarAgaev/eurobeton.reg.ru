/* Калькулятор рассчёта стоимости Бетона с доставкой */
document.addEventListener("DOMContentLoaded", () => {
    if (concreteCalcForm) {
        const items = JSON.parse(concreteAllItems.dataset.items);
        const factories = JSON.parse(deliveryPrices.dataset.deliveryPrices);
        let builtRout;
        let coordsFromMap;

        const controls = [
            concreteGrade, concreteFiller,
            concreteFrost, concreteMobility,
            concreteWater, concreteAntifreeze,
        ];

        // Обработчики для кликов по кнопкам
        const btnsResetSelects = document
            .getElementsByClassName('btn__reset-select');
        for (let btn of btnsResetSelects) {
            btn.addEventListener('click', evt => {
                const parent = evt.target.parentElement;
                const controller = parent.querySelector('select');

                // Сбрасываем класс выбранного селекта у родителя
                parent.classList.remove('selected');

                // Сбрасываем выбранное состояние у самого селекта
                controller.selectedIndex = 0;

                // Перефильтруем option(ы) и сам select(ы)
                fnFilterOptions(fnFilterAllItems());
            });
        }

        // Если пользователь выбрал орпеделённу характеристику бетона
        // то проверяем уеё у всех товаров из раздела Бетон,
        // если не выбрал, то возвращаем результат true для того, чтобы
        // объект с проверяемым товаром попал в отфильтрованный массив.
        const fnFilterAllItems = () => {
            return items.filter(item => {
                return (controls[0].value
                    ? item.PROPS.CONCRETE_GRADE.VALUE_XML_ID === controls[0].value
                    : true)
                    && (controls[1].value
                        ? item.PROPS.CONCRETE_FILLER.VALUE_XML_ID === controls[1].value
                        : true)
                    && (controls[2].value
                        ? item.PROPS.CONCRETE_FROST.VALUE_XML_ID === controls[2].value
                        : true)
                    && (controls[3].value
                        ? item.PROPS.CONCRETE_MOBILITY.VALUE_XML_ID === controls[3].value
                        : true)
                    && (controls[4].value
                        ? item.PROPS.CONCRETE_WATER.VALUE_XML_ID === controls[4].value
                        : true)
                    && (controls[5].value
                        ? item.PROPS.CONCRETE_ANTIFREEZE_ADDITIVE.VALUE_XML_ID === controls[5].value
                        : true);
            })
        };

        // Фильтруем все option для всех select(ов) и оставляем только
        // те свойства которые представленны в выбранных товарах
        // из раздела Бетон
        const fnFilterOptions = (filteredArray) => {
            // Сбрасываем все option(ы)
            for (let i = 0; i < controls.length; i++) {
                for(let option of controls[i].options) {
                    if (option.value) {
                        option.classList.add('disabled');
                    }
                }
            }

            // Для имеющихся свойств влючаем option(ы) с соответствующим ID
            for (let i = 0; i < filteredArray.length; i++) {
                for (let key in filteredArray[i].PROPS) {
                    let el = document.getElementById(filteredArray[i].PROPS[key].VALUE_XML_ID);
                    if (el) {
                        el.classList.remove('disabled');
                    }
                }
            }
        }

        // Обрабатываем изменене значения во всех Select(ах)
        for (let i = 0; i < controls.length; i++) {
            controls[i].addEventListener('change', () => {
                fnFilterOptions(fnFilterAllItems());

                const parentClasses = controls[i].parentElement.classList;
                controls[i].options[controls[i].selectedIndex].value
                    ? parentClasses.add('selected')
                    : parentClasses.remove('selected');
            });
        }

        // Сразу после загрузки страницы вызваем фильтрацию option
        // для каждого select(а), чтобы оставить только актуальные
        fnFilterOptions(fnFilterAllItems());

        // Открвыаем закрываем блок с доп. параметрами
        concreteAddParamsTglr.addEventListener('click', evt => {
            concreteAddParamsTglr.classList.toggle('params-visible');
            concreteParamsGroupTwo.classList.toggle('params-visible');
        });

        // Изменяем значение объема Бетона в форме
        const editValue = (direction, curValue) => {
            let newValue = curValue === ""
                ? 0
                : direction
                    ? Number(curValue) + 1
                    : Number(curValue) - 1;

            return newValue < 0 ? 0 : newValue;
        };

        btnConcreteValPlus.addEventListener('click', () => {
            concreteValue.value = editValue(
                true,
                concreteValue.value);
        });

        btnConcreteValMinus.addEventListener('click', () => {
            concreteValue.value = editValue(
                false,
                concreteValue.value);
        });

        // Показываем Яндекс карту для выбора места доставки
        btnSelectAddressOnMap.addEventListener('click', evt => {
            document.body.classList.add("modal-open");
            concreteCalcMap.classList.add('visible');
        });

        // Скрываем Яндекс карту для выбора доставки и чистим её
        btnConcreteMapCloser.addEventListener('click', () => {
            document.body.classList.remove("modal-open");
            concreteCalcMap.classList.remove('visible');

            // Чистим ошибку на поле для Адреса доставки
            concreteAddress.parentElement.classList.remove('has__error');
        });

        // Инициализируем Яндкс карту
        ymaps.ready(concreteCalcMapInit);

        function concreteCalcMapInit() {
            let concreteCalcMap = new ymaps.Map("concreteCalcMap",
                {
                    center: [55.907807031377885,37.54312876660157],
                    zoom: 10,
                    controls: [],
                },
                {
                    balloonMaxWidth: 250,
                }
            );

            // В цикле добавляем метки на карту
            for(let key in factories) {
                concreteCalcMap.geoObjects.add(new ymaps.Placemark(
                    JSON.parse(factories[key].coordinates),
                    {
                        balloonContentHeader: factories[key].name,
                        balloonContentBody: factories[key].address
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
            concreteCalcMap.events.add('click', evt => {
                concreteCalcMap.balloon.close(); // закрываем открытый балун
                const receivedCoords = evt.get('coords');

                // Показываем новый балун
                concreteCalcMap.balloon.open(receivedCoords, {
                    contentHeader:'Координаты места<br>доставки:',
                    contentBody:'<span>[' + [
                        receivedCoords[0].toPrecision(10),
                        receivedCoords[1].toPrecision(10)
                    ].join(', ') + ']</span>',
                    contentFooter:'<i>Координаты скопированы в поле<br>адрес доставки.</i>'
                });

                // Пушим координаты в поле Адрес доставки
                concreteAddress.value = '[' + [
                    receivedCoords[0],
                    receivedCoords[1]
                ].join(',') + ']';

                // Сохраняем координаты в переменную для декодирования и расчёта
                // стоимости доставки
                coordsFromMap = []; // облуляем массив при каждом клике по карте
                coordsFromMap.push(receivedCoords[0]);
                coordsFromMap.push(receivedCoords[1]);
            });

            // Скрываем хинт при открытии балуна.
            concreteCalcMap.events.add('balloonopen', function (e) {
                concreteCalcMap.hint.close();
            });

            // Функция для очистки формы расчёта стоимости бетона
            const resetConcreteForm = () => {
                concreteCalcForm.reset();

                // Перефильтруем option(ы) и сам select(ы)
                fnFilterOptions(fnFilterAllItems());

                // Скрываем сообщение с данными опитмального товара
                concreteResultContainer.classList.remove('visible');

                // Чистим карту
                concreteCalcMap.balloon.close();
                concreteCalcMap.geoObjects.remove(builtRout);
                concreteCalcMap.setCenter([55.907807031377885,37.54312876660157], 10);
            };

            // Обработчик отправки формы
            // Рассчитываем оптимальный товар
            // и показываем пользователю рассчётные данные
            concreteCalcForm.addEventListener('submit', evt => {
                evt.preventDefault();
                concreteResultContainer.classList.remove('visible');
                concreteErrorCoordsContainer.classList.remove('visible');
                concreteErrorRouteContainer.classList.remove('visible');

                // Сбрасываем ошибки на плях формы
                concreteAddress.parentElement
                    .classList
                    .remove('has__error');
                concreteGrade.parentElement
                    .classList
                    .remove('has__error');
                concreteValue.parentElement.parentElement
                    .classList
                    .remove('has__error');

                let formValid = true;

                if (concreteAddress.value === '') {
                    concreteAddress.parentElement
                        .classList
                        .add('has__error');
                    concreteAddress.focus();
                    formValid = false;
                }

                if (!concreteGrade.options[concreteGrade.selectedIndex].value) {
                    concreteGrade.parentElement
                        .classList
                        .add('has__error');
                    formValid = false;
                }

                if (concreteValue.value === '' || concreteValue.value === '0') {
                    concreteValue.parentElement.parentElement
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
                        let addressValue = validCoords(concreteAddress.value)
                            ? coordsFromMap
                            : concreteAddress.value;

                        const myGeocoder = ymaps.geocode(addressValue);
                        myGeocoder.then(
                            response => {
                                if (!response.geoObjects.get(0)) {
                                    spinner.classList.remove('visible');
                                    concreteErrorCoordsContainer.classList.add('visible');
                                    concreteAddress.parentElement.classList.add('has__error');
                                }
                                else {
                                    // Сбрасываем расстояния, роуты и цену доставки
                                    // у заводов для корректного пересчёта расстояний
                                    for (let i in factories) {
                                        delete factories[i]['distance'];
                                        delete factories[i]['route'];
                                        delete factories[i]['deliveryPrice'];
                                    }

                                    /**
                                     * В цикле проходим по всем заводам и расчитываем расстояние
                                     * от каждого завода до точки поставки продукции.
                                     * Полученный результат сохраняем в массиве завода.
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
                                                    factories[i]['deliveryPrice'] = parseFloat(factories[i]['prices'][key].replace(/,/, '.')) * concreteValue.value;
                                                    break;
                                                }
                                            }

                                            /**
                                             * Для того чтобы гарантировать что все асинхронные запрсы выполенены
                                             * и все координаты получены на каждой итерации цикла, проверяем
                                             * все заводы на наличие у них дистанции до выбранного места доставки
                                             * и если дистанция есть у всех, а токое возомжно только после того
                                             * как последний асинхронный запрос вернёт данные, определяем кротчайший
                                             * маршрут до завода и пушим его в карту
                                             */
                                            let isRequestsFinished = true;
                                            for (let i in factories) {
                                                if (!factories[i]['distance']) {
                                                    isRequestsFinished = false;
                                                    break;
                                                }
                                            }

                                            /**
                                             * Если у всех заводов посчитана дистанция и стоимость доставки
                                             * считаем стомость каждого товара из отфильтрованного
                                             * списка товаров по каждому из заводов. Полученную и итоговую
                                             * стоимости товоара сохраняем в объекте товара в отфильтрованном
                                             * списке товаров в productPrice и finalPrice соответственно.
                                             */
                                            if(isRequestsFinished) {
                                                // Фильтруем товары в соответствии с выбранными
                                                // пользователем характеристиками
                                                const items = fnFilterAllItems();

                                                /**
                                                 * Оптимальный товара
                                                 *
                                                 * @type {Object}
                                                 * @param {number} id - ID опитмального товара в массиве товаров items
                                                 * @param {number} factory - ID оптимального заводо в массиве цент оптимального товара
                                                 * @param {number} distance - Дистанция до оптимального завода, нужна в том случае
                                                 *                            если на двух заводах итоговая цена товара одинакова,
                                                 *                            тогда выберем везти с того завода который ближе
                                                 */
                                                let optimalProduct = null;

                                                // ID ближайшего завода на случай слишком длоинной дистанции
                                                let factoryId = null;

                                                /**
                                                 * Определяем ИТОГОВОУ цену товара на каждом из заводов
                                                 * с учётом доставки от этого завода.
                                                 * Полученный результат записываем в объект PRICES в котором
                                                 * имя свойства - ИД завода, а значение - объект с итоговй ценой
                                                 * и др. параметрами по этому заводу
                                                 *
                                                 * Имена свойства/ID заводов взяты из ID инфоблока завода
                                                 * Битрикс/Администрирование/Контент/Прайсы/Доставка Бетона
                                                 */
                                                items.forEach((item, index) => {
                                                    item['PRICES'] = {};

                                                    for (let factoryID = 350; factoryID < 356; factoryID++) {
                                                        // Цена товара на конкретном заводе
                                                        const price = parseFloat(item.PROPS['PRICE_FACTORY_ID_' + factoryID].VALUE.replace(/,/, '.')) * concreteValue.value;

                                                        item['PRICES'][factoryID] = factories[factoryID].deliveryPrice
                                                            ? {
                                                                  deliveryPrice : factories[factoryID].deliveryPrice,
                                                                  distance: factories[factoryID].distance,
                                                                  productPrice : price,
                                                                  finalPrice : factories[factoryID].deliveryPrice + price,
                                                              }
                                                            : null;

                                                        /**
                                                         * Определяем оптимальый товар (минимальная цена с учётом доставки)
                                                         * Если цена рассчитвыаемого на этой итерации товара меньше цены
                                                         * товара ID которого хранится в переменной optimalProduct
                                                         * или если цены равны и доставка текущего товара меньше
                                                         * доставки оптимального, перезаписываем оптимальный товара,
                                                         * оптимальный завод и оптимальную доставку текущим товаром
                                                         */
                                                        if (item['PRICES'][factoryID]) {
                                                            const newOptimalProduct = {
                                                                id: index,
                                                                factory: factoryID,
                                                                distance: factories[factoryID].distance,
                                                            };

                                                            // Если оптимальный продукт не определён (первая итерация), присваиваем текущий
                                                            if (!optimalProduct) {
                                                                optimalProduct = newOptimalProduct;
                                                            } else {
                                                                const currentPrice = item['PRICES'][factoryID].finalPrice;
                                                                const optimalPrice = items[optimalProduct.id]['PRICES'][optimalProduct.factory].finalPrice;
                                                                const currentDistance = item['PRICES'][factoryID].distance;
                                                                const optimalDistance = items[optimalProduct.id]['PRICES'][optimalProduct.factory].distance;

                                                                // Если цена текущего товара меньше цены оптимального, присваиваем текущий
                                                                if (currentPrice < optimalPrice) {
                                                                    optimalProduct = newOptimalProduct;
                                                                }
                                                                else {
                                                                    // Если цена текущего равна цены оптимального сравниваем дистанцию доставки
                                                                    // и если текущая меньше, меняем оптимальный товар на текущий
                                                                    if (currentPrice === optimalPrice && currentDistance < optimalDistance) {
                                                                        optimalProduct = newOptimalProduct;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                });

                                                /**
                                                 * Определяем завод или с минмальной ценой или самый ближайшй к место доставки
                                                 * Показываем пользователю минмальную цену товара с учётом доставки
                                                 * или выводим сообщение что не можем доставить (слишком далеко)
                                                 */
                                                if (optimalProduct) {
                                                    // Сохраняем оптимальный завод в переменную для построения маршрута
                                                    factoryId = optimalProduct.factory;

                                                    // Собираем имя товара
                                                    let name = '';
                                                    name += (items[optimalProduct.id]['FIELDS']['NAME'] !== 'Цементное молоко'
                                                                && items[optimalProduct.id]['FIELDS']['NAME'] !== 'Пусковая смесь')
                                                        ? items[optimalProduct.id]['FIELDS']['PREVIEW_TEXT']
                                                        : '';
                                                    name += items[optimalProduct.id]['PROPS']['CONCRETE_GRADE']['VALUE']
                                                        ? ' ' + items[optimalProduct.id]['PROPS']['CONCRETE_GRADE']['VALUE']
                                                        : '';
                                                    name += items[optimalProduct.id]['PROPS']['CONCRETE_MOBILITY']['VALUE']
                                                        ? ' ' + items[optimalProduct.id]['PROPS']['CONCRETE_MOBILITY']['VALUE']
                                                        : '';
                                                    name += items[optimalProduct.id]['PROPS']['CONCRETE_FROST']['VALUE']
                                                        ? ' ' + items[optimalProduct.id]['PROPS']['CONCRETE_FROST']['VALUE']
                                                        : '';
                                                    name += items[optimalProduct.id]['PROPS']['CONCRETE_WATER']['VALUE']
                                                        ? ' ' + items[optimalProduct.id]['PROPS']['CONCRETE_WATER']['VALUE']
                                                        : '';
                                                    name += items[optimalProduct.id]['PROPS']['CONCRETE_FILLER']['VALUE']
                                                        ? ' ' + items[optimalProduct.id]['PROPS']['CONCRETE_FILLER']['VALUE']
                                                        : '';
                                                    name += items[optimalProduct.id]['PROPS']['CONCRETE_ANTIFREEZE_ADDITIVE']['VALUE']
                                                        ? ' До: ' + items[optimalProduct.id]['PROPS']['CONCRETE_ANTIFREEZE_ADDITIVE']['VALUE'] + '°C'
                                                        : '';

                                                    // Собираем описание товара
                                                    let description = '';
                                                    description += concreteRentPump.checked
                                                        ? '*Пользователь ометил поле Арендовать бетононасос. '
                                                        : '';
                                                    description += 'Марка: ' + items[optimalProduct.id]['PROPS']['CONCRETE_GRADE']['VALUE'] + ';';
                                                    description += items[optimalProduct.id]['PROPS']['CONCRETE_MOBILITY']['VALUE']
                                                        ? ' Подвижность: ' + items[optimalProduct.id]['PROPS']['CONCRETE_MOBILITY']['VALUE'] + ';'
                                                        : '';
                                                    description += items[optimalProduct.id]['PROPS']['CONCRETE_FROST']['VALUE']
                                                        ? ' Морозостойкость: ' + items[optimalProduct.id]['PROPS']['CONCRETE_FROST']['VALUE'] + ';'
                                                        : '';
                                                    description += items[optimalProduct.id]['PROPS']['CONCRETE_WATER']['VALUE']
                                                        ? ' Водонепроницаемость: ' + items[optimalProduct.id]['PROPS']['CONCRETE_WATER']['VALUE'] + ';'
                                                        : '';
                                                    description += items[optimalProduct.id]['PROPS']['CONCRETE_FILLER']['VALUE']
                                                        ? ' Наполнитель: ' + items[optimalProduct.id]['PROPS']['CONCRETE_FILLER']['VALUE'] + ';'
                                                        : '';
                                                    description += items[optimalProduct.id]['PROPS']['CONCRETE_ANTIFREEZE_ADDITIVE']['VALUE']
                                                        ? ' Противоморозная добавка: ' + items[optimalProduct.id]['PROPS']['CONCRETE_ANTIFREEZE_ADDITIVE']['VALUE'] + '°C;'
                                                        : '';

                                                    let productPrices = {};
                                                    for (let id = 350; id < 356; id++) {
                                                        productPrices[id] = items[optimalProduct.id]['PROPS']['PRICE_FACTORY_ID_' + id]['VALUE'];
                                                    }

                                                    // Добавляем свойства оптимального товара в результирующее сообщение
                                                    concreteNameContainer.innerText = name;
                                                    concretePriceContainer.innerText = (items[optimalProduct.id]['PRICES'][factoryId]['finalPrice']).toFixed(2);
                                                    concreteFactoryContainer.innerText = factories[factoryId]['name'];
                                                    concreteRoutContainer.innerText = factories[factoryId]['distance'] + ' км.';
                                                    concreteValueContainer.innerHTML = concreteValue.value + ' м<sup>3</sup>';
                                                    concreteCoordsContainer.innerText = factories[factoryId]['name'];
                                                    concreteProdDeliveryPriceContainer.innerText = (factories[factoryId]['deliveryPrice']).toFixed(2) + ' руб.';
                                                    concreteProductPriceContainer.innerText = (items[optimalProduct.id]['PRICES'][factoryId]['productPrice']).toFixed(2) + ' руб.';

                                                    // Сохраняем полученные данные в скрытые поля формы
                                                    // для отправки на сервер и добавления их в переменную сессии
                                                    // с данными корзины
                                                    concreteRouteLength.value = factories[factoryId]['distance'];
                                                    concreteDeliveryPriceController.value = (factories[factoryId]['deliveryPrice']).toFixed(2);
                                                    concreteProductPriceController.value = (items[optimalProduct.id]['PRICES'][factoryId]['productPrice']).toFixed(2);
                                                    concreteFinalPriceController.value = (items[optimalProduct.id]['PRICES'][factoryId]['finalPrice']).toFixed(2);
                                                    concreteDescriptionController.value = description;
                                                    concreteNameController.value = name;
                                                    concretePricesController.value = JSON.stringify(productPrices);
                                                    concretePicSrcController.value = items[optimalProduct.id]['PREVIEW_PICTURE']['SRC'];

                                                    // Показываем сообщение с расчётными данными продукта
                                                    concreteResultContainer.classList.add('visible');
                                                } else {
                                                    /**
                                                     * Если не удальсь определить опитмальный товар
                                                     * значит место доставки слишком далеко, тогда
                                                     * определяем ближайший завод к месту поставки,
                                                     * на котором есть данный вид продукции
                                                     * пушм его роут в карту и говорим пользователю,
                                                     * о слишком длинной доставке
                                                     */
                                                    for(let id in factories) {
                                                        if (factories[id]['distance']) {
                                                            factoryId = !factoryId
                                                                ? id
                                                                : factories[id]['distance'] < factories[factoryId]['distance']
                                                                    ? id
                                                                    : factoryId;
                                                        }
                                                    }

                                                    // Показываем сообщение Слишком длинная доставка
                                                    concreteErrorRouteContainer.classList.add('visible');
                                                }

                                                spinner.classList.remove('visible');

                                                // Удаляем предыдущий маршрут с карты для случаев
                                                // пересчёта маршрута без перезагрузки страницы
                                                if (builtRout) concreteCalcMap.geoObjects.remove(builtRout);

                                                // Сохраняем полученный маршрут в переменную,
                                                // чтобы потом была возможность удалить его с карты
                                                // Предыдущая строка кода: concreteCalcMap.geoObjects.remove(builtRout);
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
                                                concreteCalcMap.geoObjects.add(factories[factoryId].route);

                                                // Сохраняем ID оптимального завода в скрытое поле формы
                                                concreteOptimalFactory.dataset.optimalFactoryId = JSON.stringify(factoryId);
                                                concreteOptimalFactory.value = factoryId;

                                                concreteCalcMap.balloon.close(); // закрываем открытый балун



                                                console.log('Продукты (items): ', items);
                                                console.log('Заводы и цены (factories): ', factories);
                                                console.log('Оптимальный товар (optimalProduct): ', optimalProduct);
                                                console.log('Оптимальный завод (factories[factoryId]): ', factories[factoryId]);
                                                console.log('name:', factories[factoryId]['name']);
                                                console.log('address:', factories[factoryId]['address']);
                                                console.log('distance:', factories[factoryId]['distance'], 'км.');
                                                console.log('deliveryPrice:', factories[factoryId]['deliveryPrice'], 'руб.');
                                                console.log('*********************************')
                                            }
                                        });
                                    }
                                }
                            },
                            err => {
                                if (errCounter <= 10) {
                                    calculate();
                                } else {
                                    spinner.classList.remove('visible');
                                    console.log(err);
                                    alert("Во время работы калькулятора произошла ошибка. Попробуйте перезагрузить страницу или повторить попытку позже.");
                                }
                            }
                        );
                    }

                    // Первый запуск фунции получения данных с Яндекс карт.
                    calculate();
                }
            });

            /**
             * 1. Добавляем оптимальный товар в Сессию.
             * 2. Меняем счётчик товаров в корзине в шапке сайта.
             * 3. Актуализируем модальное окно с Корзиной.
             */
            addConcreteToCart.addEventListener('click', () => {
                spinner.classList.add('visible');
                getResource(concreteCalcForm.action, concreteCalcForm)
                    .then(response  => {
                        console.log(response)
                        spinner.classList.remove('visible');

                        if (response['IS_ERRORS']) {
                            alert('Товар не добавле в Корзину. Перезагрузите страницу и попробуйте снова.')
                        } else {

                            // Сбарсываем форму рассчёта стоимости
                            resetConcreteForm();

                            // Показываем сообщение об удачном добавлении товара в корзину
                            concreteModal.classList.add('show');
                            msgAddConcreteTrue.classList.add('visible');

                            // Событи на кнопки в модольном сообщении
                            btnOpenModalCart.addEventListener('click', () => {
                                concreteModal.classList.remove('show');
                                msgAddConcreteTrue.classList.remove('visible');
                                fnCartModalToggle(true);
                            });

                            btnConcreteModalClose.addEventListener('click', () => {
                                concreteModal.classList.remove('show');
                                msgAddConcreteTrue.classList.remove('visible');
                            });

                            concreteModal.addEventListener('click', evt => {
                                if (evt.target.id === 'concreteModal') {
                                    concreteModal.classList.remove('show');
                                    msgAddConcreteTrue.classList.remove('visible');
                                }
                            });

                            // Меняем количество товаров в Корзине на иконке корзины в хедере
                            cartItemsCounter.innerText = response['CART_ITEM_COUNT'];
                            cartItemsCounter.classList.add('items-added');

                            setTimeout(() => {
                                cartItemsCounter.classList.remove('items-added');
                            }, 4500);

                            // Отправленный на сервер оптимальный товар
                            const product = response['GETTING_POST'];

                            // Получаем предприятие отгрузки продукции
                            const fromFactoryId = product[`optimal-factory-id`];
                            const fromFactoryName = JSON.parse(product['factories'])[fromFactoryId]['name'];

                            const insertItemHtmlContent = '' +
                                '<li class="cart-modal__item" data-product-type="' + product[`product-type`] + '" data-pruduct-id="' + response[`ADDED_ITEM_ID`] + '">' +
                                    '<span class="cart-modal__item__delete" title="Удалить товар из корзины"></span>' +
                                    '<div class="cart-modal__item__title">' + product[`product-name`] + '</div>' +
                                    '<div class="cart-modal__item__content d-flex flex-column align-items-start flex-sm-row align-items-sm-center">' +
                                        '<span class="cart-modal__item__pic mb-3 mb-sm-0" style="background-image: url(' + product[`product-pic-src`] + ')"></span>' +
                                        '<ul class="cart-modal__item__props mb-1 mb-sm-0">' +
                                            '<li class="cart-modal__item__value">Количество: ' + product[`product-value`] + ' куб.м.</li>' +
                                            '<li class="cart-modal__item__product-price">Цена товара: ' + product[`product-price`] + ' руб.</li>' +
                                            '<li class="cart-modal__item__delivery-price">Стоимость доставки: ' + product[`delivery-price`] + ' руб.</li>' +
                                        '</ul>' +
                                        '<div class="cart-modal__item__result-price d-flex flex-row align-items-baseline flex-sm-column">' +
                                            '<span class="pr-1 pr-sm-0">Итоговая цена:</span>' +
                                            '<span class="num">' + product[`final-price`] + ' руб.</span>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="cart-modal__item__inform d-flex flex-column">' +
                                        '<div class="cart-modal__item__inform-title">' +
                                            '<span class="controller"></span>Дополнительная информация' +
                                        '</div>' +
                                        '<div class="cart-modal__item__inform-body">' +
                                            '<p class="mb-0">' +
                                                '<b>Характеристики:</b> ' + product[`product-description`] + '<br>' +
                                                '<b>Место отгрузки: </b> '+ fromFactoryName + '<br>' +
                                                '<b>Место поставки:</b> ' + product[`delivery-address`] + '<br>' +
                                                '<b>Расстояние доставки:</b> ' + product[`route-length`] + ' км.' +
                                            '</p>' +
                                        '</div>' +
                                    '</div>' +
                                '</li>';

                            // Добавляем товар в корзину в модальном окне
                            document
                                .getElementById('cartItemsConcrete')
                                .insertAdjacentHTML('beforeend', insertItemHtmlContent);

                            // Показываем блоки с товарами и скрываем заглушку для пустой корзины
                            noProductsMsg.classList.add('hidden');
                            cartModalBody.classList.remove('hidden');
                            cartModalFooter.classList.remove('hidden');

                            // Увиличиваем итоговую стоимость всех товаров в корзине на ссумму добавленного товара
                            const newFinalCartPrice =
                                parseFloat(finalCartPriceContainer.innerText) +
                                parseFloat(product['final-price']);

                            finalCartPriceContainer.innerText =
                                (Math.round(parseFloat(newFinalCartPrice) * 100) / 100).toFixed(2);
                        }
                    });
            });
        }
    }
});
