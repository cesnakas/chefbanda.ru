<?php

$_SERVER["DOCUMENT_ROOT"] = realpath(dirname(__FILE__) . "/..");
$DOCUMENT_ROOT            = $_SERVER["DOCUMENT_ROOT"];

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
global $USER;
//$USER->Authorize(1);

CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);

@set_time_limit(0);
@ignore_user_abort(true);


//$USER->Authorize(277);
$debug = false;
//$debug = true;


if($debug)
{
	ini_set('display_errors', 1);
	error_reporting(E_ERROR && E_WARNING);
}

CModule::IncludeModule('iblock');


$baseURL = 'https://chefbanda.ru';

//список цветов
CModule::IncludeModule('highloadblock'); // подключение модуля HL блоков

$hlBlockId         = 6; // ID Highload-блока
$hlBlock           = Bitrix\Highloadblock\HighloadBlockTable::getById($hlBlockId)->fetch(); // получаем объект вашего HL блока
$entity            = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlBlock);  // получаем рабочую сущность
$entity_data_class = $entity->getDataClass(); // получаем экземпляр класса
$entity_table_name = $hlBlock['TABLE_NAME']; // присваиваем переменной название HL таблицы
$sTableID          = 'tbl_' . $entity_table_name; // добавляем префикс и окончательно формируем название
$rsData            = $entity_data_class::getList(
	array(
		'select' => [
			'*',
		],
		'filter' => [
		],
	)
);
$colors            = [];
while ($el = $rsData->fetch())
{
	$colors[ $el['UF_XML_ID'] ] = $el['UF_NAME'];
}

global $IBLOCK_ID, $arSections;
$IBLOCK_ID = 23;//товары

$arSections = [];//категории
$arElements = [];//товары
$arProducts = [];//товары бренда
//$elementsIds = [];
$arOffers        = [];//товарные предложения
$quantityByCount = [];//количество товаров по цветам

/*
Поварские фартуки, Скрутки для ножей: 7235
Поварские кители, Рубашки для официантов: 2396
Поварские брюки: 7236
 */
$google_product_category = [
	7235 => [
		593,//Поварские фартуки
		598,//Скрутки для ножей
	],
	2396 => [
		590,//Поварские кители
		591,//Мужские поварские кители
		592,//Женские поварские кители
		597,//Рубашки для официантов
	],
	7236 => [
		594,//Поварские брюки
		595,//Мужские поварские брюки
		596,//Женские поварские брюки
	],
];
/*
Различаем по значению поля ТОВАРА Пол:
Женщинам: 455
Мужчинам: 472
Унисекс: 528
 */
$fb_product_category = [
	1374 => 455,//Женщинам
	1373 => 472,//Мужчинам
	1375 => 528,//Унисекс
];

$gender = [
	1374 => 'female',
	1373 => 'male',
	1375 => 'unisex',
];

$arInfo = CCatalogSKU::GetInfoByProductIBlock($IBLOCK_ID);

$productIdProp      = 'PROPERTY_' . $arInfo['SKU_PROPERTY_ID'];
$productIdPropValue = $productIdProp . '_VALUE';

//получение всех товаров бренда
$arSelect = [
	"ID",
	"NAME",
	"DETAIL_PAGE_URL",
	"PROPERTY_TSVET",
	"DETAIL_TEXT",
	"DETAIL_PAGE_URL",
	"SECTION_CODE",
	"PROPERTY_PROIZVODITEL",
	"PROPERTY_CML2_ARTICLE",
	"PROPERTY_POL",
	"PROPERTY_SOSTAV",
];
$arFilter = [
	"IBLOCK_ID"             => $IBLOCK_ID,
	"ACTIVE"                => "Y",
	"PROPERTY_PROIZVODITEL" => 6159,//Bandit
//	"ID"                    => 148951,//fot test
];

$arOrder = ["SORT" => "ASC"];
$res     = CIBlockElement::GetList($arOrder, $arFilter, false, $arLimit, $arSelect);

while ($arResult = $res->fetch())
{
	$arProducts[ $arResult['ID'] ] = $arResult;
}

$prodIds = array_keys($arProducts);

//выбор всех ТП товаров бренда
if(is_array($arInfo))
{
	$arFilter = [
		'IBLOCK_ID'    => $arInfo['IBLOCK_ID'],
		"ACTIVE"       => "Y",
		$productIdProp => $prodIds,
	];

	if($debug)
	{
//		$arFilter[ $productIdProp ] = 148940;//for test
	}

	$rsOffers = CIBlockElement::GetList(
		array(),
		$arFilter,
		false,
		[],
		[
			'ID',
			'IBLOCK_ID',
			'NAME',
			'PROPERTY_248',
			"DETAIL_PICTURE",
			"QUANTITY",
			"PROPERTY_PROIZVODITEL",
			$productIdProp,
		]
	);
	while ($arOffer = $rsOffers->GetNext())
	{
		//цвет ТП, если нет - пропуск
		$color = $colors[ $arOffer['PROPERTY_248_VALUE'] ];
		if(empty($color))
		{
			continue;
		}

		$productID = $arOffer[ $productIdPropValue ];
		$offerID   = $arOffer['ID'];


		$arPRODUCT     = $arProducts[ $productID ];
		$productSku    = $arPRODUCT['PROPERTY_CML2_ARTICLE_VALUE'];
		$productSostav = $arPRODUCT['PROPERTY_SOSTAV_VALUE'];

		//обработаные элементы
		$elementId = $productID . '_' . $color;

		//количество товаров по цветам
		$arOfferProduct = (\Bitrix\Catalog\Model\Product::getList(
			[
				'filter' => ['=ID' => $arOffer['ID']],
			]
		))->fetch();

		if(!isset($quantityByCount[ $elementId ]))
		{
			$quantityByCount[ $elementId ] = 0;
		}
		$quantityByCount[ $elementId ] += $arOfferProduct['QUANTITY'];

		//устанение дублей
		if(isset($arElements[ $elementId ]))
		{
			continue;
		}

		//пропуск товаров которых нет в наличии
		if(!$quantityByCount[ $elementId ])
		{
			continue;
		}

		//Получение категорий товара
		$prodSections = [];
		$arSelect2    = array("ID", "NAME", "CODE");
		$res          = CIBlockElement::GetElementGroups($productID, true, $arSelect2);
		while ($ob = $res->Fetch())
		{
			$prodSections[] = $ob['ID'];
		}

		//доп. фото
		$additional_image_linksStr = '';

		$MORE_PHOTO = [];
		$res        = CIBlockElement::GetProperty($arOffer['IBLOCK_ID'], $offerID, "sort", "asc",
		                                          array("CODE" => "MORE_PHOTO"));
		while ($ob = $res->Fetch())
		{
			$photo = CFile::GetPath($ob['VALUE']);
			if(!empty($photo))
			{
				$MORE_PHOTO[] = $baseURL . $photo;
			}
		}

		$SECTION_CODE = getSection($arPRODUCT['IBLOCK_SECTION_ID']);

		//Страничка товара на сайте.
		$arPRODUCT['ELEMENT_CODE'] = $arPRODUCT['CODE'];
		$arPRODUCT['SECTION_CODE'] = $SECTION_CODE;
		$detail_page_url           = $baseURL . \CIBlock::ReplaceDetailUrl(
				$arPRODUCT['DETAIL_PAGE_URL'],
				$arPRODUCT,
				true
			);


		//Детальное фото из любого СКУ данного Цвета.
		$photoID = $arOffer['DETAIL_PICTURE'];
		$photo   = CFile::GetPath($photoID);

		//Цена
		$price_result = CPrice::GetList(
			array(),
			array(
				"PRODUCT_ID"       => $productID,
				"CATALOG_GROUP_ID" => 2,
			)
		);
		while ($arPrices = $price_result->Fetch())
		{
			break;
		}

		if(!isset($arPrices['PRICE']) || empty($arPrices['PRICE']))
		{
			continue;
		}

		$price = $arPrices['PRICE'];
		$price = number_format($price, 2, '.', '');
		$price .= ' RUB';


		//required fields
		$arElement                 = [];
		$arElement['id']           = $productSku . '_' . $color;//Арикул, знак подчеркивания и писать Цвет из СКУ: BK19009_Белый
		$arElement['title']        = $arPRODUCT['NAME'];//Товар SEO Заголовок элемента:
		$arElement['description']  = HTMLToTxt($arPRODUCT['DETAIL_TEXT'], "", [
			"'<img[^>]*?>'si",
			"'<a[^>]*?>'si",
			"'<div[^>]*?>'si",
		]);
		$arElement['availability'] = 'out of stock';
		$arElement['condition']    = 'new';//Всегда new
		$arElement['price']        = $price;//Цена любого СКУ данного Цвета - СКУ стоят одинаково, такова наша ценовая политика.
		$arElement['link']         = $detail_page_url;//Страничка товара на сайте.
		$arElement['image_link']   = $baseURL . $photo;//Детальное фото из любого СКУ данного Цвета.
		$arElement['brand']        = $arPRODUCT['PROPERTY_PROIZVODITEL_VALUE'];//Свойство товара Товара Производитель

//		$arElement['item_group_id'] = $productSku;//Значение поля Артикул Товара, Например, BK19009
		$arElement['color']         = $color;//Значение поля Цвет из группы СКУ, Например, Белый
		$arElement['age_group']         = 'adult';//Всегда пишем значение adult
		$arElement['size']          = 'Уточняйте размер на сайте или у менеджера';//Всегда пишем значение adult
		$arElement['material']      = $productSostav;//Значение поля Состав Товара, Например, 55% полиэстер, 40% вискоза, 5% лайкра

		//https://developers.facebook.com/docs/marketing-api/catalog/reference/#da-commerce
		if(!empty($prodSections))
		{
			foreach ($google_product_category as $gCat => $gProductCategories)
			{
				if(!empty(array_intersect($gProductCategories, $prodSections)))
				{
					$arElement['google_product_category'] = $gCat;//google_product_category
					break;
				}
			}
		}

		if(!empty($fb_product_category[ $arPRODUCT['PROPERTY_POL_ENUM_ID'] ]))
		{
			$arElement['fb_product_category'] = $fb_product_category[ $arPRODUCT['PROPERTY_POL_ENUM_ID'] ];//fb_product_category
		}

		if(!empty($fb_product_category[ $arPRODUCT['PROPERTY_POL_ENUM_ID'] ]))
		{
			$arElement['gender'] = $gender[ $arPRODUCT['PROPERTY_POL_ENUM_ID'] ];//По значению поля Пол Товара выбираем английский аналог и пишем его
		}

		//доп. фото
		$MORE_PHOTO_STR                     = implode(',', $MORE_PHOTO);
		$arElement['additional_image_link'] = $MORE_PHOTO_STR;


		$arElements[ $elementId ] = $arElement;

		$arOffers[] = $arOffer;
	}
}

$arrHeaderCSV = [];

foreach ($arElements as $elementId => &$arElement)
{
	//поиск ТП товара с указаным цветом
	//Если есть хоть 1 шт Доступного количества для СКУ данного цвета - то in stock
	if($quantityByCount[ $elementId ] > 0)
	{
		$arElement['availability'] = 'in stock';
		$arElement['inventory']    = $quantityByCount[ $elementId ];//Сумма значений "Доступное количество" для всех СКУ данного Артикуло-Цвета
	}

	if(empty($arrHeaderCSV))
	{
		$arrHeaderCSV = array_keys($arElement);
	}
}

if($debug)
{
	print_r('<pre>');
	print_r('$arElement: ');
	print_r($arElements);
	print_r('</pre>');
	exit;
}


//make csv
//save data as CSV
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/classes/general/csv_data.php"); // Подключаем библиотеку CCSVData

$fileName = 'data_export_fb.csv';
$filePath = $_SERVER['DOCUMENT_ROOT'] . '/export/' . $fileName; // Путь до файла, куда записываем данные из инфоблока, от корня сайта
$fileUrl  = '/export/' . $fileName;

$fp = fopen($filePath,
            'w+'); // Очищаем файл CSV, иначе записи будут добавляться к уже имеющимся, причем, вместе с шапкой CSV
@fclose($fp); // Закрываем файл CSV

$fields_type = 'R'; // Дописываем строки в файл
$delimiter   = ";"; // Устанавливаем разделитель для CSV файла
$csvFile     = new CCSVData($fields_type, false); // Создаём объект – экземпляр класса CCSVData
$csvFile->SetFieldsType($fields_type); // Метод класса CCSVData, задающий тип записи в файл R
$csvFile->SetDelimiter($delimiter); // Метод класса CCSVData, устанавливающий разделитель
$csvFile->SetFirstHeader(false); // Метод класса CCSVData, указывающий, что первая строка будет шапкой

//Создаем шапку и записываем в CSV файл (не обязательно)
$csvFile->SaveFile($filePath, $arrHeaderCSV); // Записываем шапку в CSV файл

foreach ($arElements as &$arElement)
{
	$_arElement = [];
	foreach ($arElement as $item)
	{
		$_arElement[] = $item;
	}

	$csvFile->SaveFile($filePath, $_arElement); // Записываем шапку в CSV файл
}

if(ob_get_level())
{
	ob_end_clean();
}

$sapi = php_sapi_name();
if ($sapi=='cli') {
	exit;
}

// заставляем браузер показать окно сохранения файла
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . basename($fileName));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filePath));
// читаем файл и отправляем его пользователю
readfile($filePath);
exit;


function getSection($IBLOCK_SECTION_ID)
{
	global $IBLOCK_ID, $arSections;
	//категория
	if(!isset($arSections[ $IBLOCK_SECTION_ID ]))
	{
		//поиск категории
		$resSect = CIBlockSection::GetList(
			[],
			[
				"ID" => $IBLOCK_SECTION_ID,
			],
			false,
			[
				'ID',
				'CODE',
			]
		);

		$SECTION                          = $resSect->GetNext();
		$arSections[ $IBLOCK_SECTION_ID ] = $SECTION['CODE'];
	}

	return $arSections[ $IBLOCK_SECTION_ID ];
}










