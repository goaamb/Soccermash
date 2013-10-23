                  <div id="footMenu">
                  <div><ul>
                  <li><a class="openlegal" onclick="openlegal();" href="#"><? print $_IDIOMA->traducir("Legal notice"); ?></a></li>
                 <!--  <li><a class="openhelp" href="#helpsection"><? print $_IDIOMA->traducir("Help"); ?></a></li> -->
                  <!--<li><a href="#">Developers </a></li>-->
                  <!--<li><a href="#">Blog</a></li>-->
                  <!--<li><a href="#">Press</a></li>-->
                  <!--<li><a href="mailto:soccermash@soccermash.com"><? print $_IDIOMA->traducir("Advertise"); ?></a></li>-->
                  <!--<li><a href="#">Jobs</a></li>-->
                  <li><a id="openabout" onclick="openabout();" href="#"><? print $_IDIOMA->traducir("About"); ?></a></li>
                  <!--<li><a href="#">Mobile</a></li>-->
                  </ul></div>
                  </div>
                  
                  <div id="footMenuDos" class="txtColorLC">
                  <div id="copy"><span>SOCCERMASH &copy; <? echo date('Y') ?></span></div><!--END copy-->

									<div id="lang">
                    <p id="lgsel"><a id="chooseLang" onclick="$('#availLang').toggle('fast');" class="txtColorLC onright"><? print $_IDIOMA->traducir("Choose your language"); ?></a></p>
                    	  <div id="availLang">
                        	<ul>
                          	<li><a href="javascript:cambiarIdioma('en-US');">English</a></li>
                  		    <li><a href="javascript:cambiarIdioma('es-ES');">Espa&ntilde;ol</a></li>
                  		    <li><a href="javascript:cambiarIdioma('pt-PT');">Portugu&ecirc;s</a></li>
                           <!-- <li><a href="#">Portugu&ecirc;s</a></li>
                            <li><a href="#">Fran&ccedil;aise</a></li>
                            <li><a href="#">Ελληνικά</a></li>-->
                          </ul>
                   </div>                  		

                  </div><!--END lang-->
                           
                  </div><!--END footMenuDos-->
<script type="text/javascript">
function cambiarIdioma(lg){
	G.cookie.set("lang",lg);
	$('#availLang').hide('fast');
	var loc=location.href.split("#");
	if(loc.length>1){
		loc.pop();
	}
	location.href=loc[0];
}
</script>