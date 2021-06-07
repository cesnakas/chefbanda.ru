<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Сертификаты, профессиональная одежда для поваров в интернет-магазине Chef Banda");
$APPLICATION->SetPageProperty("description", "Интернет-магазин Chef Banda продает только профессиональную одежду для поваров. Все товары в каталоге имеют сертификаты.");
$APPLICATION->SetTitle("Сертификаты");

$_SESSION['brand']="";
$_SESSION['type']="";
?> 
<h1>О компании</h1>
<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"personal",
	Array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "",
		"COMPONENT_TEMPLATE" => "personal",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(),
		"MENU_CACHE_TIME" => "3600000",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "about_footer",
		"USE_EXT" => "N"
	)
);?> <br>
<h1>Сертификаты</h1>
<!--div class="filtr-sert">
	<div class="select-sert">
		<label>Бренд</label>
		<select name="brand">
			<?
			$arSelect = Array("ID", "NAME", "IBLOCK_ID");
$arFilter = Array("IBLOCK_ID"=>1, "ACTIVE"=>"Y", "=NAME" => "Униформа ChefWorks");
			$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>500), $arSelect);
			while($ob = $res->GetNextElement())
			{
			$arFields = $ob->GetFields();
			?>
			<option value="<?=$arFields["ID"]?>"><?=$arFields["NAME"]?></option>
			<?
			}
			?>
		</select>
	</div>
	<div class="select-sert">
 <label>Тип</label>
		<select name="type">
			<option value="все">(все)</option>
			<?
			$property_enums_type = CIBlockPropertyEnum::GetList(Array("VALUE"=>"ASC"), Array("IBLOCK_ID"=>21, "CODE"=>"TYPE"));
			while($enum_fields_type = $property_enums_type->GetNext())
			{
			?>
			<option value="<?=$enum_fields_type["VALUE"]?>"><?=$enum_fields_type["VALUE"]?></option>
			<?}?>
		</select>
	</div>
</div-->

<script>
	$(document).ready(function(){
		$("select[name=brand]").change(function(){
			var brand = $(this).val();
			var type = "<?=$_SESSION['type']?>";
			$.ajax({
				type: "POST",
				url: '/ajax/selectSertBrand.php',
				data: {brand: brand, type: type},
				success: function(data){
					$("#sertList").html(data);
				}
			});
		});

		$("select[name=type]").change(function(){
			var type = $(this).val();
			var brand = "<?=$_SESSION['brand']?>";
			$.ajax({
				type: "POST",
				url: '/ajax/selectSertBrand.php',
				data: {type: type, brand: brand},
				success: function(data){
					$("#sertList").html(data);
				}
			});
		});
	});
</script>

<div id="sertList">
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"sert", 
	array(
		"COMPONENT_TEMPLATE" => "sert",
		"IBLOCK_TYPE" => "info",
		"IBLOCK_ID" => "21",
		"NEWS_COUNT" => "100",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "TYPE",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"STRICT_SECTION_CHECK" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>