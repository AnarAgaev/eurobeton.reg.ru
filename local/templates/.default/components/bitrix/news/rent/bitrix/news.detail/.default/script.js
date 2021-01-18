// Обработчик отправки формы Заказ доп. оборудования
document.addEventListener("DOMContentLoaded", function () {

    const body = document.body;
    const formEO        = document.getElementById('formEquipmentOrder');
    const nameEO        = document.getElementById('formEquipmentOrderName');
    const mailEO        = document.getElementById('formEquipmentOrderMail');
    const phoneEO       = document.getElementById('formEquipmentOrderPhone');
    const msgEO         = document.getElementById('formEquipmentOrderMsg');
    const modalEOOrder  = document.getElementById('modalEquipmentOrder');
    const modalEOBody   = document.getElementById('modalDialogEquipmentOrder');
    const sendMsgEOTrue = document.getElementById("sendEquipmentOrderMsgTrue");
    const btnEOClose    = document.getElementById("btnEOClose");
    const btnFRSubmit    = document.getElementById("btnFRSubmit");

    function cleanErrsEO (name, mail, phone, msg) {
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

    function cleanFieldsEO (name, mail, phone, msg) {
        name.value = '';
        mail.value = '';
        phone.value = '';
        msg.value = '';
    }

    function toggleModalEO (modal, action) {
        if (action) {
            body.classList.add("modal-open");
            modal.classList.add("show");
        } else {
            const modalDialog = modal.getElementsByClassName("modal__dialog")[0];

            body.classList.remove("modal-open");
            modal.classList.remove("show");
            modalDialog.classList.remove('hide');
            sendMsgEOTrue.classList.remove('visible');

            sendMsgEOTrue.

            cleanErrsEO(nameEO, mailEO, phoneEO, msgEO);
            cleanFieldsEO(nameEO, mailEO, phoneEO, msgEO);
        }
    }

    function rentFunctionSubmit() {

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

            $.ajax({
                url: formEO.action,
                type: "POST",
                dataType: "JSON",
                data: new FormData(formEO),
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response['IS_ERRORS']) {
                        alert('Сообщение не отправлено. Произошла ошибка. Попробуйте немного позже.');
                    } else {
                        cleanFieldsEO(nameEO, mailEO, phoneEO, msgEO);
                        modalEOBody.classList.add('hide');
                        sendMsgEOTrue.classList.add("visible");
                    }
                },
                error: function (xhr, desc, err) {
                    alert('Ошибка сервера. Сообщение не отправлено. Попробуйте немного позже.');
                    console.log(desc, err);
                },
                complete: function () {
                    spinner.classList.remove('visible');
                }
            });
        }
    }

    btnEOClose
        .addEventListener("click", function () {
            toggleModalEO(modalEOOrder, false);
        });

    btnFRSubmit
        .addEventListener('click', function () {
            rentFunctionSubmit();
        });

    $('#formEquipmentOrder').submit(function () {
        rentFunctionSubmit();
        return false;
    });
});