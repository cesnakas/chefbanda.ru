<?php 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
\Bitrix\Main\Loader::includeModule('iblock');

$id = intval($_REQUEST['id']);
$iblock_id = intval($_REQUEST['iblock_id']);
$type = htmlspecialchars($_REQUEST['type']);

$arInfo = CCatalogSKU::GetInfoByProductIBlock($iblock_id);
$rsOffers = CIBlockElement::GetList(array(),array('IBLOCK_ID' => $arInfo['IBLOCK_ID'], 'PROPERTY_'.$arInfo['SKU_PROPERTY_ID'] => $id,
'PROPERTY_TYPE_SERT_VALUE' => $type));
if($ob = $rsOffers->GetNextElement()) {
	$arOffer = $ob->GetFields();
}
 if($type=="Для Розничной сети"){?>
<a href="#" class="addCart changeID changeQty changeCart" data-id="<?=$arOffer['ID']?>" data-quantity="1">
<img src="/bitrix/templates/dresscode/images/incart.png" class="icon">В корзину</a>

<?} else {?>
<a href="javascript:void(0);" class="addCart fastBack changeID"
<?/*<a href="javascript:void(0);" class="addCart bx_big bx_bt_button bx_cart h2o_giftsert_popup_link" */?>
					data-id="<?=$arOffer['ID']?>">
						<img src="/bitrix/templates/dresscode/images/incart.png" class="icon"><? echo "В корзину"; ?></a>

<?}?>