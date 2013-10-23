<?php

require_once $_SERVER ['DOCUMENT_ROOT'] . '/gbase.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/gestion/lib/site_ini.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/gestion/modulos/home/modules/classAndres.php';
$date = date ('Y/m/d');


if(isset($_SESSION["bEditPlayer"]) && $_SESSION["bEditPlayer"]==true){
								   
	if(isset($_SESSION["iIdPlayer"]) && isset($_SESSION["iPerfilPlayer"]) ){															 
			$idUserVisiting = $_SESSION["iIdPlayer"];
			$idProfileVisiting = $_SESSION["iPerfilPlayer"];
	}
			
}else{#logicA ORIG
if (!isset($_SESSION['idUserVisiting'])){
	$idUserVisiting = $_SESSION ['iSMuIdKey'];
	$idProfileVisiting = $_SESSION['iSMuProfTypeKey'];
}else{
	$idUserVisiting = $_SESSION ['idUserVisiting'];
	$ml=new ModelLoader("ax_generalRegister");
	if($ml->buscarPorCampo(array("id"=>$_SESSION ['idUserVisiting']))){
		$idProfileVisiting = $ml->profileId;
	}else{
		$idProfileVisiting = $_SESSION ['iSMuProfTypeKey'];
	}
}
}

$type=$_POST['type'];
$value=addslashes($_POST['value']);
$value=preg_replace("/width:\s*\d+px;?/iU", "", $value);
$value=str_replace("'", "`", $value);

switch($type){
	case 'update': 
		
		
		$table = selectTable ($idProfileVisiting);
		$anexo = 'Observation';
		$tableProfile = $table.$anexo;
		
		$sql="SELECT * FROM $tableProfile WHERE idPlayer=$idUserVisiting";
		$query=mysql_query($sql);
		if(!mysql_num_rows($query)>0){
		
			$insert="INSERT INTO $tableProfile (idPlayer,observation,date) VALUES ('$idUserVisiting','$value','$date')";
			$res=mysql_query($insert) or die('error: '.mysql_error());			
		
		}else{
		
		$update="UPDATE $tableProfile SET observation='$value',date='$date' WHERE idPlayer=$idUserVisiting";
		$res=mysql_query($update) or die('error: '.mysql_error());
		
		}
	break;

}
$value=str_replace("\\'", "'", $value);
?>

	<script>
		window.top.window.$("#GetInVal2").html('<?php echo str_replace(array("\n","\r","'"), array("","","\\'"), str_replace("<a",'<a target="_blank"',$value)); ?>');
		window.top.window.$("#GetOut2").hide('400');
		window.top.window.$("#loadingSaveTd2").hide();
		window.top.window.$("#GetIn2").show('400');
		window.top.window.$("#GetOut2").hide('400');
		window.top.window.$("#GetIn2").show('400');
	</script>

	
