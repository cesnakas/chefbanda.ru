<?php 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	use Bitrix\Main,
		Bitrix\Main\Loader,
		Bitrix\Main\Entity,
		Bitrix\Main\Localization\Loc,
		Bitrix\Main\Type\DateTime,
		Bitrix\Highloadblock as HL,
		Bitrix\Sale\Internals;

	CModule::IncludeModule('highloadblock');
	$hlId = 8;
		$hlblock = HL\HighloadBlockTable::getById($hlId)->fetch();
		$entity = HL\HighloadBlockTable::compileEntity($hlblock);
		$entityClass = $entity->getDataClass();


global $USER;

if($USER->isAdmin() && $_REQUEST['ID']){
	\Bitrix\Main\Loader::includeModule('iblock');
	\Bitrix\Main\Loader::includeModule('catalog');
	\Bitrix\Main\Loader::includeModule('sale');

	$IBLOCK_ID = 23;
	$DISCOUNT_ID = intval($_REQUEST['ID']);
	
	if($DISCOUNT_ID > 0){
	
		$arSelect = Array("ID", "NAME", "IBLOCK_ID");
		$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		$i=0;
		while($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();
			$db_props = CIBlockElement::GetProperty($IBLOCK_ID, $arFields['ID'], array("sort" => "asc"), Array("CODE"=>"OFFERS"));
			$propValues = [];
			while($ar_props = $db_props->Fetch()){
				$propValues[] = $ar_props['VALUE'];
			}
			if(in_array(6104, $propValues)){
				$propValues = array_diff($propValues, [6104]);
				CIBlockElement::SetPropertyValuesEx($arFields['ID'], $IBLOCK_ID, ['OFFERS'=>$propValues]);
			}
		}
		unset($arSelect);
		unset($arFilter);
		unset($res);
		unset($ob);
		unset($arFields);
		unset($propValues);
		
		
		$groupDiscountIterator = Bitrix\Sale\Internals\DiscountTable::getList(array(
			'select' => array("CONDITIONS_LIST", "ACTIONS_LIST"),
			'filter' => array('ID'=>$DISCOUNT_ID, "ACTIVE" => "Y")
		));
		if ($groupDiscount = $groupDiscountIterator->fetch()) {
			$discountValue = $groupDiscount['ACTIONS_LIST']['CHILDREN'][0]['DATA']['Value'];
			$discPropValue = '-'.$discountValue.'%';
			$ibpenum = new CIBlockPropertyEnum;
			$ibpenum->Update(6104, Array('VALUE'=>$discPropValue));
			$filter=[];
			foreach($groupDiscount['ACTIONS_LIST']['CHILDREN'][0]['CHILDREN'] as $item){
				if($item['CLASS_ID']=='CondIBSection'){
					if($item['DATA']['logic']=="Not"){
						$obSect = CIBlockSection::GetByID($item['DATA']['value']);
						if ($sect = $obSect->GetNext())
						{
							$arFilter = array('IBLOCK_ID' => $IBLOCK_ID, '>LEFT_MARGIN' => $sect['LEFT_MARGIN'], '<RIGHT_MARGIN' => $sect['RIGHT_MARGIN'], '>DEPTH_LEVEL' => $sect['DEPTH_LEVEL']);
							$rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter);
							while ($arSect = $rsSect->GetNext())
							{
								$filter['!SECTION_ID'][] = $arSect['ID'];
							}
						}
						$filter['!SECTION_ID'][] = $item['DATA']['value'];
					} elseif($item['DATA']['logic']=="Equal"){
						$filter['SECTION_ID'][] = $item['DATA']['value'];
					}
					$filter["INCLUDE_SUBSECTIONS"] = "Y";
				} elseif($item['CLASS_ID']=='CondIBElement'){
					if($item['DATA']['logic']=="Not"){
						foreach($item['DATA']['value'] as $val){
							$filter['!ID'][] = $val;
						}
					} elseif($item['DATA']['logic']=="Equal"){
						foreach($item['DATA']['value'] as $val){
							$filter['=ID'][] = $val;
						}
					}
				} elseif(strpos($item['CLASS_ID'], 'CondIBProp') !== false){
					$cond = explode(":", $item['CLASS_ID']);
					if($item['DATA']['logic']=="Not"){
						$filter['!PROPERTY_'.$cond[2]][] = $item['DATA']['value'];
					} elseif($item['DATA']['logic']=="Equal"){
						$filter['PROPERTY_'.$cond[2]][] = $item['DATA']['value'];
					}
				}
			}
			file_put_contents($_SERVER['DOCUMENT_ROOT']."/logDiscount.txt", var_export($filter, 1));
			$arSelect = Array("ID", "NAME", "IBLOCK_ID");
			$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
			$arFilter = array_merge($arFilter, $filter);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			$i=1;
			while($ob = $res->GetNextElement())
			{
				$arFields = $ob->GetFields();
				$db_props = CIBlockElement::GetProperty($IBLOCK_ID, $arFields['ID'], array("sort" => "asc"), Array("CODE"=>"OFFERS"));
				$propValues = [];
				while($ar_props = $db_props->Fetch()){
				$propValues[] = $ar_props['VALUE'];
				}
				$propValues[] = 6104;
				CIBlockElement::SetPropertyValuesEx($arFields['ID'], $IBLOCK_ID, ['OFFERS'=>$propValues]);
				$i++;
			}
		} else {
			LocalRedirect("/bitrix/admin/sale_discount_edit.php?ID=".$DISCOUNT_ID."&lang=ru&filter=Y&set_filter=Y");
		}
	}

		$res_hl = $entityClass::getList(array(
			'select' => array('ID', 'UF_DISCOUNT_ID', 'UF_IS_PRODUCTS'),
			'filter'=> array('UF_DISCOUNT_ID' => $DISCOUNT_ID)
				   ));
		if($row = $res_hl->fetch()){
			$entityClass::update($row['ID'], array('UF_IS_PRODUCTS' => 1));
		} else {
			$entityClass::add(array('UF_DISCOUNT_ID' => $DISCOUNT_ID, 'UF_IS_PRODUCTS' => 1));
		}

	LocalRedirect("/bitrix/admin/sale_discount_edit.php?ID=".$DISCOUNT_ID."&lang=ru&filter=Y&set_filter=Y");
}