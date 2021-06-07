<?php 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');
CModule::IncludeModule('catalog');

echo "<pre>";
$rsParentSection = CIBlockSection::GetByID(196);
if ($arParentSection = $rsParentSection->GetNext())
{
$arFilter = array('IBLOCK_ID' => 17,'>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],'>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']);
   $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter);
   while ($arSect = $rsSect->GetNext())
   {
		$bs = new CIBlockSection;
		$arFields = Array(
		  "ACTIVE" => "Y",
		  "IBLOCK_SECTION_ID" => $IBLOCK_SECTION_ID,
		  "IBLOCK_ID" => 19,
		  "NAME" => $arSect['NAME'],
		  "CODE" => $arSect['CODE']
		  );
var_dump($arSect);
	   /*$ID = $bs->Add($arFields);
		  $res = ($ID>0);

		
		if(!$res)
echo $bs->LAST_ERROR;*/
   }

}

echo "</pre>";