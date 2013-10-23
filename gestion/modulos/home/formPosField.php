<?
$dir='';
require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/profile/profileClass.php');

$str='';
//////check if some checks.. are active/////
for($i=0;$i<11;$i++){
	if(isset($_POST['position'.$i])){
			$str=$str.($i+1).',';		
	}
}


	 //////////check the profile visiting///////////////
	 if(!isset($_SESSION['idUserVisiting']) || $_SESSION['idUserVisiting']==0 || $_SESSION['idUserVisiting']==$_SESSION['iSMuIdKey']){
		 $idUserVisiting=$_SESSION["iSMuIdKey"];
 }else{
	 $idUserVisiting=$_SESSION["idUserVisiting"];
 }
	 
if(!isset($_SESSION['idProfileVisiting']) || $_SESSION['idProfileVisiting']==0 || $_SESSION['idProfileVisiting']==$_SESSION['iSMuProfTypeKey']){
 	$idProfileVisiting=$_SESSION["iSMuProfTypeKey"];
}else{
 	$idProfileVisiting=$_SESSION["idProfileVisiting"];
}

	/////////update position/////////////
	$aFields=array();
	$aFields['position']=$str;
	
	
	$pr=new Profile();
	$pr->upProfile(2,$aFields,"idUser=".$idUserVisiting."");	
	
	echo '
		<script type="text/javascript">
			window.top.window.$("#changePosMsg").html("updated");
		</script>
	';
	
?>