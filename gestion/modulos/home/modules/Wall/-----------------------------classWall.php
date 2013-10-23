<?php
//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 

//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/lib/site_ini.php");
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/site_ini.php");


$type=$_POST['type'];
//$idUser=(int)$_POST['dasjkldasyqwebmasdnmpsa'];
//$idProfile=(int)$_POST['fdkjasfdsjakldausoiq'];

//var_dump($type);
//var_dump($idUser);
//$idUser=cleanDirty($idUser);

//var_dump($idUser);
//var_dump($idProfile);

if(!isset($_SESSION['idUserVisiting'])){;
$idUserVisiting=$_SESSION['iSMuIdKey'];
}else{
$idUserVisiting=$_SESSION['idUserVisiting'];
}

/*$oDB3=new mysql;
$oDB3->connect();
$asd5=$oDB3->query("SELECT profileId FROM ax_generalRegister WHERE id=$idUserVisiting");
while ($row5 = mysql_fetch_array($asd5)){
	$profileVisiting=$row5['profileId'];
}*/


if(!isset($_SESSION['idProfileVisiting'])){;
$profileVisiting=$_SESSION['iSMuProfTypeKey'];
}else{
$profileVisiting=$_SESSION['idProfileVisiting'];
}



switch($type){

	case 'insert':
	
		$value=$_POST['value'];
		$idUser=$idUserVisiting;
		//$idUserWho=$_SESSION['idUserVisiting'];
		$idUserWho=$_SESSION['iSMuIdKey'];
		//$idProfile=$_SESSION['iSMuProfTypeKey'];
		
		$fields=array('publication'=>$value,'user_id'=>$idUser,'user_id_who'=>$idUserWho,'time'=>time());
		$jug=new Publication();
		
		$agtime=$profileVisiting;
		$table=selectTable($agtime);
		$anexo='Wall';
		$tableProfile=$table.$anexo;
		//var_dump($tableProfile);
		
		$jug->addPublication($tableProfile,$fields);
		break;
	
	case 'selCom':
		$idUser=(int)$_POST['idUser'];
		$coment=$_POST['djkasdjsjdklscxzqwe'];
		$jug=new Publication();
		$jug->selCom($idUser,$idProfile,$coment);
		
	case 'insertComment':
	
		$agtime=$profileVisiting;
		$table=selectTable($agtime);
		$anexo='ReceivedComments';
		$tableProfile=$table.$anexo;
		
		$comment=$_POST['value'];
		$idComment=$_POST['askhjdasoljqkwdsanmcxgzh'];
		$idUserWhoMakeComment=$_SESSION['iSMuIdKey'];
		//$idUserVisiting=$_SESSION['idUserVisiting'];
		$time=time();
		$jug= new Publication();
		$jug->addComment($tableProfile,$comment,$idComment,$idUserWhoMakeComment,$idUserVisiting,$time);
		break;
		
	case 'deleteComment':
		
		$agtime=$profileVisiting;
		$table=selectTable($agtime);
		$anexo='ReceivedComments';
		$tableProfile=$table.$anexo;
		$idUserVisiting=$_SESSION['iSMuIdKey'];
		$idRow=$_POST['value'];
		$jug= new Publication();
		$jug->deleteComment($tableProfile,$idRow,$idUserVisiting);
		break;

	case 'deletePublication':
	
		$agtime=$profileVisiting;
		$table=selectTable($agtime);
		$anexo='Wall';
		$anexo2='ReceivedComments';
		$tableWall=$table.$anexo;
		$tableReceivedComments=$table.$anexo2;
		
		$idUserVisiting=$_SESSION['iSMuIdKey'];
		$idRow=$_POST['value'];
		$jug= new Publication();
		$jug->deletePublication($tableWall,$tableReceivedComments,$idRow,$idUserVisiting);
		break;
		
	case 'checkComment':
		
		$agtime=$profileVisiting;
		$table=selectTable($agtime);
		$anexo='PubComChecks';
		$table=$table.$anexo;
		
		$id_user=$idUserVisiting;
		$id_user_profile=$profileVisiting;
				
		$id_coment = $_POST['value'];
		$id_user_who_check=$_SESSION['iSMuIdKey'];
		$time=time();
		$jug= new Publication();
		$jug->checkComment($table,$id_user,$id_user_profile,$id_coment,$id_user_who_check,$time);
		
	break;
	
		case 'unCheckComment':
		
		$agtime=$profileVisiting;
		$table=selectTable($agtime);
		$anexo='PubComChecks';
		$table=$table.$anexo;
		
		$id_user=$idUserVisiting;
		$id_user_profile=$profileVisiting;
				
		$id_coment = $_POST['value'];
		$id_user_who_check=$_SESSION['iSMuIdKey'];
		$time=time();
		$jug= new Publication();
		$jug->unCheckComment($table,$id_user,$id_user_profile,$id_coment,$id_user_who_check,$time);
		
	break;
	
	case 'checkPublication':
	
		$agtime=$profileVisiting;
		$table=selectTable($agtime);
		$anexo='PubComChecks';
		$table=$table.$anexo;
		
		$id_user=$idUserVisiting;
		$id_user_profile=$profileVisiting;
				
		$id_publication = $_POST['value'];
		$id_user_who_check=$_SESSION['iSMuIdKey'];
		$time=time();
		$jug= new Publication();
		$jug->checkPublication($table,$id_user,$id_user_profile,$id_publication,$id_user_who_check,$time);
	
	break;
	
	break;
	
		case 'unCheckPublication':
		
		$agtime=$profileVisiting;
		$table=selectTable($agtime);
		$anexo='PubComChecks';
		$table=$table.$anexo;
		
		$id_user=$idUserVisiting;
		$id_user_profile=$profileVisiting;
				
		$id_coment = $_POST['value'];
		$id_user_who_check=$_SESSION['iSMuIdKey'];
		$time=time();
		$jug= new Publication();
		$jug->unCheckPublication($table,$id_user,$id_user_profile,$id_coment,$id_user_who_check,$time);
		
	break;
		
}


class Publication{

	function __construct(){
		global $SITE_oDB;	
		$this->oDB =& $SITE_oDB;
	}
	
	function checkComment($table,$id_user,$id_user_profile,$id_coment,$id_user_who_check,$time){
		$ocurrencias=0;#ocurrencias
		$sSQL_Select=GenerateSelect('*',$table,'id_coment='.$id_coment.' AND id_user_who_check='.$id_user_who_check);
		if($DB_Result = $this->oDB->Query($sSQL_Select)){
			$ocurrencias=mysql_num_rows($DB_Result);
				if($ocurrencias != 0){
					//var_dump($ocurrencias);
					die('You can´t check this comment again!');
				}
			
		}else{
		die('We have a problem whit this request, please try again in a few second, if this problem persist, please contact us');
		}
		
				
		$fields=array('id_user'=>$id_user,'id_user_profile'=>$id_user_profile,'id_coment'=>$id_coment,'id_user_who_check'=>$id_user_who_check,'time'=>$time);
		//var_dump($fields);
		$sSQL_Insert = GenerateInsert($table,$fields);
		//var_dump($sSQL_Insert);
		if($DB_Result = $this->oDB->Query($sSQL_Insert)){
			echo true;		
		}else{
			echo false;
		}


		############
		#Empiezan las alertas
				
		if(!isset($_SESSION['idUserVisiting']) OR ($_SESSION['idUserVisiting']==0)){
			$idUserVisiting=$_SESSION['iSMuIdKey'];
		}else{
			$idUserVisiting=$_SESSION['idUserVisiting'];
		}
		
		
		if(!isset($_SESSION['idProfileVisiting']) OR ($_SESSION['idProfileVisiting']==0)){;
			$profileVisiting=$_SESSION['iSMuProfTypeKey'];
		}else{
			$profileVisiting=$_SESSION['idProfileVisiting'];
		}
		
		#genero tabla WallAlerta
		$table4=selectTable($profileVisiting);
		$anexo4='WallAlert';
		$tableWallAlerts4=$table4.$anexo4;
		
		//var_dump($tableWallAlerts);

		
		#Generlo la tabla Wall
		$table5=selectTable($profileVisiting);
		$anexo5='ReceivedComments';
		$tableReceivedComments5=$table5.$anexo5;
		
		
		#Selecciono el user id que checkea y el user id que recibe el check
		$sSQL_Select4321=generateSelect('idUserWhoReceiveAComment,idUserWhoMakeComment',$tableReceivedComments5,"id=$id_coment");
		//var_dump($sSQL_Select4321);
		$DB_Result123123 = $this->oDB->Query($sSQL_Select4321);
		while($res321=mysql_fetch_array($DB_Result123123)){
			//$id_user_who_maque_comment=$res['idUserWhoReceiveAComment'];#
			$id_user_received_alert=$res321['idUserWhoMakeComment'];#el que recibe la alerta
		}
		
		
		#si son distintos guardo en la tabla alertas
		if($id_user_received_alert != $_SESSION['iSMuIdKey']){
		//echo "entro - ";
		//$fields2=array('id_comment'=>$id_coment,'id_user'=>$id_user_who_check2,'id_userWhoMakeComment'=>$id_user,'activity'=>'like your comment','viewed'=>1,'hidden'=>1,'time'=>$time);
		$fields5=array('id_comment'=>$id_coment,'id_user'=>$id_user_received_alert,'id_userWhoMakeComment'=>$_SESSION['iSMuIdKey'],'activity'=>4,'viewed'=>1,'hidden'=>1,'time'=>$time);
		//var_dump($fields5);
		$sSQL_Insert4 = GenerateInsert($tableWallAlerts4,$fields5);
		$DB_Result4 = $this->oDB->Query($sSQL_Insert4);
		}############
		
		
		//var_dump($sSQL_Insert);
	}
	
	//($table,$id_user,$id_user_profile,$id_coment,$id_user_who_check,$time);
		
		function unCheckComment($table,$id_user,$id_user_profile,$id_coment,$id_user_who_check,$time){
		$ocurrencias=0;
		
		 
		
		$sSQL_Delete="DELETE FROM $table where id_coment=$id_coment AND id_user_who_check=$id_user_who_check";
		if(mysql_query($sSQL_Delete)){
			echo true;
		}else{
			echo false;
		}
		
		}
		
		
		function unCheckPublication($table,$id_user,$id_user_profile,$id_coment,$id_user_who_check,$time){
		$ocurrencias=0;
		
		 
		
		$sSQL_Delete="DELETE FROM $table where id_publication=$id_coment AND id_user_who_check=$id_user_who_check";
		if(mysql_query($sSQL_Delete)){
			echo true;
		}else{
			echo false;
		}
		
		}
		
		/*if($DB_Result = $this->oDB->Query($sSQL_Select)){
			$ocurrencias=mysql_num_rows($DB_Result);
				if($ocurrencias != 0){
					//var_dump($ocurrencias);
					die('You can´t check this comment again!');
				}
			
		}else{
		die('We have a problem whit this request, please try again in a few second, if this problem persist, please contact us');
		}
		
		$fields=array('id_user'=>$id_user,'id_user_profile'=>$id_user_profile,'id_coment'=>$id_coment,'id_user_who_check'=>$id_user_who_check,'time'=>$time);
		//var_dump($fields);
		$sSQL_Insert = GenerateInsert($table,$fields);
		//var_dump($sSQL_Insert);
		if($DB_Result = $this->oDB->Query($sSQL_Insert)){
			echo true;
		}else{
			echo false;
		}	*/
			//var_dump($sSQL_Insert);
	
	
	
	
	
		function checkPublication($table,$id_user,$id_user_profile,$id_publication,$id_user_who_check,$time){
		$ocurrencias=0;
		$sSQL_Select=GenerateSelect('*',$table,'id_publication='.$id_publication.' AND id_user_who_check='.$id_user_who_check);
		if($DB_Result = $this->oDB->Query($sSQL_Select)){
			$ocurrencias=mysql_num_rows($DB_Result);
				if($ocurrencias != 0){
					//var_dump($ocurrencias);
					die('You can´t check this publication again!');
				}
			
		}else{
		die('We have a problem whit this request, please try again in a few second, if this problem persist, please contact us');
		}
		
		#Guardo el check en pubComChecks
		$fields=array('id_user'=>$id_user,'id_user_profile'=>$id_user_profile,'id_publication'=>$id_publication,'id_user_who_check'=>$id_user_who_check,'time'=>$time);
		$sSQL_Insert = GenerateInsert($table,$fields);
		if($DB_Result = $this->oDB->Query($sSQL_Insert)){
			echo true;
		
		
		#Empiezan las alertas
				
		if(!isset($_SESSION['idUserVisiting'])){
			$idUserVisiting=$_SESSION['iSMuIdKey'];
		}else{
			$idUserVisiting=$_SESSION['idUserVisiting'];
		}
		
		
		if(!isset($_SESSION['idProfileVisiting'])){;
			$profileVisiting=$_SESSION['iSMuProfTypeKey'];
		}else{
			$profileVisiting=$_SESSION['idProfileVisiting'];
		}
		
		#genero tabla WallAlerta
		$table2=selectTable($profileVisiting);
		$anexo2='WallAlert';
		$tableWallAlerts=$table2.$anexo2;
		
		//var_dump($tableWallAlerts);

		
		#Generlo la tabla Wall
		$table3=selectTable($profileVisiting);
		$anexo3='Wall';
		$tableWall=$table3.$anexo3;
		
		
		#Selecciono el user id que checkea y el user id que recibe el check
		$sSQL_SELECT2=GenerateSelect('user_id_who,user_id',$tableWall,"id=$id_publication");
		//var_dump($sSQL_SELECT2);
		$DB_Result3 = $this->oDB->Query($sSQL_SELECT2);
		while($reess=mysql_fetch_array($DB_Result3)){
			//$id_user_who_check2=$reess['user_id_who'];#El que checkea
			$id_user=$reess['user_id'];#el que recibe
		}
		
		
		//echo "id_user: ".$id_user."-";
		//echo "id_user_who_check2: ".$id_user_who_check2."-";
		
		#si son distintos guardo en la tabla alertas
		//var_dump($id_user);
//		var_dump($id_user_who_check2);
		if($id_user != $_SESSION['iSMuIdKey']){
		//echo "entro - ";
		$fields2=array('id_publication'=>$id_publication,'id_user'=>$id_user,'id_userWhoMakeComment'=>$_SESSION['iSMuIdKey'],'activity'=>3,'viewed'=>1,'hidden'=>1,'time'=>$time);
		//var_dump($fields2);
		$sSQL_Insert2 = GenerateInsert($tableWallAlerts,$fields2);
		$DB_Result2 = $this->oDB->Query($sSQL_Insert2);
		}
		
		
		}else{
			echo false;
		}//var_dump($fields);
		
		
		
		//var_dump($sSQL_Insert);
			
			//var_dump($sSQL_Insert);
	}
	
	function deletePublication($tableWall,$tableReceivedComments,$idRow,$idUserVisiting){

		$sSQL_Delete= "DELETE FROM $tableReceivedComments WHERE (idUserWhoMakeComment=$idUserVisiting OR idUserWhoReceiveAComment=$idUserVisiting) AND idComment=$idRow";

		$DB_Result = $this->oDB->Query($sSQL_Delete);

		$sSQL_Delete2= "DELETE FROM $tableWall WHERE (user_id=$idUserVisiting OR user_id_who=$idUserVisiting) AND id=$idRow";

		$DB_Result2 = $this->oDB->Query($sSQL_Delete2);
		
		if($DB_Result){
			//echo "<br />DB_Result TRUE: ";
			//var_dump($sSQL_Delete);
			//var_dump($DB_Result);
		}else{
			//var_dump($sSQL_Delete);
			//var_dump($DB_Result);
			//echo "<br />DB_Result FALSE: ";
		}
		
		if($DB_Result2){
			//echo "<br />DB_Result2 TRUE: ";
			//var_dump($sSQL_Delete2);
			//var_dump($DB_Result2);
		}else{
			//echo "<br />DB_Result2 FALSE: ";
			//var_dump($sSQL_Delete2);
			//var_dump($DB_Result2);
		}
		}
		
	
	function deleteComment($tableProfile,$idRow,$idUserVisiting){
		
		$sSQL_Delete = "DELETE FROM $tableProfile WHERE (idUserWhoMakeComment=$idUserVisiting OR idUserWhoReceiveAComment=$idUserVisiting) AND id=$idRow";
		//var_dump($sSQL_Delete);
		//die('asd');
		if($DB_Result = $this->oDB->Query($sSQL_Delete)){
		//var_dump($DB_Result);
			echo true;
		}else{
			echo false;
		}		
		//var_dump($sSQL_Delete);
	}
	
	
	
			/*True= Envio de notificaciones a los que escribieron en esta publicacion*/
		/*	$sSQL_Select = GenerateSelect('*',$tableProfile,'idComment='.$idComment);
			//var_dump($sSQL_Select);
			$DB_Result = $this->oDB->Query($sSQL_Select);
			while($res=mysql_fetch_array($DB_Result)){
				if($res['idUserWhoMakeComment']!=$_SESSION['iSMuIdKey']){
							
							$arregloParaLimiarUsersId[]=;
							echo true;
					
					}
							
							$thisUser=$res['idUserWhoMakeComment'];//necesito id perfil
							$table=selectTable($thisUser);
							$anexo='WallAlerts';
							$tableProfile=$table.$anexo;
							
					$arregloLimpio=array_unique($arregloParaLimiarUsersId);
					$fieldsForAlerts=array('id_user'=>$thisUser,'id_publication'=>$idComment,'id_userWhoMakeComment'=>$_SESSION['iSMuIdKey'],'activity'=>'commented on','time'=>time());
					$sSQL_Insert2 = GenerateInsert('ax_playerWallAlert',$fieldsForAlerts);
					if($DB_Result2 = $this->oDB->Query($sSQL_Insert2)){
					
					
				};
			}
	
	*/
	
	function addComment($tableProfile,$comment,$idComment,$idUserWhoMakeComment,$idUserVisiting,$time){
		$fields=array('comment'=>$comment,'idComment'=>$idComment,'idUserWhoMakeComment'=>$idUserWhoMakeComment,'idUserWhoReceiveAComment'=>$idUserVisiting,'time'=>$time);
		//var_dump($fields);
		$sSQL_Insert = GenerateInsert($tableProfile,$fields);
		//var_dump($sSQL_Insert);
		if($DB_Result = $this->oDB->Query($sSQL_Insert)){
			echo true;
		
			
			
			
		############
		#Empiezan las alertas
				
		if(!isset($_SESSION['idUserVisiting']) OR ($_SESSION['idUserVisiting']==0)){
			$idUserVisiting=$_SESSION['iSMuIdKey'];
		}else{
			$idUserVisiting=$_SESSION['idUserVisiting'];
		}
		
		
		if(!isset($_SESSION['idProfileVisiting']) OR ($_SESSION['idProfileVisiting']==0)){;
			$profileVisiting=$_SESSION['iSMuProfTypeKey'];
		}else{
			$profileVisiting=$_SESSION['idProfileVisiting'];
		}
		
		#genero tabla WallAlerta
		$table4=selectTable($profileVisiting);
		$anexo4='WallAlert';
		$tableWallAlerts4=$table4.$anexo4;
		
		//echo "genero tabla wall alerts<br />";
		//var_dump($tableWallAlerts4);

		
		#Generlo la tabla Wall
		$table5=selectTable($profileVisiting);
		$anexo5='ReceivedComments';
		$tableReceivedComments5=$table5.$anexo5;
		
		//echo "genero tabla ReceivedComments<br />";
		//var_dump($tableReceivedComments5);

		
		
		#Selecciono el user id que checkea y el user id que recibe el check
		//$sSQL_SELECT2=GenerateSelect('user_id_who,user_id',$tableWall,"id=$id_publication");
		$sSQL_Select4321=generateSelect('user_id_who,user_id',$table5.'Wall',"id=$idComment");
		
		//echo "genero la consulta<br />";
		//var_dump($sSQL_Select4321);
		$DB_Result123123 = $this->oDB->Query($sSQL_Select4321);
		while($res321=mysql_fetch_array($DB_Result123123)){
			//$id_user_who_maque_comment=$res['idUserWhoReceiveAComment'];#
			$id_user_received_alert=$res321['user_id'];#el que recibe la alerta
		}
		
		//echo "El que recibe la alerta<br />";
		//var_dump($id_user_received_alert);
		//echo "yo<br />";
		//var_dump($_SESSION['iSMuIdKey']);
		
		#si son distintos guardo en la tabla alertas
		if($id_user_received_alert != $_SESSION['iSMuIdKey']){
		//echo "entro - ";
		//$fields2=array('id_comment'=>$id_coment,'id_user'=>$id_user_who_check2,'id_userWhoMakeComment'=>$id_user,'activity'=>'like your comment','viewed'=>1,'hidden'=>1,'time'=>$time);
		$fields5=array('id_comment'=>$idComment,'id_user'=>$id_user_received_alert,'id_userWhoMakeComment'=>$_SESSION['iSMuIdKey'],'activity'=>2,'viewed'=>1,'hidden'=>1,'time'=>$time);
		//var_dump($fields5);
		$sSQL_Insert4 = GenerateInsert($tableWallAlerts4,$fields5);
		
		//echo "genero insert en wallAlerts<br />";
		//var_dump($sSQL_Insert4);
		
		$DB_Result4 = $this->oDB->Query($sSQL_Insert4);
		}############
		
		
		##Terminan las alertas

			}else{
		echo false;
		}		
			
			
		//echo "resultado <br />";
		//var_dump($DB_Result4);
	}
	
	function selCom($idUser,$idProfile,$comment){
		$table=selectTable($idProfile);
		$anexo='Wall';
		$tableProfile=$table.$anexo;
		
		//var_dump($tableProfile);
		die();
		$select="SELECT id,user_id,publication,time FROM $tableProfile WHERE user_id=$idUser and id=$comment";
		$res=mysql_query($select);
		while($row=mysql_fetch_array($res)){
				$return['qwerfghjklpoiuhgvc']=$row['id'];//id
				$return['dasjkluaduasdkasla']=dirty($row['user_id']);//user_id
				$return['aslqwdsaouiqwieqls']=$row['publication'];//publication
				$return['dopqwepqwufyuixzvy']=$row['time'];//time
		}
		echo json_encode($return);
		
	}
	
	function addPublication($tableProfile,$fields){
		//$table=selectTable($profileId);
		//$anexo='Wall';
		//$tableProfile=$table.$anexo;
//		$this->addPub($tableProfile,$fields);		
		$sSQL_Insert = GenerateInsert($tableProfile,$fields);
		if($DB_Result = $this->oDB->Query($sSQL_Insert)){
			echo true;
		}else{
			echo false;
		}
		
	//	echo "sql_insert<br />";
		//var_dump($sSQL_Insert);
		
		
		if($DB_Result){
		
		//echo "db_result<br />";
		//var_dump($DB_Result);
		
		if(!isset($_SESSION['idUserVisiting']) or ($_SESSION['idUserVisiting']==0)){;
			$idUserVisiting=$_SESSION['iSMuIdKey'];
		}else{
			$idUserVisiting=$_SESSION['idUserVisiting'];
		}
			
			
		//echo "idUserVisiting<br />";
		//var_dump($idUserVisiting);
		
			if($idUserVisiting != $_SESSION['iSMuIdKey']){
			
			$idProfile=$_SESSION['idProfileVisiting'];
			$tableForAddPublication=selectTable($idProfile);
			
			
			$idPublication=mysql_insert_id();
			
			//echo "idPublication viene de mysqlInsertId<br />";
			//var_dump($idPublication);
		
				$fieldsForAlerts=array('id_user'=>$idUserVisiting,'id_publication'=>$idPublication,'id_userWhoMakeComment'=>$_SESSION['iSMuIdKey'],'activity'=>1,'viewed'=>1,'hidden'=>1,'time'=>time());
				$sSQL_Insert2 = GenerateInsert($tableForAddPublication.'WallAlert',$fieldsForAlerts);
				
				//echo "sql_insert<br />";
				//var_dump($sSQL_Insert2);
				
				if($DB_Result = $this->oDB->Query($sSQL_Insert2)){
					echo true;
				}else{
					echo false;
					//var_dump($DB_Result);
				}
				
				//echo "DB_Result<br />";
				//var_dump($DB_Result);
		
			}
		}
	//var_dump($sSQL_Insert);
	}
}	

?>