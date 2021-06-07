<?php 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

CModule::IncludeModule("highloadblock");

$hlblock = HL\HighloadBlockTable::getById(5)->fetch();
$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$data2 = file_get_contents($_SERVER['DOCUMENT_ROOT']."/cards.csv");
$data = explode("\n", $data2);

foreach($data as $key => $d2) {
	if($key < 10){
		$d = explode(";", $d2);
		$result = $entity_data_class::add(
                  array(
                           'UF_NAME' => $d[1],
                           'UF_XML_ID' => $d[2],
                           'UF_VERSION' => $d[3],
                           'UF_DESCRIPTION' => $d[4],
							'UF_KOD' => $d[5],
							'UF_KODKARTY' => $d[6],
							'UF_NAKOPLENIE' => $d[7],
							'UF_PROTSENTSKIDKI' =>$d[8]
                        )
                     );
				if ($result->isSuccess()) 
               {         
                  echo 'ДОБАВЛЕН ' . $result->getId() . "\n";         
               }
               else
               { 
                  echo 'ОШИБКА ' . implode(', ', $result->getErrors()) . "\n";
               }  
		//var_dump($d);
	}
}