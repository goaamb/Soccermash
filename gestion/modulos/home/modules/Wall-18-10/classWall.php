<?php
$dir = '';
require_once ($_SERVER ['DOCUMENT_ROOT'] . $dir . '/gbase.php');
require_once ($_GBASE . '/goaamb/mail/qmail.php');
//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 

//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/lib/site_ini.php");
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/site_ini.php");

require_once $_GBASE. '/goaamb/idioma.php';
 if(class_exists("Idioma")){
   $_IDIOMA=Idioma::darLenguaje();
   }  



//$_SESSION["iSMuIdKey"]
//$_SESSION["iSMuProfTypeKey"]
//$_SESSION["idUserVisiting"]
//$_SESSION["idProfileVisiting"]




$type=$_POST['type'];
//$idUser=(int)$_POST['dasjkldasyqwebmasdnmpsa'];
//$idProfile=(int)$_POST['fdkjasfdsjakldausoiq'];

//var_dump($type);
//var_dump($idUser);
//$idUser=cleanDirty($idUser);

//var_dump($idUser);
//var_dump($idProfile);


/*if(!isset($_SESSION['idUserVisiting'])){;
$idUserVisiting=$_SESSION['iSMuIdKey'];
}else{
$idUserVisiting=$_SESSION['idUserVisiting'];
}*/

/*$oDB3=new mysql;
$oDB3->connect();
$asd5=$oDB3->query("SELECT profileId FROM ax_generalRegister WHERE id=$idUserVisiting");
while ($row5 = mysql_fetch_array($asd5)){
	$profileVisiting=$row5['profileId'];
}*/




#Obtengo el idProfile de la persona que estoy viendo (sea cualquiera o yo)
function idProfileVisiting(){

	if(!isset($_SESSION['idProfileVisiting']) or ($_SESSION['idProfileVisiting']==0) or ($_SESSION['idProfileVisiting']==NULL)){
		$profileVisiting=(int)$_SESSION['iSMuProfTypeKey'];
		return $profileVisiting;
	}else{
		$profileVisiting=(int)$_SESSION['idProfileVisiting'];
		return $profileVisiting;
	}

}

#Obtengo el id de la persona que estoy viendo (sea cualquiera o yo)
function idUserVisiting(){

	if(!isset($_SESSION['idUserVisiting']) or ($_SESSION['idUserVisiting']==0) or ($_SESSION['idUserVisiting']==NULL)){
		$idUserVisiting=(int)$_SESSION['iSMuIdKey'];
		return $idUserVisiting;
	}else{
		$idUserVisiting=(int)$_SESSION['idUserVisiting'];
		return $idUserVisiting;
	}	
	
}


function myId(){
	$myId=(int)$_SESSION['iSMuIdKey'];
	return $myId;
}

function myProfile(){
	$iSMuProfTypeKey=(int)$_SESSION['iSMuProfTypeKey'];
	return $iSMuProfTypeKey;
}



switch($type){

	case 'insert':
	
		$value=$_POST['value'];
		
		$idUserVisiting=idUserVisiting();
		$idProfileVisiting=idProfileVisiting();
		$user_id=$idUserVisiting;#usuario que recibe la publicacion
		$user_id_who=myId();#usuario que envia la publicacion
		
		$table=selectTable($idProfileVisiting);#Tabla de la persona que estoy visitando: ax_[tipoPerfil]
		
		
		$fields=array('publication'=>$value,'user_id'=>$user_id,'user_id_who'=>$user_id_who,'time'=>time());
		
		$jug=new Publication();
		$jug->addPublication($table,$fields);
		break;
	
	case 'selCom':
		$idUser=(int)$_POST['idUser'];
		$coment=$_POST['djkasdjsjdklscxzqwe'];
		$jug=new Publication();
		$jug->selCom($idUser,$idProfile,$coment);
		
	case 'insertComment':
	
		$idProfileVisiting=idProfileVisiting();
		$table=selectTable($idProfileVisiting);
		
		
		$comment=$_POST['value'];
		$idComment=$_POST['askhjdasoljqkwdsanmcxgzh'];
		$idUserWhoMakeComment=myId();
		$idUserVisiting=idUserVisiting();
		$time=time();
		$jug= new Publication();
		$jug->addComment($table,$comment,$idComment,$idUserWhoMakeComment,$idUserVisiting,$time);
		break;
		
	case 'deleteComment':
		
		$agtime=idProfileVisiting();
		$table=selectTable($agtime);
		$anexo='ReceivedComments';
		$tableProfile=$table.$anexo;
		$idUserVisiting=$_SESSION['iSMuIdKey'];
		$idRow=$_POST['value'];
		$jug= new Publication();
		$jug->deleteComment($tableProfile,$idRow,$idUserVisiting);
		break;

	case 'deletePublication':
	
		$agtime=idProfileVisiting();
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
		
		$idProfileVisiting=idProfileVisiting();
		$table=selectTable($idProfileVisiting);

		
		
		$id_user=idUserVisiting();
		$id_user_profile=$idProfileVisiting;
				
		$id_coment = $_POST['value'];
		$id_user_who_check=myId();
		$time=time();
		$jug= new Publication();
		$jug->checkComment($table,$id_user,$id_user_profile,$id_coment,$id_user_who_check,$time);
		
	break;
	
		case 'unCheckComment':
		
		$idProfileVisiting=idProfileVisiting();
		$table=selectTable($idProfileVisiting);
		
		$id_user=idUserVisiting();
		$id_user_profile=$idProfileVisiting;
				
		$id_coment = $_POST['value'];
		$id_user_who_check=myId();
		$time=time();
		$jug= new Publication();
		$jug->unCheckComment($table,$id_user,$id_user_profile,$id_coment,$id_user_who_check,$time);
		
	break;
	
	case 'checkPublication':
	
		$idProfileVisiting=idProfileVisiting();
		$table=selectTable($idProfileVisiting);
		
		$id_user=idUserVisiting();
		$id_user_profile=$idProfileVisiting;
				
		$id_publication = $_POST['value'];
		$id_user_who_check = $_SESSION['iSMuIdKey'];
		$time=time();
		$jug= new Publication();
		$jug->checkPublication($table,$id_user,$id_user_profile,$id_publication,$id_user_who_check,$time);
	
	break;
	

	
		case 'unCheckPublication':
		
		$idProfileVisiting=idProfileVisiting();
		$table=selectTable($idProfileVisiting);

		$id_user=idUserVisiting();
		$id_user_profile=$idProfileVisiting;
				
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
	
	function checkPublication($table,$id_user,$id_user_profile,$id_publication,$id_user_who_check,$time){
		
		$ocurrencias=0;
		$sSQL_Select=GenerateSelect('*',$table.'PubComChecks','id_publication='.$id_publication.' AND id_user_who_check='.$id_user_who_check);
		
		//var_dump($sSQL_Select);
		if($DB_Result = $this->oDB->Query($sSQL_Select)){
			$ocurrencias=mysql_num_rows($DB_Result);
				if($ocurrencias != 0){
					//var_dump($ocurrencias);
					die('You can`t check this publication again!');
				}
			
		}else{
			die('We have a problem whit this request, please try again in a few second, if this problem persist, please contact us');
		}
		
		
		#buscar publicacion en wall para saber el id de la persona que la hizo y el idprofile en generalRegister
		
		$sSQL_Select=generateSelect('*',$table.'Wall',"id=$id_publication");
		//var_dump($sSQL_Select);
		$DB_Result = $this->oDB->Query($sSQL_Select);
			while($res=mysql_fetch_array($DB_Result)){
			$user_id_who=$res['user_id_who'];
		}
		
		$sSQL_Select=generateSelect('profileId','ax_generalRegister',"id=$user_id_who");
		//var_dump($sSQL_Select);
		$DB_Result = $this->oDB->Query($sSQL_Select);
			while($res=mysql_fetch_array($DB_Result)){
			$profileId=$res['profileId'];
		}
		
		#Guardo el check en WallAlert
		$realTable=selectTable($profileId);
		//var_dump($realTable);
		$fields=array('id_publication'=>$id_publication,'id_user'=>$user_id_who,'id_userWhoMakeComment'=>$id_user_who_check,'activity'=>3,'viewed'=>1,'time'=>$time,'hidden'=>1);
		$sSQL_Insert=GenerateInsert($realTable.'WallAlert',$fields);
		//var_dump($sSQL_Insert);
		if($DB_Result = $this->oDB->Query($sSQL_Insert)){
			echo true;
		}
		
		#Guardo el check en pubComChecks
		$fields=array('id_user'=>$user_id_who,'id_user_profile'=>$profileId,'id_publication'=>$id_publication,'id_user_who_check'=>$id_user_who_check,'time'=>$time);
		$sSQL_Insert = GenerateInsert($table.'PubComChecks',$fields);
		//var_dump($sSQL_Insert);
		if($DB_Result = $this->oDB->Query($sSQL_Insert)){
			echo true;
		

		
		
		#Selecciono el user id que checkea y el user id que recibe el check
		$sSQL_SELECT2=GenerateSelect('user_id_who,user_id,publication',$table.'Wall',"id=$id_publication");
		//var_dump($sSQL_SELECT2);
		$DB_Result3 = $this->oDB->Query($sSQL_SELECT2);
		while($reess=mysql_fetch_array($DB_Result3)){
			//$id_user_who_check2=$reess['user_id_who'];#El que checkea
			$id_user=$reess['user_id'];#el que recibe
			$publication=$reess['publication'];
		}
	
		#qMail
			$idUserVisiting=$id_user;
			$sSql_SelectNLN=generateSelect('name,lastName','ax_generalRegister',"id=$idUserVisiting");
			$DB_ResultNLN = $this->oDB->Query($sSql_SelectNLN);
			
			while($resNLN=mysql_fetch_array($DB_ResultNLN)){
				//$id_user_who_check2=$reess['user_id_who'];#El que checkea
					$aUsuario['name']=$resNLN['name']." ".$resNLN['lastName'];
			}

			
			$iUserIdSM=$_SESSION['iSMuIdKey'];
			$sSql_SelectNLN=generateSelect('name,lastName','ax_generalRegister',"id=$iUserIdSM");
			$DB_ResultNLN = $this->oDB->Query($sSql_SelectNLN);
			
			while($resNLN=mysql_fetch_array($DB_ResultNLN)){
				//$id_user_who_check2=$reess['user_id_who'];#El que checkea
					$aUsuario2['name2']=$resNLN['name']." ".$resNLN['lastName'];
			}
			
			global $_IDIOMA;
			
			$prioridad  = "Sistema";
			$asunto    	= $_IDIOMA->traducir('Your publication has been checked at SOCCERMASH.com');
			$tipo    	= "alguno";
			
			
			$archivo='/templatemail/emailFromWall.tpl';
			$iUserIdSM=$user_id_who;#idUsuarioReciveEmail
			$aUsuario['msj']=$aUsuario2['name2']." ".$_IDIOMA->traducir("checked your publication").": <a href='http://www.soccermash.com'>".$publication."</a>";#msj
			

				if(QMail::add($tipo, $iUserIdSM, $asunto, $archivo, $aUsuario, $prioridad)){
					return true;
				}
			##end qMail
		
		}
		//var_dump($fields);
		
		
		}
	
	function checkComment($table,$id_user,$id_user_profile,$id_coment,$id_user_who_check,$time){
		$ocurrencias=0;#ocurrencias
		$sSQL_Select=GenerateSelect('*',$table.'PubComChecks','id_coment='.$id_coment.' AND id_user_who_check='.$id_user_who_check);
		if($DB_Result = $this->oDB->Query($sSQL_Select)){
			$ocurrencias=mysql_num_rows($DB_Result);
				if($ocurrencias != 0){
					//var_dump($ocurrencias);
					die('You can`t check this comment again!');
				}
			
		}else{
		die('We have a problem whit this request, please try again in a few second, if this problem persist, please contact us');
		}
		
				
		#buscar comentarios en ReceivedComment para saber el id de la persona que la hizo y el idprofile en generalRegister
		
		$sSQL_Select=generateSelect('*',$table.'ReceivedComments',"id=$id_coment");
		//var_dump($sSQL_Select);
		$DB_Result = $this->oDB->Query($sSQL_Select);
			while($res=mysql_fetch_array($DB_Result)){
			$idUserWhoMakeComment=$res['idUserWhoMakeComment'];
			$comment=$res['comment'];
		}
		
		$sSQL_Select=generateSelect('profileId','ax_generalRegister',"id=$idUserWhoMakeComment");
		//var_dump($sSQL_Select);
		$DB_Result = $this->oDB->Query($sSQL_Select);
			while($res=mysql_fetch_array($DB_Result)){
			$profileId=$res['profileId'];
		}
		
		$realTable=selectTable($profileId);
		
		######
		#Guardo el check en WallAlert
		$realTable=selectTable($profileId);
		//var_dump($realTable);
		$fields=array('id_comment'=>$id_coment,'id_user'=>$idUserWhoMakeComment,'id_userWhoMakeComment'=>$id_user_who_check,'activity'=>4,'viewed'=>1,'time'=>$time,'hidden'=>1);
		$sSQL_Insert=GenerateInsert($realTable.'WallAlert',$fields);
		//var_dump($sSQL_Insert);
		//var_dump($sSQL_Insert);
		if($DB_Result = $this->oDB->Query($sSQL_Insert)){
			echo true;
		}
		
		#Guardo el check en pubComChecks
		$fields=array('id_user'=>$idUserWhoMakeComment,'id_user_profile'=>$profileId,'id_coment'=>$id_coment,'id_user_who_check'=>$id_user_who_check,'time'=>$time);
		$sSQL_Insert = GenerateInsert($table.'PubComChecks',$fields);
		//var_dump($sSQL_Insert);
		if($DB_Result = $this->oDB->Query($sSQL_Insert)){
			echo true;
			
		}
		
		
		#Selecciono el user id que checkea y el user id que recibe el check
		$sSQL_SELECT2=GenerateSelect('idUserWhoMakeComment,comment',$table.'ReceivedComments',"id=$id_coment");
		//var_dump($sSQL_SELECT2);
		//var_dump($sSQL_SELECT2);
		$DB_Result3 = $this->oDB->Query($sSQL_SELECT2);
		while($reess=mysql_fetch_array($DB_Result3)){
			//$id_user_who_check2=$reess['user_id_who'];#El que checkea
			$id_user=$reess['idUserWhoMakeComment'];#el que recibe
			$comment=$reess['comment'];
		}
		
		

		
		//echo "empieza el email";
			#qMail
			$idUserVisiting=$id_user;
			$sSql_SelectNLN=generateSelect('name,lastName','ax_generalRegister',"id=$idUserVisiting");
			//var_dump($sSql_SelectNLN);
			$DB_ResultNLN = $this->oDB->Query($sSql_SelectNLN);
			
			while($resNLN=mysql_fetch_array($DB_ResultNLN)){
				//$id_user_who_check2=$reess['user_id_who'];#El que checkea
					$aUsuario['name']=$resNLN['name']." ".$resNLN['lastName'];
			}
			
			
			$iUserIdSM=$_SESSION['iSMuIdKey'];
			$sSql_SelectNLN=generateSelect('name,lastName','ax_generalRegister',"id=$iUserIdSM");
			$DB_ResultNLN = $this->oDB->Query($sSql_SelectNLN);
			
			while($resNLN=mysql_fetch_array($DB_ResultNLN)){
				//$id_user_who_check2=$reess['user_id_who'];#El que checkea
					$aUsuario2['name2']=$resNLN['name']." ".$resNLN['lastName'];
			}
			

			global $_IDIOMA;
			
			$prioridad  = "Sistema";
			$asunto    	= $_IDIOMA->traducir('Your comment has been checked at SOCCERMASH.com');
			$tipo    	= "alguno";
			
			
			$archivo='/templatemail/emailFromWall.tpl';
			$iUserIdSM=$id_user;#idUsuarioReciveEmail
			$aUsuario['msj']=$aUsuario2['name2']." ".$_IDIOMA->traducir("checked your comment").": <a href='http://www.soccermash.com'>".$comment."</a>";#msj
			
				//var_dump($iUserIdSM);
				//var_dump($aUsuario);
				if(QMail::add($tipo, $iUserIdSM, $asunto, $archivo, $aUsuario, $prioridad)){
					return true;
				}
			##end qMail
		//echo "termino el email";
		}############

	
	//($table,$id_user,$id_user_profile,$id_coment,$id_user_who_check,$time);
		
		function unCheckComment($table,$id_user,$id_user_profile,$id_coment,$id_user_who_check,$time){
		$ocurrencias=0;

		
		$sSQL_Delete="DELETE FROM ".$table."PubComChecks where id_coment=$id_coment AND id_user_who_check=$id_user_who_check";
		//var_dump($sSQL_Delete);
		if(mysql_query($sSQL_Delete)){
				echo true;
			}else{
				echo false;
			}
		
		$myId=myId();
		
		$sSQL_Delete2="DELETE FROM ".$table."WallAlert where id_comment=$id_coment and id_userWhoMakeComment=$myId";
		//var_dump($sSQL_Delete2);
		if(mysql_query($sSQL_Delete2)){
				echo true;
			}else{
				echo false;
			}
		
		}
		
		
		
		
		function unCheckPublication($table,$id_user,$id_user_profile,$id_coment,$id_user_who_check,$time){
		$ocurrencias=0;
		
		 
		
		$sSQL_Delete="DELETE FROM ".$table."PubComChecks where id_publication=$id_coment AND id_user_who_check=$id_user_who_check";
		if(mysql_query($sSQL_Delete)){
			echo true;
		}else{
			echo false;
		}
		
		$sSQL_Delete="DELETE FROM ".$table."WallAlert where id_publication=$id_coment AND id_userWhoMakeComment=$id_user_who_check";
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
					die('You can�t check this comment again!');
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
	
	
	
	
	
		############
		
		//var_dump($sSQL_Insert);
			
			//var_dump($sSQL_Insert);
	
	
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
	
	function addComment($table,$comment,$idPublication,$idUserWhoMakeComment,$idUserVisiting,$time){
		$vueltas=0;
		$idPublication=(int)$idPublication;#id de la publicacion
		
		$fields=array('idUserWhoReceiveAComment'=>$idUserVisiting,'idUserWhoMakeComment'=>$idUserWhoMakeComment,'idComment'=>$idPublication,'comment'=>$comment,'time'=>$time);		
		$sSQL_Insert = GenerateInsert($table.'ReceivedComments',$fields);

		if($DB_Result = $this->oDB->Query($sSQL_Insert)){
			echo true;
		}else{
			echo false;
		}
		
		
		#select de todos los ids de las personas que comentaron esa publicacion
		
		$sSQL_Select=generateSelect('idComment,idUserWhoMakeComment',$table.'ReceivedComments',"idComment=$idPublication");
		if($DB_Result = $this->oDB->Query($sSQL_Select)){
			
			while($resSelectUserIdWhoMakeComment=mysql_fetch_array($DB_Result)){
				$idUserWhoMakeCommentN[]=(int)$resSelectUserIdWhoMakeComment['idUserWhoMakeComment'];#el que el comentario sea quien sea
				$idComment=(int)$resSelectUserIdWhoMakeComment['idComment'];#el que el comentario sea quien sea
			}
				
				$usuarioQueCreaLaPublicacion=generateSelect('user_id_who',$table.'Wall',"id=$idComment");
				$DB_Result = $this->oDB->Query($usuarioQueCreaLaPublicacion);
				while($resUsuarioQueCreaLaPublicacion=mysql_fetch_array($DB_Result)){
					$idUsuarioQueCreaLaPublicacion=(int)$resUsuarioQueCreaLaPublicacion['user_id_who'];
				}
				
				$idUserWhoMakeCommentN[]=$idUsuarioQueCreaLaPublicacion;
			//	echo $idUsuarioQueCreaLaPublicacion;
			//echo "<br />Antes del unique<br />";
			//var_dump($idUserWhoMakeCommentN);
			$idUserWhoMakeCommentN=array_unique($idUserWhoMakeCommentN);
			//echo "<br />Despues del unique<br />";
			//var_dump($idUserWhoMakeCommentN);
			array_values($idUserWhoMakeCommentN);
			//var_dump($idUserWhoMakeCommentN);
			foreach ($idUserWhoMakeCommentN as $id){
					$newArray[]=$id;
			}
			//var_dump($newArray);
		
			#Select de los perfiles de cada usuario, tengo que sacar el profileId del registro general y ahi armar selectTable();
			foreach ($newArray as $id){
				$sSQL_SelectProfileId=generateSelect('profileId','ax_generalRegister',"id=$id");
				if($DB_ResultProfileId = $this->oDB->Query($sSQL_SelectProfileId)){
					while($resSelectProfileId=mysql_fetch_array($DB_ResultProfileId)){
						$idsProfile=(int)$resSelectProfileId['profileId'];#el que el comentario sea quien sea
					}
						$vueltas++;
						//echo $vueltas;
						#Alerta
						$myId=myId();
						if($id != $myId){
						
							$tableForAlert=selectTable($idsProfile);
							
							$field=array('id_comment'=>$idPublication,'id_user'=>$id,'id_userWhoMakeComment'=>$myId,'activity'=>2,'viewed'=>1,'hidden'=>1,'time'=>$time);
							$sSQL_InsertAlerts=generateInsert($tableForAlert.'WallAlert',$field);
							//var_dump($sSQL_InsertAlerts);
							if($DB_Result = $this->oDB->Query($sSQL_InsertAlerts)){
								echo true;
							}else{
								echo false;
							}
							
							#email:
			
							$sSql_SelectNLN=generateSelect('name,lastName','ax_generalRegister',"id=$id");
							$DB_ResultNLN = $this->oDB->Query($sSql_SelectNLN);
							
							//echo "selectForEamil";
							//var_dump($sSql_SelectNLN);
							while($resNLN=mysql_fetch_array($DB_ResultNLN)){
								//$id_user_who_check2=$reess['user_id_who'];#El que checkea
									$aUsuario['name']=$resNLN['name']." ".$resNLN['lastName'];
							}

							
							$iUserIdSM=$myId;
							$sSql_SelectNLN=generateSelect('name,lastName','ax_generalRegister',"id=$iUserIdSM");
							$DB_ResultNLN = $this->oDB->Query($sSql_SelectNLN);
							
							
							//echo "selectForEamil2";
							//var_dump($sSql_SelectNLN);
							
							while($resNLN=mysql_fetch_array($DB_ResultNLN)){
								//$id_user_who_check2=$reess['user_id_who'];#El que checkea
									$aUsuario2['name2']=$resNLN['name']." ".$resNLN['lastName'];
							}
							
							global $_IDIOMA;
							
							$prioridad  = "Sistema";
							$asunto    	= $_IDIOMA->traducir('Your publication has been comented at SOCCERMASH.com');
							$tipo    	= "alguno";
							
							
							$archivo='/templatemail/emailFromWall.tpl';
							$idUserWhoReceiveComment=$id;#idUsuarioReciveEmail
							
							
							$aUsuario['msj']=$aUsuario2['name2']." ".$_IDIOMA->traducir("commented your publication").": <a href='http://www.soccermash.com'>$comment</a>";
							

								if(QMail::add($tipo, $idUserWhoReceiveComment, $asunto, $archivo, $aUsuario, $prioridad)){
									echo true;
								}
							
						}
						
					
				}
			}
			
		}else{
			echo false;
		}
		
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
	
	function addPublication($table,$fields){
		
		$myId=myId();
		$idUserVisiting=idUserVisiting();
		
		//$table.='Wall';#Ahora genero la tabla Wall: ax_[tipoPerfil]Wall
		#Guardo la publicacion
		$sSQL_Insert = GenerateInsert($table.'Wall',$fields);
		//var_dump($sSQL_Insert);
		if($DB_Result = $this->oDB->Query($sSQL_Insert)){
			echo true;#guardada
			$idPublication=mysql_insert_id();
			if($myId != $idUserVisiting){
			
				#Alerta al usuario
		
		$idQueRecibeAlerta=$fields['user_id'];#Este seria el ID de la persona a la cual estoy visitando y por ende a la cual le escribi un mensaje
		//var_dump($idQueRecibeAlerta);
		$idUsuarioEscribe=$fields['user_id_who'];#Este es el usuario que escribe, osea yo =) 
		//var_dump($idUsuarioEscribe);
		$fieldsForAlerts=array('id_publication'=>$idPublication,'id_user'=>$idQueRecibeAlerta,'id_userWhoMakeComment'=>$idUsuarioEscribe,'activity'=>1,'viewed'=>1,'hidden'=>1,'time'=>time());
		$sSQL_Insert2 = GenerateInsert($table.'WallAlert',$fieldsForAlerts);
		//var_dump($sSQL_Insert2);
		if($DB_Result2 = $this->oDB->Query($sSQL_Insert2)){
			echo true;#guardada
		}else{
			echo false;#error
			die('We have some problems whit Alerts, please try again');
		}
		
		
		#Envio de Email
		
			$idUserVisiting=(int)$_SESSION['idUserVisiting'];
			$sSql_SelectNLN=generateSelect('name,lastName','ax_generalRegister',"id=$idUserVisiting");
			//var_dump($sSql_SelectNLN);
			$DB_ResultNLN = $this->oDB->Query($sSql_SelectNLN);
			
			while($resNLN=mysql_fetch_array($DB_ResultNLN)){
				//$id_user_who_check2=$reess['user_id_who'];#El que checkea
					$aUsuario['name']=$resNLN['name']." ".$resNLN['lastName'];
			}

			
			$iUserIdSM=(int)$_SESSION['iSMuIdKey'];
			$sSql_SelectNLN=generateSelect('name,lastName','ax_generalRegister',"id=$iUserIdSM");
			//var_dump($sSql_SelectNLN);
			$DB_ResultNLN = $this->oDB->Query($sSql_SelectNLN);
			
			while($resNLN=mysql_fetch_array($DB_ResultNLN)){
				//$id_user_who_check2=$reess['user_id_who'];#El que checkea
					$aUsuario2['name2']=$resNLN['name']." ".$resNLN['lastName'];
			}
			
			global $_IDIOMA;
			
			$prioridad  = "Sistema";
			$asunto    	= $_IDIOMA->traducir('You receive a publication on your wall at SOCCERMASH.com');
			$tipo    	= "alguno";
			
			$archivo='/templatemail/emailFromWall.tpl';
			$iUserIdSM=(int)$_SESSION['idUserVisiting'];#idUsuarioReciveEmail
			$aUsuario['msj']=$aUsuario2['name2']." ".$_IDIOMA->traducir("published on your wall").": <a href='http://www.soccermash.com'>".$fields['publication']."</a>";
			

				if(QMail::add($tipo, $iUserIdSM, $asunto, $archivo, $aUsuario, $prioridad)){
					return true;
				}
			
			}
		}else{
			echo false;#error
			die('We have some problems whit Publications, please try again');
		}
		
		
		
		
		
		
	}

	
}	
?>