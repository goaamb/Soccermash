<?php if(isset($_SESSION['iIdAgent'])){?>
<img style="margin: 0pt 10px 10px 0pt;" src="img/logoRepresent.jpg">
<span class="verde">
<?php
  require_once $_SERVER["DOCUMENT_ROOT"] . '/gbase.php';
  require_once $_SERVER["DOCUMENT_ROOT"] . '/goaamb/idioma.php';
  if(class_exists("Idioma") && !isset($_IDIOMA)){
	 $_IDIOMA=Idioma::darLenguaje();
  }
  global $_IDIOMA;
  print $_IDIOMA->traducir("You're removing to the manager administrative permissions on this network"); ?>
</span>

<hr/>

<input onclick="JS_deleteAgent(<?php print $_SESSION['iIdAgent'];?>);" type="submit" class="saveEditingP ui-button ui-widget ui-state-default ui-corner-all" style="background-color: red;background-image: none;" value="<?php print $_IDIOMA->traducir("Yes, Remove"); ?>." />
<div style="clear:both;"></div>
<?php }
