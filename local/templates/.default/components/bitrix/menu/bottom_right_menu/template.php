<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
    <ul class="footer__nav__list section3 d-flex flex-wrap flex-lg-column">

    <? foreach($arResult as $arItem):
        if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
            continue;
    ?>
        <?if($arItem["SELECTED"]):?>
            <li class="footer__nav__item">
                <a href="<?=$arItem["LINK"]?>" class="nav__link selected">
                    <?=$arItem["TEXT"]?>
                </a>
            </li>
        <?else:?>
            <li class="footer__nav__item">
                <a href="<?=$arItem["LINK"]?>" class="nav__link">
                    <?=$arItem["TEXT"]?>
                </a>
            </li>
        <?endif?>
    <?endforeach?>
    </ul>
<?endif?>
