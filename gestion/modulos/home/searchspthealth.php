<p>2. Check the filter to search</p>
<ul>
<li><label class="lblCHK" for="nutr"><input type="checkbox"  class="spCheck" value="37" name="nutr" id="nutr" tabindex="" /></label><span>Nutritionist</span></li>
<li><label class="lblCHK" for="sptmedic"><input type="checkbox"  class="spCheck" value="38" name="sptmedic" id="sptmedic" tabindex="" /></label><span>Sport Medic</span></li>
<li><label class="lblCHK" for="mssgt"><input type="checkbox"  class="spCheck" value="39" name="mssgt" id="mssgt" tabindex="" /></label><span>Massagist</span></li>
</ul>
<p>Country</p>
<span><input type="text" id="countrySearch" name="countrySearch" /></span>
<p>Club</p>
<span><input type="text" id="clubSearch" name="clubSearch" /></span>

<p>Age</p>
<span><select type="text" id="ageSearch" name="ageSearch" >
<option selected="selected" value="">Age</option>
<? 
for ($i=14; $i<111; $i++){
	echo '<option value="'.$i.'">'.$i.'</option>';
}  
?>
<script type="text/javascript">
var srchOpt = $('.lblCHK')
srchOpt.click(function(){														
$(this).toggleClass('lblCHK2');
});
</script>