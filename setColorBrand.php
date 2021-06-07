<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application; 
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

CModule::IncludeModule('iblock');
CModule::IncludeModule('highloadblock');
set_time_limit(0);
ini_set("memory_limit", -1);


$data2 = file_get_contents($_SERVER['DOCUMENT_ROOT']."/colorBrandChef.csv");
		$data = explode("\n", $data2);
	$cnt = count($data);
   $hlblock = HL\HighloadBlockTable::getById(6)->fetch(); // id highload блока
   $entity = HL\HighloadBlockTable::compileEntity($hlblock);
   $entityClass = $entity->getDataClass();

foreach($data as $key => $d2) {

				$d = explode(";", $d2);
$d[0] = trim($d[0]);
$d[1] = trim($d[1]);
$file = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"].$d[1]);
$entityClass::add(array("UF_FILE" => $file, "UF_NAME" => $d[0], "UF_BRAND" => $d[2]));
}