<?php


require_once $_SERVER ['DOCUMENT_ROOT'] . '/gestion/lib/site_ini.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/gestion/modulos/home/modules/classAndres.php';
$date = date ('d/m/Y');

if (!isset($_SESSION['idUserVisiting'])){
	$idUserVisiting = $_SESSION ['iSMuIdKey'];
	$idProfileVisiting = $_SESSION['iSMuProfTypeKey'];
}else{
	$idUserVisiting = $_SESSION ['idUserVisiting'];
	$idProfileVisiting = $_SESSION ['iSMuProfTypeKey'];
}

$type=$_POST['type'];
$value=$_POST['value'];


/*echo $type;
echo "<br />";
echo $value;
echo "<br />";
$sql=generateSelect('*','ax_generalRegister',"id=$idUserVisiting");
echo $sql;
echo "<br />";
*/
switch($type){
	case 'update': 
		
		
		$table = selectTable ($idProfileVisiting);
		$anexo = 'New';
		$tableProfile = $table.$anexo;
		$update="UPDATE $tableProfile SET description='$value' WHERE idPlayer=$idUserVisiting";
		$res=mysql_query($update) or die('error: '.mysql_error());
	break;

}
?>

	<script>
		window.top.window.$("#GetInVal").html('<?php echo str_replace(array("\n","\r","'"), array("","","\\'"), $value); ?>');
		window.top.window.$("#GetOut").hide('400');
		window.top.window.$("#GetIn").show('400');
		window.top.window.$("#GetOut").hide('400');
		window.top.window.$("#GetIn").show('400');
	</script>
