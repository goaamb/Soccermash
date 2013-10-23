<?php if ( (isset($_GET['id']) || $_GET['id']!="") &&(isset($_GET['nProfile'])) ){?>
<img style="margin: 0pt 10px 10px 0pt;" src="img/logoRepresent.jpg">
<span class="verde"><?php print $_GET['name'].' '.$_GET['last'];?> <span><?php print $_GET['nProfile'];?></span><br/>
<?php 
  require_once $_SERVER["DOCUMENT_ROOT"] . '/gbase.php';
  require_once $_SERVER["DOCUMENT_ROOT"] . '/goaamb/idioma.php';
  if(class_exists("Idioma") && !isset($_IDIOMA)){
	 $_IDIOMA=Idioma::darLenguaje();
  }
global $_IDIOMA; print $_IDIOMA->traducir("is asking you to manage your profesional soccer profile"); ?>
.</span>

<hr/>
<p>
1. <?php print $_IDIOMA->traducir("You have read our privacy policy"); ?>.
</p><br/><p>
2.<?php print $_IDIOMA->traducir("When you approve this person to lead your profile, you�ll allow him/her to administrate your professional SOCCERMASH.com profile data (photos, videos, news, messeges, etc.) under your agreement."); ?>
</p><br/><p>
3.<?php print $_IDIOMA->traducir("You are the only responsible for damages that misuse this professional and personal information that can be generated at this person."); ?>
</p><br/><p>
4. <?php print $_IDIOMA->traducir("This person could remove you whenever he/her wants"); ?>.
</p><br/><p>
5. SOCCERMASH.com <?php print $_IDIOMA->traducir("is not responsible about this representation"); ?>.
</p>
<hr/>
<div id="Errormsgs" style="color:red;display:none;" ><?php print $_IDIOMA->traducir("Debe aceptar la clausula, para continuar"); ?>.</div>
<div class="agree">
<input type="checkbox" name="agree" id="agree"/>
<?php print $_IDIOMA->traducir("I agree"); ?>
</div>
<input onclick="$('#alertEmergente').hide();$('#alertEmergente0').hide();JS_hideAllNoti();JS_hideInvitationRepre('flwContII<?php echo $_GET['n'];?>'); JS_removeNotiAgent(<?php echo $_GET['id'];?>);" type="submit" id="butonEr" class="saveEditingP ui-button ui-widget ui-state-default ui-corner-all" style="background-color: red;background-image: none;" value="<?php print $_IDIOMA->traducir("Reject"); ?>" />
<input onclick="aceptarSolicitud(<?php echo $_GET['id'];?>);" type="submit" id="butonE" class="saveEditingP ui-button ui-widget ui-state-default ui-corner-all" onmouseover="$('#butonE').addClass('ui-state-hover');" onmouseout="$('#butonE').removeClass('ui-state-hover');" value="<?php print $_IDIOMA->traducir("Accept"); ?>" />
<div style="clear:both;"></div>
<?php }?>
