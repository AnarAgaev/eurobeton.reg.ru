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
<div class="section table">
    <div class="container">
        <table class="table">
            <tbody class="table__body">
                <tr class="table__line table__line_caption">
                    <th>Информация о тендере</th>
                    <th><span class="date-line">Дата начала</span>и окончания</th>
                    <th>Место поставки</th>
                    <th>Начальная цена</th>
                    <th></th>
                </tr>
                <?foreach($arResult["ITEMS"] as $arItem):?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <tr class="table__line" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <td class="table__column">
                            <div class="table__cell-caption">Информация о тендере</div>
                            <?=$arItem['PROPERTIES']['DESCRIPTION']['~VALUE']['TEXT']?>
                        </td>
                        <td class="table__column">
                            <div class="table__cell-caption">Дата начала и окончания</div>
                            <div class="date d-flex justify-content-center align-items-center flex-xl-column">
                                <?=$arItem['PROPERTIES']['START']['VALUE']?>
                                <div class="line"></div>
                                <?=$arItem['PROPERTIES']['END']['VALUE']?>
                            </div>
                        </td>
                        <td class="table__column">
                            <div class="table__cell-caption">Место поставки</div>
                            <?=$arItem['PROPERTIES']['PLACE']['~VALUE']['TEXT']?>
                        </td>
                        <td class="table__column">
                            <div class="table__cell-caption">Начальная цена</div>
                            <?=$arItem['PROPERTIES']['PRICE']['VALUE']?>
                        </td>
                        <td class="table__column">
                            <button class="table__btn btn">ОСТАВИТЬ ЗАЯВКУ</button>
                        </td>
                    </tr>
                <?endforeach;?>
            </tbody>
        </table>
    </div>
</div>
