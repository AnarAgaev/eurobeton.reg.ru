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
?>
<div class="page-title">
    <div class="container">
        <h1 class="page-title__content"><?=$arResult['NAME']?></h1>
    </div>
</div>
<div class="single-news">
    <div class="container">
        <div class="single-news__slider">
            <div class="slider">
                <?/* Предыдущая/Следующая новости Start
                  * https://dev.1c-bitrix.ru/api_help/iblock/classes/ciblockelement/getlist.php
                  * Смотри Пример 6:
                  */
                $res=CIBlockElement::GetList(
                    array(
                        "SORT" => "DESC"
                    ),
                    array(
                        "ACTIVE"=>"Y",
                        "IBLOCK_ID"=>$arResult["IBLOCK_ID"],
                        "IBLOCK_SECTION_ID"=>$arResult["IBLOCK_SECTION_ID"]
                    ),
                    false,
                    array(
                        "nPageSize" => "1",
                        "nElementID" => $arResult["ID"]
                    ),
                    array(
                        "ID",
                        "NAME",
                        "DETAIL_PAGE_URL"
                    )
                );

                $navElement = array();
                while($ob = $res->GetNext()){
                    $navElement[] = $ob;
                }

                if (count($navElement) == 2 && $arResult["ID"] == $navElement[0]['ID']):?>
                    <a href="<?=$navElement[1]['DETAIL_PAGE_URL']?>/"
                       class="slider__controller slider__controller_left slider-controller-left"></a>
                <?elseif (count($navElement) == 3):?>
                    <a href="<?=$navElement[2]['DETAIL_PAGE_URL']?>/"
                       class="slider__controller slider__controller_left slider-controller-left"></a>
                    <a href="<?=$navElement[0]['DETAIL_PAGE_URL']?>/"
                       class="slider__controller slider__controller_right slider-controller-right"></a>

                <?elseif (count($navElement) == 2 && $arResult["ID"] == $navElement[1]['ID']):?>
                    <a href="<?=$navElement[0]['DETAIL_PAGE_URL']?>/"
                       class="slider__controller slider__controller_right slider-controller-right"></a>
                <?endif;?>

                <div class="slider__viewport">
                    <div class="slider__list d-flex">
                        <div class="slider__item">
                            <div class="single-news__pic" style="background-image: url(<?=$arResult['DETAIL_PICTURE']['SRC']?>)"></div>
                            <div class="single-news__content"><?=$arResult['DETAIL_TEXT']?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?/* Вставка включаемой области Баннер "Получить расчёт стоимости"
   * Внтури родительского контейнера включаемой области /include/request-price.php
   * две дочерние включаемые области /include/request-price-title.php и /include/request-price-txt.php
   * соответственно с заголовком блока и текстом блока
   */
$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => "/include/request-price.php"
    )
);?>

<?/* Вклчаемая область Промо "Сеть бетонных заводов ..."
   * Внтури родительского контейнера включаемой области /include/promo.php
   * две дочерние включаемые области /include/promo-title.php и /include/promo-list.php
   * соответственно с заголовком блока и списком преимуществ
   */
$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => "/include/promo.php"
    )
);?>
