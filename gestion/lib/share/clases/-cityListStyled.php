<?php
	require_once('nucleo/nucleo.php');
			
	class CityList{
						
			
			///////////////Initialize/////////////////
			function __construct($hname,$tit,$shw,$shwit,$sel,$code,$mrg=0)
			{
			
				if(!empty($hname) && !empty($tit) && !empty($shw) && !empty($shwit) && !empty($sel) && !empty($code)){
						
						$this->CountryCode=$code;
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
					
													
					echo '
					<input type="hidden" name="'.$this->name.'" id="'.$this->name.'"/>
					<input type="hidden" name="cityName" id="cityName"/>
					
	
	<span class="clear pos" id="theCityName"> </div><label class="posLabel" for="'.$this->name.'"><div style="margin-left:'.$this->margin.'px;">'.$this->title.'</div></label>
          <div id="selectMenu"><span id="'.$this->showed.'"></span>
     <div id="'.$this->showIt.'" class="dontshow">
                  <ul id="'.$this->selector.'">
						';
												
						$bd = new conexion();
						
						$registro = $bd->query("SELECT ID,NAME,CountryCode FROM ax_city WHERE CountryCode='".$this->CountryCode."' order by Name asc");
						
						if($registro[0]!=""){
							foreach($registro as $city){
							
							echo '
							 <li id="'.$city->ID.'">'.$city->NAME.'</li>
							';
							
							}//for
						}//if
						
						
						
						?>
						<script type="text/javascript">
						
							$(document).ready(function() {
 	
								   
								  $("#textShowed3").click(function() {
									$("#showIT3").toggle()
								  });
								  $("#selector3 li").click(function() {
									var idSel3 = $(this).attr("id");
									var a3 = $(this).text();	
									//Nationality
									$('#cityId').attr('value',idSel3);		
									$('#cityName').attr('value',a3);
									$("#textShowed3").text(a3);
									$("#showIT3").hide("fast");
									$("#firstName").focus()
								  })
	  
  
						});
						
						</script>
						<?php
						
						
						
						
					echo '</ul>
                     </div>
            </div>
              
          <!--END selectMenu-->
         
     </span> 
	 
	  <span class="clear pos" id="cityLink">
		  <a href="javascript:;" onclick="$(\'#theCityName\').hide(); $(\'#cityName\').val(\'-\'); $(\'#othCity\').show(); $(\'#cityLink\').hide();">Other City</a>
          </span>
           	
		  <span class="clear pos" id="othCity" style="display:none;">
	  	 
          <label id="ooCity" for="otherCity">Other City</label>
          <input class="input" name="otherCity" id="otherCity" type="text" id="otherCity" onchange="$(\'#cityName\').val($(\'#otherCity\').val()); $(\'#cityId\').val(\'111111111\')" /></span>
	 
	 ';
					
							

			
			}//showList
			
			

}//class

?>
