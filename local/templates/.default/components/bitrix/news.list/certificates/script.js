// Функция создаёт новый элемент для списка новостей и возвращает его
const createItemCertificates = (
    id,
    detailPictureHref,
    previewPictureSrc,
    alt,
    title,
) => {

    let item = document.createElement('li');
    let link = document.createElement('a');
    let pic = document.createElement('img');

    item.classList.add('col-md-6');
    item.classList.add('col-lg-4');
    item.classList.add('col-xl-3');
    item.classList.add('certificates-item');
    item.classList.add('hide');
    item.id = id;

    link.classList.add('certificates__card');
    link.setAttribute('fancybox', 'certificates__gallery')
    link.href = detailPictureHref;

    pic.classList.add('certificates__pic');
    pic.src = previewPictureSrc;
    pic.title = title;
    pic.alt = alt;

    link.appendChild(pic);
    item.appendChild(link);

    return item;
};

/* Для асинхронного получения данных с сервера
 * используется сервис-функция getResource
 * по пути /local/templates/.default/js/main.js
 */
document.addEventListener("DOMContentLoaded",() => {
    const btnGetNextPage = document
        .getElementById("btnGetNextSertificates");

    btnGetNextPage
        .addEventListener('click', event => {
            event.preventDefault();

            const container = document.getElementById('certificatesListContainer');
            const spinner = document.getElementById('spinner');
            spinner.classList.add('visible');

            getResource(btnGetNextPage.href)
                .then(response  => {
                    spinner.classList.remove('visible');
                    const isScrolled = window.pageYOffset;

                    // В цикле собирем новые элементы с карточками сертификатов
                    // и с задержкой добавляем их в родительский контейнер.
                    for (let key in response) {
                        // пропускаем первый массив в полученном результате,
                        // т.к. там записаны данные для следующей страницы
                        if (key === '0') continue;

                        let item = createItemCertificates(
                            response[key].ID,
                            response[key].DETAIL_PICTURE_SRC,
                            response[key].PREVIEW_PICTURE_SRC,
                            response[key].PREVIEW_ALT,
                            response[key].PREVIEW_TITLE,
                        );

                        container.appendChild(item);

                        setTimeout(() => {
                            item.classList.remove('hide');
                        }, (key * 100));
                    }

                    // Скролл к первомо добавленному элементу
                    window.scrollTo(0, isScrolled);

                    // Если это пследняя страница удаляем кнопку ПОКАЗАТЬ ЕЩЁ
                    // если нет, то пишем в кнопку адрес следующей
                    // загружаемой страницы
                    if (response['0']['NEXT_PAGE_URL'] !== null) {
                        btnGetNextPage.href = response['0']['NEXT_PAGE_URL'];
                    } else {
                        btnGetNextPage.style.display = 'none';
                    }

                    // Переинициализируем fancybox для только-что добавленыых элементов
                    $().fancybox({
                        selector : '.certificates__card',
                    });
                });
        });
});
