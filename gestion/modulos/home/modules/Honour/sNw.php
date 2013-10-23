<?php

require_once $_SERVER ['DOCUMENT_ROOT'] . '/gbase.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/gestion/lib/site_ini.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/gestion/modulos/home/modules/classAndres.php';
$date = date ('Y/m/d');

if(isset($_SESSION["bEditPlayer"])&& $_SESSION["bEditPlayer"]==true){#si la edicion del perfil q se kiere guardar 
								    #es la de player x su representante
	if(isset($_SESSION["iIdPlayer"])&&isset($_SESSION["iPerfilPlayer"])){															 
			$idUserVisiting = $_SESSION["iIdPlayer"];
			$idProfileVisiting = $_SESSION['iPerfilPlayer'];
	}
			
}else{#sigue como era la logica original

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
$value=$_POST['value'];

switch($type){
	case 'update': 
		
		$table = selectTable ($idProfileVisiting);
		$anexo = 'Honour';
		$tableProfile = $table.$anexo;
	
		/////////checks if exists///////
		$sql="SELECT * FROM $tableProfile WHERE idPlayer=$idUserVisiting";
		$query=mysql_query($sql);
		if(!mysql_num_rows($query)>0){
			
			$insert="INSERT INTO $tableProfile (idPlayer,honour,date) VALUES ('$idUserVisiting','$value','$date')";
			$res=mysql_query($insert) or die('error: '.mysql_error());			
						
		}else{
			
			$update="UPDATE $tableProfile SET honour='$value',date='$date' WHERE idPlayer=$idUserVisiting";
			$res=mysql_query($update) or die('error: '.mysql_error());
			
		}
		
	break;

}
?>

	<script>
		window.top.window.$("#GetInValHN").html('<?php echo str_replace(array("\n","\r","'"), array("","","\\'"), str_replace("<a",'<a target="_blank"',$value)); ?>');
		window.top.window.$("#GetOutHN").hide('400');
		window.top.window.$("#GetInHN").show('400');
		window.top.window.$("#GetOutHN").hide('400');
		window.top.window.$("#GetInHN").show('400');
	</script>
