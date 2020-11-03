<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '<div class="bread-crumbs"><div class="container"><div class="bread-crumbs__wrap d-flex justify-content-center"><ul class="bread-crumbs__list d-flex flex-wrap justify-content-center">';
$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
    $slash = ($index > 0 ? '&nbsp;/' : '');

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '
			<li class="bx-breadcrumb-item" id="bx_breadcrumb_'.$index.'">
				'. $slash .'
				<a class="bread-crumbs__link" 
                   href="'.$arResult[$index]["LINK"].'" 
                   title="'.$title.'">
					'.$title.'
				</a>
			</li>';
	}
	else
	{
		$strReturn .= '
			<li class="bx-breadcrumb-item">
				'. $slash .'
				<span class="bread-crumbs__link">'.$title.'</span>
			</li>';
	}
}
$strReturn .= '</ul></div></div></div>';
return $strReturn;