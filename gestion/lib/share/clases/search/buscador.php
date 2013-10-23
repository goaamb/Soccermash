 <div id="buscador1" style="position:absolute; left:2px; top:-5px; width:280px; height:100px; background:#FFF; border:thin solid #CCC; overflow-y:auto; overflow-x:hidden; z-index:999;">
	  	 
		 <div style="float:right;"><a href="javascript:;" onclick="hide_me('buscador1');">[X]</a></div>
		  <!--<input class="input" type="text" name="user2" id="user2" onkeyup="busca('user2','user_rellena','<? print $_POST["tipe"]; ?>','<? print $_POST["user"]; ?>','<? print $_POST["hidden"]; ?>');" />-->
		
		  <div id="user_rellena" style="width:350px; height:70px; overflow-x:hiden; overflow-y:auto;"></div>
			
			<?
			$string=$_POST["hidden"];
			$str=$string[0];
			$userVal=strtoupper($str).substr($_POST["hidden"],1);
			?>
			
		  <div style="float:right;"><a style="font-size:11px;" href="javascript:;" onclick="unhide_me('<? print 'other_'.$userVal; ?>'); hide_me('<? echo 'span_'.$_POST['hidden']; ?>'); $('#<? echo $_POST["user"]; ?>').val('');">Other</a></div>
		  
	  </div>