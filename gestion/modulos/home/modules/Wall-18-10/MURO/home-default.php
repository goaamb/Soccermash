<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('gestion/modulos/home/head.php'); ?>

</head>
<body >

    <div id="header">
			<?php include('gestion/modulos/home/tprgtmenu.php'); ?>
  	</div><!--END header-->
      
    <div id="holder">
    	<div id="news">
        <span>Here the news rss</span>
     	  <div><span id="mobil"></span><span id="world"></span></div>
      </div><!--END news-->
    		
<!--------------------------------------------->         
        <div id="leftcolumn">
          <?php include('gestion/modulos/home/maquetacion/photoprofile.php');?>
          <?php include('gestion/modulos/home/menuprofile.php');?>
          <?php include('gestion/modulos/home/maquetacion/followers.php');?>
          <?php include('gestion/modulos/home/votesviews.php');?>
        </div><!--END leftcolumn-->
        
<!--------------------------------------------->        
        <div id="centralcolumn">
        	 <?php include('gestion/modulos/home/maquetacion/idprofile.php');?>
					 <?php include('gestion/modulos/home/slidemultimedia.php');?>

           <!-- ////////////////////// VIDEO PLAYER ////////////////////////////// -->				 
					 <div id="videoPlayer"><a class="onright closer" href="#">Close</a>
                  112345464654
           
      <!--Eliminar este link al integrar, ya que queda el que se carga desde videoPlayer.php--></div>  
      <!-- ////////////////////// VIDEOS ////////////////////////////// -->
					    <div id="delVideo"></div>	
			    <div id="videoProfile">
						<script type="text/javascript">
                    function loadVideos(){
                    var idUser=<? echo $_SESSION["iSMuIdKey"]; ?>;
                    var idProfile=<? echo $_SESSION["iSMuProfTypeKey"]; ?>;
                    var idUserVisiting=<? echo $idUserVisiting; ?>;
                    var idProfileVisiting=<? echo $idProfileVisiting; ?>;
                    $("#videoProfile").html('<img src="img/indicator.gif"/>');
                    $("#videoProfile").load('gestion/modulos/video/view/videoTester.php',{page:1,idUserVisiting:idUserVisiting,idProfileVisiting:idProfileVisiting,idUser:idUser,idProfile:idProfile});
                    }
                    loadVideos();
                  </script>
				  </div>
           <?php include('gestion/modulos/home/perfil/maquetacion/perf.player.php');?>
           <?php include('gestion/modulos/home/modules.php');?>
           <?php include('gestion/modulos/home/wall.php');?>
           <div id="results"></div>	
        </div><!--END centralcolumn-->
<!--------------------------------------------->         
        <div id="rightcolumn">
        		<div id="internalNews">
                  <span>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. 
                  </span>
                </div><!--close internalNews-->
                
                <div id="search">
                	<?php include('gestion/modulos/home/search.php');?>	
        				</div><!--close search-->
                
                <div id="latestPeople">
                		<?php include('gestion/modulos/home/latestpeople.php');?>
       					 </div><!--close latestPeople-->
       		         
                <div id="sugestedPeople">
                  	<?php include('gestion/modulos/home/sugestedpeople.php');?>
        				</div><!--close sugestedPeople-->
                
                <div id="advertising">
                  <?php include('gestion/modulos/home/advertising.php');?>
                  <?php include('gestion/modulos/home/advertising.php');?>
                  <span><a class="onright" href="#">Create an add</a>
                  <hr />
                	</span>
                </div><!--close advertising-->
      
                <div id="sponsoredBy">
                  <?php include('gestion/modulos/home/sponsored.php');?>
                </div><!--close sponsoredby-->  
        
        </div><!--END rightcolumn-->
        <div class="cleared"></div> 
    </div><!--END holder-->
        <div id="footer">
          <?php include('gestion/modulos/home/footer.php');?>
        </div><!--END footer-->
        <div id="help"></div>
</body>
<span style="display:none;" title="precharge">
<img src="img/videoOn.jpg" width="20" height="20"/>
<img src="img/photoOn.jpg" width="20" height="20"/>
<img src="img/audioOn.jpg" width="20" height="20"/>
<img src="img/notesOn.jpg" width="20" height="20"/>

</span>
</html>
