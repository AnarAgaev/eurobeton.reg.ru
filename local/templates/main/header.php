<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<? use Bitrix\Main\Page\Asset; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<?$APPLICATION->ShowHead();?>
	<title><?$APPLICATION->ShowTitle();?></title>
    <?php
        Asset::getInstance()->addString('<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />');
        Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1.0">');
        Asset::getInstance()->addString('<meta http-equiv="X-UA-Compatible" content="ie=edge">');
        Asset::getInstance()->addString('<meta name="robots" content="index, follow">');

        /* Added Fancybox apps */
        Asset::getInstance()->addCss('https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css');
        Asset::getInstance()->addJs('https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js');
        Asset::getInstance()->addJs('https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js');

        /* Added base site includes */
        Asset::getInstance()->addString('<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Source+Sans+Pro:wght@400;600;700;900&display=swap" rel="stylesheet">');
        Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/css/vendors.css');
        Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/css/main.css');
        Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/js/main.js');

        /* Added Yandex maps */
        Asset::getInstance()->addJs('https://api-maps.yandex.ru/2.1/?apikey=bcf0711f-5031-4e9a-a643-2984d4000f2b&amp;lang=ru_RU');
    ?>
</head>
<body class="page-index">
	<div id="panel"><?$APPLICATION->ShowPanel();?></div>
	<div class="modal" id="modalSetOrder">
		<div class="modal__dialog modal__dialog_set-order">
			<div class="modal__close"></div>
			<div class="modal__content">
				<div class="modal__header"><h4 class="modal__title">Оставить заявку</h4></div>
				<div class="modal__body"><h5 class="modal__subtitle">Вам нужна помощь в расчёте стоимости бетона? Или у Вас
						есть другой вопрос?<br>Наш менеджер поможет Вам во всём разобраться</h5>
					<form class="form modal__form d-flex flex-column flex-md-row" enctype="multipart/form-data"
						  method="post">
						<div class="modal__controls d-flex flex-column"><label class="label label_w272"><span>Ваше имя (название организации):</span><input
									type="text" placeholder="Иван"></label><label
								class="label label_w272"><span>Ваш e-mail:</span><input type="text"
																						placeholder="example@example.com"></label><label
								class="label label_w272"><span>Телефон:</span><input type="text"
																					 placeholder="+7 (999) 999-99-99"></label>
						</div>
						<div class="modal__msg"><label class="label"><span>Ваш вопрос (данные для расчета)?:</span><textarea
									placeholder="Начните вводить ..."></textarea></label></div>
					</form>
				</div>
				<div class="modal__footer d-flex flex-column flex-md-row align-items-center justify-content-center">
					<button class="btn">отправить</button>
					<div class="modal__agreement">Нажимая кнопку, вы соглашаетесь с условиями
						<a class="link" href="/">пользовательского соглашения</a>
						по обработке персональных данных
					</div>
				</div>
			</div>
		</div>
	</div>
		<header class="header">
			<div class="header__top">
				<div class="container">
					<div class="header__top__wrap row d-flex justify-content-between align-items-center" id="headerTop">
						<div class="header__top__body d-flex align-items-center justify-content-between">
							<div class="nav-tglr" id="navTgglr">
								<div class="nav-tglr__burger"></div>
							</div>
							<div class="region d-flex flex-md-column align-items-center justify-content-center" id="region">
								<div class="region__map-marker d-md-none"><img src="<?= DEFAULT_TEMPLATE_PATH; ?>/img/map-marker-alt-solid.svg" alt=""
																			   title=""></div>
								<div class="region__caption d-none d-md-block">Ваш регион:</div>
								<div class="region__description" id="regionCity">Москва</div>
								<ul class="region__list">
									<li class="region__item active" data-region-city="Москва"><span>Москва</span></li>
									<li class="region__item" data-region-city="Липецк"><span>Липецк</span></li>
									<li class="region__item" data-region-city="Екатеринбург"><span>Екатеринбург</span></li>
									<li class="region__item" data-region-city="Кстово"><span>Кстово</span></li>
									<li class="region__item" data-region-city="Лобня"><span>Лобня</span></li>
								</ul>
							</div>
							<div id="navContainer">
								<nav class="nav" id="headerTopNav">
									<ul class="nav__list d-flex">
										<li class="drop nav__item d-flex flex-column align-items-start"><a
												class="nav__link drop" href="/">О компании</a>
											<ul class="company dropdown__list d-flex flex-column">
												<li class="dropdown__item"><a class="dropdown__link" href="/">Новости</a></li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">Вакансии</a></li>
											</ul>
										</li>
										<li class="drop nav__item d-flex align-items-center"><a class="nav__link drop" href="/">Продукция</a>
										</li>
										<li class="drop nav__item d-flex align-items-center"><a class="nav__link drop" href="/">Производство</a>
										</li>
										<li class="drop nav__item d-flex align-items-center"><a class="nav__link drop" href="/">Аренда</a>
										</li>
										<li class="nav__item d-flex align-items-center"><a class="nav__link"
																						   href="/">Доставка</a></li>
										<li class="nav__item d-flex align-items-center"><a class="nav__link"
																						   href="/">Тендеры</a></li>
										<li class="nav__item d-flex align-items-center"><a class="nav__link"
																						   href="/">Контакты</a></li>
									</ul>
								</nav>
							</div>
							<div class="handset" id="headerPhoneBtn"><img src="<?= DEFAULT_TEMPLATE_PATH; ?>/img/phone-alt-solid.svg" alt="" title=""></div>
							<div class="cart d-flex justify-content-end align-items-center" id="cart">
								<div class="cart__caption">Корзина</div>
								<div class="cart__items">
									<div class="cart__items__num">5</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="header__bottom" id="headerBottomContainer">
				<div class="container header__bottom__container">
					<div class="headerBottom header__bottom__wrap d-flex justify-content-between align-items-center"
						 id="headerBottom"><a class="logo" href="/" id="logo"><img class="logo" src="<?= DEFAULT_TEMPLATE_PATH; ?>/img/logo.svg"
																				   alt="главная" title="главная"></a>
						<div id="prodContainer">
							<div class="products d-flex flex-column" id="nav">
								<ul class="products__list d-flex">
									<li class="drop products__item"><a class="products__link drop" href="/">Бетон</a>
										<div class="products__dropdown concrete d-flex justify-content-center align-items-center">
											<ul class="dropdown-list d-flex flex-column">
												<li class="dropdown__item"><a class="dropdown__link" href="/">БЕТОН М100
														(В7,5)</a></li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">БЕТОН М150
														(В10)</a></li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">БЕТОН М200
														(В15)</a></li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">БЕТОН М250
														(В20)</a></li>
											</ul>
											<ul class="dropdown-list d-flex flex-column">
												<li class="dropdown__item"><a class="dropdown__link" href="/">БЕТОН М300
														(В22,5)</a></li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">БЕТОН М350
														(В25)</a></li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">БЕТОН М400
														(В30)</a></li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">БЕТОН М450
														(В35)</a></li>
											</ul>
											<ul class="dropdown-list d-flex flex-column">
												<li class="dropdown__item"><a class="dropdown__link" href="/">БЕТОН М550
														(В40)</a></li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">БЕТОН М600
														(В45)</a></li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">БЕТОН М700
														(В50)</a></li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">БЕТОН М800
														(В60)</a></li>
											</ul>
											<ul class="dropdown-list d-flex flex-column">
												<li class="dropdown__item"><a class="dropdown__link" href="/">РАСТВОР БЕТОНА</a>
												</li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">ТОВАРНЫЙ БЕТОН</a>
												</li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">ТЯЖЕЛЫЙ БЕТОН</a>
												</li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">ДЛЯ ФУНДАМЕНТА</a>
												</li>
											</ul>
										</div>
									</li>
									<li class="drop products__item"><a class="products__link drop" href="/">Щебень</a>
										<div class="products__dropdown rubble d-flex justify-content-center align-items-center">
											<ul class="dropdown-list d-flex flex-column">
												<li class="dropdown__item"><a class="dropdown__link" href="/">Гранитный
														щебень</a></li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">Доломитовый
														щебень</a></li>
											</ul>
										</div>
									</li>
									<li class="products__item"><a class="products__link" href="/">Минеральный порошок</a></li>
								</ul>
							</div>
						</div>
						<div class="operating d-flex flex-column align-items-center align-items-md-end justify-content-center"
							 id="operating">
							<div class="operating__worktime">Работаем: 24/7</div>
							<div class="operating__phone"><a class="phone" href="tel:84957953018">+7 (495) 795-30-18</a></div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<main class="main">