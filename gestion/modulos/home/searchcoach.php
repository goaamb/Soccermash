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

<script type="text/javascript">
$('#endcontdatSearch').datepicker();
var srchOpt = $('.lblCHK')
srchOpt.click(function(){														
$(this).toggleClass('lblCHK2');
});
</script>