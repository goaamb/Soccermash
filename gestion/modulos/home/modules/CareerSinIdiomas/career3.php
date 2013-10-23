<div id="career"><h4 id="caree">CAREER<em class="plus open close"></em></h4>
    <div class="innerContent margLeftCenter caree">
       	<p class="editMode txtColorLC hide">Example: Won Championships or competitions local and international.</p>

<?php 
//$iUserIdSM=67;
$iUserIdSM=$_SESSION["iSMuIdKey"];
$iUserProfileId=$_SESSION["iSMuProfTypeKey"];
//$iUserProfileId=2;
//echo "Userid :".$_SESSION["iSMuIdKey"];
//echo "<br />UserProfile :".$_SESSION["iSMuProfTypeKey"]."<br />";
$date='';
?>

<table class="Tbl5" width="575">
<thead>
<tr><th width="79">Category</th><th width="78">Club</th><th width="65">Matches</th><th width="65">Titular</th><th width="54">Goals</th><th width="54">Assists</th><th width="63">Yellow <br />Cards</th><th width="61">Red <br />Cards</th><th width="37">Seasons</th><th class="whitecell" width="17"></th></tr>
</thead>
<tbody>



<?php

//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 

$oDB=new mysql;
$oDB->connect();
	$table=selectTable($iUserProfileId);
	$anexo='Career';
	$tableProfile=$table.$anexo;
	
//mysql_connect("localhost","root","");
//mysql_select_db("soccermash_test2");
//echo "Visiting: ".$_SESSION['idUserVisiting']."<br />";
//echo "Session : ".$_SESSION['iSMuIdKey']."<br />";

if($iUserIdSM === $_SESSION['idUserVisiting']){

$sql="SELECT * FROM $tableProfile WHERE idPlayer=$iUserIdSM AND hidden = 'Visible'";

}else{

$iUserIdSm=(int)$_SESSION['idUserVisiting'];
$sql="SELECT * FROM $tableProfile WHERE idPlayer=$iUserIdSm AND hidden = 'Visible'";

}

$sql2=$oDB->query($sql) or die(mysql_error());


while ($row = mysql_fetch_array($sql2)) {

		echo '<tr class="greenTr"><td><div id='.$row['id'].' >';
		//echo "CATEGORY: <a href='#'  id='editCategory'>".$row['category']. " </a>  Title: ".$row['title']. " COUNTRY ". $row['country']. " YEAR OF ".$row['yearOf']. " CLUB OR ASOCIATION ".$row['clubOrAsociation']. " HIDDEN ".$row['hidden']. "</a> <br />";
		//////////////////CATEGORY//////////////////
		echo '<div id="category_'.$row['id'].'" >';
		echo $row['category']." ".utf8_encode("º");
		echo '</div></td>';
		

		
		//////////////////OtherClub//////////////////
		
		if($row['clubOrAsociation']==0){
		$club=$row['otherClub'];
		
		}else{
		
		$sql5="SELECT * FROM ax_club WHERE id=".$row['clubOrAsociation']."";
		$sql6=mysql_query($sql5) or die(mysql_error());
		$row3=mysql_fetch_array($sql6);
		$club=$row3['name'];
		}
		echo '<th>';
		//echo ($row['clubOrAsociation']==0) ? $row4['otherClub']  : $row4['name'];
		echo $club.'</a></div></th>';
		
	
		
		
		////////////////////echo ($row['country']==NULL) ? '...' : $row['country'];//////////////////

		echo '<td><div id="matches_'.$row['id'].'" >';
		echo $row['matches'];
		echo '</div></td>';
				
		
		//////////////////titular //////////////////
		echo '<td><div id="titular_'.$row['id'].'" >';
		echo $row['titular'];
		echo '</div></td>';
		//////////////////goals//////////////////
		
		echo '<td><div id="goals_'.$row['id'].'">';
		echo $row['goals'];
		echo '</div></td>';
		
		//////////////////assists //////////////////
		echo '<td><div id="assists_'.$row['id'].'" >';
		echo $row['assists'];
		echo '</div></td>';
		
		//////////////////yellowCards  //////////////////
		echo '<td><div id="yellowCards_'.$row['id'].'" >';
		echo $row['yellowCards'];
		echo '</div></td>';
		
		//////////////////redCards   //////////////////
		echo '<td><div id="redCards_'.$row['id'].'" >';
		echo $row['redCards'];
		echo '</div></td>';
		
		//////////////////season  //////////////////
	//	echo '<td><div id="season_'.$row['id'].'" >';
	//	echo $row['season'];
	//	echo '</div>';
		
		//////////////////year  //////////////////
		echo '<td><div id="year_'.$row['id'].'" >';
		echo $row['year'];
		echo '</div></td></tr>';
		
		if($date<$row['date']){
		$date=$row['date'];
		}

}

echo '</tbody></table><br /><strong>Last Update </strong>'.$date.'<br /><br />';
?>
</div><!--END innerCont..-->
<hr /></div>
