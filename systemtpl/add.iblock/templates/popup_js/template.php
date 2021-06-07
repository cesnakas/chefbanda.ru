<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>
<div class="window-call-fon" onclick="$('#<?=$arParams["ID_WINDOW"];?>').hide();$('.window-call-fon').hide();"></div>
<div class="window-call-block" id="<?=$arParams["ID_WINDOW"];?>" >
		<span ><?=$arParams["LINK_NAME"];?></span>
			<form action="" method="post" name=""> 
				<label>Имя</label>
				<div class="window-call-block-wrap">
					<input type="text" class="window-call-block-input" value="" name="NAME">
					<?=$arResult["ERRORS"]['NAME']?>
				</div>
			<?foreach($arParams["PROPERTY_CODE"] as $code):?>
				<label><?=$arResult["PROPERTIES"][$code]['NAME']?></label>
				<div class="window-call-block-wrap">
					<input type="text" class="window-call-block-input" value="" name="<?=$code?>">
					<?=$arResult["ERRORS"][$code]?>
				</div>
			<?endforeach;?>	
			<?php if($arParams["USE_CAPTCHA"]=="Y"):?>
				<label>Код</label>
				<div class="window-call-block-wrap">
					<input type="hidden" name="captcha_sid" value="<?=$arResult['CAPTCHA_CODE'];?>" />
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult['CAPTCHA_CODE'];?>" alt="CAPTCHA"  style="height: 29px; float: left; margin-right: 9px;" />
					<input type='text' value=''  name='captcha_word' style="width: 104px;">
					<?=$arResult["ERRORS"]['captcha_word']?>
				</div>
			
		<?php endif?>
				<input type="submit" class="window-call-block-submit" value="Отправить">
				<input name="<?=$arParams["ID_BUTT"];?>" type="hidden" value=1>	
		</form>
	</div>
	<?if($arParams["LINK_SHOW"]=="Y"):?>
		<a style="cursor:pointer" onclick="$('#<?=$arParams["ID_WINDOW"];?>').show();$('.window-call-fon').show();"><?=$arParams["LINK_NAME"];?></a>
	<?endif;?>
	
 