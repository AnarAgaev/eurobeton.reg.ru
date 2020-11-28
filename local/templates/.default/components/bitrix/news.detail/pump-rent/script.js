/* Обработчик отправки формы Расчёт стоимости аренды Бетононасоса */
document.addEventListener("DOMContentLoaded", () => {
    const body = document.body;

    const cleanErrsRP = (name, mail, phone, time) => {
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
    };

    const cleanFieldsRP = (name, mail, phone, time, selectLength) => {
        name.value = '';
        mail.value = '';
        phone.value = '';
        time.value = '';

        // Длинна подачи - это select, поэтому сбрасываем
        // превый в true а все остальные в false
        for (let i = 0; i < selectLength.options.length; i++) {
            selectLength.options[i].selected = i === 0;
            selectLength.options[i].defaultSelected = i === 0;
        }

        lengthRP.selectedIndex = 0;
    };

    const toggleModalRP = (modal, action) => {
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
            const selects = modalDialog.getElementsByClassName("select");

            for (let i = 0; i < modalsResult.length; i++) {
                modalsResult[i].classList.remove('visible');
            }

            for (let i = 0; i < errors.length; i++) {
                errors[i].innerHTML = '';
            }

            for (let i = 0; i < labels.length; i++) {
                labels[i].classList.remove("has__error");
            }

            for (let i = 0; i < inputs.length; i++) {
                inputs[i].value = '';
            }

            for (let i = 0; i < selects.length; i++) {
                for (let j = 0; j < selects[i].options.length; j++) {
                    selects[i].options[j].selected = j === 0;
                }
            }

            resultRP.innerText = '0';
        }
    };

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

    btnRPClose
        .addEventListener("click", () =>  toggleModalRP(modalRP, false));

    /* Сразу получаем прайс с ценами, чтобы динамически
     * формировать select выбора длинны шланга и заполняем
     * option у select полученными данными
     */
    getResource('/utils/get-price-rent.php')
        .then(response  => {
            for (let prop in response) {
                const newOption = prop === '0'
                    ? new Option(response[prop]['code'].slice(23,25), response[prop]['value'], true, true)
                    : new Option(response[prop]['code'].slice(23,25), response[prop]['value']);
                lengthRP.append(newOption );
            }
        });

    /* Функция для расчёта стоимости доставки.
     *
     * Для неё не нужны все данные формы, достаточно
     * Длинны подачи и Количества часов в рабочей
     * смене.
     *
     * Слушаем изменения селекта Длинна подачи
     * и изменеие инпута Количество часоов.
     * На имзенение каждого из значений запускаем
     * фунцию и пересчитываем стоимость доставки.
     *
     * Полученный результат пушив в соотетсвующий
     * конейнер в DOM и заполняем скрытые поля,
     * которые понадобятся при формировании письма
     * отправляемого менеджеру компании.
     */
    function calcRentPrice() {
        const numberLength = Number(lengthRP.options[lengthRP.selectedIndex].text);
        const priceHour = parseFloat(lengthRP.options[lengthRP.selectedIndex].value);
        const hours = timeRP.value === ''
            ? 0
                : Number(timeRP.value) < 8
                    ? 8
                    : Number(timeRP.value); // Минимальная смена 8 часов

        const calcResult = priceHour * hours; // Считаем суммарную стоимость аренды бетононасоса

        numLength.value = numberLength;
        priceResult.value = calcResult;
        numberShifts.value = Math.trunc(hours / 8);
        extraHours.value = hours % 8;
        resultRP.innerText = calcResult.toString();

        // Убираем ошибку для поля с часами для случаеа если пользователь
        // превый раз ввел некорректные данные и даллее при зименнеии данных
        // показываемая ошибка будет вводить пользователя в заблужение
        timeRP.nextSibling.innerHTML = '';
        timeRP.parentElement.classList.remove('has__error');
    }

    // Слушаем изменения input с количеством часов
    timeRP.addEventListener('input', () => {
        calcRentPrice();
    });

    // Слушаем изменение select с длинной подачи
    lengthRP.addEventListener('change', () => {
        calcRentPrice();
    });


    formRP.addEventListener('submit', evt => {
        evt.preventDefault();
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

            getResource(formRP.action, formRP)
                .then(response  => {
                    spinner.classList.remove('visible');

                    if (response['IS_ERRORS']) {
                        alert('Сообщение не отправлено. Произошла ошибка. Попробуйте немного позже.')
                    } else {
                        cleanFieldsRP(nameRP, mailRP, phoneRP, timeRP, lengthRP);
                        modalDialogRP.classList.add('hide');
                        sendMsgRPTrue.classList.add("visible");
                    }
                });
        }
    });
});