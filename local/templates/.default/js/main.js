// Сервис-функция асинхронного поучения данных с сервера
const getResource = async (url) => {
    const response = await fetch(url);

    if (!response.ok) {
        throw new Error('Не удалось получить данные от ' + url +  '. Получен ответ: ' . response.status);
    }

    try {
        return await response.json();
    } catch (error) {
        throw new TypeError('Полученные данные должны быть в формате JSON. Произошла ошибка на URL: ' + response.url);
    }
};



document.addEventListener("DOMContentLoaded",() => {

    const body = document.body;
    const dropLinks = document.querySelectorAll(".products__link.drop");
    const navLinks = document.querySelectorAll(".nav__item.drop");
    const faqLinks = document.getElementsByClassName("faq__item");
    let windowWidth = window.innerWidth;

    const closeAccordion = () => {
        for (let i = 0; i < dropLinks.length; ++i) {
            dropLinks[i]
                .parentElement
                .classList
                .remove('visible');
        }

        for (let i = 0; i < navLinks.length; ++i) {
            navLinks[i]
                .classList
                .remove('visible');
        }
    };


    window.addEventListener('resize', (event) => {
        windowWidth = window.innerWidth;

        windowWidth >= 768
            ? replaceCart(true) // replace cart to top
            : replaceCart(false);  // replace cart to bottom

        windowWidth >= 1250
            ? replaceNav(true) // replace nav after logo
            : replaceNav(false);

        windowWidth >= 768
            ? replaceOperating(true) // Replace operating after initial page
            : replaceOperating(false);


        // roll up all drop navigation when user resize window
        for (let j = 0; j < dropLinks.length; ++j) {
            dropLinks[j]
                .parentElement
                .classList
                .remove('visible');
        }

        // Hide header nav and header phone
        body.classList.remove('phone-visible');
        body.classList.remove('nav-visible');

        // Hide city select
        region.classList.remove("city-select-visible");

    });

// Toggle phone at the header on mobile screen
    const headerPhoneBtn = document.getElementById('headerPhoneBtn');
    const toggleHeaderPhone = () => {
        body
            .classList
            .toggle('phone-visible');
        body
            .classList
            .remove('nav-visible');

        closeAccordion();
    };
    headerPhoneBtn.addEventListener('click', toggleHeaderPhone);


// Toggle navigation at the header on mobile screen
    const navTgglr = document.getElementById('navTgglr');
    const toggleHeaderNav = () => {
        body
            .classList
            .toggle('nav-visible');

        body
            .classList
            .remove('phone-visible');

        closeAccordion();
    };
    navTgglr.addEventListener('click', toggleHeaderNav);


// Toggle city selector at the header on mobile screen
    const region = document.getElementById("region");

    region.addEventListener("click", event => {
        let el = event.target;

        if (el.closest('#region')) {
            region
                .classList
                .toggle("city-select-visible");
        }

        body
            .classList
            .remove('phone-visible');
        body
            .classList
            .remove('nav-visible');

        closeAccordion();
    });

// Replace cart at the header on mobile screen
    const cart = document.getElementById("cart");
    const headerBottom = document.getElementById("headerBottom");
    const headerTop = document.querySelector("#headerTop .header__top__body");

    const replaceCart = (move) => {
        move
            ? headerTop.appendChild(cart)
            : headerBottom.appendChild(cart);
    };

    // Replace cart after initial page
    windowWidth >= 768
        ? replaceCart(true)
        : replaceCart(false);





// Replace operating at the header on mobile screen
    const operating = document.getElementById("operating");

    const replaceOperating = (move) => {
        move
            ? headerBottom.appendChild(operating)
            : body.prepend(operating);
    };

    // Replace operating after initial page
    windowWidth >= 768
        ? replaceOperating(true)
        : replaceOperating(false);




// Replace navigation at the header on mobile screen
    const headerBottomContainer = document.getElementById("headerBottomContainer");
    const headerTopNav = document.getElementById("headerTopNav");
    const nav = document.getElementById("nav");
    const prodContainer = document.getElementById("prodContainer");
    const navContainer = document.getElementById("navContainer");

    const replaceNav = (move) => {
        if (move) {
            prodContainer.appendChild(nav);
            navContainer.appendChild(headerTopNav);
        } else {
            nav.appendChild(headerTopNav);
            headerBottomContainer.prepend(nav);
        }
    };

    windowWidth >= 1250
        ? replaceNav(true) // replace nav after logo
        : replaceNav(false);



// Nav accordion for mobile version
    if (windowWidth <=1250) {

        // Toggle product dropdown
        for (let i = 0; i < dropLinks.length; ++i) {
            dropLinks[i].addEventListener('click', event => {

                event.preventDefault(); // stopping click on link

                let prntClasses = event.target.parentElement.classList;
                let isVisible = prntClasses.contains('visible');

                closeAccordion();

                isVisible
                    ? prntClasses.remove('visible')
                    : prntClasses.add('visible');
            });
        }

        // Toggle nav dropdown
        for (let i = 0; i < navLinks.length; ++i) {
            navLinks[i].addEventListener('click', event => {
                let elClasses = event.target.classList;
                let isVisible = elClasses.contains('visible');

                closeAccordion();

                isVisible
                    ? elClasses.remove('visible')
                    : elClasses.add('visible');
            });
        }


    }






// FAQ accordion
    const closeFaqAccordion = () => {
        for (let i = 0; i < faqLinks.length; ++i) {
            faqLinks[i].classList.remove("visible");
        }
    };

    if (faqLinks.length > 0) {
        for (let i = 0; i < faqLinks.length; ++i) {
            faqLinks[i].addEventListener('click', event => {
                let li = event.target.closest('li');
                let isVisible = li.classList.contains('visible');

                closeFaqAccordion();

                isVisible
                    ? li.classList.remove('visible')
                    : li.classList.add('visible');
            });
        }  }







// Input FILE
    let inputs = document.querySelectorAll(".label_file input");

    for (let i = 0; i < inputs.length; i++) {
        let controller = inputs[i].nextElementSibling;

        inputs[i].addEventListener('change', (event) => {
            controller.innerHTML = event.target.value.split('\\').pop();
        });
    }







// Show, hide modals
    let btns = document.getElementsByClassName('btn-modal');

    const toggleModal = (modal, action) => {
        if (action) {
            body.classList.add("modal-open");
            modal.classList.add("show");
        } else {
            body.classList.remove("modal-open");
            modal.classList.remove("show");
        }
    };

    for (let i = 0; i < btns.length; i++) {
        btns[i].addEventListener('click', event => {
            event.preventDefault();

            const modalId = event.target.dataset.modalId;
            const modal = document.getElementById(modalId);

            if (modal) {
                const btnClose = modal.querySelector(".modal__close");

                btnClose.addEventListener("click",
                    () => toggleModal(modal, false));

                modal.addEventListener("click", event => {
                    if (event.target.id ===  modalId) {
                        toggleModal(modal, false);
                    }
                });

                toggleModal(modal, true);
            }
        });
    }




// Show, hide comments for product on product page
    const tgglr = document.querySelector(".description__toggler");

    if (tgglr) {
        const prodTxt = tgglr.closest(".description");

        tgglr.addEventListener("click", () => {
            prodTxt.classList.toggle("show");

            tgglr.innerHTML === "Развернуть"
                ? tgglr.innerHTML = "Свернуть"
                : tgglr.innerHTML = "Развернуть";
        });
    }




// Click outside any elements
    document.addEventListener("click", event => {
        const el = event.target.parentElement;

        if (!el.closest('#region')) {
            region.classList.remove("city-select-visible");
        }



        // el.closest('#region') || el.id === "region"

        // Click outside city select
        // if (el.id !== "region" && region.classList.contains("city-select-visible")) {
        //   region.classList.remove("city-select-visible");
        // }
    });





// Slider for small image at the block
    const pics = document.querySelectorAll(".sml-img-slider__item");

    for (let i = 0; i < pics.length; i++) {
        pics[i].addEventListener("click", event => {
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






// Breakstone page accordion
    const bsBtns = document.querySelectorAll(".breakstone__accordion-caption");
    const bsTxts = document.querySelectorAll(".breakstone__accordion-content");
    const closeBreakstoneAccordion = () => {
        for (let i = 0; i < bsBtns.length; i++) {
            bsBtns[i].classList.remove("active");
            bsTxts[i].classList.remove("visible");
        }
    };

    for (let i = 0; i < bsBtns.length; i++) {
        bsBtns[i].addEventListener("click", event => {
            const el = event.target;
            const elCaptionMark = el.dataset.captionMark;
            const elContent = el.parentElement.querySelector(`[data-caption-for="${elCaptionMark}"]`);

            // Off oll buttons and all content blocks
            if (!el.classList.contains("active")) {
                closeBreakstoneAccordion();
            }

            el.classList.toggle("active");
            elContent.classList.toggle("visible");
        });
    }




/*
 * Работа с городом пользователя.
 *
 * Смтотрим город в Storage, елси его нет, то создаём перемунную
 * с городом по умолчанюи (Москва).
 *
 * Размещаем город по умолчанию в выпадающем меню выбора города
 * в хедере.
 * */
    if (storageAvailable('localStorage')) {
        if(!localStorage.getItem('usrCity')) {
            localStorage.setItem('usrCity', 'Москва'); // Устанавливаем город по умолчанию в localStorage
        }
    }
    else {
        console.log(
            'Браузер не поддерживает localStorage, возможно находится в режиме Инкогнито',
            'Необходима реализация поддержки выбора города на альтернативной технологии.'
        );
    }
/*
 * Меняем город пользователя по клику на пунке города
 * в выпадающем меню в хедере
 * */
    let cities = document.querySelectorAll(".region__item");
    let cityContainer = document.getElementById("regionCity");


    const activeSelectedCity = () => {
        let usrCity = localStorage.getItem('usrCity');
        let cityItems = document.getElementsByClassName("region__item");

        for (let i = 0; i < cityItems.length; i++) {
            usrCity === cityItems[i].dataset.regionCity
                ? cityItems[i].classList.add('active')
                : cityItems[i].classList.remove('active');
        }
    };

    // Размещаем город пользователя как выбранный в хедере
    cityContainer.innerHTML = localStorage.getItem('usrCity');

    // Делаем выбранный город пользователя скрытым при инициализации страницы
    activeSelectedCity();

    for (let i = 0; i < cities.length; i++) {
        cities[i].addEventListener("click", event => {
            let cityItem = event.target.closest(".region__item");

            // Получаем город по которому кликнул пользователь
            let city = cityItem.dataset.regionCity
                ? cityItem.dataset.regionCity
                : event.target.closest(".region__item").dataset.regionCity;

            // Меняем город в контейнере
            cityContainer.innerHTML = city;

            // Меняем город пользователя в localStorage
            localStorage.setItem('usrCity', city);

            activeSelectedCity();
        });
    }












    /* Yandex maps -- START
     *
     * Функция ymaps.ready() будет вызвана, когда
     * загрузятся все компоненты API,
     * а также когда будет готово DOM-дерево.
     */
    ymaps.ready(init);
    function init() {

        // Карта на Главной старнице
        if (document.getElementById("indexMap")) {
            let indexMap = new ymaps.Map("indexMap", {
                    // Координаты центра карты.
                    // Порядок по умолчанию: «широта, долгота».
                    // Чтобы не определять координаты центра карты вручную,
                    // воспользуйтесь инструментом Определение координат.
                    center: [55.38046857198313,41.687034406250014],
                    // Уровень масштабирования. Допустимые значения:
                    // от 0 (весь мир) до 19.
                    zoom: 6,
                    controls: [],
                }),

                myPlacemarkKstovo = new ymaps.Placemark([56.179510068572036,44.15730749999993],
                    {
                        balloonContentHeader: "Кстовский филиал",
                        balloonContentBody: "г. Кстово, ул. Магистральная, д. 1"
                    },
                    {
                        iconLayout: 'default#image',
                        iconImageHref: '/local/templates/.default/img/mark.png',
                        iconImageSize: [36, 43],
                        iconImageOffset: [-15, -43]
                    }),
                myPlacemarkLipetsk = new ymaps.Placemark([52.60358425779388,39.59623749999995],
                    {
                        balloonContentHeader: "Липецкий филиал",
                        balloonContentBody: "г. Липецк, район Цемзавода, 398027"
                    },
                    {
                        iconLayout: 'default#image',
                        iconImageHref: '/local/templates/.default/img/mark.png',
                        iconImageSize: [36, 43],
                        iconImageOffset: [-15, -43]
                    }),
                myPlacemarkGranitstroy = new ymaps.Placemark([56.00991906873449,37.436966],
                    {
                        balloonContentHeader: "Гранитстрой",
                        balloonContentBody: "г. Лобня, Краснополянский проезд, д. 5"
                    },
                    {
                        iconLayout: 'default#image',
                        iconImageHref: '/local/templates/.default/img/mark.png',
                        iconImageSize: [36, 43],
                        iconImageOffset: [-15, -43]
                    }),
                myPlacemarkStroyRegion = new ymaps.Placemark([56.86988406782098,60.59384549999995],
                    {
                        balloonContentHeader: "ООО «СтройРегион-Трейд ЕК»",
                        balloonContentBody: "г. Екатеринбург, ул. Артинская, д. 18"
                    },
                    {
                        iconLayout: 'default#image',
                        iconImageHref: '/local/templates/.default/img/mark.png',
                        iconImageSize: [36, 43],
                        iconImageOffset: [-15, -43]
                    }),
                myPlacemarkEvrobeton = new ymaps.Placemark([55.77380806896347,37.50681899999997],
                    {
                        balloonContentHeader: "Москва: ЖБИ АО «Евробетон»",
                        balloonContentBody: "г. Москва, 3-й Силикатный проезд, д. 10 , стр. 15"
                    },
                    {
                        iconLayout: 'default#image',
                        iconImageHref: '/local/templates/.default/img/mark.png',
                        iconImageSize: [36, 43],
                        iconImageOffset: [-15, -43]
                    }),
                myPlacemarkMedvedkovo = new ymaps.Placemark([55.88525156886214,37.62130049999999],
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

            // Пушим метки в карту indexMap
            indexMap.geoObjects
                .add(myPlacemarkKstovo)
                .add(myPlacemarkLipetsk)
                .add(myPlacemarkGranitstroy)
                .add(myPlacemarkEvrobeton)
                .add(myPlacemarkMedvedkovo)
                .add(myPlacemarkStroyRegion);
            indexMap.controls.add('zoomControl');
            indexMap.behaviors.disable('scrollZoom');
        }

        // Карта на старнице Контакты
        if (document.getElementById("contactsMap")) {
            let indexMap = new ymaps.Map("contactsMap", {
                    // Координаты центра карты.
                    // Порядок по умолчанию: «широта, долгота».
                    // Чтобы не определять координаты центра карты вручную,
                    // воспользуйтесь инструментом Определение координат.
                    center: [55.77380806896347,37.50681899999997],
                    // Уровень масштабирования. Допустимые значения:
                    // от 0 (весь мир) до 19.
                    zoom: 16,
                    controls: [],
                }),

                myPlacemarkMsk = new ymaps.Placemark([55.77380806896347,37.50681899999997],
                    {
                        balloonContentHeader: "Головной офис в Москве",
                        balloonContentBody: "123308, Россия, г. Москва, Силикатный проезд, д. 10, стр. 15"
                    },
                    {
                        iconLayout: 'default#image',
                        iconImageHref: '/local/templates/.default/img/mark.png',
                        iconImageSize: [36, 43],
                        iconImageOffset: [-15, -43]
                    });

            // Пушим метки в карту indexMap
            indexMap.geoObjects
                .add(myPlacemarkMsk)
            indexMap.controls.add('zoomControl');
            indexMap.behaviors.disable('scrollZoom');
        }

    }
    //** Yandex maps -- END










});


/*
 * Функция проверки поддержки localStorage
 * if (storageAvailable('localStorage')) {
 * 	// Yippee! We can use localStorage awesomeness
 * }
 * else {
 * 	// Too bad, no localStorage for us
 * }
 * */
function storageAvailable(type) {
    try {
        let storage = window[type],
            x = '__storage_test__';
        storage.setItem(x, x);
        storage.removeItem(x);
        return true;
    }
    catch(e) {
        return false;
    }
}





// Using polyfills
(function() {
    // проверяем поддержку
    if (!Element.prototype.closest) {
        // реализуем
        Element.prototype.closest = function(css) {
            let node = this;

            while (node) {
                if (node.matches(css)) return node;
                else node = node.parentElement;
            }
            return null;
        };
    }
})();

(function() {
    // проверяем поддержку
    if (!Element.prototype.matches) {
        // определяем свойство
        Element.prototype.matches = Element.prototype.matchesSelector ||
            Element.prototype.webkitMatchesSelector ||
            Element.prototype.mozMatchesSelector ||
            Element.prototype.msMatchesSelector;
    }
})();

// Source: https://github.com/jserz/js_piece/blob/master/DOM/ParentNode/prepend()/prepend().md
(function (arr) {
    arr.forEach(function (item) {
        if (item.hasOwnProperty('prepend')) {
            return;
        }
        Object.defineProperty(item, 'prepend', {
            configurable: true,
            enumerable: true,
            writable: true,
            value: function prepend() {
                let argArr = Array.prototype.slice.call(arguments),
                    docFrag = document.createDocumentFragment();

                argArr.forEach(function (argItem) {
                    let isNode = argItem instanceof Node;
                    docFrag.appendChild(isNode ? argItem : document.createTextNode(String(argItem)));
                });

                this.insertBefore(docFrag, this.firstChild);
            }
        });
    });
})([Element.prototype, Document.prototype, DocumentFragment.prototype]);
