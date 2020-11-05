<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
/*
 * На странице реализована AJAX подгрузка сертификатов после клика по кноаке ЗАГРУЗИТЬ ЕЩЁ СЕРТИФИКАТЫ
 *
 * Обработчик клика и реализация AJAX запроса в файле script.js соответствующего шаблона
 * /local/templates/.default/components/bitrix/news.list/certificates/script.js
 *
 * Компонент собирающий и отдающй данные (сертификаты следующей страницы)
 * реализован в файле get-next-sertificates-page.php
 * /utility/get-next-sertificates-page.php
 *
 * Ссылка для получения данных хранится в параметре href у кнопки ЗАГРУЗИТЬ ЕЩЁ СЕРТИФИКАТЫ
 * При первой загрузке пишем туда адрес первой следующей стрницы
 *
 * !!!Важно:
 * Количество сертификатов показываемых на одной странице в текущем компоненте
 * должно совпадать с колиеством сертификатов показываемых на странице в компоненте
 * собирающим данные для следующей страницы (get-next-sertificates-page.php), в компонентах
 * за это отвечает параметр "NEWS_COUNT" => "количество_показываемых_элементов"
 * Либо Инициализируемый адрес для первого запроса должен начинаться со страницы
 * содержащей следующеий сертификат после уже показанного.
 *
 * Для того чтобы компонент отвечающий на асинхонноый запрос отдавал чистые данные JSON
 * в папке его шаблона добален файл component_epilog.php в котором необходимые данные
 * вырезаются из содежания
 * /local/templates/.default/components/bitrix/news.list/ajax-news-list/component_epilog.php
 *
 * $arResult["NAV_RESULT"]->NavPageNomer; - Номер текущей страницы
 * $arResult["NAV_RESULT"]->NavPageCount; - Количество страниц
 * $arResult["NAV_RESULT"]->NavRecordCount; - Общее количество элементов
 * $arResult["NAV_RESULT"]->NavPageSize; - Количество элементов на странице
 */
?>
<div class="container">
    <ul class="row certificates__list" id="certificatesListContainer">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <li class="col-md-6 col-lg-4 col-xl-3"
                id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <a class="certificates__card"
                   data-fancybox="certificates__gallery"
                   href="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>">
                    <img class="certificates__pic"
                         src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                         alt="<?=$arItem["DETAIL_PICTURE"]["ALT"]?>"
                         title="<?=$arItem["DETAIL_PICTURE"]["TITLE"]?>">
                </a>
            </li>
        <?endforeach;?>
    </ul>
</div>
<?/* Выводим кнопку ЗАГРУЗИТЬ ЕЩЁ только в том случае
   * если номер тукущей страницы меньше
   * общего количества страниц с элементами
   */
if($arResult["NAV_RESULT"]->NavPageNomer < $arResult["NAV_RESULT"]->NavPageCount):?>
    <div class="get-more">
        <div class="container">
            <div class="d-flex justify-content-center page-certificates">
                <a class="get-more__link"
                   href="/utils/get-next-sertificates-page.php?PAGEN_1=2"
                   id="btnGetNextSertificates">
                    Загрузить ещё сертификаты
                </a>
            </div>
        </div>
    </div>
<?endif;?>
