// Функция создаёт новый набор элементов (карточек с новостями) для списка новостей и возвращает его
function createItemNews(date, detailPageUrl,
                        id, pictureSrc,
                        text) {
    let item = document.createElement('div');
    let link = document.createElement('a');
    let pic = document.createElement('div');
    let desc = document.createElement('div');
    let dte = document.createElement('div');
    let caption = document.createElement('div');

    item.classList.add('col-md-6');
    item.classList.add('col-xl-3');
    item.classList.add('d-flex');
    item.classList.add('justify-content-center');
    item.classList.add('news-item');
    item.classList.add('hide');
    item.id = id;

    link.classList.add('news-list__card');
    link.href = detailPageUrl + '/';

    pic.classList.add('news-list__pic');
    pic.style.backgroundImage = 'url('+ pictureSrc +')';

    desc.classList.add('news-list__desc');

    dte.classList.add('news-list__date');
    dte.innerText = date;

    caption.classList.add('news-list__caption');
    caption.innerText = text;

    desc.appendChild(dte);
    desc.appendChild(caption);
    link.appendChild(pic);
    link.appendChild(desc);
    item.appendChild(link);

    return item;
}

// Асинхронно получаем список новостей следующей страницы с сервера
document.addEventListener("DOMContentLoaded", function () {

    const btnGetNextPage = document
        .getElementById("btnGetNextPage");

    btnGetNextPage
        .addEventListener('click', function (event) {
            event.preventDefault();

            const container = document.getElementById('newsListContainer');
            const spinner = document.getElementById('spinner');

            spinner.classList.add('visible');

            $.post(btnGetNextPage.href)
                .done(function (data) {
                    const response = JSON.parse(data);
                    const isScrolled = window.pageYOffset;

                    // В цикле собирем новые элементы с карточками новостей
                    // и с задержкой добавляем их в родительский контейнер.
                    for (let key in response) {
                        if (key === '0') continue;

                        const item = createItemNews(
                            response[key].DATE,
                            response[key].DETAIL_PAGE_URL,
                            response[key].ID,
                            response[key].PICTURE_SRC,
                            response[key].TEXT
                        );

                        container.appendChild(item);

                        setTimeout(function () {
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

                })
                .always(function () {
                    spinner.classList.remove('visible');
                });
        });
});
