<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application; 
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

CModule::IncludeModule('iblock');
CModule::IncludeModule('highloadblock');
set_time_limit(0);
ini_set("memory_limit", -1);

function meta_page_refresh($url,$time=0){
        if($time<0)$time=0;
        echo '
        <meta http-equiv="refresh" content="'.$time.';url='.$url.'">';
}
		$stepInterval = 15;
    $startTime = time();

if (!isset($_GET['id'])) {
        $ns['id'] = -1;
    } else {
	$ns['id'] = (int)$_GET['id'];
	}

		$data2 = file_get_contents($_SERVER['DOCUMENT_ROOT']."/imageTp140318.csv");
		$data = explode("\n", $data2);
	$cnt = count($data);
   $hlblock = HL\HighloadBlockTable::getById(2)->fetch(); 
   $entity = HL\HighloadBlockTable::compileEntity($hlblock);
   $entityClass = $entity->getDataClass();
		echo "<pre>";

			foreach($data as $key => $d2) {
				if($key > $ns['id']) {
				$d = explode(";", $d2);

				$d[2] = trim($d[2]);

				$arSelect = Array("ID", "NAME", "IBLOCK_ID", "PROPERTY_MORE_PHOTO");
				$arFilter = Array("IBLOCK_ID"=>17, "ACTIVE"=>"Y", "=XML_ID" => $d[0]);
				$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
				$i=0;
				if($ob = $res->GetNextElement())
				{
				 $arFields = $ob->GetFields();

					if(strpos($d[2], "скетч") !== false || strpos($d[2], "образец") !== false) {
						//$arFile = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"].$d[1]);
						//CIBlockElement::SetPropertyValueCode($arFields["ID"], "MORE_PHOTO", Array("VALUE"=>$arFile));
					} else {

$arInfo = CCatalogSKU::GetInfoByProductIBlock(17);
if (is_array($arInfo))
{ 
	$rsOffers = CIBlockElement::GetList(array(),array('IBLOCK_ID' => $arInfo['IBLOCK_ID'], 'PROPERTY_'.$arInfo['SKU_PROPERTY_ID'] => $arFields["ID"]));
	while($ob2 = $rsOffers->GetNextElement()) {
		$arOffer = $ob2->GetFields();
		$arOfferProps = $ob2->GetProperties();
		//var_dump($arOffer["NAME"]);
		//var_dump($arOfferProps["TSVET"]['VALUE']);
		if($arOfferProps["TSVET"]['VALUE']) {
		$res_hl = $entityClass::getList(array(
			   'select' => array('UF_NAME'),
			   'filter' => array('UF_XML_ID' => $arOfferProps["TSVET"]['VALUE'])
		   ));

		$row = $res_hl->fetch();
$tsvet = $row["UF_NAME"];
		} else {
			$tsvet = substr($arOffer["NAME"], strpos($arOffer["NAME"], ", ")+2, -1);
		}
		if($tsvet == $d[2]) {

			$arFile = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"].$d[1]);
			CIBlockElement::SetPropertyValueCode($arOffer["ID"], "MORE_PHOTO", Array("VALUE"=>$arFile));
			}
			//var_dump($arOffer["ID"]);

			//var_dump($update);
		}
		//var_dump($row);
	}
}
				}

$ns['id'] = $key;

				}


	if ($stepInterval > 0 && (time() - $startTime) > $stepInterval) {
	 break;
	}
			}


if($ns['id'] < $cnt-1) {
	meta_page_refresh('csvImageTp.php?id='.$ns['id'], 0);
} else {
echo "Готово";
}
		echo "</pre>";		