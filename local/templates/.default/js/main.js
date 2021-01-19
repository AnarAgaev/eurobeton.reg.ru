/* Функция для валидации электронной почты */
window.validMail = function(mail) {
    let regular = /.+@.+\..+/i;
    return regular.test(mail);
}

/* Функция для валидации телефона */
window.validPhone = function(phone) {
    let regular = /^((8|\+7)[\- ]?)?(\(?\d{3,4}\)?[\- ]?)?[\d\- ]{6,10}$/;
    return regular.test(phone);
}

/* Функция для валидации даты */
window.validDate = function(date) {
    let regular = /^\d{2}\.\d{2}\.\d{4}$/
    return regular.test(date);
}

/* Функция для валидации координат для рассчёта API Yandex maps */
window.validCoords = function(coordsStr) {
    let regular = /^\[\d{2}\.\d+,\d{2}\.\d+\]$/  // [55.90356412305141,37.3824537177734]
    return regular.test(coordsStr);
}

/* Функция возвращает координаты элемента в контексте документа */
window.getCoords = function(elem) {
    let box = elem.getBoundingClientRect();

    return {
        top: box.top + pageYOffset,
        left: box.left + pageXOffset
    };
}

/* Функция данных полей с числовыми значениями */
window.editValue = function(direction, curValue) {
    let newValue = curValue === ""
        ? 0
        : direction
            ? Number(curValue) + 1
            : Number(curValue) - 1;

    return newValue < 0 ? 0 : newValue;
}

/**
 * IE11 не поддерживает promise, поэтому некорректно отрабатывает запрос
 * route в  АПИ Яндекс карт (он построен на promise),
 * https://yandex.ru/dev/maps/jsapi/doc/2.1/ref/reference/route.html
 * внутри ответа (then) не виден конкретный завод по которому рассчитвыем
 * маршур (внтури перебираемого цикла for номер завода всегда последний + 1).
 * Для того чтобы определить завод по которому
 * производятся рассчёты, используем функциию catchFactory в которую
 * передаём рассчитанный rout который вернул АПИ Яндекс карт. В возвращаемом
 * ответе есть координаты завода, используемые для расчёта. Даллее в массиве
 * с заводами находим завод с этими координатами и возвращаем его из функции.
 */
window.catchFactory = function(coords, factories) {
    for (let i in factories) {
        const factoryCoords = JSON.parse(factories[i]['coordinates']);

        if (coords[0] === factoryCoords[0]
            && coords[1] === factoryCoords[1]) {

            return i;
        }
    }
}

document.addEventListener("DOMContentLoaded",function() {
    const body = document.body;
    const dropLinks = document.querySelectorAll(".products__link.drop");
    const navLinks = document.querySelectorAll(".nav__item.drop");
    let windowWidth = window.innerWidth;

    function closeAccordion() {
        for (let i = 0; i < dropLinks.length; i++) {
            dropLinks[i]
                .parentElement
                .classList
                .remove('visible');
        }

        for (let i = 0; i < navLinks.length; i++) {
            navLinks[i]
                .classList
                .remove('visible');
        }
    }

    window.addEventListener('resize', function() {
        windowWidth = window.innerWidth;

        if (windowWidth >= 768) {
            replaceCart(true) // replace cart to top
            replaceOperating(true) // Replace operating after initial page
        } else {
            replaceCart(false);  // replace cart to bottom
            replaceOperating(false);
        }

        if (windowWidth >= 1250) {
            replaceNav(true) // replace nav after logo
        } else {
            replaceNav(false);
        }

        // Сворачиваем все дроп меню
        // for (let j = 0; j < dropLinks.length; j++) {
        //     dropLinks[j]
        //         .parentElement
        //         .classList
        //         .remove('visible');
        // }

        // Скрываем навигацию,телефон и выбор города в шапке
        // body.classList.remove('phone-visible');
        // body.classList.remove('nav-visible');
        // region.classList.remove("city-select-visible");
    });

    /* Переключенние телефона в шапке сайта на мобильной версии */
    headerPhoneBtn.addEventListener('click', function() {
        body.classList.toggle('phone-visible');
        body.classList.remove('nav-visible');
        region.classList.remove("city-select-visible");

        closeAccordion();
    });

    /* Переключаем навигацию в шапке сайта на мибильных экранах */
    navTgglr.addEventListener('click', function() {
        body.classList.toggle('nav-visible');
        body.classList.remove('phone-visible');
        region.classList.remove("city-select-visible");

        closeAccordion();
    });

    /* Преключаем город в шапке сайта на моибильных экранах */
    region.addEventListener("click", function(event) {
        let el = event.target;

        if (el.closest('#region')) {
            region.classList.toggle("city-select-visible");
        }

        body.classList.remove('phone-visible');
        body.classList.remove('nav-visible');

        closeAccordion();
    });

    /* Обработка переноса и клика корзины в шапке сайта */
    const headerTop = document
        .querySelector("#headerTop .header__top__body");

    function replaceCart(move) {
        move
            ? headerTop.appendChild(cart)
            : headerBottom.appendChild(cart);
    }

    /* Ставим корзину в нужное место после инициализации страницы */
    windowWidth >= 768
        ? replaceCart(true)
        : replaceCart(false);

    /* Перенос рабочего времени в шапке сайта на моибльной версиии */
    function replaceOperating(move) {
        move
            ? headerBottom.appendChild(operating)
            : body.prepend(operating);
    }

    /* Ставим рабочее время в нужное место при инициализации */
    windowWidth >= 768
        ? replaceOperating(true)
        : replaceOperating(false);

    /* Перенос навигации в шапке сайта на мобильной версии */
    function replaceNav(move) {
        if (move) {
            prodContainer.appendChild(nav);
            navContainer.appendChild(headerTopNav);
        } else {
            nav.appendChild(headerTopNav);
            headerBottomContainer.prepend(nav);
        }
    }

    windowWidth >= 1250
        ? replaceNav(true)
        : replaceNav(false);

    /* Акоордион для навигации в шапке сайта на мобильной версии */
    if (windowWidth <= 1250) {
        for (let i = 0; i < dropLinks.length; i++) {
            dropLinks[i].addEventListener('click', function (event) {
                event.preventDefault();

                let prntClasses = event.target.parentElement.classList;
                let isVisible = prntClasses.contains('visible');

                closeAccordion();

                isVisible
                    ? prntClasses.remove('visible')
                    : prntClasses.add('visible');
            });
        }

        for (let i = 0; i < navLinks.length; i++) {
            navLinks[i].addEventListener('click', function (event) {
                const elClasses = event.target.classList;
                const isVisible = elClasses.contains('visible');

                closeAccordion();

                isVisible
                    ? elClasses.remove('visible')
                    : elClasses.add('visible');
            });
        }
    }

    /* FAQ Аккордеон */
    const faqLinks = document.getElementsByClassName("faq__item");

    function closeFaqAccordion() {
        for (let i = 0; i < faqLinks.length; i++) {
            faqLinks[i].classList.remove("visible");
        }
    }

    if (faqLinks.length > 0) {
        for (let i = 0; i < faqLinks.length; ++i) {
            faqLinks[i].addEventListener('click', function(event) {
                let li = event.target.closest('li');
                let isVisible = li.classList.contains('visible');

                closeFaqAccordion();

                isVisible
                    ? li.classList.remove('visible')
                    : li.classList.add('visible');
            });
        }
    }


    /* Обработка изменения Инпут полей для выбора файла */
    const inputsFile = document.querySelectorAll(".label_file input");

    for (let i = 0; i < inputsFile.length; i++) {
        const controller = inputsFile[i].nextElementSibling;

        inputsFile[i].addEventListener('change', function (event) {
            controller.innerHTML = event.target.value.split('\\').pop();
        });
    }


    /* Показываем и скрываем модальные окна */
    const btns = document.getElementsByClassName('show-modal');

    function toggleModal(modal, action) {
        if (action) {
            body.classList.add("modal-open");
            modal.classList.add("show");
        } else {
            const modalDialog = modal.getElementsByClassName("modal__dialog")[0];

            body.classList.remove("modal-open");
            modal.classList.remove("show");
            modalDialog.classList.remove('hide');

            const modalsResult = document.getElementsByClassName('send-msg-true');
            const errors = modalDialog.getElementsByClassName("err__msg");
            const labels = modalDialog.getElementsByClassName("label");
            const inputs = modalDialog.getElementsByClassName("input");
            const texts = modalDialog.getElementsByClassName("textarea");
            const files = modalDialog.querySelectorAll('input[type="file"]');
            const selects = modalDialog.getElementsByClassName("select");

            // Отдельно чистим поле с ценой расчёт аредны бетононасоса
            const rentPumpResult = document.getElementById('formRentPumpResult');

            if (modalsResult.length > 0) {
                for (let i = 0; i < modalsResult.length; i++) {
                    modalsResult[i].classList.remove('visible');
                }
            }

            if (errors.length > 0) {
                for (let i = 0; i < errors.length; i++) {
                    errors[i].innerHTML = '';
                }
            }

            if (labels.length > 0) {
                for (let i = 0; i < labels.length; i++) {
                    labels[i].classList.remove("has__error");
                }
            }

            if (inputs.length > 0) {
                for (let i = 0; i < inputs.length; i++) {
                    inputs[i].value = '';
                }
            }

            if (texts.length > 0) {
                for (let i = 0; i < texts.length; i++) {
                    texts[i].value = '';
                }
            }

            if (files.length > 0) {
                for (let i = 0; i < files.length; i++) {
                    files[i].nextElementSibling.innerHTML = '';
                }
            }

            if (selects.length > 0) {
                for (let i = 0; i < selects.length; i++) {
                    for (let j = 0; j < selects[i].options.length; j++) {
                        selects[i].options[j].selected = j === 0;
                    }
                }
            }

            if (rentPumpResult) {
                rentPumpResult.innerText = '0';
            }
        }
    }

    for (let i = 0; i < btns.length; i++) {
        btns[i].addEventListener('click', function(event) {
            event.preventDefault();

            const modalId = event.target.dataset.modalId;
            const modal = document.getElementById(modalId);

            if (modal) {
                const btnClose = modal.querySelector(".modal__close");

                btnClose.addEventListener("click",
                    function() { toggleModal(modal, false); } );

                modal.addEventListener("click", function (event) {
                    if (event.target.id ===  modalId) {
                        toggleModal(modal, false);
                    }
                });

                toggleModal(modal, true);
            }
        });
    }


    /* Показываем/скрываем комменты к товару на странице с карточкой товара */
    const tgglr = document.querySelector(".description__toggler");

    if (tgglr) {
        const prodTxt = tgglr.closest(".description");

        tgglr.addEventListener("click", function() {
            prodTxt.classList.toggle("show");

            tgglr.innerHTML === "Развернуть"
                ? tgglr.innerHTML = "Свернуть"
                : tgglr.innerHTML = "Развернуть";
        });
    }


    /* Обработка кликов вне элементов */
    document.addEventListener("click",  function(event) {
        const el = event.target.parentElement;

        if (!el.closest('#region')) {
            region.classList.remove("city-select-visible");
        }

    });


    /* Слайдер для маленьких картинок на страницах Лаборатория и Товарный бетон */
    const pics = document.querySelectorAll(".sml-img-slider__item");

    for (let i = 0; i < pics.length; i++) {
        pics[i].addEventListener("click",  function (event) {
            const el = event.target;

            if (el.classList.contains("back")) {
                const before = el.previousElementSibling;
                const after = el.nextElementSibling;
                const parent = el.parentElement;

                if (after) {
                    before.classList.remove("front");
                    el.classList.remove("back");
                    el.classList.add("front");
                    after.classList.add("back");
                    parent.append(before);
                } else {
                    before.classList.remove("front");
                    before.classList.add("back");
                    el.classList.remove("back");
                    el.classList.add("front");
                    parent.append(before);
                }
            }
        });
    }


    /* Аккордеон для блока с описанием предприятия на странице Производство -> Щебень */
    const bsBtns = document.querySelectorAll(".breakstone__accordion-caption");
    const bsTxts = document.querySelectorAll(".breakstone__accordion-content");

    function closeBreakstoneAccordion() {
        for (let i = 0; i < bsBtns.length; i++) {
            bsBtns[i].classList.remove("active");
            bsTxts[i].classList.remove("visible");
        }
    }

    for (let i = 0; i < bsBtns.length; i++) {
        bsBtns[i].addEventListener("click",  function(event) {
            const el = event.target;
            const elCaptionMark = '[data-caption-for="' + el.dataset.captionMark + '"]';
            const elContent = el.parentElement.querySelector(elCaptionMark);

            // Off oll buttons and all content blocks
            if (!el.classList.contains("active")) {
                closeBreakstoneAccordion();
            }

            el.classList.toggle("active");
            elContent.classList.toggle("visible");
        });
    }


    /*
     * Работа с городом пользователя в шапке сайта.
     *
     * Смтотрим город в Cookies, елси его нет, то создаём перемунную
     * с городом по умолчанюи (Москва).
     *
     * Размещаем город по умолчанию в выпадающем меню выбора города в хедере.
     * */
    // Функция возвращает куки с указанным name, или undefined, если ничего не найдено
    function getCookie(name) {
        let matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    // Устанавливаем город по умолчанию в Cookies, если его там нет
    if(!getCookie('usrCity')) {
        let date = new Date(Date.now() + 2.628e+9);
        date = date.toUTCString();
        document.cookie = "usrCity=Москва; path=/; expires=" + date;
    }

    // Меняем город пользователя по клику на пунке города в выпадающем меню в хедере
    let cities = document.querySelectorAll(".region__item");
    let cityContainer = document.getElementById("regionCity");

    function activeSelectedCity() {
        let usrCity = getCookie('usrCity');
        let cityItems = document.getElementsByClassName("region__item");

        for (let i = 0; i < cityItems.length; i++) {
            usrCity === cityItems[i].dataset.regionCity
                ? cityItems[i].classList.add('active')
                : cityItems[i].classList.remove('active');
        }
    }

    // Размещаем город пользователя как выбранный в хедере
    cityContainer.innerHTML = getCookie('usrCity');

    // Делаем выбранный город пользователя скрытым при инициализации страницы
    activeSelectedCity();

    for (let i = 0; i < cities.length; i++) {
        cities[i].addEventListener("click", function(event) {
            let cityItem = event.target.closest(".region__item");

            // Получаем город по которому кликнул пользователь
            let city = cityItem.dataset.regionCity
                ? cityItem.dataset.regionCity
                : event.target.closest(".region__item").dataset.regionCity;

            // Меняем город в контейнере
            cityContainer.innerHTML = city;

            // Меняем город пользователя в localStorage
            let date = new Date(Date.now() + 2.628e+9);
            date = date.toUTCString();
            document.cookie = "usrCity=" + city + "; path=/; expires=" + date;

            activeSelectedCity();
        });
    }


    /* Yandex maps
     * Функция ymaps.ready() будет вызвана, когда загрузятся все
     * компоненты API, а также когда будет готово DOM-дерево.
     */
    if (document.getElementById("indexMap")
        || document.getElementById("contactsMap")
        || document.getElementById("deliveryMap")) {
        ymaps.ready(init);
    }
    function init() {
        // Создаём метки один раз, а длее пушим их в нужную карту
        const myPlacemarkMsk = new ymaps.Placemark(
            [55.77380806896347,37.50681899999997],
            {
                balloonContentHeader: "АО «Евробетон»<br>Головной офис в Москве",
                balloonContentBody: "123308, Россия, г. Москва,<br>Силикатный проезд, д. 10, стр. 15"
            },
            {
                iconLayout: 'default#image',
                iconImageHref: '/local/templates/.default/img/mark-contacts.png',
                iconImageSize: [179, 44],
                iconImageOffset: [-15, -44]
            });
        const myPlacemarkKstovo = new ymaps.Placemark(
            [56.179510068572036,44.15730749999993],
            {
                balloonContentHeader: "Кстовский филиал",
                balloonContentBody: "г. Кстово, ул. Магистральная, д. 1"
            },
            {
                iconLayout: 'default#image',
                iconImageHref: '/local/templates/.default/img/mark.png',
                iconImageSize: [36, 43],
                iconImageOffset: [-15, -43]
            });
        const myPlacemarkLipetsk = new ymaps.Placemark(
            [52.60358425779388,39.59623749999995],
            {
                balloonContentHeader: "Липецкий филиал",
                balloonContentBody: "г. Липецк, район Цемзавода, 398027"
            },
            {
                iconLayout: 'default#image',
                iconImageHref: '/local/templates/.default/img/mark.png',
                iconImageSize: [36, 43],
                iconImageOffset: [-15, -43]
            });
        const myPlacemarkGranitstroy = new ymaps.Placemark(
            [56.00991906873449,37.436966],
            {
                balloonContentHeader: "Гранитстрой",
                balloonContentBody: "г. Лобня, Краснополянский проезд, д. 5"
            },
            {
                iconLayout: 'default#image',
                iconImageHref: '/local/templates/.default/img/mark.png',
                iconImageSize: [36, 43],
                iconImageOffset: [-15, -43]
            });
        const myPlacemarkStroyRegion = new ymaps.Placemark(
            [56.86988406782098,60.59384549999995],
            {
                balloonContentHeader: "ООО «СтройРегион-Трейд ЕК»",
                balloonContentBody: "г. Екатеринбург, ул. Артинская, д. 18"
            },
            {
                iconLayout: 'default#image',
                iconImageHref: '/local/templates/.default/img/mark.png',
                iconImageSize: [36, 43],
                iconImageOffset: [-15, -43]
            });
        const myPlacemarkEvrobeton = new ymaps.Placemark(
            [55.77380806896347,37.50681899999997],
            {
                balloonContentHeader: "Москва: ЖБИ АО «Евробетон»",
                balloonContentBody: "г. Москва, 3-й Силикатный проезд, д. 10 , стр. 15"
            },
            {
                iconLayout: 'default#image',
                iconImageHref: '/local/templates/.default/img/mark.png',
                iconImageSize: [36, 43],
                iconImageOffset: [-15, -43]
            });
        const myPlacemarkMedvedkovo = new ymaps.Placemark(
            [55.88525156886214,37.62130049999999],
            {
                balloonContentHeader: "Филиала Медведково АО «ЕВРОБЕТОН»",
                balloonContentBody: "ул. Чермянская, д.5"
            },
            {
                iconLayout: 'default#image',
                iconImageHref: '/local/templates/.default/img/mark.png',
                iconImageSize: [36, 43],
                iconImageOffset: [-15, -43]
            });

        // Карта на Главной старнице
        if (document.getElementById("indexMap")) {
            const map = new ymaps.Map("indexMap", {
                // Координаты центра карты.
                // Порядок по умолчанию: «широта, долгота».
                // Чтобы не определять координаты центра карты вручную,
                // воспользуйтесь инструментом Определение координат.
                center: [55.38046857198313,41.687034406250014],
                // Уровень масштабирования. Допустимые значения:
                // от 0 (весь мир) до 19.
                zoom: 6,
                controls: [],
            });
            // Пушим метки заводов в карту на главной странице (indexMap)
            map.geoObjects
                .add(myPlacemarkKstovo)
                .add(myPlacemarkLipetsk)
                .add(myPlacemarkGranitstroy)
                .add(myPlacemarkEvrobeton)
                .add(myPlacemarkMedvedkovo)
                .add(myPlacemarkStroyRegion);
            map.controls.add('zoomControl');
            map.behaviors.disable('scrollZoom');
        }

        // Карта на старнице Контакты
        if (document.getElementById("contactsMap")) {
            const map = new ymaps.Map("contactsMap", {
                center: [55.77380806896347,37.50681899999997],
                zoom: 16,
                controls: [],
            });
            map.geoObjects.add(myPlacemarkMsk);
            map.controls.add('zoomControl');
            map.behaviors.disable('scrollZoom');
        }
    }


    // Yandex maps на страницах Производство бетона и Производства щебня бетона товарного
    if (document.getElementById("prodMap")) {
        const btnsOpenMap = document.getElementsByClassName("open-map");
        const prodMap = document.getElementById('prodMap');
        const btnClose = document.getElementById('prodMapCloser');

        btnClose.addEventListener('click', function() {
            prodMap.classList.remove('visible');
        });

        // Создаём карту
        ymaps.ready( function() {
            const prodYaMap = new ymaps.Map("prodMap", {
                // Координаты центра карты.
                // Порядок по умолчанию: «широта, долгота».
                // Чтобы не определять координаты центра карты вручную,
                // воспользуйтесь инструментом Определение координат.
                center: [55.75652310301268,37.616237390624995],
                // Уровень масштабирования. Допустимые значения:
                // от 0 (весь мир) до 19.
                zoom: 5,
                controls: ['default', 'routeButtonControl'],
            });

            // Собираем метки и добавляем на карту
            for (let i = 0; i < btnsOpenMap.length; i++) {
                const coordinate = btnsOpenMap[i].dataset.coord;
                const hint = btnsOpenMap[i].dataset.hintDesc;

                const myPlacemark = new ymaps.Placemark(
                    JSON.parse(coordinate),
                    { balloonContentBody: hint },
                    {
                        iconLayout: 'default#imageWithContent',
                        iconImageHref: '/local/templates/.default/img/mark.png',
                        iconImageSize: [36, 43],
                        iconImageOffset: [-15, -43]
                    }
                );
                // Добавляем созданную метку на карту
                prodYaMap.geoObjects.add(myPlacemark);
            }

            prodYaMap.behaviors.disable('scrollZoom');

            // Открываем крту при клике на люой из кнопок
            for (let i = 0; i < btnsOpenMap.length; i++) {
                btnsOpenMap[i].addEventListener('click', function(evt) {
                    evt.preventDefault();
                    prodMap.classList.add('visible');

                    let local = evt.target.dataset.coord; // Забираем координаты из кнопки
                    local = JSON.parse(local);
                    prodYaMap.setZoom(18,{smooth:true,centering:true}); //Увеличиваем карту до нужного размера
                    prodYaMap.panTo(local); //Перемещаем карту к нужной метке
                });
            }
        });
    }


    // Обработчик отправки формы Сообщение с сайта
    if (document.getElementById('formFeedback')) {
        const name          = document.getElementById('formFeedbackName');
        const mail          = document.getElementById('formFeedbackMail');
        const phone         = document.getElementById('formFeedbackPhone');
        const msg           = document.getElementById('formFeedbackMsg');
        const modalSetOrder = document.getElementById('modalSetOrder');
        const modalBody     = document.getElementById('modalDialogFeedback');
        const sendMsgTrue   = document.getElementById("sendMsgTrue");

        function cleanErrs(name, mail, phone, msg) {
            // Чистим контейнеры для сообщений об ошибках
            name.nextSibling.innerHTML = '';
            mail.nextSibling.innerHTML = '';
            phone.nextSibling.innerHTML = '';
            msg.nextSibling.innerHTML = '';

            // Удаляем класс ошибки у родительского узла
            name.parentElement.classList.remove('has__error');
            mail.parentElement.classList.remove('has__error');
            phone.parentElement.classList.remove('has__error');
            msg.parentElement.classList.remove('has__error');
        }

        function cleanFields(name, mail, phone, msg) {
            name.value = '';
            mail.value = '';
            phone.value = '';
            msg.value = '';
        }

        function feedbackFunctionSubmit() {
            cleanErrs(name, mail, phone, msg);
            let formValid = true;

            if (msg.value === '') {
                let err = msg.nextElementSibling;
                err.innerHTML = 'Напишите вопрос';
                msg.parentElement.classList.add('has__error');
                msg.focus();
                formValid = false;
            }

            if (phone.value === '') {
                let err = phone.nextElementSibling;
                err.innerHTML = 'Укажите телефон';
                phone.parentElement.classList.add('has__error');
                formValid = false;
                phone.focus();
            } else {
                if (validPhone(phone.value) === false) {
                    let err =  phone.nextElementSibling;
                    err.innerHTML = 'Некорректный телефон';
                    phone.parentElement.classList.add('has__error');
                    formValid = false;
                    phone.focus();
                }
            }

            if (mail.value === '') {
                let err =  mail.nextElementSibling;
                err.innerHTML = 'Укажите e-mail';
                mail.parentElement.classList.add('has__error');
                formValid = false;
                mail.focus();
            } else {
                if (validMail(mail.value) === false) {
                    let err =  mail.nextElementSibling;
                    err.innerHTML = 'Некорректный e-mail';
                    mail.parentElement.classList.add('has__error');
                    formValid = false;
                    mail.focus();
                }
            }

            if (name.value === '') {
                let err =  name.nextElementSibling;
                err.innerHTML = 'Укажите имя';
                name.parentElement.classList.add('has__error');
                name.focus();
                formValid = false;
            }

            if (formValid) {
                spinner.classList.add('visible');

                $.post(
                    formFeedback.action,
                    $('#formFeedback').serializeArray(),
                    "json"
                ).done(function (response) {
                    if (response['IS_ERRORS']) {
                        alert('Сообщение не отправлено. Произошла ошибка. Попробуйте немного позже.');
                    } else {
                        cleanFields(name, mail, phone, msg);
                        modalBody.classList.add('hide');
                        sendMsgTrue.classList.add("visible");
                    }
                }).fail(function() {
                    console.log('Сообщение не отправлено. Произошла ошибка. Попробуйте немного позже.');
                }).always(function () {
                    spinner.classList.remove('visible');
                });
            }
        }

        btnFFClose
            .addEventListener("click", function () {
                toggleModal(modalSetOrder, false);
            });

        btnFFSubmit
            .addEventListener('click', function () {
                feedbackFunctionSubmit();
            });

        $('#formFeedback').submit(function () {
            feedbackFunctionSubmit();
            return false;
        });
    }


    // Обработчик отправки формы "Записать на собеседование"
    if (document.getElementById('formVacancy')) {
        const nameVacancy        = document.getElementById('formVacancyName');
        const birthdayVacancy    = document.getElementById('formVacancyBirthday');
        const phoneVacancy       = document.getElementById('formVacancyPhone');
        const emailVacancy       = document.getElementById('formVacancyEmail');
        const positionVacancy    = document.getElementById('formVacancyPosition');
        const questionaryVacancy = document.getElementById('formVacancyQuestionary');
        const photoVacancy       = document.getElementById('formVacancyPhoto');

        function cleanErrsVacancy (
            name, birthday, phone,
            email, position, questionary,
            photo) {

            // Чистим контейнеры для сообщений об ошибках
            name.nextSibling.innerHTML = '';
            birthday.nextSibling.innerHTML = '';
            phone.nextSibling.innerHTML = '';
            email.nextSibling.innerHTML = '';
            position.nextSibling.innerHTML = '';
            questionary.nextSibling.nextSibling.innerHTML = ''; // у этого инпута span с ошибкой стоит чере одно поле, которое служит для отображения выбранного файла
            photo.nextSibling.nextSibling.innerHTML = ''; // у этого инпута span с ошибкой стоит чере одно поле, которое служит для отображения выбранного файла

            // Удаляем класс ошибки у родительского узла
            name.parentElement.classList.remove('has__error');
            birthday.parentElement.classList.remove('has__error');
            phone.parentElement.classList.remove('has__error');
            email.parentElement.classList.remove('has__error');
            position.parentElement.classList.remove('has__error');
            questionary.parentElement.classList.remove('has__error');
            photo.parentElement.classList.remove('has__error');
        }

        function cleanFieldsVacancy (
            name, birthday, phone,
            email, position, questionary,
            photo) {
            name.value = '';
            birthday.value = '';
            phone.value = '';
            email.value = '';
            position.value = '';
            questionary.value = '';
            photo.value = '';
            questionary.nextElementSibling.innerHTML = '';
            photo.nextElementSibling.innerHTML = '';
        }

        function vacancyFunctionSubmit() {
            cleanErrsVacancy(
                nameVacancy, birthdayVacancy, phoneVacancy,
                emailVacancy, positionVacancy, questionaryVacancy,
                photoVacancy);

            let formValid = true;

            questionaryVacancy.nextElementSibling.innerHTML = questionaryVacancy.value.split('\\').pop();
            photoVacancy.nextElementSibling.innerHTML = photoVacancy.value.split('\\').pop();

            // Фото можно не добавлять, нет проверки на пустое поле.
            if (photoVacancy.value !== '') {
                let type = photoVacancy
                    .files[0]
                    .name
                    .split(".")
                    .splice(-1,1)[0];

                if (!(type === 'jpg' || type === 'gif' || type === 'bmp' || type === 'png' || type === 'jpeg')) {
                    let err =  photoVacancy.nextElementSibling.nextElementSibling;
                    err.innerHTML = 'Выбранный файл - не картинка. Допускаются файлы jpg, gif, bmp, png, jpeg';
                    photoVacancy.parentElement.classList.add('has__error');
                    formValid = false;
                }
            }

            if (questionaryVacancy.value !== '') {
                let type = questionaryVacancy
                    .files[0]
                    .name
                    .split(".")
                    .splice(-1,1)[0];

                if (!(type === 'txt' || type === 'doc' || type === 'docx' || type === 'rtf' || type === 'pdf')) {
                    let err =  questionaryVacancy.nextElementSibling.nextElementSibling;
                    err.innerHTML = 'Ошибка формата. Допускаются txt, doc, docx, rtf, pdf';
                    questionaryVacancy.parentElement.classList.add('has__error');
                    formValid = false;
                }
            }

            if (positionVacancy.value === '') {
                let err = positionVacancy.nextElementSibling;
                err.innerHTML = 'Укажите желаемую должность';
                positionVacancy.parentElement.classList.add('has__error');
                positionVacancy.focus();
                formValid = false;
            }

            if (emailVacancy.value === '') {
                let err = emailVacancy.nextElementSibling;
                err.innerHTML = 'Укажите Ваш Емэйл';
                emailVacancy.parentElement.classList.add('has__error');
                emailVacancy.focus();
                formValid = false;
            } else {
                if (validMail(emailVacancy.value) === false) {
                    let err =  emailVacancy.nextElementSibling;
                    err.innerHTML = 'Емэйл указан некорректно';
                    emailVacancy.parentElement.classList.add('has__error');
                    emailVacancy.focus();
                    formValid = false;
                }
            }

            if (phoneVacancy.value === '') {
                let err = phoneVacancy.nextElementSibling;
                err.innerHTML = 'Укажите Ваш телефон';
                phoneVacancy.parentElement.classList.add('has__error');
                phoneVacancy.focus();
                formValid = false;
            } else {
                if (validPhone(phoneVacancy.value) === false) {
                    let err =  phoneVacancy.nextElementSibling;
                    err.innerHTML = 'Телефон указан некорректно';
                    phoneVacancy.parentElement.classList.add('has__error');
                    phoneVacancy.focus();
                    formValid = false;
                }
            }

            if (birthdayVacancy.value === '') {
                let err = birthdayVacancy.nextElementSibling;
                err.innerHTML = 'Укажите дату рождения';
                birthdayVacancy.parentElement.classList.add('has__error');
                birthdayVacancy.focus();
                formValid = false;
            } else {
                if (validDate(birthdayVacancy.value) === false) {
                    let err =  birthdayVacancy.nextElementSibling;
                    err.innerHTML = 'Формат даты должен быть ДД.ММ.ГГГГ';
                    birthdayVacancy.parentElement.classList.add('has__error');
                    birthdayVacancy.focus();
                    formValid = false;
                }
            }

            if (nameVacancy.value === '') {
                let err = nameVacancy.nextElementSibling;
                err.innerHTML = 'Заполните поле имя';
                nameVacancy.parentElement.classList.add('has__error');
                nameVacancy.focus();
                formValid = false;
            }

            if (formValid) {
                spinner.classList.add('visible');

                $.ajax({
                    url: formVacancy.action,
                    type: "POST",
                    dataType: "JSON",
                    data: new FormData(formVacancy),
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response['IS_ERRORS']) {
                            alert('Данные не добавлены. Ошибка сервера. Попробуйте немного позже.');
                        } else {
                            cleanFieldsVacancy(
                                nameVacancy, birthdayVacancy, phoneVacancy,
                                emailVacancy, positionVacancy, questionaryVacancy,
                                photoVacancy);

                            const modalDialog = modalVacancy.getElementsByClassName('send-msg-true')[0];

                            modalVacancy.classList.add('show');
                            body.classList.add('modal-open');
                            modalDialog.classList.add('visible');

                            btnVacancyClose.addEventListener('click', function () {
                                modalVacancy.classList.remove('show');
                                body.classList.remove('modal-open');
                                modalDialog.classList.remove('visible');
                            });
                        }
                    },
                    error: function (xhr, desc, err) {
                        console.log('Данные не добавлены. Произошла ошибка. Попробуйте немного позже.');
                        console.log(desc, err);
                    },
                    complete: function () {
                        spinner.classList.remove('visible');
                    }
                });
            }
        }

        $('#formVacancy').submit(function () {
            vacancyFunctionSubmit();
            return false;
        });
    }


    // Обработчик отправки формы Заявка на тендер
    if (document.getElementById('formRequestTender')) {
        const nameRequestTender     = document.getElementById('formRequestTenderName');
        const addressRequestTender  = document.getElementById('formRequestTenderAddress');
        const directorRequestTender = document.getElementById('formRequestTenderDirector');
        const ogrnRequestTender     = document.getElementById('formRequestTenderOgrn');
        const phoneRequestTender    = document.getElementById('formRequestTenderPhone');
        const mailRequestTender     = document.getElementById('formRequestTenderMail');
        const docsRequestTender     = document.getElementById('formRequestTenderDocs');
        const moneyRequestTender    = document.getElementById('formRequestTenderMoney');

        function cleanErrsRequestTender (
            name, address, director,
            ogrn, phone, mail, docs,
            money) {
            // Чистим контейнеры для сообщений об ошибках
            name.nextSibling.innerHTML = '';
            address.nextSibling.innerHTML = '';
            director.nextSibling.innerHTML = '';
            ogrn.nextSibling.innerHTML = '';
            phone.nextSibling.innerHTML = '';
            mail.nextSibling.innerHTML = '';
            money.nextSibling.innerHTML = '';
            docs.nextSibling.nextSibling.nextSibling.innerHTML = ''; // у этого инпута span с ошибкой стоит чере одно поле, которое служит для отображения выбранного файла

            // Удаляем класс ошибки у родительского узла
            name.parentElement.classList.remove('has__error');
            address.parentElement.classList.remove('has__error');
            director.parentElement.classList.remove('has__error');
            ogrn.parentElement.classList.remove('has__error');
            phone.parentElement.classList.remove('has__error');
            mail.parentElement.classList.remove('has__error');
            name.parentElement.classList.remove('has__error');
            money.parentElement.classList.remove('has__error');
            docs.parentElement.classList.remove('has__error');
        }

        function cleanFieldsRequestTender (
            name, address, director,
            ogrn, phone, mail, docs,
            money) {
            name.value = '';
            address.value = '';
            director.value = '';
            ogrn.value = '';
            phone.value = '';
            mail.value = '';
            money.value = '';
            docs.nextElementSibling.innerHTML = '';
        }

        function tenderFunctionSubmit() {
            cleanErrsRequestTender(
                nameRequestTender, addressRequestTender,
                directorRequestTender, ogrnRequestTender,
                phoneRequestTender, mailRequestTender,
                docsRequestTender, moneyRequestTender);

            let formValid = true;

            if (moneyRequestTender.value === '') {
                let err =  moneyRequestTender.nextElementSibling;
                err.innerHTML = 'Укажите сумму';
                moneyRequestTender.parentElement.classList.add('has__error');
                moneyRequestTender.focus();
                formValid = false;
            }

            if (docsRequestTender.value !== '') {
                let type = docsRequestTender
                    .files[0]
                    .name
                    .split(".")
                    .splice(-1,1)[0];

                if (!(type === '7z' || type === 'gzip' || type === 'rar' || type === 'zip' || type === 'gz')) {
                    let err =  docsRequestTender.nextElementSibling.nextElementSibling;
                    err.innerHTML = 'Не корректный формат файла. Необходимо выбрать архив. Допускаются форматы 7z, gz, gzip, rar, zip';
                    docsRequestTender.parentElement.classList.add('has__error');
                    formValid = false;
                }
            }

            if (mailRequestTender.value === '') {
                let err =  mailRequestTender.nextElementSibling;
                err.innerHTML = 'Укажите Е-mail';
                mailRequestTender.parentElement.classList.add('has__error');
                formValid = false;
                mailRequestTender.focus();
            } else {
                if (validMail(mailRequestTender.value) === false) {
                    let err =  mailRequestTender.nextElementSibling;
                    err.innerHTML = 'Некорректный Еmail';
                    mailRequestTender.parentElement.classList.add('has__error');
                    formValid = false;
                    mailRequestTender.focus();
                }
            }

            if (directorRequestTender.value === '') {
                let err = directorRequestTender.nextElementSibling;
                err.innerHTML = 'Укажите ФИО директора';
                directorRequestTender.parentElement.classList.add('has__error');
                directorRequestTender.focus();
                formValid = false;
            }

            if (phoneRequestTender.value === '') {
                let err = phoneRequestTender.nextElementSibling;
                err.innerHTML = 'Укажите телефон';
                phoneRequestTender.parentElement.classList.add('has__error');
                formValid = false;
                phoneRequestTender.focus();
            } else {
                if (validPhone(phoneRequestTender.value) === false) {
                    let err =  phoneRequestTender.nextElementSibling;
                    err.innerHTML = 'Некорректный телефон';
                    phoneRequestTender.parentElement.classList.add('has__error');
                    formValid = false;
                    phoneRequestTender.focus();
                }
            }

            if (addressRequestTender.value === '') {
                let err = addressRequestTender.nextElementSibling;
                err.innerHTML = 'Укажите адрес';
                addressRequestTender.parentElement.classList.add('has__error');
                addressRequestTender.focus();
                formValid = false;
            }

            if (ogrnRequestTender.value === '') {
                let err = ogrnRequestTender.nextElementSibling;
                err.innerHTML = 'Укажите ОГРН';
                ogrnRequestTender.parentElement.classList.add('has__error');
                ogrnRequestTender.focus();
                formValid = false;
            }

            if (nameRequestTender.value === '') {
                let err = nameRequestTender.nextElementSibling;
                err.innerHTML = 'Укажите наименование';
                nameRequestTender.parentElement.classList.add('has__error');
                nameRequestTender.focus();
                formValid = false;
            }

            if (formValid) {
                spinner.classList.add('visible');

                $.ajax({
                    url: formRequestTender.action,
                    type: "POST",
                    dataType: "JSON",
                    data: new FormData(formRequestTender),
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response['IS_ERRORS']) {
                            alert('Заявка на тендер не отправлена. Ошибка сервера. Попробуйте немного позже.');
                        } else {
                            cleanFieldsRequestTender(
                                nameRequestTender, addressRequestTender,
                                directorRequestTender, ogrnRequestTender,
                                phoneRequestTender, mailRequestTender,
                                docsRequestTender, moneyRequestTender);

                            let modal = document.getElementById('modalRequestTender');
                            let modalDialog = document.getElementById('modalDialogRequestTender');
                            let sendRequestTenderTrue = document.getElementById("sendMsgRequestTenderTrue");
                            let btnClose = document.getElementById('btnMRTClose');

                            modalDialog.classList.add('hide');
                            sendRequestTenderTrue.classList.add("visible");

                            btnClose.addEventListener('click', function() {
                                modal.classList.remove('show');
                                body.classList.remove('modal-open');
                                modalDialog.classList.remove('hide');
                                sendRequestTenderTrue.classList.remove("visible");
                            });
                        }
                    },
                    error: function (xhr, desc, err) {
                        console.log('Заявка на тендер не отправлена. Произошла ошибка. Попробуйте немного позже.');
                        console.log(desc, err);
                    },
                    complete: function () {
                        spinner.classList.remove('visible');
                    }
                });
            }
        }

        btnFTSubmit
            .addEventListener('click', function () {
                tenderFunctionSubmit();
            });

        $('#formRequestTender').submit(function () {
            tenderFunctionSubmit();
            return false;
        });
    }


    // Блокируем ссылки/пункты меню Производство
    const prodMenuItem = document
        .getElementsByClassName("production")[0]
        .previousElementSibling;

    prodMenuItem.style.cursor = "default";
    prodMenuItem.addEventListener('click', function(evt) {
        evt.preventDefault();
    });


    // Инициализируем Slick Slider на слайдере Партнёры (Главная страница)
    $('.partners-slick-slider').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        prevArrow: "<div class=\"slider__controller slider__controller_left\"></div>",
        nextArrow: "<div class=\"slider__controller slider__controller_right\"></div>",
        responsive: [
            {
                breakpoint: 1400,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });



    // Инициализируем Slick Slider на слайдере товаров
    $('.product-slick-slider').slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 2,
        prevArrow: "<div class=\"slider__controller slider__controller_left\"></div>",
        nextArrow: "<div class=\"slider__controller slider__controller_right\"></div>",
        adaptiveHeight: true,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
        ]
    });

    // Скролл к первому слайду после клика по стрелками влево/вправо на слайдере
    function handleClickSliderControls(sliderContainerId) {
        const sliderContainer = document
            .getElementById(sliderContainerId);

        if (sliderContainer) {
            const controls = sliderContainer
                .getElementsByClassName("slider__controller");

            for (let i = 0; i < controls.length; i++) {
                controls[i].addEventListener('click', function () {
                    $('html, body').animate({
                        scrollTop: $(sliderContainer).offset().top + 80
                    }, 500);
                });
            }

        }
    }

    // Инициализируем Скролл к первому слайду только для мобильных
    if (windowWidth < 992) {
        handleClickSliderControls("concreteSlider");
        handleClickSliderControls("rubbleSlider");
        handleClickSliderControls("pumpSlider");
    }



    // Обраотчика логики корзины
    cart = document.getElementById("cart");
    cartModalClose = document.getElementById("cartModalClose");

    window.fnCartModalToggle = function(action) {
        cartModal = document.getElementById("cartModal");
        cartModalDialog = document.getElementById("cartModalDialog");
        msgSetOrderTrue = document.getElementById("msgSetOrderTrue");

        if (action) {
            body.classList.add("modal-open");
            cartModal.classList.add("show");
        } else {
            body.classList.remove("modal-open");
            cartModal.classList.remove("show");
            cartModalDialog.classList.remove('hide');

            // Если открыто модальное окно об удачном
            // создании заказа, чистим корзину
            if (msgSetOrderTrue.classList.contains('visible')) {
                // Сбрасываем итоговоую сумму всех товаров в корзине
                finalCartPriceContainer.innerText = '0.00';
                // Показываем заглушку для корзины без товаров
                noProductsMsg.classList.remove('hidden');
                // Скрвыаем список товаров в корзине
                cartModalBody.classList.add('hidden');
                // Скрываем форму ввода доп. данных в корзине
                cartModalFooter.classList.add('hidden');
                // Удаляем все товары из корзины
                const productLists = cartModalBody.querySelectorAll('.cart-modal__list');
                for (let i = 0; i < productLists.length; i++) {
                    while (productLists[i].firstChild) {
                        productLists[i]
                            .removeChild(productLists[i].firstChild);
                    }
                }
            }

            fnCleanCartFormControls();
            fnCleanCartFromErr();

            const modalsResult = document.getElementsByClassName('send-msg-true');
            if (modalsResult.length > 0) {
                for (let i = 0; i < modalsResult.length; i++) {
                    modalsResult[i].classList.remove('visible');
                }
            }
            msgSetOrderTrue.classList.remove('visible');
        }
    };

    // Открываем Корзину в модальном окне при клике на иконку корзины в хедере
    cart.addEventListener('click', function() {
        fnCartModalToggle(true);
    });

    // Закрываем мальное окно корзиныы при клике на крестик-закрыть окно
    cartModalClose.addEventListener('click', function() {
        fnCartModalToggle(false);
    });

    // Закрывамем модальное окно корзина при клике вне мадального окна
    cartModal.addEventListener('click', function (evt) {
        if (evt.target.id === 'cartModal')
            fnCartModalToggle(false);
    });

    // Динамическое удаление товара из корзины
    // и из структуры данных, хранящейся в сесиии
    function fnDeleteItemFromSession(url) {
        $.post(url)
            .done(function (data) {
                const response = JSON.parse(data);

                if (response['IS_ERRORS']) {
                    alert('К сожалению не удалось удалить товар из корзины. ' +
                        'Перезагрузите страницу и попробуйте ещё раз.')
                } else {
                    cartItemsCounter.innerText = response['CART_ITEM_COUNT'];

                    if (response['CART_ITEM_COUNT'] === 0) {
                        finalCartPriceContainer.innerText = '0.00';

                        setTimeout(function () {
                            noProductsMsg.classList.remove('hidden');
                            cartModalBody.classList.add('hidden');
                            cartModalFooter.classList.add('hidden');
                        }, 300);
                    } else {
                        // Уменьшаяем итоговую сумму корзины
                        // на величину стоимости удалённого товара
                        const newFinalCartPrice =
                            parseFloat(finalCartPriceContainer.innerText) -
                            parseFloat(response['PRODUCT_PRICE']);

                        finalCartPriceContainer.innerText =
                            Math.round(newFinalCartPrice * 100) / 100;
                    }
                }
            });
    }

    // Так как при добавлении нового элемента он создаётся динамически,
    // для того чтобы работала функция удаления элемента
    // без перезагрузки страницы, слушаем событие click
    // на всём списке элементов
    cartModalBody.addEventListener( 'click', function (evt) {
        const el = evt.target;
        // Удаление элемнта
        if (el.classList.contains('cart-modal__item__delete')) {
            const item = el.parentElement;
            const url = '/utils/delete-item-from-cart.php'
                + '?type='
                + item.dataset.productType
                + '&id='
                + item.dataset.pruductId;

            item.classList.add('deleted');

            // Удаляем товар из корзины
            setTimeout(function() {
                // item.parentNode.removeChild(item);
                $(item).remove();
            },1000);

            // Удаляем товар из сессионых данных
            fnDeleteItemFromSession(url);
        }

        // Пказваем/скрываем поле с дополнительной информацией в карточке товара
        if (el.classList
            .contains('cart-modal__item__inform-title')) {
            el.nextElementSibling
                .classList
                .toggle('visible');
            el.classList
                .toggle('active');
        }
    });

    // Обработчик отправки формы с данными корзины:
    // 1. Добавляем новый элемент Заказ в инфоблок Заказы
    // 2. Отправляем письмо менеджеру с данными нового заказа
    formCartPhone = document.getElementById("formCartPhone");
    formCartMail = document.getElementById("formCartMail");
    formCartDate = document.getElementById("formCartDate");
    formCartName = document.getElementById("formCartName");
    formCartMsg = document.getElementById("formCartMsg");
    btnSetOrderClose = document.getElementById("btnSetOrderClose");
    formCart = document.getElementById("formCart");
    btnFCSubmit = document.getElementById("btnFCSubmit");

    function fnCleanCartFromErr() {
        formCartPhone
            .parentElement
            .classList
            .remove('has__error');

        formCartPhone
            .nextElementSibling
            .innerHTML = '';

        formCartMail
            .parentElement
            .classList
            .remove('has__error');

        formCartMail
            .nextElementSibling
            .innerHTML = '';

        formCartDate
            .parentElement
            .classList
            .remove('has__error');

        formCartDate
            .nextElementSibling
            .innerHTML = '';

        formCartName
            .parentElement
            .classList
            .remove('has__error');

        formCartName
            .nextElementSibling
            .innerHTML = '';
    }

    function fnCleanCartFormControls() {
        formCartPhone.value = "";
        formCartMail.value = "";
        formCartDate.value = "";
        formCartName.value = "";
        formCartMsg.value = "";
    }

    btnSetOrderClose.addEventListener('click', function () {
        fnCartModalToggle(false);
    });

    function cartFunctionSubmit() {
        fnCleanCartFromErr();

        let formValid = true;

        if (formCartPhone.value === '') {
            formCartPhone
                .nextElementSibling
                .innerHTML = 'Укажите телефон';

            formCartPhone
                .parentElement
                .classList
                .add('has__error');

            formValid = false;
            formCartPhone.focus();
        } else {
            if (validPhone(formCartPhone.value) === false) {
                formCartPhone
                    .nextElementSibling
                    .innerHTML = 'Некорректный телефон';

                formCartPhone
                    .parentElement
                    .classList
                    .add('has__error');

                formValid = false;
                formCartPhone.focus();
            }
        }

        if (formCartMail.value === '') {
            formCartMail
                .nextElementSibling
                .innerHTML = 'Укажите Email';

            formCartMail
                .parentElement
                .classList
                .add('has__error');

            formValid = false;
            formCartMail.focus();
        } else {
            if (validMail(formCartMail.value) === false) {
                formCartMail
                    .nextElementSibling
                    .innerHTML = 'Некорректный Email';

                formCartMail
                    .parentElement
                    .classList.add('has__error');

                formValid = false;
                formCartMail.focus();
            }
        }

        if (formCartDate.value === '') {
            formCartDate
                .nextElementSibling
                .innerHTML = 'Укажите дату доставки';

            formCartDate
                .parentElement
                .classList
                .add('has__error');

            formCartDate.focus();
            formValid = false;
        } else {
            if (validDate(formCartDate.value) === false) {
                formCartDate
                    .nextElementSibling
                    .innerHTML = 'Формат даты должен быть ДД.ММ.ГГГГ';

                formCartDate
                    .parentElement
                    .classList
                    .add('has__error');

                formCartDate.focus();
                formValid = false;
            }
        }

        if (formCartName.value === '') {
            formCartName
                .nextElementSibling
                .innerHTML = 'Укажите наименование компании';

            formCartName
                .parentElement
                .classList
                .add('has__error');

            formCartName.focus();
            formValid = false;
        }

        if (formValid) {
            spinner.classList.add('visible');

            $.ajax({
                url: formCart.action,
                type: "POST",
                dataType: "JSON",
                data: new FormData(formCart),
                processData: false,
                contentType: false,
                success: function (response) {

                    console.log(response)

                    if (response['IS_ERRORS']) {
                        alert('К сожалению не удалось оформить Заказ. ' +
                            'Произошла ошибка. Попробуйте немного позже.')
                    } else {
                        // Сбрасываем количество товаров в корзине на иконке в хедере сайта
                        // Сброс оставльных полей формы и всех заказов происходит по клику
                        // Закрыть в модальном сообщении об удачном размещении заказа
                        cartItemsCounter.innerText = '0';
                        msgSetOrderTrue.classList.add("visible");
                        cartModalDialog.classList.add('hide');
                    }
                },
                error: function (xhr, desc, err) {
                    console.log('К сожалению не удалось оформить Заказ. ' +
                        'Произошла ошибка. Попробуйте немного позже.');
                    console.log(desc, err);
                },
                complete: function () {
                    spinner.classList.remove('visible');
                }
            });
        }
    }

    btnFCSubmit
        .addEventListener('click', function () {
            cartFunctionSubmit();
        });

    $('#formCart').submit(function () {
        cartFunctionSubmit();
        return false;
    });
});