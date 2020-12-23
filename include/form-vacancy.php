<form class="form form-interview-wrap"
      enctype="multipart/form-data"
      method="POST"
      name="add_interview_request"
      action="/utils/handle-interview-request.php"
      id="formVacancy">
    <div class="container">
        <div class="form__controls form_interview d-flex flex-column align-items-start flex-lg-row flex-wrap">
            <div class="form__title">Записать на собеседование</div>
            <label class="label label_w378">
                <span>Фамилии, Имя, Отчество:</span>
                <input class="input control"
                       type="text"
                       placeholder="Иванов Иван Иванович"
                       name="name"
                       id="formVacancyName">
                <span class="err__msg"></span>
            </label>
            <label class="label label_w284">
                <span>Дата рождения:</span>
                <input class="input control"
                       type="text"
                       placeholder="дд.мм.гггг"
                       name="birthday"
                       id="formVacancyBirthday">
                <span class="err__msg"></span>
            </label>
            <label class="label label_w339">
                <span>Телефон:</span>
                <input class="input control"
                       type="text"
                       placeholder="+7 (000) 000-00-00"
                       name="phone"
                       id="formVacancyPhone">
                <span class="err__msg"></span>
            </label>
            <label class="label label_w378">
                <span>Е-mail почта:</span>
                <input class="input control"
                       type="text"
                       placeholder="example@example.com"
                       name="email"
                       id="formVacancyEmail">
                <span class="err__msg"></span>
            </label>
            <label class="label label_w653">
                <span>На какую должность Вы претендуете в нашей компании:</span>
                <input class="input control"
                       type="text"
                       name="position"
                       id="formVacancyPosition">
                <span class="err__msg"></span>
            </label>
            <label class="label label_file label_w299">
                <span>Прикрепить резюме (по желанию):</span>
                <input type="file"
                       class="input"
                       name="questionary"
                       id="formVacancyQuestionary">
                <span class="controller control"></span>
                <span class="err__msg"></span>
            </label>
            <label class="label label_file label_w175">
                <span>Прикрепить фото:</span>
                <input type="file"
                       class="input"
                       name="photo"
                       id="formVacancyPhoto">
                <span class="controller control"></span>
                <span class="err__msg"></span>
            </label>
            <div class="form__send-wrap d-flex flex-column flex-md-row align-items-md-center">
                <div class="form__send-btn">
                    <button class="btn" type="submit">отправить</button>
                </div>
                <div class="form__send-caption">
                    <span>
                        Нажимая кнопку, вы соглашаетесь с условиями
                        <a class="link"
                           target="_blank"
                           title="Пользовательское соглашение"
                           href="/polzovatelskoe-soglashenie/">пользовательского соглашения
                        </a> по обработке персональных данных</span>
                </div>
            </div>
        </div>
    </div>
</form>