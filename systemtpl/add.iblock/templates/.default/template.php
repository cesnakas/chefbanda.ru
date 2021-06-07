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
$ajax_send=($_REQUEST["ajax_send"]==1&&$_REQUEST[$arParams["ID_BUTT"]]);
?>
<?if($arResult['SUCCSES']): ?>
	<?if($ajax_send) $APPLICATION->RestartBuffer();?>
				
	<?echo  htmlspecialchars_decode($arParams["SUCCES_TEXT"]); ?>
	
	<?if($ajax_send) exit;?>
<?endif?>




<?if(!$arResult['SUCCSES']||$arParams["SUCCES_SHOW"]=="Y"): ?>
<span class='page-call-block-span'><?=$arParams["LINK_NAME"];?></span>
<div class='page-call-block'>
		<br>
			<form action="" method="post" name="" id="form-<?=$arParams["ID_BUTT"];?>"  <?//enctype="multipart/form-data" ?>> 
<?if($ajax_send) $APPLICATION->RestartBuffer();?>			
				<label>Имя</label>
				<div class="page-call-block-wrap">
					<input type="text" class="page-call-block-input" value="<?=$arResult["VALUES"]['NAME']?>" name="NAME">
					<?=$arResult["ERRORS"]['NAME']?>
				</div>
			<?foreach($arParams["PROPERTY_CODE"] as $code):?>
				<label><?=$arResult["PROPERTIES"][$code]['NAME']?> <?if($arResult["PROPERTIES"][$code]['REQUEST']): ?>*<?endif ?></label>
				<div class="page-call-block-wrap">
					<input type="text" class="page-call-block-input" value="<?=$arResult["VALUES"][$code]?>" name="<?=$code?>">
					<?=$arResult["ERRORS"][$code]?>
				</div>
			<?endforeach;?>	
		<?php if($arParams["USE_CAPTCHA"]=="Y"):?>
				<label>Код</label>
				<div class="page-call-block-wrap">
					<input type="hidden" name="captcha_sid" value="<?=$arResult['CAPTCHA_CODE'];?>" />
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult['CAPTCHA_CODE'];?>" alt="CAPTCHA"  style="height: 29px; float: left; margin-right: 9px;" />
					<input type='text' value=''  name='captcha_word' style="width: 104px;">
					<?=$arResult["ERRORS"]['captcha_word']?>
				</div>
			
		<?php endif?>
			
				<input type="submit" class="page-call-block-submit"  value="Отправить">
				
		<?foreach($arParams["HIDE"] as $code=>$data): ?>
			<input name="<?=$code;?>" type="hidden" value="<?=$data?>">	
		<?endforeach ?>   
		<?if($arParams["USE_HIDDEN"]=="Y"): ?> 
			<input name="sfEmail" type="text" value="" style="display:none;">	
		<?endif ?> 
				<input name="<?=$arParams["ID_BUTT"];?>" type="hidden" value=1>	
<?if($ajax_send) exit;?>					
		</form>
</div>
	<?if($arParams['SEND_AJAX']=="Y"): ?>
	 <script>
	 BX.ready(function(){ 
		 $("#form-<?=$arParams["ID_BUTT"];?>" ).submit(function() { 
		 	
			var form=$(this);
		 	$.post(location.href,
		 			$(this).serialize()+"&ajax_send=1", 
		 		     function(data)
		 		     {
		 		   
		 		     //var ar_data = JSON.parse(data);
		 		     form.html(data);
		 		     },
		 		     'html'
		 		     );
		 	
		 	return false;
			 });
	 });
	 </script>
	 <?endif ?>
 <?endif ?>