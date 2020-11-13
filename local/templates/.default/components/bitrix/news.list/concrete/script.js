// Функция создаёт новый элемент для списка товаров
// на странице каталога Бетон и возвращает его
const createItemCertificates = (
    id, name, previewPictureSrc,
    previewText, concreteGrade,
    concreteClass, concreteMobility,
    concreteFrost, concreteWater,
    money, priceMinimum, detailPageUrl
) => {
    let item = document.createElement('div');
    item.classList.add(
        "col-sm-6",
        "col-lg-4",
        "col-xl-3",
        "catalog__item",
        "d-flex",
        "flex-column",
        "justify-content-start",
        "align-items-center",
        "hide"
    );
    item.id = id;

    let pic = document.createElement('div');
    pic.classList.add("prices__pic");
    pic.style.backgroundImage = "url("+ previewPictureSrc +")";

    let caption = document.createElement('div');
    caption.classList.add("prices__caption");
    caption.innerHTML = previewText;

    let desc = document.createElement('div');
    desc.classList.add("prices__desc");
    desc.innerHTML = concreteGrade
        + concreteClass
        + concreteMobility
        + concreteFrost
        + concreteWater;

    let price = document.createElement('div');
    price.classList.add("prices__price");
    price.innerHTML = priceMinimum
        ? "от<span>"+ money +"</span>руб."
        : "<span>"+ money +"</span>руб.";

    let btn = document.createElement('div');
    btn.classList.add("prices__btn");

    let link = document.createElement('a');
    link.classList.add("btn");
    link.href = detailPageUrl;
    link.innerHTML = "подробнее";

    // Собираем кнопку Подробнее
    btn.appendChild(link);

    // Собираем карточку товара
    item.appendChild(pic);
    item.appendChild(caption);
    item.appendChild(desc);
    item.appendChild(price);
    item.appendChild(btn);

    return item;
};

/* Для асинхронного получения данных с сервера
 * используется сервис-функция getResource
 * по пути /local/templates/.default/js/main.js
 */
document.addEventListener("DOMContentLoaded",() => {
    const btnGetNextPage = document
        .getElementById("btnGetNextBetonPage");

    btnGetNextPage
        .addEventListener('click', event => {
            event.preventDefault();

            const container = document.getElementById('itemsListContainer');
            const spinner = document.getElementById('spinner');
            spinner.classList.add('visible');

            getResource(btnGetNextPage.href)
                .then(response  => {
                    spinner.classList.remove('visible');
                    const isScrolled = window.pageYOffset;

                    // В цикле собирем новые элементы с карточками товаров
                    // и с задержкой добавляем их в родительский контейнер.
                    for (let key in response) {
                        // пропускаем первый массив в полученном результате,
                        // т.к. там записаны данные для следующей страницы
                        if (key === '0') continue;

                        let item = createItemCertificates(
                            response[key].ID,
                            response[key].NAME,
                            response[key].PREVIEW_PICTURE_SRC,
                            response[key].PREVIEW_TEXT,
                            response[key].CONCRETE_GRADE,
                            response[key].CONCRETE_CLASS,
                            response[key].CONCRETE_MOBILITY,
                            response[key].CONCRETE_FROST,
                            response[key].CONCRETE_WATER,
                            response[key].PRICE,
                            response[key].PRICE_MINIMUM,
                            response[key].DETAIL_PAGE_URL,
                        );

                        container.appendChild(item);

                        setTimeout(() => {
                            item.classList.remove('hide');
                        }, (key * 100));
                    }

                    // Скролл к первомо добавленному элементу
                    window.scrollTo(0, isScrolled);

                    // Если это пследняя страница удаляем кнопку ПОКАЗАТЬ ЕЩЁ ТОВАРЫ
                    // если нет, то пишем в кнопку адрес следующей
                    // загружаемой страницы
                    if (response['0']['NEXT_PAGE_URL'] !== null) {
                        btnGetNextPage.href = response['0']['NEXT_PAGE_URL'];
                    } else {
                        btnGetNextPage.style.display = 'none';
                    }
                });
        });
});
