<div class="modal" id="modalSetOrder">
    <div class="send-msg-true flex-column justify-content-center align-items-center" id="sendMsgTrue">
        <h3 class="send-msg-true__title">Сообщение отправлено</h3>
        <span class="send-msg-true__txt">Менеджер свяжется с Вами в ближайшее время.</span>
        <button class="btn" id="btnFBClose">Закрыть</button>
    </div>

    <div class="modal__dialog modal__dialog_set-order" id="modalDialogFeedback">
        <div class="modal__close"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h4 class="modal__title">Оставить заявку</h4>
            </div>
            <div class="modal__body">
                <h5 class="modal__subtitle">
                    Вам нужна помощь в расчёте стоимости бетона? Или у Вас
                    есть другой вопрос?<br>Наш менеджер поможет Вам во всём разобраться
                </h5>
                <form class="form modal__form d-flex flex-column flex-md-row"
                      name="add_feedback"
                      action="/utils/handle-feedback-form.php"
                      method="POST"
                      enctype="multipart/form-data"
                      id="formFeedback">
                    <div class="modal__controls d-flex flex-column">
                        <label class="label label_w272">
                            <span>Ваше имя (название организации):</span>
                            <input class="input"
                                   type="text"
                                   name="name"
                                   placeholder="Иван"
                                   id="formFeedbackName">
                            <span class="err__msg"></span>
                        </label>
                        <label class="label label_w272">
                            <span>Ваш e-mail:</span>
                            <input class="input"
                                   type="text"
                                   placeholder="example@example.com"
                                   name="email"
                                   id="formFeedbackMail">
                            <span class="err__msg"></span>
                        </label>
                        <label class="label label_w272">
                            <span>Телефон:</span>
                            <input class="input"
                                   type="text"
                                   placeholder="+7 (999) 999-99-99"
                                   name="phone"
                                   id="formFeedbackPhone">
                            <span class="err__msg"></span>
                        </label>
                    </div>
                    <div class="modal__msg">
                        <label class="label">
                            <span>Ваш вопрос (данные для расчета)?:</span>
                            <textarea class="textarea"
                                      placeholder="Начните вводить ..."
                                      name="message"
                                      id="formFeedbackMsg"></textarea>
                            <span class="err__msg"></span>
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal__footer d-flex flex-column flex-md-row align-items-center justify-content-center">
                <button class="btn" type="submit" form="formFeedback">отправить</button>
                <div class="modal__agreement">
                    Нажимая кнопку, вы соглашаетесь с условиями
                    <a class="link"
                       target="_blank"
                       title="Пользовательское соглашение"
                       href="/polzovatelskoe-soglashenie/">
                        пользовательского соглашения
                    </a> по обработке персональных данных
                </div>
            </div>
        </div>
    </div>
</div>