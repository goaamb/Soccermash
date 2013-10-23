
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