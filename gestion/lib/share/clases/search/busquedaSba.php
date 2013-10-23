<?
		///////////////Create conection////////////////////////
						
				require_once('../nucleo/motor.php');
				$bd1= new conexion();
			
				$tipo=addslashes($tipo);
				$valor=addslashes($valor);
		////////////////Searchibg for data depending on $tipo/////////////////////////////		
				
				if($tipo=="usuario"){
				
				
				
					$registro = $bd1->query("SELECT * FROM ax_registerProfile WHERE active='1'");
				
				
				}elseif($tipo=="coach"){
				
					$registro = $bd1->query("SELECT * FROM ax_registerProfile WHERE profileId BETWEEN '7' AND '12' AND active='1'");
				
				
				}elseif($tipo=="president"){
				
					$registro = $bd1->query("SELECT * FROM ax_registerProfile WHERE active='1'");
				
				
				}elseif($tipo=="manag"){
					
					$registro = $bd1->query("SELECT * FROM ax_registerProfile WHERE profileId BETWEEN '18' AND '19' AND active='1'");
				
				
				}elseif($tipo=="jugador"){
				
					$registro = $bd1->query("SELECT * FROM ax_registerProfile WHERE profileId BETWEEN '2' AND '6' AND active='1'");
				
				
				}elseif($tipo=="clubes"){
				
								
					$registro = $bd1->query("SELECT * FROM ax_club WHERE (nickName LIKE '%".$valor."%' OR name LIKE '%".$valor."%') AND active='1' ORDER BY name ASC");
					
			
				}elseif($tipo=="country"){
				
					$registro = $bd1->query("SELECT * FROM ax_country WHERE country LIKE '%".$valor."%' ORDER BY country ASC");			
					//$registro = $bd1->query("SELECT * FROM ax_country");
					
					
				}elseif($tipo=="companies"){
				
					$registro = $bd1->query("SELECT * FROM ax_company WHERE name LIKE '%".$valor."%' ORDER BY name ASC");			
					//$registro = $bd1->query("SELECT * FROM ax_country");	
					
				}elseif($tipo=="federations"){
				
					$registro = $bd1->query("SELECT * FROM ax_federation WHERE name LIKE '%".$valor."%' ORDER BY name ASC");			
					//$registro = $bd1->query("SELECT * FROM ax_country");		
					
			
				}
				
			
		///////////////////Searching depending on $valor/////////////////////////
				
				if($registro[0]!=""){
					
					
					
				foreach ($registro as $persona){
					
						
						
						
					if($tipo=="clubes"){	
		
				
				
						//$nombre = $bd1->query("SELECT * FROM ax_club WHERE idUser='".$persona->idGeneral."' AND (nickName LIKE '%".$valor."%' OR name LIKE '%".$valor."%') ORDER BY name ASC");	
						if($persona->check=='1'){
							$checkImg="   <img src='img/accept.png' width='11' height='11'/>";
						}else{
							$checkImg="";
						}
						echo "<div style='font-size:12px;' onclick='document.getElementById(\"$hidden\").value=\"".$persona->id."\"; document.getElementById(\"$user\").value=\"".$persona->name." ".$persona->federationName. $persona->otherFederation ."\"; hide_me(\"buscador1\"); '>".$persona->name." - ".$persona->federationName. $persona->otherFederation . $checkImg . "</div>";
						
					
					}elseif($tipo=="country"){
					

		
						
						//$nombre = $bd1->query("SELECT * FROM ax_country");	
						echo "<div style='font-size:12px;' onclick='document.getElementById(\"$hidden\").value=\"".$persona->id."\"; document.getElementById(\"$user\").value=\"".html_entity_decode($persona->country)."\"; hide_me(\"buscador1\");'>".html_entity_decode($persona->country)." <img src='img/accept.png'/></div>";
						
						
						
					}elseif($tipo=="companies"){
						if($persona->check=='1'){
							$checkImg="   <img src='img/accept.png' width='11' height='11'/>";
						}else{
							$checkImg="";
						}

						//$nombre = $bd1->query("SELECT * FROM ax_country");	
						echo "<div style='font-size:12px;' onclick='document.getElementById(\"$hidden\").value=\"".$persona->id."\"; document.getElementById(\"$user\").value=\"".html_entity_decode($persona->name)."\"; hide_me(\"buscador1\");'>".html_entity_decode($persona->name). $checkImg ."</div>";	
						
						
						
					}elseif($tipo=="federations"){
						if($persona->check=='1'){
							$checkImg="   <img src='img/accept.png' width='11' height='11'/>";
						}else{
							$checkImg="";
						}
						
						//$nombre = $bd1->query("SELECT * FROM ax_country");	
						echo "<div style='font-size:12px;' onclick='document.getElementById(\"$hidden\").value=\"".$persona->id."\"; document.getElementById(\"$user\").value=\"".html_entity_decode($persona->name)."\"; hide_me(\"buscador1\");'>".html_entity_decode($persona->name). $checkImg ."</div>";	
							
									
					
					}else{
		
												
						$nombre = $bd1->query("SELECT * FROM ax_generalRegister WHERE id='".$persona->idGeneral."' AND (lastName LIKE '%".$valor."%' OR name LIKE '%".$valor."%') ORDER BY lastName ASC");	
					
						echo "<div style='font-size:12px;' onclick='document.getElementById(\"$hidden\").value=\"".$persona->idGeneral."\"; document.getElementById(\"$user\").value=\"".$nombre[0]->lastName." ".$nombre[0]->name."\"; hide_me(\"buscador1\");'>".html_entity_decode($nombre[0]->lastName)." ".html_entity_decode($nombre[0]->name)." <img src='img/accept.png'/></div>";
					
					
					
					
					}
						
						
					
				
										
					}//for
		
		
		
				}else{
				
				echo "No results";
				}

?>
