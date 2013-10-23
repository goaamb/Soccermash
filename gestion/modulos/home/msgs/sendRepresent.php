<img style="margin: 0pt 10px 10px 0pt;" src="img/logoRepresent.jpg">
<span class="verde">
<?php 
  require_once $_SERVER["DOCUMENT_ROOT"] . '/gbase.php';
  require_once $_SERVER["DOCUMENT_ROOT"] . '/goaamb/idioma.php';
  if(class_exists("Idioma") && !isset($_IDIOMA)){
	 $_IDIOMA=Idioma::darLenguaje();
  }
global $_IDIOMA; print $_IDIOMA->traducir("You are requesting this person to be represented by you:"); ?>
</span>

<hr/>
<p>
1. 
<?php print $_IDIOMA->traducir("You have read our privacy policy."); ?>
</p><br/><p>
2. <?php print $_IDIOMA->traducir("When this person approve you to be his/her manager, you'll handle his/her  professional SOCCERMASH.com profile data under your legal responsability. You'll be able to upload Photos, Videos, News, etc."); ?>
</p><br/><p>
3. <?php print $_IDIOMA->traducir("Tú eres el único responsable de daños y perjuicios que el uso indebido de esta información profesional y personal pueda generarle a esta persona."); ?>
</p><br/><p>
4. <?php print $_IDIOMA->traducir("This person could remove you as manager whenever he/her wants.:"); ?>
</p><br/><p>
5. <?php print $_IDIOMA->traducir("SOCCERMASH.com is not responsible about this representation."); ?>
</p>
<hr/>
<div id="Errormsgs" style="color:red;display:none;" >
<?php print $_IDIOMA->traducir("Deve aceptar la clausula, para continuar."); ?></div>
<div class="agree">
<input type="checkbox" name="agree" id="agree"/>

<?php print $_IDIOMA->traducir("I agree"); ?>
</div>

<input onclick="JS_addRepresentedNotifi();" type="submit" id="butonE" class="saveEditingP ui-button ui-widget ui-state-default ui-corner-all" onmouseover="$('#butonE').addClass('ui-state-hover');" onmouseout="$('#butonE').removeClass('ui-state-hover');" value="<?php print $_IDIOMA->traducir("Send"); ?>" />
<div style="clear:both;"></div>