<?php

//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 

//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/lib/site_ini.php");
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/site_ini.php");

$type=$_POST['type'];

$MyProfileId=$_SESSION['iSMuProfTypeKey'];
$MyUserId=$_SESSION['iSMuIdKey'];

$table=selectTable($MyProfileId);
$anexo='WallAlert';
$tableWallAlert=$table.$anexo;

$oDB=new mysql;
$oDB->connect();
$oDB2=new mysql;
$oDB2->connect();

switch ($type){
	/*case 'seeAlerts':
		
		$sSQL_Select=GenerateSelect('*',$tableWallAlert,"id_user=$MyUserId and viewed=0");
		if($result=$oDB->query($sSQL_Select)){
		while($res = mysql_fetch_array($result)){
			$UIWMC=$res['id_userWhoMakeComment'];
			$SelectDFUWMC=GenerateSelect('name,lastName,photo','ax_generalRegister',"id=$UIWMC");
			$result2=$oDB->query($SelectDFUWMC);
			while($res2 = mysql_fetch_array($result2)){
				echo $res2['name'].' ';
				echo $res2['lastName'].' ';
				//echo $res2['photo'].'--------';
			}
					
					
					echo $res['activity'].' ';
					
			$SelectUser=GenerateSelect('name,lastName,photo','ax_generalRegister',"id=$MyUserId");
			$result3=$oDB->query($SelectUser);
			while($res3 = mysql_fetch_array($result3)){
				echo $res3['name'].' ';
				echo $res3['lastName'];
				echo ' Wall ';
				//echo $res3['photo'].'--------';
			}
					
					echo ago($res['time']);
					echo "<br >";
					
			}
		}
		
		break;
		
		*/
	case 'seeViewed':
					
		$field=array('viewed'=>0);
		$sSQL_Update=GenerateUpdate($tableWallAlert,$field, "id_user=$MyUserId");
		if($result=$oDB->query($sSQL_Update)){
			echo true;
		}else{
			echo false;
		}
		
		break;
	
	case 'delete':
		$id=$_POST['id'];
		$field=array('hidden'=>0);
		$sSQL_Update=GenerateUpdate($tableWallAlert,$field,"id_user=$MyUserId AND id=$id");
		if($result=$oDB->query($sSQL_Update)){
			echo true;
		}else{
			echo false;
		}
		break;
}





?>