
<script>
$('#observationHiddenAg').toggle(function(){
	$.ajax({
		url: dir+"Observation/classObservation.php",
		data: "type=editHidden&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST',
		success: function(){
			$("#observationHiddenAg").css('background-position','-149px -79px');
		}
	});
		
	},function(){
		$.ajax({
		url: dir+"Observation/classObservation.php",
		data: "type=editVisible&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST',
		success: function(){

			$("#observationHiddenAg").css('background-position','-165px -79px');
		}
	});
		
	});
	</script>
 <?php //require_once("gestion/lib/share/clases/search/buscador.js.php"); ?>


<!-- <script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script> -->
<script type="text/javascript" src="../js/jquery.js" ></script>

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
//$iUserIdSM=67;
//$iUserIdSM=$_SESSION["iSMuIdKey"];

$agdate=$_GET['agdate'];
$agtime=$_GET['agtime'];

//echo "agdata: ".$agdate;
//echo "<br />agtime: ".$agtime;
//echo "<br />";

//$iUserProfileId=$_SESSION["iSMuProfTypeKey"];
//$iUserProfileId=2;
//echo "Userid :".$_SESSION["iSMuIdKey"];
//echo "<br />UserProfile :".$_SESSION["iSMuProfTypeKey"]."<br />";
?>


<?php 
//$iUserIdSM=67;

//$iUserProfileId=$_SESSION["iSMuProfTypeKey"];


//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php");
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php");

	$table=selectTable($agtime);
	$anexo='Observation';
	$tableProfile=$table.$anexo;

?>
<script>

var $iUserIdSM=<?php echo $iUserIdSM; ?>;
var $iUserProfileId=<?php echo $iUserProfileId; ?>;
//alert($iUserIdSM);
//alert($iUserProfileId);
</script>
</head>
<body>

<?php
//$Visiting=(int)$_SESSION['idUserVisiting'];
//$Session=(int)$_SESSION["iSMuIdKey"];

//echo "Visiting: ".$Visiting."<br />";
//echo "Session: ".$Session."<br />";
if($idUserVisiting == $_SESSION["iSMuIdKey"]){


//require_once("../gestion/lib/share/clases/search/buscador.php");

$oDB=new mysql;
$oDB->connect();
//mysql_connect("localhost","root","");
//mysql_select_db("soccermash_test2");
$sql="SELECT * FROM $tableProfile WHERE idPLayer=$agdate ORDER BY ID DESC";


?>
        <span class="icon iposition" id="observationHiddenAg"></span>
         <table width="575" class="Tbl3" border="0"><!--la clase .onedit da background color de edicion-->
           <tr>
		   <td id="obsvTxt" width="560">
		   
		   <?

$exist='';
$sql2=$oDB->query($sql);


if (mysql_num_rows($sql2)==0)
{
$exist='No hay datos = 0';
} else {
$exist='Hay datos = 1';
}

//echo "Exists: ".$exist."<br /><br />";


if ($exist=='No hay datos = 0'){
//echo " a guardar datos<br />";

echo "<a href='javascript:;' onClick='javascript:WhenEnterForFirstTimeObservationsag(agdate,agtime);'>To start adding information, click here first</a>";


}

else
{
while ($row = mysql_fetch_array($sql2)) {

/*
$subject = $row['observation'];
$pattern = '/[[:space:]]/';
preg_match($pattern, substr($subject,3), $matches, PREG_OFFSET_CAPTURE);
if($matches){
echo "vacio";
}else
{
echo "lleno";
}*/


		//echo '<div id='.$row['id'].' >';
		//echo "CATEGORY: <a href='#'  id='editCategory'>".$row['category']. " </a>  Title: ".$row['title']. " COUNTRY ". $row['country']. " YEAR OF ".$row['yearOf']. " CLUB OR ASOCIATION ".$row['clubOrAsociation']. " HIDDEN ".$row['hidden']. "</a> <br />";
		//////////////////CATEGORY//////////////////
		echo '<div id="observation_'.$row['id'].'" ><a  href="javascript:void(0);" onClick="convertToInputObservationag(\''.$row['id'].'\',\'observation\',this, \''.$agdate.'\', \''.$agtime.'\');" >';
		echo (($row['observation'])==NULL ? 'Click here to start adding information' : $row['observation'].".");
		echo '</a></div>';

		
		//////////////////Hidden//////////////////
		//echo '<td><div id="hidden_'.$row['id'].'" ><a  href="javascript:void(0);" onClick="convertToSelectHiddenObservationag(\''.$row['id'].'\',\'hidden\',\''.$row['hidden'].'\', \''.$agdate.'\', \''.$agtime.'\')">';
		//echo $row['hidden'];
		//echo '</a></div></td>';
		
if($date<$row['date']){
		$date=$row['date'];
		}
		
}
}

?>
</td></tr></table>

<br />Last Update: <?php echo $date; 
}else{
echo "You can not edit this profile, only can edit your own profile";
}
?>
