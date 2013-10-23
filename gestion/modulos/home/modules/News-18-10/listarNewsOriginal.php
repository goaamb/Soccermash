<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/gestion/lib/site_ini.php'; 
$date=date("Y-m-d");
?><script>
$('#newsHiddenAg').toggle(function(){
	$.ajax({
		url: dir+"News/classNews.php",
		data: "type=editHidden&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST',
		success: function(){
			$("#newsHiddenAg").css('background-position','-149px -79px');
		}
	});
		
	},function(){
		$.ajax({
		url: dir+"News/classNews.php",
		data: "type=editVisible&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST',
		success: function(){

			$("#newsHiddenAg").css('background-position','-165px -79px');
		}
	});
		
	});
	</script>
<?php // require_once("gestion/lib/share/clases/search/buscador.js.php"); ?>


<?php
if(!isset($_SESSION['idUserVisiting'])){

//echo "<br />Id User Visiting no esta seteado: ".$_SESSION['idUserVisiting'];

$idUserVisiting = $_SESSION['iSMuIdKey'];

//echo "<br />Ahora el valor de idUserVisiting es $idUserVisiting";

}else{

//echo "<br />Id User Visiting estaba seteado como: ".$_SESSION['idUserVisiting'];
$idUserVisiting = $_SESSION['idUserVisiting'];
//echo "<br />Ahora el valor de idUserVisiting es $idUserVisiting";

}
//echo "THIS IS :".$_SESSION['idUserVisiting'];
//$iUserIdSM=67;
//$iUserIdSM=$_SESSION["iSMuIdKey"];
//$iUserProfileId=$_SESSION["iSMuProfTypeKey"];
//$iUserProfileId=2;

$agdate=$_GET['agdate'];
$agtime=$_GET['agtime'];

//echo "agdata: ".$agdate;
//echo "<br />agtime: ".$agtime;

?>

<script>

var $iUserIdSM='<?php echo (isset($iUserIdSM)?$iUserIdSM:""); ?>';
var $iUserProfileId='<?php echo (isset($iUserProfileId)?$iUserProfileId:""); ?>';
//alert($iUserIdSM);
//alert($iUserProfileId);
</script>

<?php
$Visiting=(int)(isset($_SESSION['idUserVisiting'])?$_SESSION['idUserVisiting']:0);
$Session=(int)(isset($_SESSION["iSMuIdKey"])?$_SESSION["iSMuIdKey"]:0);

//echo "Visiting: ".$Visiting."<br />";
//echo "Session: ".$Session."<br />";
if($idUserVisiting == $_SESSION["iSMuIdKey"]){
?>

<?php

//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php");
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php");

	$table=selectTable($agtime);
	$anexo='New';
	$tableProfile=$table.$anexo;

//require_once("../gestion/lib/share/clases/search/buscador.php");
$oDB=new mysql;
$oDB->connect();

//mysql_connect("localhost","root","");
//mysql_select_db("soccermash_test2");
$sql="SELECT * FROM $tableProfile WHERE idPlayer='$agdate' ORDER BY ID DESC";
//var_dump($sql);

?>
       <span class="icon iposition" id="newsHiddenAg"></span>
         <table width="575" class="Tbl3" border="0"><!--la clase .onedit da background color de edicion-->
           <tr>
            <td id="obsvTxt" width="560">
			
<?php 
$exist='';
$sql2=$oDB->query($sql) or die(mysql_error());

if (mysql_num_rows($sql2)==0)
{
$exist='No hay datos = 0';
} else {
$exist='Hay datos = 1';
}

//echo "Exists: ".$exist."<br /><br />";


if ($exist=='No hay datos = 0'){
//echo " a guardar datos<br />";

echo "<a href='javascript:;' onClick='javascript:WhenEnterForFirstTimeNewsag(agdate,agtime);'>".$_IDIOMA->traducir("To start adding information, click here first")."</a>";
echo '</td></tr>';
echo '</table>';
echo "<br />".$_IDIOMA->traducir("Last Update").": ".date("d/m/Y",strtotime($date));
}
	


else
{
	
while ($row = mysql_fetch_array($sql2)) {

	
		//<td><div id='.$row['id'].' >';
		//echo "CATEGORY: <a href='#'  id='editCategory'>".$row['category']. " </a>  Title: ".$row['title']. " COUNTRY ". $row['country']. " YEAR OF ".$row['yearOf']. " CLUB OR ASOCIATION ".$row['clubOrAsociation']. " HIDDEN ".$row['hidden']. "</a> <br />";
		//////////////////Title//////////////////
		//echo '<div id="title_'.$row['id'].'" ><a href="javascript:void(0);" onClick="convertToInputNewsag(\''.$row['id'].'\',\'title\',this, \''.$agdate.'\', \''.$agtime.'\')">';
		//echo ($row['title']==NULL)? 'Click here to add text' : $row['title'].".";
		//echo '</a></div></td>';
		

		
		//////////////////Description//////////////////
		echo '<div id="description_'.$row['id'].'" ><a  href="javascript:void(0);" onClick="convertToTextAreaNewsag(\''.$row['id'].'\',\'description\',this, \''.$agdate.'\', \''.$agtime.'\');" >';
		if ($exist==0){
		echo ($row['description']==NULL)? $_IDIOMA->traducir('Click here to add text') : $row['description'].".";}
		echo '</a></div></td>';
		
			
		//////////////////Hidden//////////////////
	//	echo '<td><div id="hidden_'.$row['id'].'" ><a  href="javascript:void(0);" onClick="convertToSelectHiddenNewsag(\''.$row['id'].'\',\'hidden\',\''.$row['hidden'].'\', \''.$agdate.'\', \''.$agtime.'\')">';
		//echo ($row['hidden'] == 'Visible') ? 'Visible' : 'Hidden' ;
	//	echo '</a></div></td>';
	echo '</tr>';

if(!$date){
		$date=$row['date'];
}
		
}
echo '</table>';
echo "<br />".$_IDIOMA->traducir("Last Update").": ".date("d/m/Y",strtotime($date));


}
}else{
print $_IDIOMA->traducir("You can not edit this profile, only can edit your own profile");
}?>