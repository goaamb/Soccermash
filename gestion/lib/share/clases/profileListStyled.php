<?
	require_once('gestion/lib/share/clases/nucleo/nucleo.php');
	////translation///////
	 require_once $_SERVER["DOCUMENT_ROOT"]. '/gbase.php';
	 require_once $_GBASE. '/goaamb/idioma.php';
	if(class_exists("Idioma")){
		 $_IDIOMA=Idioma::darLenguaje();
	  }
			
	class ProfileList{
			
			
			
			///////////////Initialize/////////////////
			public function init($hname,$tit,$shw,$shwit,$sel,$mrg=0,$lan=2)
			{
			
				
				if(!empty($hname) && !empty($tit) && !empty($shw) && !empty($shwit) && !empty($sel)){
						
						$this->name=addslashes($hname);
						$this->title=addslashes($tit);
						$this->showed=addslashes($shw);
						$this->showIt=addslashes($shwit);
						$this->selector=addslashes($sel);		
						$this->margin=addslashes($mrg);	
						$this->language=addslashes($lan);
						$this->showList();
						
				}else{
				
						echo 'Missing data';
						die(); 
				
				}
			
			}
			
			
			////////////Render the list/////////////////////
			private function showList()
			{
					
					global $_IDIOMA;					
					echo '
					
					
					
					<input type="hidden" name="'.$this->name.'" id="'.$this->name.'"/>
					
					
					<label id="labProfile" class="label" for="profile"><div style="margin-left:'.$this->margin.'px;">'.$this->title.'</div></label></td>
							 <td width="230">
							 <div id="selectMenu"><span id="'.$this->showed.'"></span>
						        
					          <div id="'.$this->showIt.'" class="dontshow">
				              <ul id="'.$this->selector.'">
	
						';
												
						$bd = new conexion();
						
						$registro = $bd->query("SELECT idProfile,profile FROM ax_profile WHERE idLanguage='".$this->language."' AND idProfile!='1' ORDER BY orderProfile LIMIT 0,25");
						
						if($registro[0]!=""){
							foreach($registro as $profile){
							
							echo '
							 <li onclick="$(\'#textShowed\').tipsy(\'hide\');" id="'.$profile->idProfile.'">'.$_IDIOMA->traducir($profile->profile).'</li>
							';
							
							}//for
						}//if
						
					echo '</ul>
                     </div>
            </div>
              
          <!--END selectMenu-->
         
    		 ';
					
							

			
			}//showList
			
			

}//class

?>