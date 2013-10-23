<?
		///getcontent//
		$theScores = file_get_contents($_POST['live'],true);
		//preg_match('@^(?:<table>)?([^</table>]+)@i',$theScores, $coincidencias);
		$res=explode("document.writeln('",$theScores);
		$res=explode("')",$res[1]);
		var_dump($res[0]);
		//echo $res[0];			
	
	
	
		
?>

<script type="text/javascript">
	/*$("table").css('width','560px');*/
	$("table a").attr('href','#');
	$("table a").click(function(){return false;});
	$("table span").html('');
	/*$("table a").css('cursor','text');
	
	$("table tbody tr td table tbody tr td").html('');*/
</script>