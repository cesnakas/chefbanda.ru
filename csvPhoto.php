<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application; 

set_time_limit(0);
ini_set("memory_limit", -1);

		CModule::IncludeModule("iblock");
/*$arSelect = Array("ID", "NAME", "IBLOCK_ID");
				$arFilter = Array("IBLOCK_ID"=>14, "ACTIVE"=>"Y");
				$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>15000), $arSelect);
				$i=0;
				while($ob = $res->GetNextElement())
				{
				 $arFields = $ob->GetFields();
CIBlockElement::SetPropertyValuesEx($arFields["ID"], false, array("MORE_PHOTO" => array("del" => "Y")));
				}
return;*/


$request = Application::getInstance()->getContext()->getRequest(); 

if($request->isPost() ){

	$value = $request->getFile("file");   
	if($value && ($value['error'] ==0) ){


		$fid = CFile::SaveFile($value, "");


		$f = CFile::GetFileArray($fid);
		//var_dump($_SERVER['DOCUMENT_ROOT'].$f['SRC']);
		$data = file_get_contents($_SERVER['DOCUMENT_ROOT'].$f['SRC']);
		//var_dump($data);
		$data = explode("\n", $data);

		foreach($data as $key => $d) {
			//if($key == 0) continue;
			//if($key >= 14500 && $key < 15000) {
$d = explode(";", $d);
$arSelect = Array("ID", "NAME", "IBLOCK_ID", "PROPERTY_MORE_PHOTO");
var_dump($d[0]);
				$arFilter = Array("IBLOCK_ID"=>17, "ACTIVE"=>"Y", "=XML_ID" => $d[0]);
				$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
				$i=0;
				if($ob = $res->GetNextElement())
				{
				 $arFields = $ob->GetFields();
					/*$more = [];
					if(!is_array($arFields["PROPERTY_MORE_PHOTO_VALUE"])) {
$arFields["PROPERTY_MORE_PHOTO_VALUE"] = array($arFields["PROPERTY_MORE_PHOTO_VALUE"]);
					}
					//var_dump($arFields["PROPERTY_MORE_PHOTO_VALUE"]);
					foreach($arFields["PROPERTY_MORE_PHOTO_VALUE"] as $foto) {
						if($foto) {
						$img = CFile::GetPath($foto);
$more[] = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"].$img);
						}
					}

$more[] = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"].$d[4]);
CIBlockElement::SetPropertyValuesEx($arFields["ID"], false, array("MORE_PHOTO" => $more));*/

					$el = new CIBlockElement;
$arLoadProductArray = Array(
  "DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"].$d[1])
  );
$el->Update($arFields["ID"], $arLoadProductArray);
				}
				//}
		}		

		//LocalRedirect('/add.php?done=OK');




	}else{
		echo "Ошибка";
		echo "<pre>";
		var_dump($value);
		echo "</pre>";
	}
}
if($_REQUEST['done'])
	echo '<h4><strong>Фото обновлены</strong></h4>';
?>
<form action="" method="post" enctype="multipart/form-data">
	<input type="file" name="file" >
	<input type="submit" name="submit" value="Отправить">

</form>
