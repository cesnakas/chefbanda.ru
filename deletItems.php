<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("deleting");
CModule::IncludeModule("iblock");
?>
<?

if($_REQUEST['secfastdel']>0){
	global $DB;
	$strSql = "
	DELETE FROM
	b_iblock_section
	WHERE `IBLOCK_ID`=".$_REQUEST['id'];

	$res = $DB->Query($strSql, false);
	LocalRedirect($APPLICATION->GetCurPage()."?succ=1");
}
?>



<?
if($_REQUEST['secdel']&&$_REQUEST['id']){
	$dLevel=$_REQUEST['lvl']!=""?$_REQUEST['lvl']:20;
	$ibId=$_REQUEST['id'];
	for(;$dLevel>0;){
		$arFilter = Array('IBLOCK_ID'=>$ibId, 'DEPTH_LEVEL'=>$dLevel);
		$secResult = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
		
		$secResult->NavStart(40);
		$secResult->NavPrint();
		while($section = $secResult->GetNext())
		{
			CIBlockSection::Delete($section['ID']) ;
		}
		if($secResult->SelectedRowsCount()==0)$dLevel--;
			else break;
	}
	?><br>
	Удаление разделов..
<script>
<?if($dLevel>=0): ?>
	location.href='?secdel=1&id=<?=$ibId ?>&lvl=<?=$dLevel ?>';
<?endif ?>	
</script>
<?
}
?>

<?

if($_REQUEST['eldel']&&$_REQUEST['id']){

		$ibId=$_REQUEST['id'];
		$arSelect = Array("ID");
		$arFilter = Array("IBLOCK_ID"=>$ibId);
		$elResult = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
		while($elem = $elResult->GetNext())
		{
			CIBlockElement::Delete($elem['ID']);
		}		
	?>
	Всего: 
	<?
	$all = CIBlockElement::GetList(Array(),  Array("IBLOCK_ID"=>$ibId), false, false, $arSelect);
	$total=$all->SelectedRowsCount();
	echo $total; ?><br>
	Удаление элементов..
<script>
<?if($total>0): ?>
	location.href='?eldel=1&id=<?=$ibId ?>';
<?endif ?>	
</script>
<?
}
?>
<?if($_REQUEST['succ'])echo "Все разделы удалены<br><br>" ?>
<div style="padding: 5px; border: 1px solid rgb(212, 212, 212); font-size: 15pt; float: left; margin: 10px;">
	<form>
		Удалить разделы<br><br>
		<input name='id' placeholder="ID инфоблока"> 
		<input name='secdel' type='hidden' value="1">
		<input type='submit'  value='Удалить' style="border: 1px solid rgb(135, 135, 135); padding: 0px 4px;"><br>
	</form>
</div>
<div style="padding: 5px; border: 1px solid rgb(212, 212, 212); font-size: 15pt; float: left; margin: 10px;">
	<form>
		Удалить элементы<br><br>
		<input name='id' placeholder="ID инфоблока"> 
		<input name='eldel' type='hidden' value="1">
		<input type='submit'  value='Удалить' style="border: 1px solid rgb(135, 135, 135); padding: 0px 4px;"><br>
	</form>
</div>

<div style="padding: 5px; border: 1px solid rgb(212, 212, 212); font-size: 15pt; float: left; margin: 10px;clear: both;">
	<form>
		<p style="color: rgb(201, 0, 0);">Быстрое удаление разделов<br><br></p>
		<input name='id' placeholder="ID инфоблока"> 
		<input name='secfastdel' type='hidden' value="1">
		<input type='submit'  value='Удалить' style="border: 1px solid rgb(135, 135, 135); padding: 0px 4px;"><br>
	</form>
	<div style="width: 279px; font-size: 10pt; color: dimgray;">
	Использовать только при очень большом колличестве разделов.<br> Предварительно удалить все елементы, если необходимо.
	
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>