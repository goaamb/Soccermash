<? 
require_once('gestion/lib/share/clases/searchSearch/buscador.js.php');
require_once('gestion/lib/share/clases/nucleo/nucleo.php');

$bdd=new conexion();

?>

<style>
.countrySearchBuscador{
width:180px;
}
.spanEcdBuscador{
width:195px;
}

#sexing{
display:none;
}

#otherPassP{
display:none;
}
</style>



<iframe id="iframeSearch" name="iframeSearch" src="" style="width:0;height:0;border:none;"></iframe>	


<form id="searcher" name="searcher" action="gestion/modulos/home/findAll.php" method="post" target="iframeSearch">


<div id="simpleSearch">      


<ul id="searchSelector"> 
<input type="hidden" value="1" name="storeSelectProfile" id="storeSelectProfile"  />
</ul>  
<!--<li id="visibleArea"><a id="showSelection" href="#">Specify / Multimedia</a>
  <ul>
    <li><a id="4">All</a></li>
    <li><a id="1">People</a></li>
    <li><a id="2">Institutions</a></li>
    <li><a id="3" class="roundedcorners">Multimedia</a></li>
  </ul>
</li>

-->

<span id="lookingfor"><input type="text" id="strgToSearch" name="strgToSearch" value="<? print $_IDIOMA->traducir("Search"); ?>" /><div id="lupaSearch" onclick="chkSrch();"></div></span>


</div>        

<div id="advSearcher">
	<div id="searchStep1">
        <ul id="searchSelectorStp1">
        <input type="hidden" value="1" name="storeSelectADVProfile" id="storeSelectADVProfile"  />
        <li id="visibleAreaStp1"><a id="showSelectionStp1" href="#"><? print $_IDIOMA->traducir("Profiles");?></a>
            <ul>
			  <li><a  id="10"><? print $_IDIOMA->traducir("All");?></a></li>
			   <li><a  id="13"><? print $_IDIOMA->traducir("People");?></a></li>
			  <li><a  id="11"><? print $_IDIOMA->traducir("Clubs / Federations / Companies");?></a></li>
			   <li><a  id="12"><? print $_IDIOMA->traducir("Multimedia");?></a></li>
			    <div id="lineDivSelect"></div>
              <li><a  id="1"><? print $_IDIOMA->traducir("Player");?></a></li> 
              <li><a  id="2"><? print $_IDIOMA->traducir("Coach");?></a></li>
              <li><a  id="3"><? print $_IDIOMA->traducir("Agent");?></a></li>
              <li><a  id="4"><? print $_IDIOMA->traducir("Scouting");?></a></li>
              <li><a  id="5"><? print $_IDIOMA->traducir("Lawyer");?></a></li>
              <li><a  id="6"><? print $_IDIOMA->traducir("Sport Health");?></a></li>
              <li><a  id="7"><? print $_IDIOMA->traducir("Sport Director");?></a></li>
              <li><a  id="8"><? print $_IDIOMA->traducir("Fan");?></a></li>
              <li><a  id="9"><? print $_IDIOMA->traducir("Journalist");?></a></li>
            </ul>
          </li>
        </ul>
  	</div><!--END of typeofsearch--> 
  
  
  	<div id="searchStep2">
	
<script type="text/javascript">
//search profile
var playerCheck = $('.lblField');
playerCheck.click(function(){																
$(this).toggleClass('lblField2');
});
		
		
var srchOpt = $('.lblCHK');
srchOpt.click(function(){              
$(this).toggleClass('lblCHK2');
});	




</script>


<!-- ////////////////////////////////////////////////// -->




<span id="fieldSrch">
	


<div id="playField">
<label title="<? print $_IDIOMA->traducir("Goalkeeper");?>" class="lblField" id="posit0" for="position0"><input onchange="chkSrch();" class="spCheck" type="checkbox"  name="position0" id="positiona0" style=" width: 12px;" /></label>
<label title="<? print $_IDIOMA->traducir("Left Back");?>" class="lblField" id="posit1" for="position1"><input onchange="chkSrch();" class="spCheck" type="checkbox"  name="position1" id="positiona1"  style=" width: 12px;" /></label>
<label title="<? print $_IDIOMA->traducir("Central Back Left");?>" class="lblField" id="posit2" for="position2"><input onchange="chkSrch();" class="spCheck" type="checkbox"  name="position2" id="positiona2" style=" width: 12px;"  /></label>
<label title="<? print $_IDIOMA->traducir("Central Back Right");?>" class="lblField" id="posit3" for="position3"><input onchange="chkSrch();" class="spCheck" type="checkbox"  name="position3" id="positiona3"  style=" width: 12px;"  /></label>
<label title="<? print $_IDIOMA->traducir("Right Back");?>" class="lblField" id="posit4" for="position4"><input onchange="chkSrch();" class="spCheck" type="checkbox"  name="position4" id="positiona4"  style=" width: 12px;" /></label>
<label title="<? print $_IDIOMA->traducir("Defensive Midfielder");?>" class="lblField" id="posit5" for="position5"><input onchange="chkSrch();" class="spCheck" type="checkbox"  name="position5" id="positiona5" style=" width: 12px;"/></label>
<label title="<? print $_IDIOMA->traducir("Creative Midfielder");?>" class="lblField" id="posit6" for="position6"><input onchange="chkSrch();" class="spCheck" type="checkbox"  name="position6" id="positiona6" style=" width: 12px;" /></label>
<label title="<? print $_IDIOMA->traducir("Left Wing");?>" class="lblField" id="posit7" for="position7"><input onchange="chkSrch();" class="spCheck" type="checkbox"  name="position7" id="positiona7" style=" width: 12px;" /></label>
<label title="<? print $_IDIOMA->traducir("Right Wing");?>" class="lblField" id="posit8" for="position8"><input onchange="chkSrch();" class="spCheck" type="checkbox"  name="position8" id="positiona8" style=" width: 12px;"   /></label>
<label title="<? print $_IDIOMA->traducir("Play Maker / Second Striker");?>" class="lblField" id="posit9" for="position9"><input onchange="chkSrch();" class="spCheck" type="checkbox"  name="position9" id="positiona9" style=" width: 12px;" /></label>
<label title="<? print $_IDIOMA->traducir("Target Striker");?>" class="lblField" id="posit10" for="position10"><input onchange="chkSrch();" class="spCheck" type="checkbox"  name="position10" id="positiona10" style=" width: 12px;" /></label>
</div>
</span> <!--end court-->






<div id="sexing">
<p><? print $_IDIOMA->traducir("Check the filter to search");?></p>
<ul>
<li><label class="lblCHK" for="mman" id="mmans1"><input value="1"  type="checkbox"  class="spCheck" name="sexito01" id="mman1" tabindex="" /></label><span><? print $_IDIOMA->traducir("Man");?></span></li>
<li><label class="lblCHK" for="mwman" id="mwmans1"><input value="2" type="checkbox"  class="spCheck" name="sexito02" id="mwman1" tabindex="" /></label><span><? print $_IDIOMA->traducir("Woman");?></span></li>

</ul>
</div>


	<div id="seePlayer">
	
	<!--<span><a href="javascript:;" onclick="hideSeePlayer();"><? //print $_IDIOMA->traducir("Close");?></a></span>-->
	
<style type="text/css">
#posit0{
position:relative;
top:61px;
left:6px;
}
.webkit #posit0,.ie #posit0{
top:61px;
*top:63px;
left:5px;
}
.opera #posit0{
top:64px;
left:5px;
}

#posit1{
position:relative;
top:25px;
left:26px;
}
.opera #posit1,.ie #posit1,.webkit #posit1{
top:22px;
left:26px;
}
#posit2{
position:relative;
top:50px;
left:8px;
}
.opera #posit2,.ie #posit2,.webkit #posit2{
top:48px;
left:9px;
}

#posit3{
position:relative;
top:75px;
left:-10px;
}
.opera #posit3,.ie #posit3,.webkit #posit3{
top:82px;
left:-8px;
}
#posit4{
position:relative;
top:100px;
left:-28px;
}
.opera #posit4,.ie #posit4,.webkit #posit4{
top:110px;
left:-25px;
}
#posit5{
position:relative;
top:35px;
left:1px;
}
.opera #posit5,.ie #posit5,.webkit #posit5{
top:36px;
left:7px;
}
#posit6{
position:relative;
top:90px;
left:-17px;
}
.opera #posit6,.ie #posit6,.webkit #posit6{
top:92px;
left:-10px;
}
#posit7{
position:relative;
top:15px;
left:-15px;
}
.opera #posit7,.ie #posit7,.webkit #posit7{
top:20px;
left:-12px;
}
#posit8{
position:relative;
top:110px;
left:-32px;
}
.opera #posit8,.ie #posit8,.webkit #posit8{
top:105px;
*top:110px;
left:-29px;
}
#posit9{
position:relative;
top:60px;
left:-35px;
}
.webkit #posit9,.ie #posit9{
top:61px;
left:-26px;	
*top:63px;
*left:-15px;	
}
.opera #posit9{
top:63px;
left:-26px;
}
#posit10{
position:relative;
top:44px;
left:146px;
}
.webkit #posit10{
top:45px;
left:146px;	
}

.ie #posit10{
top:45px;
left:155px;
*top:43px;
*left:155px;
}
.ie1 #posit10{
top:61px;
left:-20px;
}

.opera #posit10{
top:50px;
left:146px;
}
</style>
<!--[if IE 9]>
<style type="text/css">
.ie #posit10{
top:60px;
left:-23px;
}
</style>
<![endif]-->



<ul>
<li><label class="lblCHK" for="puc" id="pucpuc"><input value="01" type="checkbox"  class="spCheck" name="pyundcontr" id="puc" tabindex="" /></label><span><? print $_IDIOMA->traducir("Player under contract");?></span></li>
<li><label class="lblCHK" for="pwc" id="pwcpwc"><input value="01" type="checkbox"  class="spCheck" name="pywthoutcontr" id="pwc" tabindex="" /></label><span><? print $_IDIOMA->traducir("Player without contract");?></span></li>
<li><label class="lblCHK" for="amtp" id="amtpamtp"><input value="01" type="checkbox"  class="spCheck" name="amtpy" id="amtp" tabindex="" /></label><span><? print $_IDIOMA->traducir("Amateur players");?></span></li>
<li><label class="lblCHK" for="xpy" id="xpyxpy"><input value="01" type="checkbox"  class="spCheck" name="xply" id="xpy" tabindex="" /></label><span><? print $_IDIOMA->traducir("Ex-players");?></span></li>
<li><label class="lblCHK" for="eupassp" id="eupassp"><input value="01" type="checkbox"  class="spCheck" name="eupassp" id="eupassp" tabindex="" /></label><span><? print $_IDIOMA->traducir("EU Passport");?> &nbsp;<a href="javascript:;" onclick="$('#otherPassP').toggle();"><? print $_IDIOMA->traducir("other");?></a></span></li>
<li><input type="text" id="otherPassP" name="otherPassP" /></li>
</ul>



<p><? print $_IDIOMA->traducir("Country");?>:</p>
<span>   
  

<select type="text" class="countrySearchBuscador" id="countrySearch" name="countrySearch" > 
	<option selected="selected" value=""><? print $_IDIOMA->traducir("Country");?></option>
			<? 
			$results1=$bdd->query("SELECT country FROM ax_country");
			$theCountrs=array();
			
			foreach ($results1 as $ress){
				$theCountrs[$ress->country]=$_IDIOMA->traducir($ress->country);	
			}  
			
			asort($theCountrs);
			
			foreach($theCountrs as $kCS => $theCsS){
				echo '<option value="'.$kCS.'">'.$theCsS.'</option>';	
			}
			
			
			?>
</select> 

</span>

<p><? print $_IDIOMA->traducir("Maximum Age:");?></p>
<span><select type="text" id="ageSearch" name="ageSearch" >
<option selected="selected" value=""><? print $_IDIOMA->traducir("Age");?></option>
<? 
for ($i=14; $i<111; $i++){
	echo '<option value="'.$i.'">'.$i.'</option>';
}  
?>
</select>
</span>
<p><? print $_IDIOMA->traducir("Club:");?></p>
<span> 
<input type="text" id="clubSearch" name="clubSearch" />     
<!--<script type="text/javascript">
buscador('espacio1','clubSearch','clubes','hclub','','');
</script>-->

</span>
<p><? print $_IDIOMA->traducir("Ending Contract Date Until:");?></p>
<span class="spanEcdBuscador"> 
<select type="text" id="dDate" name="dDate" >
<option selected="selected" value=""><? print $_IDIOMA->traducir("Day");?></option>
<? 
for ($i=1; $i<32; $i++){
	echo '<option value="'.$i.'">'.$i.'</option>';
}  
?>
</select>


<select type="text" id="dMonth" name="dMonth" >
<option selected="selected" value=""><? print $_IDIOMA->traducir("Month");?></option>
<? 
for ($i=1; $i<13; $i++){
	echo '<option value="'.$i.'">'.$i.'</option>';
}  
?>
</select>


<select type="text" id="dYear" name="dYear" >
<option selected="selected" value=""><? print $_IDIOMA->traducir("Year");?></option>
<? 
for ($i=date('Y'); $i<2200; $i++){
	echo '<option value="'.$i.'">'.$i.'</option>';
}  
?>
</select>




<!--<input type="text" id="endcontdatSearch" name="endcontdatSearch" />-->
</span>



</div> <!--end see player-->









<div id="seeHealth">

<!--<span><a href="javascript:;" onclick="hideSeeHealth();"><? //print $_IDIOMA->traducir("Close");?></a></span>-->


<ul>
<li><label class="lblCHK" for="nutr" id="nutra"><input type="checkbox"  class="spCheck" name="nutr" id="nutrs" tabindex="" /></label><span><? print $_IDIOMA->traducir("Nutritionist");?></span></li>
<li><label class="lblCHK" for="sptmedic" id="sptmedica"><input type="checkbox"  class="spCheck" name="sptmedic" id="sptmedics" tabindex="" /></label><span><? print $_IDIOMA->traducir("Sport Doctor");?></span></li>
<li><label class="lblCHK" for="mssgt" id="mssgta"><input type="checkbox"  class="spCheck" name="mssgt" id="mssgts" tabindex="" /></label><span><? print $_IDIOMA->traducir("Massagist");?></span></li>
</ul>
<p><? print $_IDIOMA->traducir("Country");?>:</p>
<span>            
<select type="text" class="countrySearchBuscador" id="countrySearch2" name="countrySearch2" > 
	<option selected="selected" value=""><? print $_IDIOMA->traducir("Country");?></option>
			<? 
			$results1=$bdd->query("SELECT country FROM ax_country");
			$theCountrs=array();
			
			foreach ($results1 as $ress){
				$theCountrs[$ress->country]=$_IDIOMA->traducir($ress->country);	
			}  
			
			asort($theCountrs);
			
			foreach($theCountrs as $kCS => $theCsS){
				echo '<option value="'.$kCS.'">'.$theCsS.'</option>';	
			}
			?>
</select> 
</span>
</div>

<div id="seeDirector">

<ul>
<li><label class="lblCHK" for="sptdir"><input type="checkbox"  class="spCheck" value="35" name="sptdir" id="sptdir" tabindex="" /></label><span><? print $_IDIOMA->traducir("Sport Director");?></span></li>
<li><label class="lblCHK" for="tcnsec"><input type="checkbox"  class="spCheck" value="36" name="tcnsec" id="tcnsec" tabindex="" /></label><span><? print $_IDIOMA->traducir("Technical Secretary");?></span></li>
</ul>
<p><? print $_IDIOMA->traducir("Country");?>:</p>
<span>            
<select type="text" class="countrySearchBuscador" id="countrySearch3" name="countrySearch3" > 
	<option selected="selected" value=""><? print $_IDIOMA->traducir("Country");?></option>
			<? 
				$results1=$bdd->query("SELECT country FROM ax_country");
			$theCountrs=array();
			
			foreach ($results1 as $ress){
				$theCountrs[$ress->country]=$_IDIOMA->traducir($ress->country);	
			}  
			
			asort($theCountrs);
			
			foreach($theCountrs as $kCS => $theCsS){
				echo '<option value="'.$kCS.'">'.$theCsS.'</option>';	
			}
			?>
</select> 
</span>
</div>

<div id="seeScout">
<p><? print $_IDIOMA->traducir("Country");?>:</p>
<span>            
<select type="text" class="countrySearchBuscador" id="countrySearch4" name="countrySearch4" > 
	<option selected="selected" value=""><? print $_IDIOMA->traducir("Country");?></option>
			<? 
			$results1=$bdd->query("SELECT country FROM ax_country");
			$theCountrs=array();
			
			foreach ($results1 as $ress){
				$theCountrs[$ress->country]=$_IDIOMA->traducir($ress->country);	
			}  
			
			asort($theCountrs);
			
			foreach($theCountrs as $kCS => $theCsS){
				echo '<option value="'.$kCS.'">'.$theCsS.'</option>';	
			}
			?>
</select> 
</span>
</div>

<div id="seeLawyer">
<p><? print $_IDIOMA->traducir("Country");?>:</p>
<span>            
<select type="text" class="countrySearchBuscador" id="countrySearch5" name="countrySearch5" > 
	<option selected="selected" value=""><? print $_IDIOMA->traducir("Country");?></option>
			<? 
			$results1=$bdd->query("SELECT country FROM ax_country");
			$theCountrs=array();
			
			foreach ($results1 as $ress){
				$theCountrs[$ress->country]=$_IDIOMA->traducir($ress->country);	
			}  
			
			asort($theCountrs);
			
			foreach($theCountrs as $kCS => $theCsS){
				echo '<option value="'.$kCS.'">'.$theCsS.'</option>';	
			}
			?>
</select> 
</span>
</div>

<div id="seeJournalist">
<p><? print $_IDIOMA->traducir("Country");?>:</p>
<span>            
<select type="text" class="countrySearchBuscador" id="countrySearch6" name="countrySearch6" > 
	<option selected="selected" value=""><? print $_IDIOMA->traducir("Country");?></option>
			<? 
		$results1=$bdd->query("SELECT country FROM ax_country");
			$theCountrs=array();
			
			foreach ($results1 as $ress){
				$theCountrs[$ress->country]=$_IDIOMA->traducir($ress->country);	
			}  
			
			asort($theCountrs);
			
			foreach($theCountrs as $kCS => $theCsS){
				echo '<option value="'.$kCS.'">'.$theCsS.'</option>';	
			}
			?>
</select> 
</span>
</div>

<div id="seeFan"> 
<p><? print $_IDIOMA->traducir("Country");?>:</p>
<span>            
<select type="text" class="countrySearchBuscador" id="countrySearch7" name="countrySearch7" > 
	<option selected="selected" value=""><? print $_IDIOMA->traducir("Country");?></option>
			<? 
			$results1=$bdd->query("SELECT country FROM ax_country");
			$theCountrs=array();
			
			foreach ($results1 as $ress){
				$theCountrs[$ress->country]=$_IDIOMA->traducir($ress->country);	
			}  
			
			asort($theCountrs);
			
			foreach($theCountrs as $kCS => $theCsS){
				echo '<option value="'.$kCS.'">'.$theCsS.'</option>';	
			}
			?>
</select> 
</span>
</div>



<div id="seeCoach">

<ul>
<li><label class="lblCHK" for="cuc"><input type="checkbox"  class="spCheck" value="29" name="coachUC" id="cuc" tabindex="" /></label><span><? print $_IDIOMA->traducir("Coach Under contract");?></span></li>
<li><label class="lblCHK" for="cwoc"><input type="checkbox"  class="spCheck" value="30" name="coachWOC" id="cwoc" tabindex="" /></label><span><? print $_IDIOMA->traducir("Coach Without contract");?></span></li>
<li><label class="lblCHK" for="gkuc"><input type="checkbox"  class="spCheck" value="31" name="gkeeperUC" id="gkuc" tabindex="" /></label><span><? print $_IDIOMA->traducir("Goal keeper coach under contract");?></span></li>
<li><label class="lblCHK" for="gkwoc"><input type="checkbox"  class="spCheck" value="32" name="gkeeperWC" id="gkwoc" tabindex="" /></label><span><? print $_IDIOMA->traducir("Goal keeper coach without contract");?></span></li>
<li><label class="lblCHK" for="phuc"><input type="checkbox"  class="spCheck" value="33" name="physUC" id="phuc" tabindex="" /></label><span><? print $_IDIOMA->traducir("Physical coach under contract");?></span></li>
<li><label class="lblCHK" for="pwoc"><input type="checkbox"  class="spCheck" value="34" name="physWOC" id="pwoc" tabindex="" /></label><span><? print $_IDIOMA->traducir("Physical coach without contract");?></span>
</li>

</ul>
<p><? print $_IDIOMA->traducir("Country");?>:</p>
<span>            
<select type="text" class="countrySearchBuscador" id="countrySearch8" name="countrySearch8" > 
	<option selected="selected" value=""><? print $_IDIOMA->traducir("Country");?></option>
			<? 
			$results1=$bdd->query("SELECT country FROM ax_country");
			$theCountrs=array();
			
			foreach ($results1 as $ress){
				$theCountrs[$ress->country]=$_IDIOMA->traducir($ress->country);	
			}  
			
			asort($theCountrs);
			
			foreach($theCountrs as $kCS => $theCsS){
				echo '<option value="'.$kCS.'">'.$theCsS.'</option>';	
			}
			?>
</select> 
</span>
<p><? print $_IDIOMA->traducir("Club");?>:</p>
<span>                
<input type="text" id="clubSearch2" name="clubSearch2" />   
</span>
<p><? print $_IDIOMA->traducir("Ending Contract Date Until");?>:</p>
<span class="spanEcdBuscador">
<select type="text" id="dDate2" name="dDate2" >
<option selected="selected" value=""><? print $_IDIOMA->traducir("Day");?></option>
<? 
for ($i=1; $i<32; $i++){
	echo '<option value="'.$i.'">'.$i.'</option>';
}  
?>
</select>


<select type="text" id="dMonth2" name="dMonth2" >
<option selected="selected" value=""><? print $_IDIOMA->traducir("Month");?></option>
<? 
for ($i=1; $i<13; $i++){
	echo '<option value="'.$i.'">'.$i.'</option>';
}  
?>
</select>


<select type="text" id="dYear2" name="dYear2" >
<option selected="selected" value=""><? print $_IDIOMA->traducir("Year");?></option>
<? 
for ($i=date('Y'); $i<2200; $i++){
	echo '<option value="'.$i.'">'.$i.'</option>';
}  
?>
</select></span>
</div>

<div id="seeAgent">

<ul>
<li><label class="lblCHK" for="afifa"><input type="checkbox"  class="spCheck" value="26" name="agfifa" id="afifa" tabindex="" /></label><span><? print $_IDIOMA->traducir("Licensed FIFA  Agent");?></span></li>
<li><label class="lblCHK" for="auefa"><input type="checkbox"  class="spCheck" value="27" name="aguefa" id="auefa" tabindex="" /></label><span><? print $_IDIOMA->traducir("Licensed UEFA Agent");?></span></li>
<li><label class="lblCHK" for="aauth"><input type="checkbox"  class="spCheck" value="28" name="aauth" id="aauth" tabindex="" /></label><span><? print $_IDIOMA->traducir("Authorized Agent");?></span></li>
<p><? print $_IDIOMA->traducir("Country");?>:</p>
<span>            
<select type="text" class="countrySearchBuscador" id="countrySearch17" name="countrySearch17" > 
	<option selected="selected" value=""><? print $_IDIOMA->traducir("Country");?></option>
			<? 
		$results1=$bdd->query("SELECT country FROM ax_country");
			$theCountrs=array();
			
			foreach ($results1 as $ress){
				$theCountrs[$ress->country]=$_IDIOMA->traducir($ress->country);	
			}  
			
			asort($theCountrs);
			
			foreach($theCountrs as $kCS => $theCsS){
				echo '<option value="'.$kCS.'">'.$theCsS.'</option>';	
			}
			?>
</select> 
</span>
</ul>
</div>





<!-- ///////////INSTITUTION //////////// -->
<div id="srchInst" style="display:none;">
<p><? print $_IDIOMA->traducir("Institutions profile options");?></p>
<ul class="options">
<li><label class="lblCHK" for="club"><input type="checkbox" class="spCheck"  name="club" id="club"/></label><span><? print $_IDIOMA->traducir("Club");?></span></li>
<li><label class="lblCHK" for="company"><input type="checkbox"  class="spCheck"  name="company" id="company" /></label><span><? print $_IDIOMA->traducir("Company");?></span></li>
<li><label class="lblCHK" for="federation"><input type="checkbox"  class="spCheck"  name="federation" id="federation" /></label><span><? print $_IDIOMA->traducir("Federation");?></span></li>
</ul>




</div>




<!-- ///////////MULTIMEDIA //////////// -->
<div id="srchMult" style="display:none;">
<p><? print $_IDIOMA->traducir("Multimedia options");?></p>
<ul class="options">
<li><label class="lblCHK" for="club"><input type="checkbox"  class="spCheck" value="20" name="video" id="videoS" tabindex="" /></label><span><? print $_IDIOMA->traducir("Videos");?></span></li>
<input type="hidden" name="orderVideo" id="theOrderVid" />
<!--<li><label class="lblCHK" for="mvoted"><input type="checkbox"  class="spCheck" value="20" name="mvoted" id="mvoted" tabindex="" /></label><span><? //print $_IDIOMA->traducir("Most Voted");?></span></li>
<li><label class="lblCHK" for="mviewed"><input type="checkbox"  class="spCheck" value="20" name="mviewed" id="mviewed" tabindex="" /></label><span><? //print $_IDIOMA->traducir("Most Viewed");?></span></li>-->

<li><label class="lblCHK" for="company"><input type="checkbox"  class="spCheck" value="21" name="photo" id="photoS" tabindex="" /></label><span><? print $_IDIOMA->traducir("Photos");?></span></li>
<!--<li><label class="lblCHK" for="federation"><input type="checkbox"  class="spCheck" value="22" name="federation" id="federation" tabindex="" /></label><span>Audio</span></li>-->
</ul>

</div>








  </div><!--END searchStep2--> 

<input type="button" value="<? print $_IDIOMA->traducir("SEARCH"); ?>" id="startAdvSearch" name="startAdvSearch" onclick="chkSrch();" />

</div><!--END advSearcher-->





</form>




