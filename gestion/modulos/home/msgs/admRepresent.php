<?php if(isset($_GET['url']) || $_GET['url']!=""){?>
<img style="margin: 0pt 10px 10px 0pt;" src="img/msgsAdm.png">
<?php 
  require_once $_SERVER["DOCUMENT_ROOT"] . '/gbase.php';
  require_once $_SERVER["DOCUMENT_ROOT"] . '/goaamb/idioma.php';
  if(class_exists("Idioma") && !isset($_IDIOMA)){
	 $_IDIOMA=Idioma::darLenguaje();
  }
global $_IDIOMA;  ?>
<span class="verde"><?php print $_IDIOMA->traducir("You are going to administrate the profile of");echo ' '; print $_GET['name'].' '.$_GET['lstname'];echo ' '; ?> </span>

<hr/>

<a href="<?php print $_GET['url']?>" class="amarillo saveEditingP ui-button ui-widget ui-state-default ui-corner-all"><?php print $_IDIOMA->traducir(" ok ");?> </a>
<div style="clear:both;"></div>
<?php }?>
