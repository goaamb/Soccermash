<!--    <p>1. Select the profile type</p>
    <ul id="searchSelectorStp1">
    <input type="hidden" value="" name="storeSelectADVProfile" id="storeSelectADVProfile"  />-->
    <!--js set in hidden input the ID of selected option. Find "searcher select" at scripts.js-->
   <!-- <li id="visibleAreaStp1"><a id="showSelectionStp1" href="#">Available profiles...</a>
        <ul>
          <li><a  id="1">Player</a></li>
          <li><a  id="2">Coach</a></li>
          <li><a  id="3">Agent</a></li>
          <li><a  id="4">Scout</a></li>
          <li><a  id="5">Lawyer</a></li>
          <li><a  id="6">Sport Health</a></li>
          <li><a  id="7">Sport Director</a></li>
          <li><a  id="8">Fan</a></li>
          <li><a  id="9">Journalist</a></li>
        </ul>
      </li>
    </ul>

<script type="text/javascript">
	$(document).ready(function(){
			//search profile
		$('#showSelectionStp1').click(function(){
								$('#visibleAreaStp1 ul').toggle();											 
																			 });
		$('#searchSelectorStp1').mouseleave(function(){
											$('#visibleAreaStp1 ul').hide();							
																				});
		$('#visibleAreaStp1 ul li a').click(function(){																	 
		var idSelected = $(this).attr('id');
		var txtSelected = $(this).text();
		$('#storeSelectADVProfile').val(idSelected);
		$('#showSelectionStp1').text(txtSelected);
		$('#visibleAreaStp1 ul').toggle();

	switch (idSelected){
		case '1':
		$('#searchStep2').load('gestion/modulos/home/searchplayer.php');
		break;
		case '2':
		$('#searchStep2').load('gestion/modulos/home/searchcoach.php');
		break;
		case '3':
		$('#searchStep2').load('gestion/modulos/home/searchagent.php');
		break;
		case '4':
		$('#searchStep2').load('gestion/modulos/home/searchscout.php');
		break;
		case '5':
		$('#searchStep2').load('gestion/modulos/home/searchlawyer.php');
		break;
		case '6':
		$('#searchStep2').load('gestion/modulos/home/searchspthealth.php');
		break;
		case '7':
		$('#searchStep2').load('gestion/modulos/home/searchsptdirector.php');
		break;
		case '8':
		$('#searchStep2').load('gestion/modulos/home/searchfan.php');
		break;
		case '9':
		$('#searchStep2').load('gestion/modulos/home/searchjournalist.php');
		break;
		}
		});
	});
</script>-->