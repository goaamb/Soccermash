<?php

require_once $_SERVER['DOCUMENT_ROOT']."/gbase.php"; 
//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 


//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/lib/site_ini.php");
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/site_ini.php");
$ml=new ModelLoader("ax_generalRegister");
if(isset($_SESSION["idUserVisiting"]) && $ml->buscarPorCampo(array("id"=>$_SESSION["idUserVisiting"])) && $ml->myAgent==$_SESSION['iSMuIdKey']){
	$myId=$ml->id;
	$profileVisiting=$ml->profileid;
}else{
$myId=$_SESSION['iSMuIdKey'];

$profileVisiting=$_SESSION['iSMuProfTypeKey'];
}

$type=$_POST['type'];
$value=$_POST['value'];


$secondQuery=false;
if($type == "changeProfile"){
	switch ($value){
		case '2':  #Pasa a jugador con contrato
		
			$sSQL_Select=generateSelect('endingContractDate','ax_player',"idUser=$myId");
			$DB_Result=mysql_query($sSQL_Select) or die(mysql_error());
			while($res=mysql_fetch_array($DB_Result)){
				$endingContractDate=$res['endingContractDate'];
			}
			
			if(($endingContractDate == NULL) or (!isset($endingContractDate)) or (trim($endingContractDate)=="")){
				$endingContractDate = "0000-00-00";
				$secondQuery=true;
			}
			
			$data=array('profileId'=>2);
			$sSQL_UpdateGeneralRegister=generateUpdate('ax_generalRegister',$data,"id=$myId");
			$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			
			if($secondQuery==true){
				$perfil=array('endingContractDate'=>$endingContractDate);
				$sSQL_UpdatePerfilData=generateUpdate('ax_player',$perfil,"idUser=$myId");
				$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			};
			echo "good";
			
			break;
		case '3': #pasa a jugador sin contrato
			
			$sSQL_Select=generateSelect('lastContractDate','ax_player',"idUser=$myId");
			$DB_Result=mysql_query($sSQL_Select) or die(mysql_error());
			while($res=mysql_fetch_array($DB_Result)){
				$lastContractDate=$res['lastContractDate'];
			}
			
			if(($lastContractDate == NULL) or (!isset($lastContractDate)) or (trim($lastContractDate)=="")){
				$lastContractDate = "0000-00-00";
				$secondQuery=true;
			}
			
			$data=array('profileId'=>3);
			$sSQL_UpdateGeneralRegister=generateUpdate('ax_generalRegister',$data,"id=$myId");
			$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			
			if($secondQuery==true){
				$perfil=array('lastContractDate'=>$lastContractDate);
				$sSQL_UpdatePerfilData=generateUpdate('ax_player',$perfil,"idUser=$myId");
				$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			};
			
			echo "good";
			break;
			
		case '5': #pasa a Amateur Payer
		
		/*$sSQL_Select=generateSelect('lastContractDate','ax_player',"idUser=$myId");
			$DB_Result=mysql_query($sSQL_Select) or die(mysql_error());
			while($res=mysql_fetch_array($DB_Result)){
				$lastContractDate=$res['lastContractDate'];
			}
			
			if(($lastContractDate == NULL) or (!isset($lastContractDate)) or (trim($lastContractDate)=="")){
				$lastContractDate = "0000-00-00";
				$secondQuery=true;
			}*/
			
			$data=array('profileId'=>5);
			$sSQL_UpdateGeneralRegister=generateUpdate('ax_generalRegister',$data,"id=$myId");
			$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			
			/*if($secondQuery==true){
				$perfil=array('lastContractDate'=>$lastContractDate);
				$sSQL_UpdatePerfilData('ax_player',$perfil,"idUser=$myId");
				$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			};*/
			
			echo "good";
			break;
		case '6': #pasa a ex-player
			
			/*$sSQL_Select=generateSelect('lastContractDate','ax_player',"idUser=$myId");
			$DB_Result=mysql_query($sSQL_Select) or die(mysql_error());
			while($res=mysql_fetch_array($DB_Result)){
				$lastContractDate=$res['lastContractDate'];
			}
			
			if(($lastContractDate == NULL) or (!isset($lastContractDate)) or (trim($lastContractDate)=="")){
				$lastContractDate = "0000-00-00";
				$secondQuery=true;
			}*/
			
			$data=array('profileId'=>6);
			$sSQL_UpdateGeneralRegister=generateUpdate('ax_generalRegister',$data,"id=$myId");
			$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			
			/*if($secondQuery==true){
				$perfil=array('lastContractDate'=>$lastContractDate);
				$sSQL_UpdatePerfilData('ax_player',$perfil,"idUser=$myId");
				$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			};*/
			
			echo "good";
			break;
		
		case '7': #pasa a Coach Under Contract
		
			$sSQL_Select=generateSelect('endingContractDate','ax_coach',"idUser=$myId");
			$DB_Result=mysql_query($sSQL_Select) or die(mysql_error());
			while($res=mysql_fetch_array($DB_Result)){
				$endingContractDate=$res['endingContractDate'];
			}
			
			if(($endingContractDate == NULL) or (!isset($endingContractDate)) or (trim($endingContractDate)=="")){
				$endingContractDate = "0000-00-00";
				$secondQuery=true;
			}
			
			$data=array('profileId'=>7);
			$sSQL_UpdateGeneralRegister=generateUpdate('ax_generalRegister',$data,"id=$myId");
			$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			
			if($secondQuery==true){
				$perfil=array('endingContractDate'=>$endingContractDate);
				$sSQL_UpdatePerfilData('ax_coach',$perfil,"idUser=$myId");
				$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			};
			
			echo "good";

			break;
			
		case '8':#pasa a Coach Without Contract
		
			$sSQL_Select=generateSelect('lastContractDate','ax_coach',"idUser=$myId");
			$DB_Result=mysql_query($sSQL_Select) or die(mysql_error());
			while($res=mysql_fetch_array($DB_Result)){
				$lastContractDate=$res['lastContractDate'];
			}
			
			if(($lastContractDate == NULL) or (!isset($lastContractDate)) or (trim($lastContractDate)=="")){
				$lastContractDate = "0000-00-00";
				$secondQuery=true;
			}
			
			$data=array('profileId'=>8);
			$sSQL_UpdateGeneralRegister=generateUpdate('ax_generalRegister',$data,"id=$myId");
			$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			
			if($secondQuery==true){
				$perfil=array('lastContractDate'=>$lastContractDate);
				$sSQL_UpdatePerfilData=generateUpdate('ax_coach',$perfil,"idUser=$myId");
				$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			};
			
			echo "good";
			break;
			
		case '9': #pasa a Goalkeeper Coach Under Contract
		
			$sSQL_Select=generateSelect('endingContractDate','ax_coach',"idUser=$myId");
			$DB_Result=mysql_query($sSQL_Select) or die(mysql_error());
			while($res=mysql_fetch_array($DB_Result)){
				$endingContractDate=$res['endingContractDate'];
			}
			
			if(($endingContractDate == NULL) or (!isset($endingContractDate)) or (trim($endingContractDate)=="")){
				$endingContractDate = "0000-00-00";
				$secondQuery=true;
			}
			
			$data=array('profileId'=>9);
			$sSQL_UpdateGeneralRegister=generateUpdate('ax_generalRegister',$data,"id=$myId");
			$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			
			if($secondQuery==true){
				$perfil=array('endingContractDate'=>$endingContractDate);
				$sSQL_UpdatePerfilData=generateUpdate('ax_coach',$perfil,"idUser=$myId");
				$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			};
			
			echo "good";
			break;
			
		case '10': #pasa a Goalkeeper Coach Without Contract
		
			$sSQL_Select=generateSelect('lastContractDate','ax_coach',"idUser=$myId");
			$DB_Result=mysql_query($sSQL_Select) or die(mysql_error());
			while($res=mysql_fetch_array($DB_Result)){
				$lastContractDate=$res['lastContractDate'];
			}
			
			if(($lastContractDate == NULL) or (!isset($lastContractDate)) or (trim($lastContractDate)=="")){
				$lastContractDate = "0000-00-00";
				$secondQuery=true;
			}
			
			$data=array('profileId'=>10);
			$sSQL_UpdateGeneralRegister=generateUpdate('ax_generalRegister',$data,"id=$myId");
			$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			
			if($secondQuery==true){
				$perfil=array('lastContractDate'=>$lastContractDate);
				$sSQL_UpdatePerfilData=generateUpdate('ax_coach',$perfil,"idUser=$myId");
				$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			};
			
			echo "good";
			break;
			
		case '11': #pasa a Physical Coach Under Contract
		
			$sSQL_Select=generateSelect('endingContractDate','ax_coach',"idUser=$myId");
			$DB_Result=mysql_query($sSQL_Select) or die(mysql_error());
			while($res=mysql_fetch_array($DB_Result)){
				$endingContractDate=$res['endingContractDate'];
			}
			
			if(($endingContractDate == NULL) or (!isset($endingContractDate)) or (trim($endingContractDate)=="")){
				$endingContractDate = "0000-00-00";
				$secondQuery=true;
			}
			
			$data=array('profileId'=>11);
			$sSQL_UpdateGeneralRegister=generateUpdate('ax_generalRegister',$data,"id=$myId");
			$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			
			if($secondQuery==true){
				$perfil=array('endingContractDate'=>$endingContractDate);
				$sSQL_UpdatePerfilData=generateUpdate('ax_coach',$perfil,"idUser=$myId");
				$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			};
			
			echo "good";
			break;
			
		case '12': #pasa a Physical Coach Without Contract
		
			$sSQL_Select=generateSelect('lastContractDate','ax_coach',"idUser=$myId");
			$DB_Result=mysql_query($sSQL_Select) or die(mysql_error());
			while($res=mysql_fetch_array($DB_Result)){
				$lastContractDate=$res['lastContractDate'];
			}
			
			if(($lastContractDate == NULL) or (!isset($lastContractDate)) or (trim($lastContractDate)=="")){
				$lastContractDate = "0000-00-00";
				$secondQuery=true;
			}
			
			$data=array('profileId'=>12);
			$sSQL_UpdateGeneralRegister=generateUpdate('ax_generalRegister',$data,"id=$myId");
			$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			
			if($secondQuery==true){
				$perfil=array('lastContractDate'=>$lastContractDate);
				$sSQL_UpdatePerfilData=generateUpdate('ax_coach',$perfil,"idUser=$myId");
				$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			};
			
			echo "good";
			break;
		
		case '13':#pasa a Licensed FIFA Agent
		
			/*$sSQL_Select=generateSelect('lastContractDate','ax_agent',"idUser=$myId");
			$DB_Result=mysql_query($sSQL_Select) or die(mysql_error());
			while($res=mysql_fetch_array($DB_Result)){
				$lastContractDate=$res['lastContractDate'];
			}
			
			if(($lastContractDate == NULL) or (!isset($lastContractDate)) or (trim($lastContractDate)=="")){
				$lastContractDate = "0000-00-00";
				$secondQuery=true;
			}*/
			
			$data=array('profileId'=>13);
			$sSQL_UpdateGeneralRegister=generateUpdate('ax_generalRegister',$data,"id=$myId");
			$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			
			/*if($secondQuery==true){
				$perfil=array('lastContractDate'=>$lastContractDate);
				$sSQL_UpdatePerfilData=generateUpdate('ax_agent',$perfil,"idUser=$myId");
				$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			};*/
			
			echo "good";
			break;
		
		case '14': #pasa a Licensed UEFA Agent
		
			/*$sSQL_Select=generateSelect('lastContractDate','ax_agent',"idUser=$myId");
			$DB_Result=mysql_query($sSQL_Select) or die(mysql_error());
			while($res=mysql_fetch_array($DB_Result)){
				$lastContractDate=$res['lastContractDate'];
			}
			
			if(($lastContractDate == NULL) or (!isset($lastContractDate)) or (trim($lastContractDate)=="")){
				$lastContractDate = "0000-00-00";
				$secondQuery=true;
			}*/
			
			$data=array('profileId'=>14);
			$sSQL_UpdateGeneralRegister=generateUpdate('ax_generalRegister',$data,"id=$myId");
			$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			
			/*if($secondQuery==true){
				$perfil=array('lastContractDate'=>$lastContractDate);
				$sSQL_UpdatePerfilData=generateUpdate('ax_agent',$perfil,"idUser=$myId");
				$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			};*/
			
			echo "good";
			break;
		case '15': #pasa a Authorized Agent
		
			/*$sSQL_Select=generateSelect('lastContractDate','ax_agent',"idUser=$myId");
			$DB_Result=mysql_query($sSQL_Select) or die(mysql_error());
			while($res=mysql_fetch_array($DB_Result)){
				$lastContractDate=$res['lastContractDate'];
			}
			
			if(($lastContractDate == NULL) or (!isset($lastContractDate)) or (trim($lastContractDate)=="")){
				$lastContractDate = "0000-00-00";
				$secondQuery=true;
			}*/
			
			$data=array('profileId'=>15);
			$sSQL_UpdateGeneralRegister=generateUpdate('ax_generalRegister',$data,"id=$myId");
			$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			
			/*if($secondQuery==true){
				$perfil=array('lastContractDate'=>$lastContractDate);
				$sSQL_UpdatePerfilData=generateUpdate('ax_agent',$perfil,"idUser=$myId");
				$DB_Result=mysql_query($sSQL_UpdateGeneralRegister) or die(mysql_error());
			};*/
			
			echo "good";
			break;
	}
}
?>
