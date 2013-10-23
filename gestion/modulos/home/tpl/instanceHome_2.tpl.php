          <div id="profFields">
          	<span id="hideinf">HIDE INFO<a href="#"></a></span>
					<div id="persinfholder">
            <div id="fieldsA">
            	<!--NOTA desarrolladores: en la siguiente estructura, no anidar OTRO  div dentro del segundo div (a su vez anidado en un div), preferentemente. Usar ese segundo DIV como el DIV previsto por la programaciòn.-->
            	<div><span>Sport Nick Name:</span><div><?php echo $aProfile[0]->nick;?></div></div>
              <div><span>Date of birth:</span><div><?php echo $edad=explodeEdad($aUsuario['dayOfBirthDay']).' ('.$aUsuario['edad'].')';?></div></div>
              <div><span>Current Club:</span><div>Ejemplo</div></div>
              <div><span>Ending contract date:</span><div><?php echo $eCD=explodeEdad($aProfile[0]->endingContractDate);?></div></div>
              <div><span>Nationality:</span><div><?=$aUsuario['countryName'];?></div></div>
              <div><span>Passport:</span><div>Ejemplo</div></div>
              <div><span>Agent:</span><div>Ejemplo<span id="goto"><a class="txtColorLC" href="#">-->go to the agent's profile</a></span></div></div>
            </div><!--fieldsA-->
            <div id="fieldsB">
            		<div><span>Position:</span> <div><input type="text" value="borrar" /></div></div>
                <div><span>Skillful leg/hand:</span> <div><input type="text" value="borrar" /></div></div>
                <div><span>National Selected:</span> <div>Ejemplo</div></div>
                <div><span>Birth:</span> <div><?php echo $aUsuario['cityName'].', '.$aUsuario['countryName'];?></div></div>
                <div><span>Height:</span> <div>Ejemplo</div></div>
                <div><span>Weight:</span> <div>Ejemplo</div></div>
                <div><span>Marital Status:</span> <div> <span id="alert"><a href="#">Go</a></span> </div></div>
            </div><!--fieldsB-->
           
            <div id="advance">
								<div id="progressbar"><span id="pbyellow"></span></div>
                <p>82% (?)</p>
            </div><!--advance--> 
          </div><!--END persinfoholder-->         
          </div><!--END profFields-->
