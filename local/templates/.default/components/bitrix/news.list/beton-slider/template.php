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

/* Рузультирующий массив $arResult перед выводом шаблона
 * обрабатывается в файле result_modifier.php (находится
 * в текущем щаблоне).
 * Из массива $arResult вырезаются все элементы статус
 * которыз не установлен как "Показывать в списке популярные"
 * в карточке товара.
 */

?>
<div class="prices section_container" id="concreteSlider">
    <div class="container">
        <div class="prices__title section_title">
            <?if($APPLICATION->GetCurPage() == '/produktsiya/'):?>
                ВАС ТАКЖЕ МОЖЕТ ЗАИНТЕРЕСОВАТЬ
            <?else:?>
                Лучшие предложения
            <?endif;?>
        </div>
        <div class="prices__link"><a href="/produktsiya/beton/">Перейти в каталог</a></div>
        <div class="prices__slider">
            <div class="slider product-slick-slider">
                <?
                    $isGroupOpen = false;

                    // Используем отдельный счётчик для элементов массива,
                    // т.к. в массиве $arResult не активные элементы вырезауются
                    // и ключи элемнтов не обязательно идут по порядку
                    $counter = 0;
                ?>
                <?foreach($arResult["ITEMS"] as $arItem):?>
                    <?
                        if ($counter%2 === 0 && !$isGroupOpen) {
                            echo '<div class="slider__item__group">';
                            $isGroupOpen = true;
                        }
                        $counter++;
                    ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="slider__item d-flex flex-column justify-content-start align-items-center"
                         id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <div class="prices__pic" style="background-image: url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>)"></div>
                        <div class="prices__caption">
                            <?=$arItem["PREVIEW_TEXT"]?>
                        </div>
                        <div class="prices__desc">
                            <?=$arItem["PROPERTIES"]["CONCRETE_GRADE"]["VALUE"]?>
                            <?=$arItem["PROPERTIES"]["CONCRETE_CLASS"]["VALUE"]?>
                            <?=$arItem["PROPERTIES"]["CONCRETE_MOBILITY"]["VALUE"]?>
                            <?=$arItem["PROPERTIES"]["CONCRETE_FROST"]["VALUE"]?>
                            <?=$arItem["PROPERTIES"]["CONCRETE_WATER"]["VALUE"]?>
                        </div>
                        <div class="prices__price"><?=$arItem["PROPERTIES"]["PRICE_MINIMUM"]["VALUE_XML_ID"] ? 'от' : '';?>
                            <span><?=$arItem["PROPERTIES"]["PRICE"]["VALUE"]?></span>руб./м<sup>2</sup>
                        </div>
                        <div class="prices__btn">
                            <a class="btn" href="<?=$arItem["DETAIL_PAGE_URL"]?>">ПОДРОБНЕЕ</a>
                        </div>
                    </div>
                    <?
                        if ($counter%2 === 0 && $isGroupOpen || $counter === count($arResult['ITEMS'])) {
                            echo '</div>';
                            $isGroupOpen = false;
                        }
                    ?>
                <?endforeach;?>
            </div>
        </div>
    </div>
</div>
