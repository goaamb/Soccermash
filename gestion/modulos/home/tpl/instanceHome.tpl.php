
          <div id="profFields">
          	<span id="hideinf">HIDE INFO<a href="#"></a></span>
					<div id="persinfholder">
            <div id="fieldsA">
            	<!--NOTA desarrolladores: en la siguiente estructura, no anidar OTRO  div dentro del segundo div (a su vez anidado en un div), preferentemente. Usar ese segundo DIV como el DIV previsto por la programaciòn.-->
            
              <div><span>Date of birth:</span><div><?php echo $edad=explodeEdad($aUsuario['dayOfBirthDay']).' ('.$aUsuario['edad'].')';?></div></div>
              <div><span>Other Data:</span><div>Ejemplo</div></div>
             <div><span>Other Data:</span><div>Ejemplo</div></div>
              <div><span>Nationality:</span><div><?=$aUsuario['countryName'];?></div></div>
              <!--<div><span>Passport:</span><div>Ejemplo</div></div>
              <div><span>Agent:</span><div>Ejemplo<span id="goto"><a class="txtColorLC" href="#"></a></span></div></div>-->
            </div><!--fieldsA-->
            <div id="fieldsB">
            		
                <div><span>Other Data:</span> <div>Ejemplo</div></div>
                <div><span>Other Data:</span> <div>Ejemplo</div></div>
                <div><span>Birth:</span> <div><?php echo $aUsuario['cityName'].', '.$aUsuario['countryName'];?></div></div>
               <!-- <div><span>Height:</span> <div>Ejemplo</div></div>
                <div><span>Weight:</span> <div>Ejemplo</div></div>
                <div><span>Marital Status:</span> <div> <span id="alert"><a href="#">Go</a></span> </div></div>-->
            </div><!--fieldsB-->
           
            <div id="advance">
								<div id="progressbar"><span id="pbyellow"></span></div>
                <p>82% (?)</p>
            </div><!--advance--> 
          </div><!--END persinfoholder-->         
          </div><!--END profFields-->