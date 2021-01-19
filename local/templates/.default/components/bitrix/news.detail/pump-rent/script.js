// Обработчик отправки формы Расчёт стоимости аренды Бетононасоса
document.addEventListener("DOMContentLoaded", function () {

    const body = document.body;
    const formRP        = document.getElementById('formRentPump');
    const nameRP        = document.getElementById('formRentPumpName');
    const mailRP        = document.getElementById('formRentPumpMail');
    const phoneRP       = document.getElementById('formRentPumpPhone');
    const lengthRP      = document.getElementById('formRentPumpLength');
    const timeRP        = document.getElementById('formRentPumpTime');
    const modalRP       = document.getElementById('modalRentPump');
    const modalDialogRP = document.getElementById('modalDialogRentPump');
    const sendMsgRPTrue = document.getElementById("sendRPMsgTrue");
    const btnRPClose    = document.getElementById("btnRPClose");
    const numLength     = document.getElementById('numLength');
    const priceResult   = document.getElementById('priceResult');
    const resultRP      = document.getElementById('formRentPumpResult');
    const numberShifts  = document.getElementById('numberShifts');
    const extraHours    = document.getElementById('extraHours');
    const btnFRPSubmit  = document.getElementById('btnFRPSubmit');

    let selectWasBuilded = false;


    function cleanErrsRP (name, mail, phone, time) {
        // Чистим контейнеры для сообщений об ошибках
        name.nextSibling.innerHTML = '';
        mail.nextSibling.innerHTML = '';
        phone.nextSibling.innerHTML = '';
        time.nextSibling.innerHTML = '';

        // Удаляем класс ошибки у родительского узла
        name.parentElement.classList.remove('has__error');
        mail.parentElement.classList.remove('has__error');
        phone.parentElement.classList.remove('has__error');
        time.parentElement.classList.remove('has__error');
    }

    function cleanFieldsRP (name, mail, phone, time, selectedLength) {
        name.value = '';
        mail.value = '';
        phone.value = '';
        time.value = '';

        // Длинна подачи - это select, поэтому сбрасываем
        // первый в true а все остальные в false
        for (let i = 0; i < selectedLength.options.length; i++) {
            selectedLength.options[i].selected = i === 0;
            selectedLength.options[i].defaultSelected = i === 0;
        }

        lengthRP.selectedIndex = 0;
    }

    function toggleModalRP (modal, action) {
        if (action) {
            body.classList.add("modal-open");
            modal.classList.add("show");
        } else {
            const modalDialog = modal.getElementsByClassName("modal__dialog")[0];
            const modalsResult = document.getElementsByClassName('send-msg-true');

            body.classList.remove("modal-open");
            modal.classList.remove("show");
            modalDialog.classList.remove('hide');

            if (modalsResult.length > 0) {
                for (let i = 0; i < modalsResult.length; i++) {
                    modalsResult[i].classList.remove('visible');
                }
            }

            cleanErrsRP(nameRP, mailRP, phoneRP, timeRP); // чистим сообщения об ошибках
            cleanFieldsRP(nameRP, mailRP, phoneRP, timeRP, lengthRP); // чистим данные полей
            resultRP.innerText = '0'; // чистим рассчитанное значение
        }
    }

    /* Сразу получаем прайс с ценами, чтобы динамически
     * формировать select выбора длинны шланга и заполняем
     * option у select полученными данными
     */
    $.post('/utils/get-price-rent.php')
        .done(function (data) {
            const response = JSON.parse(data);

            $.each(response, function(key, value) {
                const selected = key === 0 ? ' selected="selected"' : '';

                $(lengthRP).append('<option' + selected
                    + ' value="' + value['value'] + '">'
                    + value['code'].slice(23,25)
                    + '</option>');

                if (key === response.length - 1) {
                    selectWasBuilded = true;
                }
            });
        });

    /* Функция для расчёта стоимости доставки.
     *
     * Для неё не нужны все данные формы, достаточно
     * Длинны подачи и Количества часов в рабочей
     * смене.
     *
     * Слушаем изменения селекта Длинна подачи
     * и изменеие инпута Количество часов.
     * На имзенение каждого из значений запускаем
     * фунцию и пересчитываем стоимость доставки.
     *
     * Полученный результат пушим в соотетсвующий
     * контейнер в DOM и заполняем скрытые поля,
     * которые понадобятся при формировании письма
     * отправляемого менеджеру компании.
     */
    function calcRentPrice() {

        const numberLength = Number(lengthRP.options[lengthRP.selectedIndex].text);
        const priceHour = parseFloat(lengthRP.options[lengthRP.selectedIndex].value);

        const hours = timeRP.value === ''
            ? 0
                : Number(timeRP.value) < 8
                    ? 8 // Минимальная смена 8 часов
                    : Number(timeRP.value);

        const calcResult = priceHour * hours; // Считаем суммарную стоимость аренды бетононасоса

        numLength.value = numberLength;
        priceResult.value = calcResult;
        numberShifts.value = Math.trunc(hours / 8);
        extraHours.value = hours % 8;
        resultRP.innerText = calcResult.toString();

        // Убираем ошибку для поля с часами для случаеа если пользователь
        // превый раз ввел некорректные данные т.к. даллее при зименнеии данных
        // показываемая ошибка будет вводить пользователя в заблужение
        timeRP.nextSibling.innerHTML = '';
        timeRP.parentElement.classList.remove('has__error');
    }

    // Слушаем изменения input с количеством часов
    timeRP.addEventListener('input',
        function () {
            if (selectWasBuilded) {
                calcRentPrice();

                if (timeRP.value !== '0') {
                    if (!(+(timeRP.value))) {
                        timeRP.value = "";
                    }
                }
            }
        });

    // Слушаем изменение select с длинной подачи
    lengthRP.addEventListener('change',
        function () {
            if (selectWasBuilded) {
                calcRentPrice();
            }
        });

    function feedbackFunctionSubmit () {
        cleanErrsRP(nameRP, mailRP, phoneRP, timeRP);

        let formValid = true;

        if (timeRP.value === '' || timeRP.value === '0') {
            let err = timeRP.nextElementSibling;
            err.innerHTML = 'Некорректное количество часов';
            timeRP.parentElement.classList.add('has__error');
            timeRP.focus();
            formValid = false;
        }

        if (phoneRP.value === '') {
            let err = phoneRP.nextElementSibling;
            err.innerHTML = 'Укажите телефон';
            phoneRP.parentElement.classList.add('has__error');
            formValid = false;
            phoneRP.focus();
        } else {
            if (validPhone(phoneRP.value) === false) {
                let err =  phoneRP.nextElementSibling;
                err.innerHTML = 'Некорректный телефон';
                phoneRP.parentElement.classList.add('has__error');
                formValid = false;
                phoneRP.focus();
            }
        }

        if (mailRP.value === '') {
            let err =  mailRP.nextElementSibling;
            err.innerHTML = 'Укажите e-mail';
            mailRP.parentElement.classList.add('has__error');
            formValid = false;
            mailRP.focus();
        } else {
            if (validMail(mailRP.value) === false) {
                let err =  mailRP.nextElementSibling;
                err.innerHTML = 'Некорректный e-mail';
                mailRP.parentElement.classList.add('has__error');
                formValid = false;
                mailRP.focus();
            }
        }

        if (nameRP.value === '') {
            let err =  nameRP.nextElementSibling;
            err.innerHTML = 'Укажите имя';
            nameRP.parentElement.classList.add('has__error');
            nameRP.focus();
            formValid = false;
        }

        if (formValid) {
            spinner.classList.add('visible');

            $.ajax({
                url: formRP.action,
                type: "POST",
                dataType: "JSON",
                data: new FormData(formRP),
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response['IS_ERRORS']) {
                        alert('Ошибка сервера. Сообщение не отправлено. Попробуйте немного позже.');
                    } else {
                        cleanFieldsRP(nameRP, mailRP, phoneRP, timeRP, lengthRP);
                        modalDialogRP.classList.add('hide');
                        sendMsgRPTrue.classList.add("visible");
                    }
                },
                error: function (xhr, desc, err) {
                    alert('Сообщение не отправлено. Произошла ошибка. Попробуйте немного позже.');
                    console.log(desc, err);
                },
                complete: function () {
                    spinner.classList.remove('visible');
                }
            });
        }
    }

    btnRPClose
        .addEventListener("click", function () {
            toggleModalRP(modalRP, false);
        });

    btnFRPSubmit
        .addEventListener('click', function () {
            feedbackFunctionSubmit();
        });

    $('#formRentPump').submit(function () {
        feedbackFunctionSubmit();
        return false;
    });
});