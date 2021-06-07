<?php 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$city = htmlspecialchars($_REQUEST['city']);
$arPlacemarks = $_REQUEST['arPlacemarks'];
$stores = $_REQUEST['stores'];
var_dump($stores);
switch($city){
	case "Санкт-Петербург" : 
		$lat = 59.95;
		$lon = 30.43;
		$z = 11;
		break;
	case "Казань" :
		$lat = 37.5;
		$lon = 49.16;
		$z = 13;
		break;
	case "Москва" :
	case "Все города" :
		$lat = 55.75;
		$lon = 37.6;
		$z = 10;
}

?>
<div id="storeListMap">
<?
$APPLICATION->IncludeComponent("bitrix:map.yandex.view", ".default", array(
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => serialize(array("yandex_lat"=>$lat,"yandex_lon"=>$lon,"yandex_scale"=>$z,"PLACEMARKS" => $arPlacemarks)),
		"MAP_WIDTH" => "auto",
		"MAP_HEIGHT" => "500",
		"CONTROLS" => array(
			0 => "ZOOM",
		),
		"OPTIONS" => array(
			//0 => "ENABLE_SCROLL_ZOOM",
			1 => "ENABLE_DBLCLICK_ZOOM",
			2 => "ENABLE_DRAGGING",
		),
		"MAP_ID" => ""
	),
	$component,
	array("HIDE_ICONS" => "Y")
);
?>
</div>
		<div id="storesList">
			<?foreach ($stores as $ins => $arNextStore):

var_dump($arNextStore);
if($arNextStore['UF_CITY'] != $city) continue;
?>
				<div class="storesListItem">
					<div class="storesListItemLeft">
						<div class="storesListItemContainer">
							<?
								if(!empty($arNextStore["DETAIL_IMG"])){
									$arNextStoreImage = CFile::ResizeImageGet($arNextStore["DETAIL_IMG"], array("width" => 170, "height" => 100), BX_RESIZE_IMAGE_PROPORTIONAL, false);
								}else{
									$arNextStoreImage["src"] = $templateFolder."/images/empty.png";
								}
							?>
							<?if(!empty($showPictures)):?>
								<div class="storesListItemPicture">
									<a href="<?=$arNextStore["URL"]?>" class="storesListTableLink"><img src="<?=$arNextStoreImage["src"]?>" alt="<?=$arNextStore["TITLE"]?>" title="<?=$arNextStore["TITLE"]?>"></a>
								</div>
							<?endif;?>
							<div class="storesListItemName">
								<a href="<?=$arNextStore["URL"]?>" class="storesListTableLink"><?=$arNextStore["TITLE"]?></a>
								<?if(!empty($arNextStore["DESCRIPTION"])):?>
									<p class="storeItemDescription"><?=$arNextStore["DESCRIPTION"]?></p>
								<?endif;?>
								<div class="storesListItemScheduleSmall">
									<img src="<?=$templateFolder."/images/timeSmall.png";?>" alt="<?=$arNextStore["SCHEDULE"]?>" title="<?=$arNextStore["SCHEDULE"]?>" class="storeListIconSmall">
									<span class="storesListItemScheduleLabel"><?=$arNextStore["SCHEDULE"]?></span>
									<div class="storesListItemHowget">
										<span class="storesListItemLabel">
											<a href="<?=$arNextStore["URL"]?>#storeHowmap_other" class="storesListTableMailLink">Как добраться?</a>
										</span>
									</div>
									<div class="storesListItemOnMap">
										<span class="storesListItemLabel">
											<a href="<?=$arNextStore["URL"]?>#storeDetailMap" class="storesListTableMailLink">Посмотреть на карте</a>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
						<?
						if(strpos($arNextStore["PHONE"], ",") !== false) 
						{
						$phone = str_replace("-", "", substr($arNextStore["PHONE"], 0, strpos($arNextStore["PHONE"], ",")));
						$dob = substr($arNextStore["PHONE"], strpos($arNextStore["PHONE"], ",")+1);
						}
						else
						{
						$phone = str_replace("-", "", $arNextStore["PHONE"]);
						$dob="";
						}
						?>
					<div class="storesListItemRight">
						<div class="storesListItemContainer">
							<div class="storesListItemHowget">
								<img class="storeListIcon" src="/bitrix/templates/dresscode/images/how-to-get.png" alt="Как добраться?"/>
								<span class="storesListItemLabel">
									<a href="<?=$arNextStore["URL"]?>#storeHowmap_other" class="storesListTableMailLink">Как добраться?</a>
								</span>
							</div>
							<div class="storesListItemOnMap">
								<img class="storeListIcon" src="/bitrix/templates/dresscode/images/on-map-ico.png" alt="Посмотреть на карте"/>
								<span class="storesListItemLabel">
									<a href="<?=$arNextStore["URL"]?>#storeDetailMap" class="storesListTableMailLink">Посмотреть на карте</a>
								</span>
							</div>
							<div class="storesListItemSchedule">
								<img src="<?=$templateFolder."/images/time.png";?>" alt="<?=$arNextStore["SCHEDULE"]?>" title="<?=$arNextStore["SCHEDULE"]?>" class="storeListIcon">
								<span class="storesListItemLabel"><?=$arNextStore["SCHEDULE"]?></span>
							</div>
							<div class="storesListItemPhone">
								<span class="storesListItemPhoneLabel"><?=GetMessage("STORES_LIST_TELEPHONE")?></span>
								<img src="<?=$templateFolder."/images/phone.png";?>" alt="<?=$arNextStore["PHONE"]?>" title="<?=$arNextStore["PHONE"]?>" class="storeListIcon">
								<span class="storesListItemLabel"><a class="storesListTableMailLink" href="tel:<?=$phone?>"><?=$phone?></a><?=$dob?></span>
							</div>
							<div class="storesListItemEmail">
								<img src="<?=$templateFolder."/images/mail.png";?>" alt="<?=$arNextStore["EMAIL"]?>" title="<?=$arNextStore["EMAIL"]?>" class="storeListIcon">
								<span class="storesListItemLabel">
									<a href="mailto:<?=$arNextStore["EMAIL"]?>" class="storesListTableMailLink"><?=$arNextStore["EMAIL"]?></a>
								</span>
							</div>
						</div>
					</div>
				</div>
			<?endforeach;?>
		</div>