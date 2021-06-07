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
<div class="win-call-back-comp" id="<?=$arParams["ID_WINDOW"];?>" >
		<span class="win-call-title"><?=$arParams["LINK_NAME"];?></span>
			<form action="" method="post" name="formsend"> 
			<fieldset>
				<label>Имя</label>
				<div class="win-call-text-wrap">
					<input type="text" class="text-input" value="" name="NAME">
					<?=$arResult["ERRORS"]['NAME']?>
				</div>
			<?foreach($arParams["PROPERTY_CODE"] as $code):?>
				<label><?=$arResult["PROPERTIES"][$code]['NAME']?></label>
				<div class="win-call-text-wrap">
					<input type="text" class="text-input" value="" name="<?=$code?>">
					<?=$arResult["ERRORS"][$code]?>
				</div>
			<?endforeach;?>	
		<?php if($arParams["USE_CAPTCHA"]=="Y"):?>
				<label>Код</label>
				<div class="win-call-text-wrap">
					<input type="hidden" name="captcha_sid" value="<?=$arResult['CAPTCHA_CODE'];?>" />
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult['CAPTCHA_CODE'];?>" alt="CAPTCHA"  style="height: 29px; float: left; margin-right: 9px;" />
					<input type='text' value=''  name='captcha_word' style="width: 104px;">
					<?=$arResult["ERRORS"]['captcha_word']?>
				</div>	
		<?php endif?>
			
				<input type="submit" class="win-call-submit" value="Отправить">
				<input name="<?=$arParams["ID_BUTT"];?>" type="hidden" value=1>	
			</fieldset>
		</form>
	</div>
	<?if($arParams["LINK_SHOW"]=="Y"):?>
		<a href="#<?=$arParams["ID_WINDOW"];?>" class="fancybox-call-back"><?=$arParams["LINK_NAME"];?></a>
	<?endif;?>