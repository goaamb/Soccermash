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

<p>2. Check the filter to search</p>
<ul>
<!--<li><label class="lblCHK" for="wuc"><input type="checkbox"  class="spCheck" value="22" name="wmundcontr" id="wuc" tabindex="" /></label><span>Women player under contract</span></li>
<li><label class="lblCHK" for="wwc"><input type="checkbox"  class="spCheck" value="23" name="wmwthoutcontr" id="wwc" tabindex="" /></label><span>Women player without contract</span></li>-->
<li><label class="lblCHK" for="puc"><input type="checkbox"  class="spCheck" value="20" name="pyundcontr" id="puc" /></label><span>Player under contract</span></li>
<li><label class="lblCHK" for="pwc"><input type="checkbox"  class="spCheck" value="21" name="pywthoutcontr" id="pwc"  /></label><span>Player without contract</span></li>
<li><label class="lblCHK" for="amtp"><input type="checkbox"  class="spCheck" value="24" name="amtpy" id="amtp"  /></label><span>Amateur players</span></li>
<li><label class="lblCHK" for="xpy"><input type="checkbox"  class="spCheck" value="25" name="xply" id="xpy" t /></label><span>Ex-players</span></li>
</ul>

<p>Country</p>
<span><input type="text" id="countrySearch" name="countrySearch" /></span>
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
<span><input type="text" id="clubSearch" name="clubSearch" /></span>
<p>Ending Contract Date</p>
<span><input type="text" id="endcontdatSearch" name="endcontdatSearch" /></span>
<span id="fieldSrch">
<div id="playField">
<label title="Goalkeeper" class="lblField" id="posit0" for="position0"><input class="spCheck" type="checkbox"  name="position0" id="position0" /></label>
<label title="Left Wing-back" class="lblField" id="posit1" for="position1"><input class="spCheck" type="checkbox"  name="position1" id="position1" /></label>
<label title="Left Centre-back" class="lblField" id="posit2" for="position2"><input class="spCheck" type="checkbox"  name="position2" id="position2"/></label>
<label title="Right Centre-back" class="lblField" id="posit3" for="position3"><input class="spCheck" type="checkbox"  name="position3" id="position3" /></label>
<label title="Right Wing-back" class="lblField" id="posit4" for="position4"><input class="spCheck" type="checkbox"  name="position4" id="position4"  /></label>
<label title="Left Centre-midfield" class="lblField" id="posit5" for="position5"><input class="spCheck" type="checkbox"  name="position5" id="position5" /></label>
<label title="Right Centre-midfield" class="lblField" id="posit6" for="position6"><input class="spCheck" type="checkbox"  name="position6" id="position6" /></label>
<label title="Left Centre-forward" class="lblField" id="posit7" for="position7"><input class="spCheck" type="checkbox"  name="position7" id="position7"  /></label>
<label title="Right Centre-forward" class="lblField" id="posit8" for="position8"><input class="spCheck" type="checkbox"  name="position8" id="position8" /></label>
<label title="Centre-Forward" class="lblField" id="posit9" for="position9"><input class="spCheck" type="checkbox"  name="position9" id="position9" /></label>
<label title="Full-forward" class="lblField" id="posit10" for="position10"><input class="spCheck" type="checkbox"  name="position10" id="position10"/></label>
</div>
</span>
<script type="text/javascript">
$(document).ready(function(){

	$('#endcontdatSearch').datepicker();
	
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
