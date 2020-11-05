<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$content = ob_get_contents();
ob_end_clean();

$APPLICATION->RestartBuffer();
    list(, $json) = explode('<!--RestartBuffer-->', $content);
    echo $json;
die();