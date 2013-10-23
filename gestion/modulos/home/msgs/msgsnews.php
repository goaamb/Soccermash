<style>
#loadingTRSS{
display:none;
}

</style>

<script type="text/javascript">
	var rssS=new Array();
	var rssT=new Array();
	var currentPositionn = 0;     //posicion actual
	var slideWidthn = 589; 
	var numberOfSlidesn = 3; 	// si la cantidad de elementos varia, esta variable tiene q ser dinamica
	function move(dir){
		if (dir == 'right'){
			if (currentPositionn <= (numberOfSlidesn-2)){ //si la cantidad de elementos a mostrar es dinamica, hay que replantear el 5 dinamicamente
				currentPositionn = currentPositionn + 1;
				$('#theRssContainer').animate({
				'marginLeft' : slideWidthn*(-currentPositionn)
				});
				return currentPositionn;
			}
		}else{
			if (currentPositionn > 0){
			currentPositionn = currentPositionn - 1;
			$('#theRssContainer').animate({
			'marginLeft' : slideWidthn*(-currentPositionn)
			});
			return currentPositionn;
			} //CLOSER
		}	//CLOSER			
	}

	
	function loadTheRss(val){
		$("#mediumRss").val(val);
		//$("#rssForm").submit();
		mediumRss=val;
		CCcountry=$("#countryRss").val();
		TTtitle=$("#countryRss").val();
		$("#theRssContainer").load('gestion/modulos/home/msgs/rss/rss.php',{countryRss:CCcountry,mediumRss:mediumRss,title:TTtitle});
		$("#loadingTRSS").show();
		currentPositionn = 0;
		$('#theRssContainer').animate({
			'marginLeft' : 0
			});
	}
	
	function setOptionsRss(val){
		$(".lastRss,.countriesRss").hide();
		$("#"+val).show();
	}//func
	
	
	function loadTheTitles(val){
		$(".lastRss").hide();
		$("#med_"+val).show();
	}//func
	
	

//alert(<? //echo $_SESSION['lg'] ?>);
	
	/*function setLiveRss(){
		
	}*/
</script>



<?php


//require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 

require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/site_ini.php");

	////translation///////
	 require_once $_SERVER["DOCUMENT_ROOT"]. '/gbase.php';
	 require_once $_GBASE. '/goaamb/idioma.php';
	if(class_exists("Idioma")){
		 $_IDIOMA=Idioma::darLenguaje();
	  }		

global $_IDIOMA;

?>

<div class="theMsgsS">

<!-- /// seccion scores /// -->
<? 
require_once($_SERVER['DOCUMENT_ROOT'].'/gestion/modulos/home/msgs/rss/rssClass.php');
//require_once($_SERVER['DOCUMENT_ROOT'].'/gestion/modulos/home/msgs/rss/rssLiveClass.php');
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/profile/profileClass.php");
$rsS=new rssClass();
//$rssLive=new rssLiveClass();
$pro=new Profile();
$theFirstRss="";


//////////Get All rs/////////////////////
$resul=$rsS->selectProfile('DISTINCT country',NULL,'country DESC');
$resul2=$rsS->selectProfile('*',NULL);



/////////Get my favourite rss/////////////////////////
$resSaved=$pro->selectGen('rss','id='.$_SESSION['iSMuIdKey']);
	if($resSaved[0]!=''){
		$resSvd=$resSaved[0]->rss;
		$expRss=explode(',',$resSvd);
		$countrySavedRss=$expRss[0];
		
		if(isset($expRss[2])){
			$xmlSavedTitle=$expRss[2];
		}
		
		
		if(isset($expRss[1])){
			$resul3=$rsS->selectProfile('medium',"rss_espanol='".$expRss[1]."'");
			$theFirstRss=$expRss[1];
			
		if($resul3[0]!=''){
			$xmlSavedRss=$resul3[0]->medium;
		}else{
			$xmlSavedRss='';
		}	
			
		}else{
			$countrySavedRss='';
			$xmlSavedRss='';
			$theLiveRss='';	
			$xmlSavedTitle='';
		}
		
	
	}else{
		$countrySavedRss='';
		$xmlSavedRss='';
		$theLiveRss='';
		$xmlSavedTitle='';
		$theFirstRss='';
	}
	
	

/////////////////livescores/////////////////////////////////

//$resulLive1=$rssLive->selectProfile('*',NULL);
?>
<div class="rss">

<div class="titlerss">
<img src="img/rssico.png" style="float: left; margin-top: 5px; margin-right: 5px;"/>
<?php print $_IDIOMA->traducir("rss");?>




<iframe id="iframeRss" name="iframeRss" src="" class="iframesResults" style="width:0; height:0; border:none;"></iframe>	

<form name="rssForm" id="rssForm" target="iframeRss" method="post" action=<? echo $_SERVER['DOCUMENT_ROOT'].'/gestion/modulos/home/msgs/rss/rss.php' ?>>


<span id="loadingTRSS"><img src="img/indicator.gif" width="15" height="15"  /></span>
	<select name="countryRss" id="countryRss" onchange="setOptionsRss(this.value);">
	<!--<option disabled selected>Select an option</option>-->
	
	<option value="FIFAcom">FIFA.com</option>
	<option value="UEFAcom">UEFA.com</option>


	<?
	asort($resul);
	if(!empty($resul[0])){
	foreach ($resul as $res){
		
		if($res->country==$countrySavedRss && $countrySavedRss!=''){
			$sel="selected='selected'";
		}else{
			$sel='';
		}
		
		
		$rescountry=str_replace('.','',$res->country);
		
		if($rescountry!="" && $res->country!='FIFA.com' && $res->country!='UEFA.com'){
		echo '<option '.$sel.' value="'.$rescountry.'">'.$_IDIOMA->traducir($res->country).'</option>';
		
		?>
		<script type="text/javascript">
			rssS.push("<? echo $rescountry; ?>");	
		</script>
		<?
	 	}
	}//for
						
			}//[0]
	?>
	
	</select>

	


<?
	///////Generate the mediums/////////////////////
	$selectSource=$_IDIOMA->traducir("Select source");
	
	if(!empty($resul[0])){
		foreach ($resul as $res){
			$rescountry=str_replace('.','',$res->country);
			echo'<select class="countriesRss" style="display:none;" name="theMediumRss" id="'.$rescountry.'" onchange="loadTheTitles(this.value);">';
			echo '<option disabled selected>'.$selectSource.'</option>';
				$resul2=$rsS->selectProfile('DISTINCT medium',"country='".$res->country."' order by medium asc");
					if(!empty($resul[0])){
						foreach ($resul2 as $res2){
							//$theRsRead=$res2->rss_espanol;	 ////Language???
							if(isset($xmlSavedRss) && $res2->medium==$xmlSavedRss){
								$sel2="selected='selected'";
							}else{
								$sel2='';
							}
								$resmedium=str_replace('.','',$res2->medium);
								echo "<option ".$sel2." value='".$resmedium."'>".$res2->medium."</option>";
		?>
		<script type="text/javascript">
			rssT.push("med_<? echo $resmedium; ?>");	
		</script>
		<?
							}//for
							
							/*if($sel!=''){			
					?>
						<script type="text/javascript">
							setOptionsRss('<? echo $xmlSavedRss; ?>');
						</script>
					<?
					}else{
					?>
						<script type="text/javascript">
							setOptionsRss('<? $resul2[0]->medium ?>');
						</script>
					<?	
					}//ifito	*/
							
						}//[]			
				
			echo'</select>';
		
		}//for
	}//[]
	
	
	
	///////////////Generate the titles////////////////
	$selectRSS=$_IDIOMA->traducir("Select RSS");
	
	$resul2=$rsS->selectProfile('DISTINCT medium',NULL);
	if(!empty($resul2[0])){
			foreach ($resul2 as $res2){
			$resmedium=str_replace('.','',$res2->medium);
			echo'<select class="lastRss" style="display:none;" name="title" id="med_'.$resmedium.'" onchange="loadTheRss(this.value);">';	
			echo '<option disabled selected>'.$selectRSS.'</option>';
				$resul3=$rsS->selectProfile('*',"medium='".$res2->medium."' order by title asc");
					
						if(!empty($resul3[0])){
						foreach ($resul3 as $res2){
							if(isset($_SESSION['lg'])){
								$replace=str_replace('-','',$_SESSION['lg']);
								$replace='rss_'.$replace;
								$theRsRead=$res2->$replace;	 ////Language???
							}else{
								$theRsRead='';
							}
								if(empty($theRsRead)){
									if(!empty($res2->rss_esES)){
										$theRsRead=$res2->rss_esES;
									}elseif(!empty($res2->rss_enUS)){
										$theRsRead=$res2->rss_enUS;
									}elseif(!empty($res2->rss_ptPT)){
										$theRsRead=$res2->rss_ptPT;
									}elseif(!empty($res2->rss_deDE)){
										$theRsRead=$res2->rss_deDE;
									}elseif(!empty($res2->rss_itIT)){
										$theRsRead=$res2->rss_itIT;
									}elseif(!empty($res2->rss_frFR)){
										$theRsRead=$res2->rss_frFR;
									}
								}//empty language
							
							/*if(isset($xmlSavedTitle) && $res2->title==$xmlSavedTitle){
								$sel2="selected='selected'";
							}else{
								$sel2='';
							}*/
								
								echo "<option value='".$theRsRead."'>".$res2->title."</option>";
								
								/*if($res2->title=="RSS"){
									?>
									<script type="text/javascript">
										loadTheRss('<? echo $theRsRead; ?>');
									</script>
									<?
								}*/
								
							}//for
						}//[]	
						echo'</select>';		
						
			}//for
			
			
			
			
	}//if
	
	
	
?>

<script type="text/javascript">
	setOptionsRss($("#countryRss").val());
</script>


	
		
	

	<input type="hidden" name="mediumRss" id="mediumRss">

	
	

<!--<input class="saveEditingP ui-button ui-widget ui-state-default ui-corner-all" role="button" type="submit" name="savenews" id="savenews" value="<?php //print $_IDIOMA->traducir("save");?>"/>-->

</form>
</div>

<div class="news">

<div style="width: 1767px;" id="theRssContainer">




</div>

</div>

<div id="ctrlnews">

<span id="left" class="controlnews" onclick="move('left')"></span>

<span id="right" class="controlnews" onclick="move('right')"></span>

</div>

</div>

<div style="clear: both; width: 100%;"></div>

<!-- ///Footer for msg with advices/// -->

<div class="footMsg"><!-- ///Start Advice/// (max 2 advices) -->

<div class="advMsg">

<div class="titAdv"><!--<a href="javascript:;" onClick="">Liga BVWA</a>--></div>

</div>

<!-- ///End advice/// --></div>

<!-- ///End Footer/// -->

<div class="shadMsg"></div>

</div>

<script type="text/javascript">
	$("#loadingTRSS").hide();
	smedRss="<? echo $theFirstRss; ?>";
	$("#theRssContainer").load('gestion/modulos/home/msgs/rss/rss.php',{countryRss:"a",mediumRss:smedRss,title:"a"});
</script>

