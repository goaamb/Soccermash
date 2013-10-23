<p>2. Check the filter to search</p>
<ul>
<li><label class="lblCHK" for="afifa"><input type="checkbox"  class="spCheck" value="26" name="agfifa" id="afifa" tabindex="" /></label><span>Licensed FIFA  Agent</span></li>
<li><label class="lblCHK" for="auefa"><input type="checkbox"  class="spCheck" value="27" name="aguefa" id="auefa" tabindex="" /></label><span>Licensed UEFA Agent</span></li>
<li><label class="lblCHK" for="aauth"><input type="checkbox"  class="spCheck" value="28" name="aauth" id="aauth" tabindex="" /></label><span>Authorized Agent</span></li>
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

<script type="text/javascript">
var srchOpt = $('.lblCHK')
srchOpt.click(function(){														
$(this).toggleClass('lblCHK2');
});
</script>