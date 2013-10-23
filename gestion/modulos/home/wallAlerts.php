<?php

require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/site_ini.php");

function seeAlerts($valorId){

	$oRespuesta = new xajaxResponse();

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
					
			
			$oRespuesta->addAssign('ekasjdioqes','innerHTML',$res2['name']);
			return $oRespuesta;
			}
		
		}
	
}	
?>