<?php
//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 

//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/lib/site_ini.php");
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/site_ini.php");


$type=$_POST['type'];

if(!isset($_SESSION['idUserVisiting'])){;
$idUserVisiting=$_SESSION['iSMuIdKey'];
}else{
$idUserVisiting=$_SESSION['idUserVisiting'];
}

if(!isset($_SESSION['idProfileVisiting'])){;
$profileVisiting=$_SESSION['iSMuProfTypeKey'];
}else{
$profileVisiting=$_SESSION['idProfileVisiting'];
}


switch($type){
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

	case 'selectComment':
	
		$agtime=$profileVisiting;
		$table=selectTable($agtime);
		$anexo='ReceivedComments';
		$tableProfile=$table.$anexo;
		
		$id=$_POST['value'];
		//$idComment=$_POST['askhjdasoljqkwdsanmcxgzh'];
		$idUserWhoMakeComment=$_SESSION['iSMuIdKey'];
		//$idUserVisiting=$_SESSION['idUserVisiting'];
		//$time=time();
		$jug= new Publication();
		$jug->selectComment($tableProfile,$id);
		break;
		
}


class Publication{

	function __construct(){
		global $SITE_oDB;	
		$this->oDB =& $SITE_oDB;
	}
function addComment($tableProfile,$comment,$idComment,$idUserWhoMakeComment,$idUserVisiting,$time){
		$fields=array('comment'=>$comment,'idComment'=>$idComment,'idUserWhoMakeComment'=>$idUserWhoMakeComment,'idUserWhoReceiveAComment'=>$idUserVisiting,'time'=>$time);
		//var_dump($fields);
		$sSQL_Insert = GenerateInsert($tableProfile,$fields);
		//var_dump($sSQL_Insert);
		if($DB_Result = $this->oDB->Query($sSQL_Insert)){
			echo mysql_insert_id();
			
		}else{
			echo false;
		}	
			//var_dump($sSQL_Insert);
	}
	
function selectComment($tableProfile,$id){
	$fields=array('id'=>$id);
	$sSQL_SELECT= GenerateSelect('*',$tableProfile,$fields);
	if($DB_Result=$this->oDB->Query($sSQL_SELECT)){
		while($res=mysql_fetch_array($DB_Result)){
			$id=$res['id']."|";
			$idUserWhoReceiveAComment=$res['idUserWhoReceiveAComment']."|";
			$idUserWhoMakeComment=$res['idUserWhoMakeComment']."|";
			$idComment=$res['idComment']."|";
			$comment=$res['comment']."|";
			$time=$res['time'];
		}
		$fakeArray=$id.$idUserWhoReceiveAComment.$idUserWhoMakeComment.$idComment.$comment.$time;
		echo $fakeArray;
		
	}else{
		echo false;
	}
}
}
?>