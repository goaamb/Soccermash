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
		$ocurrencias=0;
		$sSQL_Select=GenerateSelect('*',$table,'id_coment='.$id_coment.' AND id_user_who_check='.$id_user_who_check);
		if($DB_Result = $this->oDB->Query($sSQL_Select)){
			$ocurrencias=mysql_num_rows($DB_Result);
				if($ocurrencias != 0){
					var_dump($ocurrencias);
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
		}	
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
					var_dump($ocurrencias);
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
	
	
	
	
	
		function checkPublication($table,$id_user,$id_user_profile,$id_publication,$id_user_who_check,$time){
		$ocurrencias=0;
		$sSQL_Select=GenerateSelect('*',$table,'id_publication='.$id_publication.' AND id_user_who_check='.$id_user_who_check);
		if($DB_Result = $this->oDB->Query($sSQL_Select)){
			$ocurrencias=mysql_num_rows($DB_Result);
				if($ocurrencias != 0){
					var_dump($ocurrencias);
					die('You can�t check this publication again!');
				}
			
		}else{
		die('We have a problem whit this request, please try again in a few second, if this problem persist, please contact us');
		}
		
		$fields=array('id_user'=>$id_user,'id_user_profile'=>$id_user_profile,'id_publication'=>$id_publication,'id_user_who_check'=>$id_user_who_check,'time'=>$time);
		//var_dump($fields);
		$sSQL_Insert = GenerateInsert($table,$fields);
		//var_dump($sSQL_Insert);
		if($DB_Result = $this->oDB->Query($sSQL_Insert)){
			echo true;
		}else{
			echo false;
		}	
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
	
	
	function addComment($tableProfile,$comment,$idComment,$idUserWhoMakeComment,$idUserVisiting,$time){
		$fields=array('comment'=>$comment,'idComment'=>$idComment,'idUserWhoMakeComment'=>$idUserWhoMakeComment,'idUserWhoReceiveAComment'=>$idUserVisiting,'time'=>$time);
		//var_dump($fields);
		$sSQL_Insert = GenerateInsert($tableProfile,$fields);
		//var_dump($sSQL_Insert);
		if($DB_Result = $this->oDB->Query($sSQL_Insert)){
			echo true;
		}else{
			echo false;
		}	
			//var_dump($sSQL_Insert);
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
	//var_dump($sSQL_Insert);
	}
}	

?>