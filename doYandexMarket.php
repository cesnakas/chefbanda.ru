<?
$_SERVER["DOCUMENT_ROOT"] = __DIR__;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule("catalog");

CCatalogExport::PreGenerateExport(2);