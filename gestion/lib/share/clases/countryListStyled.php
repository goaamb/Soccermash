<?
	$dir='/';
	require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/nucleo/nucleo.php');
	/*require_once($_SERVER['DOCUMENT_ROOT'].'/gestion/lib/share/clases/lib_util.inc.php');
	 require_once $_SERVER["DOCUMENT_ROOT"]. '/gbase.php';
	 require_once $_GBASE. '/goaamb/idioma.php';
	if(class_exists("Idioma")){
		 $_IDIOMA=Idioma::darLenguaje();
	  }		*/
	
	class CountryList{
			
				
			
			///////////////Initialize/////////////////
			public function init($hname,$tit,$shw,$shwit,$sel,$mrg=0)
			{
			
				if(!empty($hname) && !empty($tit) && !empty($shw) && !empty($shwit) && !empty($sel)){
						
						$this->name=$hname;
						$this->title=$tit;
						$this->showed=$shw;
						$this->showIt=$shwit;
						$this->margin=$mrg;	
						$this->selector=$sel;		
						$this->showList();
						
				}else{
				
						echo 'Missing Name'; 
						die();
				}
			
			}
			
			
			////////////Render the list/////////////////////
			private function showList()
			{
			
			

					
					
					global $_IDIOMA;							
					echo '
					<input type="hidden" name="'.$this->name.'" id="'.$this->name.'"/>
					<input type="hidden" name="countryName" id="countryName"/>
					
	
	
	<span class="clear pos"> <label class="posLabel3" for="'.$this->name.'"><div style="margin-left:-12px;">'.$this->title.'</div></label>
          <div id="selectMenu"><span id="'.$this->showed.'"></span>
     <div id="'.$this->showIt.'" class="dontshow">
                  <ul id="'.$this->selector.'">
						';
												
						$bd = new conexion();
						
						$registro = $bd->query("SELECT Code,country FROM ax_country WHERE idLanguage='2'");
						
						$theCountrs=array();
						
						if($registro[0]!=""){
							foreach($registro as $pais){
									$theCountrs[$pais->Code]=$_IDIOMA->traducir($pais->country);	
							}  
							
							asort($theCountrs);
							
							foreach($theCountrs as $kk=> $theCosC){
								echo '
								 <li id="'.$kk.'">'.$_IDIOMA->traducir($theCosC).'</li>
								';
							}//for
						}//if
						
					echo '</ul>
                     </div>
            </div>
              
          <!--END selectMenu-->
         
     </span> ';
					
							

			
			}//showList
			
			
			
			
			
			
			
			////////////////Function to select a country by code/////////////
			public function selectCountry($code)
			{
				$bdc = new conexion();
				$registroC = $bdc->query("SELECT country FROM ax_country WHERE Code='".$code."'");
				return $registroC;
			}
			
			
			
			
			
			
			
			
			

}//class

?>
