<?
require_once("conf.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/php_interface/include/import/conf.php");
set_time_limit (1800);
$strTime=microtime(1);
CSVImport\Manager::loadAmount(0);
echo "Time:";echo microtime(1)-$strTime;

if($_REQUEST['auto']){
	echo "<script>";
	//echo 	"location.href='?auto=1'";
	echo "</script>";
	
}




/*
function ssh_exec($ip, $command) {
	$connection = ssh2_connect($ip, 22);
	if (ssh2_auth_pubkey_file($connection, 'cwru', $_SERVER['DOCUMENT_ROOT'].'/cron_import/keys/publickey', $_SERVER['DOCUMENT_ROOT'].'/cron_import/keys/privatekey')) {	
		if($sftp = ssh2_sftp($connection)){		
			if($stream = fopen('ssh2.sftp://' . intval($sftp) . '/inventory/aasqty.csv', 'r')){
				$rawData="";
				while($contents= fread($stream, 102400)){
					$rawData.=$contents;
				}
				file_put_contents($_SERVER["DOCUMENT_ROOT"]."/upload/aasqty_n.csv",$rawData);				
				fclose($stream);
			} else {	
				echo "stream error \n";
			}	
			
		} else {	
			echo "sftp error \n";
		}

	} else {
		die('<br>Public Key Authentication Failed<br>');
	}
}
ssh_exec("sftp.chefworks.com");*/
?>