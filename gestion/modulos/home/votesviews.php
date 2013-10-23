  <!-------------------- Session and session user visiting ------------------------->
                     
						    <?
							//$_SESSION['idUserVisiting']=0;
							//$_SESSION['idProfileVisiting']=0;
							
							 if(!isset($_SESSION['idUserVisiting']) || $_SESSION['idUserVisiting']==0 || $_SESSION['idUserVisiting']==$_SESSION['iSMuIdKey']){
								 $idUserVisiting=$_SESSION["iSMuIdKey"];
							 }else{
								 $idUserVisiting=$_SESSION["idUserVisiting"];
							 }
							 
							 if(!isset($_SESSION['idProfileVisiting']) || $_SESSION['idProfileVisiting']==0 || $_SESSION['idProfileVisiting']==$_SESSION['iSMuProfTypeKey']){
								 $idProfileVisiting=$_SESSION["iSMuProfTypeKey"];
							 }else{
								 $idProfileVisiting=$_SESSION["idProfileVisiting"];
							 }
							
							 ?>
						  

							
						   <!-------------------- Video rates ------------------------->
						   <div id="voteRatesLoader">
						  
							  <script type="text/javascript">
							    ///ratesVote///
								rPuV=new Array();
								rPuV.push('<? echo base64_encode($idProfileVisiting); ?>');
								rPuV.push('<? echo base64_encode($idUserVisiting); ?>');
								rPuV.push('<? echo base64_encode(0); ?>');
								
								ratesVote(rPuV);
							 </script>
						  </div>
							
							
							<!---------------- vote rates loader---------------->
							
							
							<?
							if($idProfileVisiting>1 && $idProfileVisiting<7){

								$showVoteViews='style="display:block;"';	
							}else{
								$showVoteViews='style="display:none;"';	
							}
							?>
						
						 <div id="voteRates" <? echo $showVoteViews; ?>>
						 	
							<span class="subtitlesLC paddingLC"><? print $_IDIOMA->traducir("Video Stats"); ?></span>
						
						<table border="1" bordercolor="#b8b8b8" cellpadding="5px" cellspacing="0" style="color:#000000;margin-top: 10px;vertical-align: middle;text-align: center;margin-bottom: 15px;border-bottom: 0;" align="center" width="100%">
							<tr>
								<td>
								<? print $_IDIOMA->traducir("Views"); ?>
								</td>
								<td>
								<? print $_IDIOMA->traducir("Votes"); ?>
								</td>
								<td>
								<? print $_IDIOMA->traducir("Points"); ?>
								</td>
							</tr>
							<tr>
								<td>
								<img src="img/views.png">
								</td>
								<td>
								<img src="img/votos.png">
								</td>
								<td>
								<img src="img/points.png">
								</td>
							</tr>
							<tr class="darkgreen">
								<td colspan="3">
								<? print $_IDIOMA->traducir("Players"); ?>
								</td>
							</tr>
							<tr>
								<td>
								<? print $_IDIOMA->traducir("Views"); ?>
								</td>
								<td>
								<? print $_IDIOMA->traducir("Votes"); ?>
								</td>
								<td>
								<? print $_IDIOMA->traducir("Points"); ?>
								</td>
							</tr>
							<tr id="plNum">
								<td>
								0
								</td>
								<td>
								0
								</td>
								<td>
								0
								</td>
							</tr>
							<tr class="orange">
								<td colspan="3">
								<? print $_IDIOMA->traducir("Coaches"); ?>
								</td>
							</tr>
							<tr>
								<td>
								<? print $_IDIOMA->traducir("Views"); ?>
								</td>
								<td>
								<? print $_IDIOMA->traducir("Votes"); ?>
								</td>
								<td>
								<? print $_IDIOMA->traducir("Points"); ?>
								</td>
							</tr>
							<tr id="coNum">
								<td>
								0
								</td>
								<td>
								0
								</td>
								<td>
								0
								</td>
							</tr>
							<tr class="darkorange">
								<td colspan="3">
								<? print $_IDIOMA->traducir("Agents"); ?>
								</td>
							</tr>
							<tr>
								<td>
								<? print $_IDIOMA->traducir("Views"); ?>
								</td>
								<td>
								<? print $_IDIOMA->traducir("Votes"); ?>
								</td>
								<td>
								<? print $_IDIOMA->traducir("Points"); ?>
								</td>
							</tr>
							<tr id="agNum">
								<td>
								0
								</td>
								<td>
								0
								</td>
								<td>
								0
								</td>
							</tr>
							<tr class="red">
								<td colspan="3">
								<? print $_IDIOMA->traducir("Scoutings"); ?>
								</td>
							</tr>
							<tr>
								<td>
								<? print $_IDIOMA->traducir("Views"); ?>
								</td>
								<td>
								<? print $_IDIOMA->traducir("Votes"); ?>
								</td>
								<td>
								<? print $_IDIOMA->traducir("Points"); ?>
								</td>
							</tr>
							<tr id="scNum">
								<td>
								0
								</td>
								<td>
								0
								</td>
								<td>
								0
								</td>
							</tr>
							<tr class="darkred">
								<td colspan="3">
								<? print $_IDIOMA->traducir("Sport Directors"); ?>
								</td>
							</tr>
							<tr>
								<td>
								<? print $_IDIOMA->traducir("Views"); ?>
								</td>
								<td>
								<? print $_IDIOMA->traducir("Votes"); ?>
								</td>
								<td>
								<? print $_IDIOMA->traducir("Points"); ?>
								</td>
							</tr>
							<tr id="maNum">
								<td>
								0
								</td>
								<td>
								0
								</td>
								<td>
								0
								</td>
							</tr>
							<tr class="violet">
								<td colspan="3">
								<? print $_IDIOMA->traducir("Lawyers"); ?>
								</td>
							</tr>
							<tr>
								<td>
								<? print $_IDIOMA->traducir("Views"); ?>
								</td>
								<td>
								<? print $_IDIOMA->traducir("Votes"); ?>
								</td>
								<td>
								<? print $_IDIOMA->traducir("Points"); ?>
								</td>
							</tr>
							<tr id="laNum">
								<td>
								0
								</td>
								<td>
								0
								</td>
								<td>
								0
								</td>
							</tr>
							<tr class="lightblue">
								<td colspan="3">
								<? print $_IDIOMA->traducir("Journalists"); ?>
								</td>
							</tr>
							<tr>
								<td>
								<? print $_IDIOMA->traducir("Views"); ?>
								</td>
								<td>
								<? print $_IDIOMA->traducir("Votes"); ?>
								</td>
								<td>
								<? print $_IDIOMA->traducir("Points"); ?>
								</td>
							</tr>
							<tr id="joNum">
								<td>
								0
								</td>
								<td>
								0
								</td>
								<td>
								0
								</td>
							</tr>
							<tr class="gray">
								<td colspan="3">
								<? print $_IDIOMA->traducir("TOTAL"); ?>
								</td>
							</tr>
							<tr>
								<td>
								<? print $_IDIOMA->traducir("Views"); ?>
								</td>
								<td>
								<? print $_IDIOMA->traducir("Votes"); ?>
								</td>
								<td>
								<? print $_IDIOMA->traducir("Points"); ?>
								</td>
							</tr>
							<tr id="total">
								<td>
								0
								</td>
								<td>
								<strong>
								0
								</strong>
								</td>
								<td>
								0
								</td>
							</tr>
						</table>
						
						 
						 </div>
						 
						 <!---------------------------- close voteRates -------------------------------------------> 
						 <!--close voteRates--> 