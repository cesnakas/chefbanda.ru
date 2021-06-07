<?
require_once("conf.php");
$_SERVER['DOCUMENT_ROOT'] = "/var/www/bandit/data/www/chefbanda.ru";
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
set_time_limit (300);
$strTime=microtime(1);
ColorPower::doAll();
echo "Time:";echo microtime(1)-$strTime;

if($_REQUEST['auto']){
	echo "<script>";
	//echo 	"location.href='?auto=1'";
	echo "</script>";
	
}


?>