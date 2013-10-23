<p>2. Check the filter to search</p>
<ul>
<li><label class="lblCHK" for="sptdir"><input type="checkbox"  class="spCheck" value="35" name="sptdir" id="sptdir" tabindex="" /></label><span>Sport Director</span></li>
<li><label class="lblCHK" for="tcnsec"><input type="checkbox"  class="spCheck" value="36" name="tcnsec" id="tcnsec" tabindex="" /></label><span>Technical Secretary</span></li>
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