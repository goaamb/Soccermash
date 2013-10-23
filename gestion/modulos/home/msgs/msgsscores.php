<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/css; charset=utf-8" />
<!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />-->
<meta http-equiv="Cache-Control" CONTENT="no-cache" />
<meta http-equiv="pragma" CONTENT="no-cache" />

<head>
<link href="../../../../css/homestyles.css" type="text/css" rel="stylesheet" media="screen" />
<link href="../../../../css/msgs.css" type="text/css" rel="stylesheet" media="screen" />
<script type="text/javascript" src="../../../../js/jquery-1.5.1.min.js"></script>
<script src="../../../../js/css_browser_selector.js" type="text/javascript"></script>


<style>
body{
	background:#FFFFFF;
	margin: 0;
    padding: 0;
	font-family: Verdana;
	overflow:hidden;
}
.theMsgsS {
	top:0;
}
.theMsgsS .scores .titlescores{
	*width: 587px;
}
.theMsgsS .scores .titlescores select {
 	float: left;
    margin-left: 0;
    margin-right: 6px;
    margin-top: 4px;
    width: 165px;   
}
.theMsgsS .scores .score table{
	background: none repeat scroll 0 0 transparent;
    margin-top: -30px;
	margin-left: 12px;
    width: 557px;
	z-index: 2000;
	color:#000000;
}
.theMsgsS .scores .score table tr td table{
	width: 557px;
	margin-top: 0px;
	margin-left: -4px;
}
.theMsgsS .scores .score table tr td table tr td a{
	background-color: #000000;
    color: #B2B2B2;
    cursor: default;
    display: block;
    float: left;
    font-family: Verdana;
    font-size: 11px;
    height: 14px;
	*height: 20px;
    padding: 3px 8px;
    text-align: left;
    text-decoration: none !important;
    width: 250px;
	*width: 265px;
}
#loadScores{
	background-image: url(../../../../img/indicator.gif);
	height: 33px;
    position: absolute;
    right: 13px;
    top: 30px;
    width: 33px;
	display: none;
}
.theMsgsS .scores .score table tr td table tr td span{
	background-image: url(../../../../img/livScrsMidle.png);
	background-position: center center;
    background-repeat: no-repeat;
    color: transparent;
    float: left;
    height: 20px;
    width: 18px;
}
.theMsgsS .scores .score table tr td a{
	font-family: Verdana;
	font-weight: bold !important;
	font-size: 11px;
	cursor: default;
	text-decoration: none !important;
	color:#000000;
}
.theMsgsS .scores .score table tr td,.theMsgsS .scores .score table tr th{
	font-family: Verdana;
	font-size: 11px;
}
.theMsgsS .scores .score table tr td[align="right"]{
	text-align: center;
}
.theMsgsS .scores .score table tr td[align="right"] a{
	text-align: right;
	display: block;
}
.theMsgsS .scores .titlescores{
	font-family: Verdana;
}

.theMsgsS .scores .score {
    color: transparent;
	*color:#e5e5e5;
}
.bothC{
	clear: both;
	width: 100%;
	*width: auto;
}
</style>


</head>
<body>

<?
///get the saved preferences/// 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/profile/profileClass.php");
require_once($_SERVER['DOCUMENT_ROOT'].'/gestion/modulos/home/msgs/liveRes/rssLiveClass.php');

//require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/site_ini.php");

	////translation///////
	 require_once $_SERVER["DOCUMENT_ROOT"]. '/gbase.php';
	 require_once $_GBASE. '/goaamb/idioma.php';
	if(class_exists("Idioma")){
		 $_IDIOMA=Idioma::darLenguaje();
	  }		

global $_IDIOMA;

	

?>



<script type="text/javascript">
////Checkings//////////
function StartChecking(){
		ti=setTimeout("checaNewValus()",180*1000);
	}
	
	
	function checaNewValus(){
		$("#loadTheLive").load("gestion/modulos/home/msgs/liveRes/loadLive.php",{live:window.top.window.uUrlTosave},function() {
				/*if(window.top.window.tTheResults!='empty'){
					if(window.top.window.tTheResults!=$("#loadTheLive").html()){
						window.top.window.$("#oneGoal").show();
					}
					/*eltxt=$("#loadTheLive").html();
					
					for(i in eltxt){
						if(window.top.window.tTheResults[i]!=eltxt[i]){
							eltxt[i]="<strong>"+eltxt[i]+"</strong>";		
						}
					}
					
					$("#loadTheLive").html(eltxt);*/
				//}
			
			//window.top.window.tTheResults=$("#loadTheLive").html();
		});
		//StartChecking();
	}


	function saveLivePreferences(){
		country=$("#countryLive").val();
		$("#toLoadLive").load("gestion/modulos/home/msgs/liveRes/saveLivePreferences.php",{country:country,divToCheck:window.top.window.tTheDivToCheck,url:window.top.window.uUrlTosave});	
	}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////



	////////////show the div////////////
	

	var ti='';

	function setLiveOptions(val){
		$("#loadScores").show();
		$(".theLvTitles").hide();
		$(".theUrsLive").hide();
		$("#theCodeSelect").hide();
		$("#liveTit_"+val).show();
		$("#loadScores").hide();
	}
	
	
	
	valToShowDiv='no';
	function showTheCodeSelect(val){
		$("#loadScores").show();
		$(".theUrsLive").hide();
		$("#liveCode_"+val).show();
		window.top.window.tTheDivToCheck="#liveCode_"+val;
		valToShowDiv=val;
		$("#loadScores").hide();
	}
	
	function setLiveDiv(val){
			$("#loadScores").show();
			<? $_SESSION['liveRes']='started'; ?>
			window.top.window.tTheResults='empty';
			window.top.window.uUrlTosave=val;
			$("#loadTheLive").load("gestion/modulos/home/msgs/liveRes/loadLive.php",{live:window.top.window.uUrlTosave}, function() {		
				window.top.window.tTheResults=$("#loadTheLive").html();
				$("#loadScores").hide();	
				window.top.window.$(window).height($("#loadTheLive").height()+200);
				window.top.window.$("#iframeLiveScores").height($("#loadTheLive").height()+200);
				
			});
			StartChecking();
			saveLivePreferences();
	}
	
	

	
	
</script>

<?php

//////check the saved preferences///////
$proo=new Profile();
$liveSaved=$proo->selectGen('liveRes','id='.$_SESSION['iSMuIdKey']);
	if($liveSaved[0]->liveRes!=''){
		$lSaved=$liveSaved[0]->liveRes;
		$lSaved=explode(',',$lSaved);
		$countLiveSaved=$lSaved[0];
		$divLiveSaved=$lSaved[1];
		$urlLiveSaved=$lSaved[2];
		$divLiveSaved=explode("#liveCode_",$divLiveSaved);
		$divLiveSaved=$divLiveSaved[1];
	}else{
		$countLiveSaved='';
		$divLiveSaved='';
		$urlLiveSaved='';
	}
///////////////////////////////////////////////	
	
	







/////////////////////////////////////////////////////////////////////////////////////////////
$rsS2=new rssLiveClass();
//$rssLive=new rssLiveClass();
//$pro=new Profile();


?>

<div class="theMsgsS">

<!-- /// seccion scores /// -->

<div class="scores">

<!-- /// seccion titulo scores /// -->

<div class="titlescores">

<?php print $_IDIOMA->traducir("live scores")?>


	
	
	<!--checkTheResults(tTheResults);
	<input type="button" value="probar" onclick="formLive.submit();" />-->
	
	
<!-- Country -->
<div id="loadScores"></div>
<div class="bothC"></div>
<select name="countryLive" id="countryLive" onchange="setLiveOptions(this.value)">
	<option selected="selected" disabled="disabled"><? print $_IDIOMA->traducir("Select source"); ?></option>
	<option value="World"><? print $_IDIOMA->traducir("World");?></option>
	<option value="ChampionsLeague"><? print $_IDIOMA->traducir("Champions League");?></option>
	<option value="EuropaLeague"><? print $_IDIOMA->traducir("Europa League");?></option>
	<option value="CopaAmerica"><? print $_IDIOMA->traducir("American Cup");?></option>
	<option value="FederationCup"><? print $_IDIOMA->traducir("Federation Cup");?></option>
	<option value="Oceania"><? print $_IDIOMA->traducir("Oceania");?></option>
	<option value="Sudamerica"><? print $_IDIOMA->traducir("South America");?></option>
	<option value="Norteamerica"><? print $_IDIOMA->traducir("North America");?></option>
<? 
$resul2=$rsS2->selectProfile('DISTINCT country',NULL,'country DESC');

$theCountriesLive=array();

if($resul2[0]!=''){

		foreach($resul2 as $res){
				
				
				if($res->country!="Europa League" && $res->country!="Champions League" && $res->country!="World" && $res->country!="Federation Cup" && $res->country!="Copa America" && $res->country!="Oceania" && $res->country!="Norteamerica" && $res->country!="Sudamerica"){
				
				$rescountry=ereg_replace( "([     ]+)", "",$res->country);
			
			
				/*if($countLiveSaved!=''){
					
					if($countLiveSaved==$rescountry){
						
						$sele="selected='selected'";
					}else{
						$sele='';	
					}
				}else{
					$sele='';
				}*/
				
				
		
				$theCountriesLive[$_IDIOMA->traducir($res->country)]	= '<option value="'.$rescountry.'">'.html_entity_decode($_IDIOMA->traducir($res->country)).'</option>';	
		}
		}
}		

asort($theCountriesLive);

	if(!empty($theCountriesLive)){
		foreach($theCountriesLive as $theCRes){
		
			echo $theCRes;
			
		}
	}
?>

</select>




<!-- title -->




<?	
	/////////////titles///////////////////////////////////////////////////////////////////
	if($resul2[0]!=''){
	foreach($resul2 as $res){
		$rescountry=str_replace('.','',$res->country);
		$rescountry=ereg_replace( "([     ]+)", "",$rescountry);
		echo '<select class="theLvTitles" style="display:none;" name="'.$rescountry.'" id="liveTit_'.$rescountry.'" onchange="showTheCodeSelect(this.value);">';
		echo '<option selected="selected" disabled="disabled">'.$_IDIOMA->traducir("Select source").'</option>';
	 $resul4=$rsS2->selectProfile('title,code',"country='".$res->country."'",'title DESC');
			if($resul4[0]!=''){
			foreach($resul4 as $res2){
				$restitle=str_replace('.','',$res2->title);
				$restitle=ereg_replace( "([     ]+)", "",$res2->title);
				
				
				$restitle=$rescountry.$restitle;
				
				echo '<option value="'.$restitle.'">'.$_IDIOMA->traducir($res2->title).'</option>';
			}//if
			}//[0]
	
		echo '</select>';
	}//for	
	}//[0]





///////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
	$resul3=$rsS2->selectProfile('country,title,code,clasificationCode',NULL,'title DESC');
			if($resul3[0]!=''){
			foreach($resul3 as $res3){
				$restitle=str_replace('.','',$res3->title);
				$restitle=ereg_replace( "([     ]+)", "",$restitle);
				
				$resCtitle=str_replace('.','',$res3->country);
				$resCtitle=ereg_replace( "([     ]+)", "",$resCtitle);
				
				$restitle=$resCtitle.$restitle;
				
				
				
				echo '<select class="theUrsLive" style="display:none;" name="liveCode_'.$restitle.'" id="liveCode_'.$restitle.'" onchange="setLiveDiv(this.value);">';
				echo '<option disabled="disabled" selected="selected">'.$_IDIOMA->traducir("Select source").'</option>';
					// $resul5=$rsS2->selectProfile('code,clasificationCode',"country='".$res3->country."'",'title DESC');
					//	if($resul5[0]!=''){
						//	foreach($resul5 as $res5){
								echo '<option value="'.$res3->code.'">'. $_IDIOMA->traducir("Results").'</option>';
								echo '<option value="'.$res3->clasificationCode.'">'. $_IDIOMA->traducir("Clasifications").'</option>';
							//}//for
						//}//if
				
				echo '</select>';
				
			}//if
			}//[0]
	
	

?>
<div class="bothC"></div>
</div>



<div class="score">








<!-- /// seccion datos scores /// -->

<div class="scor">




<script type="text/javascript">
	$("#liveTit_"+$("#countryLive").val()).show();
</script>







<? 
if(isset($_SESSION['liveRes']) && $_SESSION['liveRes']!=''){
	 if($divLiveSaved!='' && $countLiveSaved!='' && $urlLiveSaved!=''){
		 ?>
			<script type="text/javascript">
				$(".theUrsLive").hide();
				setLiveOptions('<? echo $countLiveSaved ?>');
				showTheCodeSelect('<? echo $divLiveSaved ?>');
				setLiveDiv('<? echo $urlLiveSaved ?>');
				$("#liveCode_<? echo $divLiveSaved; ?>").show();
			</script> 
		 
		<?
		}//if
	}//session
?>









</div>
<div id="toLoadLive"></div>
<div id="loadTheLive"></div>



<!-- 
 /// -->



</div>

<!-- /// end seccion datos scores /// -->

<!-- /// controles de desplazamiento /// -->

<!--<div id="ctrlnews">

<span id="left" class="controlnews"></span>

<span id="right" class="controlnews"></span>

</div>-->

<!-- /// end controles de desplazamiento /// -->

</div>

<!-- /// end seccion scores /// -->

<div class="bothC"></div>

<!-- ///Footer for msg with advices/// -->

<div class="footMsg"><!-- ///Start Advice/// (max 2 advices) -->

<div class="advMsg">

<div class="titAdv"><a href="javascript:;" onClick=""></a></div>

</div>

<!-- ///End advice/// --></div>

<div class="shadMsg"></div>

</div>

</body>
</html>
