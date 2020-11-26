/* Обработчик отправки формы Заказ доп. оборудования */
document.addEventListener("DOMContentLoaded", () => {
    const body = document.body;

    const cleanErrsEO = (name, mail, phone, msg) => {
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
    };

    const cleanFieldsEO = (name, mail, phone, msg) => {
        name.value = '';
        mail.value = '';
        phone.value = '';
        msg.value = '';
    };

    const toggleModalEO = (modal, action) => {
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
        }
    };

    const formEO        = document.getElementById('formEquipmentOrder');
    const nameEO        = document.getElementById('formEquipmentOrderName');
    const mailEO        = document.getElementById('formEquipmentOrderMail');
    const phoneEO       = document.getElementById('formEquipmentOrderPhone');
    const msgEO         = document.getElementById('formEquipmentOrderMsg');
    const modalEOOrder  = document.getElementById('modalEquipmentOrder');
    const modalEOBody   = document.getElementById('modalDialogEquipmentOrder');
    const sendMsgEOTrue = document.getElementById("sendEquipmentOrderMsgTrue");
    const btnEOClose    = document.getElementById("btnEOClose");

    btnEOClose
        .addEventListener("click", () =>  toggleModalEO(modalEOOrder, false));

    formEO.addEventListener('submit', evt => {
        evt.preventDefault();
        cleanErrsEO(nameEO, mailEO, phoneEO, msgEO);
        let formValid = true;

        if (msgEO.value === '') {
            let err = msgEO.nextElementSibling;
            err.innerHTML = 'Напишите комментарий';
            msgEO.parentElement.classList.add('has__error');
            msgEO.focus();
            formValid = false;
        }

        if (phoneEO.value === '') {
            let err = phoneEO.nextElementSibling;
            err.innerHTML = 'Укажите телефон';
            phoneEO.parentElement.classList.add('has__error');
            formValid = false;
            phoneEO.focus();
        } else {
            if (validPhone(phoneEO.value) === false) {
                let err =  phoneEO.nextElementSibling;
                err.innerHTML = 'Некорректный телефон';
                phoneEO.parentElement.classList.add('has__error');
                formValid = false;
                phoneEO.focus();
            }
        }

        if (mailEO.value === '') {
            let err =  mailEO.nextElementSibling;
            err.innerHTML = 'Укажите e-mail';
            mailEO.parentElement.classList.add('has__error');
            formValid = false;
            mailEO.focus();
        } else {
            if (validMail(mailEO.value) === false) {
                let err =  mailEO.nextElementSibling;
                err.innerHTML = 'Некорректный e-mail';
                mailEO.parentElement.classList.add('has__error');
                formValid = false;
                mailEO.focus();
            }
        }

        if (nameEO.value === '') {
            let err =  nameEO.nextElementSibling;
            err.innerHTML = 'Укажите имя';
            nameEO.parentElement.classList.add('has__error');
            nameEO.focus();
            formValid = false;
        }

        if (formValid) {
            spinner.classList.add('visible');
            getResource(formEO.action, formEO)
                .then(response  => {
                    spinner.classList.remove('visible');

                    if (response['IS_ERRORS']) {
                        alert('Сообщение не отправлено. Произошла ошибка. Попробуйте немного позже.')
                    } else {
                        cleanFieldsEO(nameEO, mailEO, phoneEO, msgEO);
                        modalEOBody.classList.add('hide');
                        sendMsgEOTrue.classList.add("visible");
                    }
                });
        }
    });
});