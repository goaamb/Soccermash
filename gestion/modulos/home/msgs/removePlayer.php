<?php if(isset($_GET['id']) || $_GET['id']!=""){?>
<img style="margin: 0pt 10px 10px 0pt;" src="img/logoRepresent.jpg">
<?php
  require_once $_SERVER["DOCUMENT_ROOT"] . '/gbase.php';
  require_once $_SERVER["DOCUMENT_ROOT"] . '/goaamb/idioma.php';
  if(class_exists("Idioma") && !isset($_IDIOMA)){
	 $_IDIOMA=Idioma::darLenguaje();
  }
  global $_IDIOMA;
  ?>
<span class="verde">
<?php print $_IDIOMA->traducir("Are you sure you want to delete your representation of this person? This action can not be reversed.");?>
</span>

<hr/>

<input onclick="JS_deletePlayerRepresented(<?php print $_GET['id']?>);" type="submit" class="saveEditingP ui-button ui-widget ui-state-default ui-corner-all" style="background-color: red;background-image: none;" value="<?php print $_IDIOMA->traducir('OK');?>" />
<div style="clear:both;"></div>
<?php }?>
