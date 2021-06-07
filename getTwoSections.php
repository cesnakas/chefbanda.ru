<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
if($USER->isAdmin()){
\Bitrix\Main\Loader::includeModule('iblock');

$IBLOCK_ID = 23;

$products = [];
$arSelect = Array("ID", "NAME", "IBLOCK_ID", "IBLOCK_SECTION_ID");
$arFilter = Array("IBLOCK_ID"=>IntVal($IBLOCK_ID), "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
 	$arFields = $ob->GetFields();
	$sect_ids = [];
	$dbSect = CIBlockElement::GetElementGroups($arFields['ID']);
	while($arSect = $dbSect->Fetch()){
		$sect_ids[$arSect['ID']] = $arSect['NAME'];
	}
	if(count($sect_ids) > 1){
		$products[$arFields['NAME']] = $sect_ids;
	}

}
?>
<h2>Товары в нескольких разделах</h2>
<table>
<?
$i=1;
foreach($products as $name => $sections){
?>
	<tr>
		<td><?=$i?>.</td>
		<td><?=$name?></td>
		<?foreach($sections as $id => $sect){?>
		<td><?=$id?> <?=$sect?></td>
		<?}?>
</tr>
<?
$i++;
}
?>
</table>
<?}?>