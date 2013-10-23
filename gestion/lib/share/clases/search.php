<? 
require_once('gestion/lib/share/clases/searchSearch/buscador.js.php');
?>

<iframe id="iframeSearch" name="iframeSearch" src="#" style="width:0;height:0;border:none;"></iframe>	


<form id="searcher" name="searcher" action="gestion/modulos/home/findAll.php" method="post" target="iframeSearch">


<div id="simpleSearch">    
<hr />



<ul id="searchSelector">
<input type="hidden" value="1" name="storeSelectProfile" id="storeSelectProfile"  />

<li id="visibleArea"><a id="showSelection" href="#">People</a>
  <ul>
    <li><a id="1">People</a></li>
    <li><a id="2">Institutions</a></li>
    <li><a id="3" class="roundedcorners">Multimedia</a></li>
  </ul>
</li>
</ul>  

<span id="lookingfor"><input type="text" id="strgToSearch" name="strgToSearch" /><a href="javascript:;" onclick="chkSrch();"><img src="img/looking.png" /></a></span>
<p class="onright" id="advanced"><a href="#">Advanced</a></p>

</div>      

<div id="advSearcher">
	<div id="searchStep1">
  	<p>1. Select the profile type</p>
        <ul id="searchSelectorStp1">
        <input type="hidden" value="" name="storeSelectADVProfile" id="storeSelectADVProfile"  />
        <!--js set in hidden input the ID of selected option. Find "searcher select" at scripts.js-->
        <li id="visibleAreaStp1"><a id="showSelectionStp1" href="#">Available profiles...</a>
            <ul>
              <li><a  id="1">Player</a></li>
              <li><a  id="2">Coach</a></li>
              <li><a  id="3">Agent</a></li>
              <li><a  id="4">Scout</a></li>
              <li><a  id="5">Lawyer</a></li>
              <li><a  id="6">Sport Health</a></li>
              <li><a  id="7">Sport Director</a></li>
              <li><a  id="8">Fan</a></li>
              <li><a  id="9">Journalist</a></li>
            </ul>
          </li>
        </ul>
  	</div><!--END of typeofsearch--> 
  
  
  	<div id="searchStep2">
	<div id="seePlayer">
<p>2. Check the filter to search</p>
<ul>
<li><label class="lblCHK" for="puc"><input type="checkbox"  class="spCheck" value="20" name="pyundcontr" id="puc" tabindex="" /></label><span>Player under contract</span></li>
<li><label class="lblCHK" for="pwc"><input type="checkbox"  class="spCheck" value="21" name="pywthoutcontr" id="pwc" tabindex="" /></label><span>Player without contract</span></li>
<li><label class="lblCHK" for="amtp"><input type="checkbox"  class="spCheck" value="24" name="amtpy" id="amtp" tabindex="" /></label><span>Amateur players</span></li>
<li><label class="lblCHK" for="xpy"><input type="checkbox"  class="spCheck" value="25" name="xply" id="xpy" tabindex="" /></label><span>Ex-players</span></li>
</ul>

<p>Country</p>
<span><input type="text" id="countrySearch" name="countrySearch" value="" /></span>
<p>Age</p>
<span><select type="text" id="ageSearch" name="ageSearch" >
<option selected="selected" value="">Age</option>
<? 
for ($i=14; $i<111; $i++){
	echo '<option value="'.$i.'">'.$i.'</option>';
}  
?>
</select>
</span>
<p>Club</p>
<span> 
                    
<script type="text/javascript">
buscador('espacio1','clubSearch','clubes','hclub','','');
</script>

</span>
<p>Ending Contract Date</p>
<span><input type="text" id="endcontdatSearch" name="endcontdatSearch" /></span>
<span id="fieldSrch">
<div id="playField">
<label title="Goalkeeper" class="lblField" id="posit0" for="position0"><input class="spCheck" type="checkbox"  name="position0" id="position0"  /></label>
<label title="Left Wing-back" class="lblField" id="posit1" for="position1"><input class="spCheck" type="checkbox"  name="position1" id="position1"  /></label>
<label title="Left Centre-back" class="lblField" id="posit2" for="position2"><input class="spCheck" type="checkbox"  name="position2" id="position2"  /></label>
<label title="Right Centre-back" class="lblField" id="posit3" for="position3"><input class="spCheck" type="checkbox"  name="position3" id="position3"  /></label>
<label title="Right Wing-back" class="lblField" id="posit4" for="position4"><input class="spCheck" type="checkbox"  name="position4" id="position4"  /></label>
<label title="Left Centre-midfield" class="lblField" id="posit5" for="position5"><input class="spCheck" type="checkbox"  name="position5" id="position5"  /></label>
<label title="Right Centre-midfield" class="lblField" id="posit6" for="position6"><input class="spCheck" type="checkbox"  name="position6" id="position6"  /></label>
<label title="Left Centre-forward" class="lblField" id="posit7" for="position7"><input class="spCheck" type="checkbox"  name="position7" id="position7"  /></label>
<label title="Right Centre-forward" class="lblField" id="posit8" for="position8"><input class="spCheck" type="checkbox"  name="position8" id="position8"  /></label>
<label title="Centre-Forward" class="lblField" id="posit9" for="position9"><input class="spCheck" type="checkbox"  name="position9" id="position9"  /></label>
<label title="Full-forward" class="lblField" id="posit10" for="position10"><input class="spCheck" type="checkbox"  name="position10" id="position10"  /></label>
</div>
</span>



</div>

<div id="seeHealth">
<p>2. Check the filter to search</p>
<ul>
<li><label class="lblCHK" for="nutr"><input type="checkbox"  class="spCheck" value="37" name="nutr" id="nutr" tabindex="" /></label><span>Nutritionist</span></li>
<li><label class="lblCHK" for="sptmedic"><input type="checkbox"  class="spCheck" value="38" name="sptmedic" id="sptmedic" tabindex="" /></label><span>Sport Medic</span></li>
<li><label class="lblCHK" for="mssgt"><input type="checkbox"  class="spCheck" value="39" name="mssgt" id="mssgt" tabindex="" /></label><span>Massagist</span></li>
</ul>
<p>Country</p>
<span><input type="text" id="countrySearch" name="countrySearch" /></span>
</div>

<div id="seeDirector">
<p>2. Check the filter to search</p>
<ul>
<li><label class="lblCHK" for="sptdir"><input type="checkbox"  class="spCheck" value="35" name="sptdir" id="sptdir" tabindex="" /></label><span>Sport Director</span></li>
<li><label class="lblCHK" for="tcnsec"><input type="checkbox"  class="spCheck" value="36" name="tcnsec" id="tcnsec" tabindex="" /></label><span>Technical Secretary</span></li>
</ul>
<p>Country</p>
<span><input type="text" id="countrySearch" name="countrySearch" /></span>
</div>

<div id="seeScout">
<p>Country</p>
<span><input type="text" id="countrySearch" name="countrySearch" /></span>
</div>

<div id="seeLawyer">
<p>Country</p>
<span><input type="text" id="countrySearch" name="countrySearch" /></span>
</div>

<div id="seeJournalist">
<p>Country</p>
<span><input type="text" id="countrySearch" name="countrySearch" /></span>
</div>

<div id="seeFan"> 
<p>Country</p>
<span><input type="text" id="countrySearch" name="countrySearch" /></span>
</div>

<div id="seeCoach">
<p>2. Check the filter to search</p>
<ul>
<li><label class="lblCHK" for="cuc"><input type="checkbox"  class="spCheck" value="29" name="coachUC" id="cuc" tabindex="" /></label><span>Coach Under contract</span></li>
<li><label class="lblCHK" for="cwoc"><input type="checkbox"  class="spCheck" value="30" name="coachWOC" id="cwoc" tabindex="" /></label><span>Coach Without contract</span></li>
<li><label class="lblCHK" for="gkuc"><input type="checkbox"  class="spCheck" value="31" name="gkeeperUC" id="gkuc" tabindex="" /></label><span>Goal keeper coach under contract</span></li>
<li><label class="lblCHK" for="gkwoc"><input type="checkbox"  class="spCheck" value="32" name="gkeeperWC" id="gkwoc" tabindex="" /></label><span>Goal keeper coach without contract</span></li>
<li><label class="lblCHK" for="phuc"><input type="checkbox"  class="spCheck" value="33" name="physUC" id="phuc" tabindex="" /></label><span>Physical coach under contract</span></li>
<li><label class="lblCHK" for="pwoc"><input type="checkbox"  class="spCheck" value="34" name="physWOC" id="pwoc" tabindex="" /></label><span>Physical coach without contract</span></li>
</ul>
<p>Country</p>
<span><input type="text" id="countrySearch" name="countrySearch" /></span>
<p>Club</p>
<span><input type="text" id="clubSearch" name="clubSearch" /></span>
<p>Ending Contract Date</p>
<span><input type="text" id="endcontdatSearch2" name="endcontdatSearch2"  /></span>
</div>

<div id="seeAgent">
<p>2. Check the filter to search</p>
<ul>
<li><label class="lblCHK" for="afifa"><input type="checkbox"  class="spCheck" value="26" name="agfifa" id="afifa" tabindex="" /></label><span>Licensed FIFA  Agent</span></li>
<li><label class="lblCHK" for="auefa"><input type="checkbox"  class="spCheck" value="27" name="aguefa" id="auefa" tabindex="" /></label><span>Licensed UEFA Agent</span></li>
<li><label class="lblCHK" for="aauth"><input type="checkbox"  class="spCheck" value="28" name="aauth" id="aauth" tabindex="" /></label><span>Authorized Agent</span></li>
</ul>
</div>
<script type="text/javascript">
//search profile
var playerCheck = $('.lblField')
playerCheck.click(function(){																
$(this).toggleClass('lblField2');
});
		
		
var srchOpt = $('.lblCHK');
srchOpt.click(function(){              
$(this).toggleClass('lblCHK2');
});	
</script>



  </div><!--END searchStep2--> 


<input type="button" value="SEARCH" id="startAdvSearch" name="startAdvSearch" onclick="chkSrch();" />
</div><!--END advSearcher-->





</form>






<!-- ///////////STEP ONE //////////// -->
<div id="stepOne" style="display:none;">
<p>1. Select the profile type</p>
        <ul id="searchSelectorStp1">
        <input type="hidden" value="" name="storeSelectADVProfile" id="storeSelectADVProfile"  />
        <!--js set in hidden input the ID of selected option. Find "searcher select" at scripts.js-->
        <li id="visibleAreaStp1"><a id="showSelectionStp1" href="#">Available profiles...</a>
            <ul>
              <li><a  id="1">Player</a></li>
              <li><a  id="2">Coach</a></li>
              <li><a  id="3">Agent</a></li>
              <li><a  id="4">Scout</a></li>
              <li><a  id="5">Lawyer</a></li>
              <li><a  id="6">Sport Health</a></li>
              <li><a  id="7">Sport Director</a></li>
              <li><a  id="8">Fan</a></li>
              <li><a  id="9">Journalist</a></li>
            </ul>
          </li>
        </ul>
</div>



<!-- /////////STEP TWO ////////////// -->
<style type="text/css">
#posit0{
position:relative;
top:61px;
left:6px;
}
.opera #posit0{
top:64px;
left:6px;
}
#posit1{
position:relative;
top:12px;
left:44px;
}
.ie #posit1{
top:10px;
}
.opera #posit1{
top:15px;
left:44px;
}
#posit2{
position:relative;
top:20px;
left:44px;
}
.ie #posit2{
top:16px;
}
.opera #posit2{
top:22px;
left:44px;
}
#posit3{
position:relative;
top:37px;
left:44px;
}
.ie #posit3{
top:32px;
}
.opera #posit3{
top:41px;
left:44px;
}
#posit4{
position:relative;
top:45px;
left:44px;
}
.ie #posit4{
top:37px;
}
.opera #posit4{
top:49px;
left:44px;
}
#posit5{
position:relative;
top:-25px;
left:85px;
}
.ie #posit5{
top:-34px;
}
.opera #posit5{
top:-21px;
left:85px;
}
#posit6{
position:relative;
top:5px;
left:85px;
}
.ie #posit6{
top:-8px;
}
.opera #posit6{
top:6px;
left:85px;
}
#posit7{
position:relative;
top:-68px;
left:120px;
}
.ie #posit7{
top:-80px;
}
.opera #posit7{
top:-63px;
left:120px;
}
.webkit #posit7{
top:-66px;
}
#posit8{
position:relative;
top:-5px;
left:120px;
}
.webkit #posit8{
top:-7px;
}
.ie #posit8{
top:-23px;
}
.opera #posit8{
top:-3px;
left:120px;
}
#posit9{
position:relative;
top:-56px;
left:140px;
}
.ie #posit9{
top:-74px;
}
.opera #posit9{
top:-53px;
left:140px;
}
#posit10{
position:relative;
top:-69px;
left:157px;
}
.ie #posit10{
top:-89px;
}
.opera #posit10{
top:-66px;
left:157px;
}
</style>
<div id="stepTwo" style="display:none;">
<div id="seePlayer">
<p>2. Check the filter to search</p>
<ul>
<li><label class="lblCHK" for="puc"><input type="checkbox"  class="spCheck" value="20" name="pyundcontr" id="puc" tabindex="" /></label><span>Player under contract</span></li>
<li><label class="lblCHK" for="pwc"><input type="checkbox"  class="spCheck" value="21" name="pywthoutcontr" id="pwc" tabindex="" /></label><span>Player without contract</span></li>
<li><label class="lblCHK" for="amtp"><input type="checkbox"  class="spCheck" value="24" name="amtpy" id="amtp" tabindex="" /></label><span>Amateur players</span></li>
<li><label class="lblCHK" for="xpy"><input type="checkbox"  class="spCheck" value="25" name="xply" id="xpy" tabindex="" /></label><span>Ex-players</span></li>
</ul>

<p>Country</p>
<span><input type="text" id="countrySearch" name="countrySearch" value="" /></span>
<p>Club</p>
<span><input type="text" id="clubSearch" name="clubSearch" /></span>
<p>Ending Contract Date</p>
<span><input type="text" id="endcontdatSearch3" name="endcontdatSearch3"  /></span>
<span id="fieldSrch">
<div id="playField">
<label title="Goalkeeper" class="lblField" id="posit0" for="position0"><input class="spCheck" type="checkbox"  name="position0" id="position0"  /></label>
<label title="Left Wing-back" class="lblField" id="posit1" for="position1"><input class="spCheck" type="checkbox"  name="position1" id="position1"  /></label>
<label title="Left Centre-back" class="lblField" id="posit2" for="position2"><input class="spCheck" type="checkbox"  name="position2" id="position2"  /></label>
<label title="Right Centre-back" class="lblField" id="posit3" for="position3"><input class="spCheck" type="checkbox"  name="position3" id="position3"  /></label>
<label title="Right Wing-back" class="lblField" id="posit4" for="position4"><input class="spCheck" type="checkbox"  name="position4" id="position4"  /></label>
<label title="Left Centre-midfield" class="lblField" id="posit5" for="position5"><input class="spCheck" type="checkbox"  name="position5" id="position5"  /></label>
<label title="Right Centre-midfield" class="lblField" id="posit6" for="position6"><input class="spCheck" type="checkbox"  name="position6" id="position6"  /></label>
<label title="Left Centre-forward" class="lblField" id="posit7" for="position7"><input class="spCheck" type="checkbox"  name="position7" id="position7"  /></label>
<label title="Right Centre-forward" class="lblField" id="posit8" for="position8"><input class="spCheck" type="checkbox"  name="position8" id="position8"  /></label>
<label title="Centre-Forward" class="lblField" id="posit9" for="position9"><input class="spCheck" type="checkbox"  name="position9" id="position9"  /></label>
<label title="Full-forward" class="lblField" id="posit10" for="position10"><input class="spCheck" type="checkbox"  name="position10" id="position10"  /></label>
</div>
</span>
</div>

<div id="seeHealth">
<p>2. Check the filter to search</p>
<ul>
<li><label class="lblCHK" for="nutr"><input type="checkbox"  class="spCheck" value="37" name="nutr" id="nutr" tabindex="" /></label><span>Nutritionist</span></li>
<li><label class="lblCHK" for="sptmedic"><input type="checkbox"  class="spCheck" value="38" name="sptmedic" id="sptmedic" tabindex="" /></label><span>Sport Medic</span></li>
<li><label class="lblCHK" for="mssgt"><input type="checkbox"  class="spCheck" value="39" name="mssgt" id="mssgt" tabindex="" /></label><span>Massagist</span></li>
</ul>
<p>Country</p>
<span><input type="text" id="countrySearch" name="countrySearch" /></span>
</div>

<div id="seeDirector">
<p>2. Check the filter to search</p>
<ul>
<li><label class="lblCHK" for="sptdir"><input type="checkbox"  class="spCheck" value="35" name="sptdir" id="sptdir" tabindex="" /></label><span>Sport Director</span></li>
<li><label class="lblCHK" for="tcnsec"><input type="checkbox"  class="spCheck" value="36" name="tcnsec" id="tcnsec" tabindex="" /></label><span>Technical Secretary</span></li>
</ul>
<p>Country</p>
<span><input type="text" id="countrySearch" name="countrySearch" /></span>
</div>

<div id="seeScout">
<p>Country</p>
<span><input type="text" id="countrySearch" name="countrySearch" /></span>
</div>

<div id="seeLawyer">
<p>Country</p>
<span><input type="text" id="countrySearch" name="countrySearch" /></span>
</div>

<div id="seeJournalist">
<p>Country</p>
<span><input type="text" id="countrySearch" name="countrySearch" /></span>
</div>

<div id="seeFan"> 
<p>Country</p>
<span><input type="text" id="countrySearch" name="countrySearch" /></span>
</div>

<div id="seeCoach">
<p>2. Check the filter to search</p>
<ul>
<li><label class="lblCHK" for="cuc"><input type="checkbox"  class="spCheck" value="29" name="coachUC" id="cuc" tabindex="" /></label><span>Coach Under contract</span></li>
<li><label class="lblCHK" for="cwoc"><input type="checkbox"  class="spCheck" value="30" name="coachWOC" id="cwoc" tabindex="" /></label><span>Coach Without contract</span></li>
<li><label class="lblCHK" for="gkuc"><input type="checkbox"  class="spCheck" value="31" name="gkeeperUC" id="gkuc" tabindex="" /></label><span>Goal keeper coach under contract</span></li>
<li><label class="lblCHK" for="gkwoc"><input type="checkbox"  class="spCheck" value="32" name="gkeeperWC" id="gkwoc" tabindex="" /></label><span>Goal keeper coach without contract</span></li>
<li><label class="lblCHK" for="phuc"><input type="checkbox"  class="spCheck" value="33" name="physUC" id="phuc" tabindex="" /></label><span>Physical coach under contract</span></li>
<li><label class="lblCHK" for="pwoc"><input type="checkbox"  class="spCheck" value="34" name="physWOC" id="pwoc" tabindex="" /></label><span>Physical coach without contract</span></li>
</ul>
<p>Country</p>
<span><input type="text" id="countrySearch" name="countrySearch" /></span>
<p>Club</p>
<span><input type="text" id="clubSearch" name="clubSearch" /></span>
<p>Ending Contract Date</p>
<span><input type="text" id="endcontdatSearch4" name="endcontdatSearch4"  /></span>
</div>

<div id="seeAgent">
<p>2. Check the filter to search</p>
<ul>
<li><label class="lblCHK" for="afifa"><input type="checkbox"  class="spCheck" value="26" name="agfifa" id="afifa" tabindex="" /></label><span>Licensed FIFA  Agent</span></li>
<li><label class="lblCHK" for="auefa"><input type="checkbox"  class="spCheck" value="27" name="aguefa" id="auefa" tabindex="" /></label><span>Licensed UEFA Agent</span></li>
<li><label class="lblCHK" for="aauth"><input type="checkbox"  class="spCheck" value="28" name="aauth" id="aauth" tabindex="" /></label><span>Authorized Agent</span></li>
</ul>
</div>

<script type="text/javascript">
//search profile
$("#endcontdatSearch3").datepicker({changeMonth: true, changeYear: true}).datepicker("option", "yearRange", '2011:2100');		
$("#endcontdatSearch4").datepicker({changeMonth: true, changeYear: true}).datepicker("option", "yearRange", '2011:2100');

var playerCheck = $('.lblField')
playerCheck.click(function(){																
$(this).toggleClass('lblField2');
});
		
		
var srchOpt = $('.lblCHK');
srchOpt.click(function(){              
$(this).toggleClass('lblCHK2');
});		

//////////////////////////////////
$('#showSelectionStp1').click(function(){
	$('#visibleAreaStp1 ul').toggle();											 
});


$('#visibleAreaStp1 ul li a').click(function(){																	 
		var idSelected = $(this).attr('id');
		var txtSelected = $(this).text();
		$('#storeSelectADVProfile').val(idSelected);
		$('#showSelectionStp1').text(txtSelected);
		$('#visibleAreaStp1 ul').toggle();
		
  $('#seeAgent, #seeCoach, #seeJournalist, #seeLawyer, #seeScout, #seeDirector, #seeHealth, #seePlayer').hide();
	switch (idSelected){
		case '1':
		$('#seePlayer').show(); 
		break;
		case '2':
		$('#seeCoach').show(); 
		break;
		case '3':
		$('#seeAgent').show(); 
		break;
		case '4':
		$('#seeScout').show(); 
		break;
		case '5':
		$('#seeLawyer').show(); 
		break;
		case '6':
		$('#seeHealth').show(); 
		break;
		case '7':
		$('#seeDirector').show(); 
		break;
		case '8':
		$('#seeFan').show(); 
		break;
		case '9':
		$('#seeJournalist').show();
		break;
		}
		
$("#endcontdatSearch3").datepicker({changeMonth: true, changeYear: true}).datepicker("option", "yearRange", '2011:2100');		
$("#endcontdatSearch4").datepicker({changeMonth: true, changeYear: true}).datepicker("option", "yearRange", '2011:2100');
		});
</script>




</div>






<!-- ///////////INSTITUTION //////////// -->
<div id="srchInst" style="display:none;">
<p>Institutions profile options</p>
<ul class="options">
<li><label class="lblCHK" for="club"><input type="checkbox" class="spCheck"  name="club" id="club"/></label><span>Club</span></li>
<li><label class="lblCHK" for="company"><input type="checkbox"  class="spCheck"  name="company" id="company" /></label><span>Company</span></li>
<li><label class="lblCHK" for="federation"><input type="checkbox"  class="spCheck"  name="federation" id="federation" /></label><span>Federation</span></li>
</ul>

<script type="text/javascript">
$(document).ready(function(){
	//$('#endcontdatSearch').datepicker();
	
	var srchOpt = $('.lblCHK')
	srchOpt.click(function(){														
	$(this).toggleClass('lblCHK2');
	});
	
	var playerCheck = $('.lblField')
	playerCheck.click(function(){																
	$(this).toggleClass('lblField2');
	});
});
</script>


</div>




<!-- ///////////MULTIMEDIA //////////// -->
<div id="srchMult" style="display:none;">
<p>Multimedia options</p>
<ul class="options">
<li><label class="lblCHK" for="club"><input type="checkbox"  class="spCheck" value="20" name="video" id="video" tabindex="" /></label><span>Videos</span></li>
<li><label class="lblCHK" for="company"><input type="checkbox"  class="spCheck" value="21" name="photo" id="photo" tabindex="" /></label><span>Photos</span></li>
<!--<li><label class="lblCHK" for="federation"><input type="checkbox"  class="spCheck" value="22" name="federation" id="federation" tabindex="" /></label><span>Audio</span></li>-->
</ul>
<script type="text/javascript">
$(document).ready(function(){
//	$('#endcontdatSearch').datepicker();
	
	var srchOpt = $('.lblCHK')
	srchOpt.click(function(){														
	$(this).toggleClass('lblCHK2');
	});
	
	var playerCheck = $('.lblField')
	playerCheck.click(function(){																
	$(this).toggleClass('lblField2');
	});
});
</script>
</div>


