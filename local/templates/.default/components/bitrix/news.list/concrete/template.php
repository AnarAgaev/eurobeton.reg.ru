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
 * На странице реализована AJAX подгрузка товаров раздела Бетон после клика по кноаке ЗАГРУЗИТЬ ЕЩЁ ТОВАРЫ
 *
 * Обработчик клика и реализация AJAX запроса в файле script.js соответствующего шаблона
 * /local/templates/.default/components/bitrix/news.list/concrete/script.js
 *
 * Компонент собирающий и отдающй данные (товары следующей страницы)
 * реализован в файле /utility/get-next-beton-page.php
 *
 * Ссылка для получения данных хранится в параметре href у кнопки ЗАГРУЗИТЬ ЕЩЁ ТОВАРЫ
 * При первой загрузке пишем туда адрес первой следующей стрницы
 * в нашем случае это 3 страница, т.к. на превой странице выводим 8 товаров, а далее
 * подгружаем по 4 товара после каждого клика по кнопке ЗАГРУЗИТЬ ЕЩЁ ТОВАРЫ
 *
 * Для того чтобы компонент отвечающий на асинхонноый запрос отдавал чистые данные JSON
 * в папке его шаблона добален файл component_epilog.php в котором необходимые данные
 * вырезаются из содежания
 * /local/templates/.default/components/bitrix/news.list/ajax-beton-list/component_epilog.php
 *
 */
//debug($arResult['ITEMS']);
?>
<div class="catalog">
    <div class="container">
        <div class="row justify-content-center justify-content-sm-start"
             id="itemsListContainer">
            <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="col-sm-6 col-lg-4 col-xl-3 catalog__item d-flex flex-column justify-content-start align-items-center"
                     id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <div class="prices__pic" style="background-image: url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>)"></div>
                    <div class="prices__caption"><?=$arItem["PREVIEW_TEXT"]?></div>
                    <div class="prices__desc">
                        <?if ($arItem["PROPERTIES"]["CONCRETE_GRADE"]["VALUE"] !== 'Цементное молоко'
                            && $arItem["PROPERTIES"]["CONCRETE_GRADE"]["VALUE"] !== 'Пусковая смесь'
                            && $arItem["PROPERTIES"]["CONCRETE_GRADE"]["VALUE"]
                        ) echo $arItem["PROPERTIES"]["CONCRETE_GRADE"]["VALUE"];?>
                        <?=$arItem["PROPERTIES"]["CONCRETE_MOBILITY"]["VALUE"] ?: ''?>
                        <?=$arItem["PROPERTIES"]["CONCRETE_FROST"]["VALUE"] ?: ''?>
                        <?=$arItem["PROPERTIES"]["CONCRETE_WATER"]["VALUE"] ?: ''?>
                        <?=$arItem["PROPERTIES"]["CONCRETE_FILLER"]["VALUE"] ?: ''?>
                        <?/*=$arItem["PROPERTIES"]["CONCRETE_ANTIFREEZE_ADDITIVE"]["VALUE"] ?: ''*/?>
                    </div>
                    <div class="prices__price">
                        <?
                        // Определяем минмальную цену товара на предприятии
                        // Если цен более чем одна, добавляем приставку от

                        $PRICE_COUNT = 0;
                        $PRICE = false;

                        for ($i = 350; $i < 356; $i++) {
                            $CURRENT_PRICE = (float) str_replace(',','.',$arItem['PROPERTIES']['PRICE_FACTORY_ID_'.$i]['VALUE']);

                            if ($CURRENT_PRICE != 0) {
                                $PRICE = !$PRICE
                                    ? $CURRENT_PRICE
                                    : $CURRENT_PRICE < $PRICE
                                        ? $CURRENT_PRICE
                                        : $PRICE;
                                $PRICE_COUNT++;
                            }
                        }

                        if ($PRICE_COUNT > 0) echo 'от ';
                        echo '<span>'.$PRICE . '</span> руб./м<sup>3</sup>';?></div>
                    <div class="prices__btn">
                        <a class="btn" href="<?=$arItem["DETAIL_PAGE_URL"]?>">подробнее</a>
                    </div>
                </div>
            <?endforeach;?>
        </div>
    </div>
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
                   href="/utils/get-next-beton-page.php?PAGEN_1=3"
                   id="btnGetNextBetonPage">
                    Загрузить ещё товары
                </a>
            </div>
        </div>
    </div>
<?endif;?>