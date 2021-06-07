<?
require_once("conf.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/php_interface/include/import/conf.php");
\Bitrix\Main\Loader::includeModule("iblock");
file_put_contents($_SERVER["DOCUMENT_ROOT"]."/cron_import/log.log",Date("d.m.Y H:i:s ")."START\n",FILE_APPEND);
set_time_limit (1800);
$strTime=microtime(1);
$result=CSVImport\Manager::fullImport(0);
AveragePrice::doAll();
echo "<br>Time:";echo microtime(1)-$strTime;

CCatalogExport::PreGenerateExport(2);
 
 

?>