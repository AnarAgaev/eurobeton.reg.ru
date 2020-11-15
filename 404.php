<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?$APPLICATION->SetTitle("404 Not Found");?>
<div class="pnf">
    <div class="pnf__tringle"></div>
    <div class="container">
        <div class="pnf__pic">
            <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/404.png" alt="Ошибка 404. Страница не найдена">
        </div>
        <div class="pnf__title">
            Ошибка!
        </div>
        <div class="pnf__err">404</div>
        <div class="pnf__subtitle">
            К сожалению, запрашиваемая страница не найдена...
        </div>
        <div class="pnf__link">
            <a href="/">Вернуться на главную</a>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>