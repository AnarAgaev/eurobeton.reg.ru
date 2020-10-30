<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? //debug($arResult); ?>

<? if (!empty($arResult)) : ?>
    <div id="navContainer">
        <nav class="nav" id="headerTopNav">
            <ul class="nav__list d-flex">
                <?
                $previousLevel = 0;
                foreach($arResult as $arItem):?>

                    <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
                        <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
                    <?endif?>

                    <?if ($arItem["IS_PARENT"]):?>
                        <li class="drop nav__item d-flex flex-column align-items-start">
                            <a href="<?=$arItem["LINK"]?>"
                               class="<?if ($arItem["SELECTED"]) : ?>selected nav__link drop<?else : ?>nav__link drop<?endif?>">
                                <?=$arItem["TEXT"]?>
                            </a>
                            <ul class="<?= $arItem['PARAMS']['DIF_CLASS']; ?> dropdown__list d-flex flex-column">
                    <?else:?>
                        <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                            <li class="nav__item d-flex align-items-center">
                                <a href="<?=$arItem["LINK"]?>"
                                   class="<?if ($arItem["SELECTED"]):?>selected nav__link<?else:?>nav__link<?endif?>">
                                    <?=$arItem["TEXT"]?>
                                </a>
                            </li>
                        <?else:?>
                            <li class="dropdown__item">
                                <a href="<?=$arItem["LINK"]?>"
                                   class="<?if ($arItem["SELECTED"]):?>selected dropdown__link<?else:?>dropdown__link<?endif?>">
                                    <?=$arItem["TEXT"]?>
                                </a>
                            </li>
                        <?endif?>
                    <?endif?>
                    <?$previousLevel = $arItem["DEPTH_LEVEL"];?>
                <?endforeach?>

                <?if ($previousLevel > 1)://close last item tags?>
                    <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
                <?endif?>
            </ul>
        </nav>
    </div>
<? endif ?>
