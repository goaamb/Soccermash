<? require_once('../../lib/site_ini.php'); ?>
<div id="helpsection">

<div id="tophelp">
<h2><? print $_IDIOMA->traducir("About"); ?></h2>
</div>
 <span><a class="onright" id="closingHlp" title="Close help"><? print $_IDIOMA->traducir("Close"); ?></a></span>
  <div id="central">
      <div class="helpitem">
      	<span class="holdtitle" title="visible">
          <span class="title">
            <span></span>
              <? print $_IDIOMA->traducir("About"); ?></span>
           <span id="visible" class="more"></span>
        </span>
        
        	<div class="holdcontent visible"><p><? print $_IDIOMA->traducir("SOCCERMASH.com – The premier social network for professional soccer players.

If you are a soccer player, amateur player, ex-player, sport director, coach, agent, scouting, lawyer, sport doctor, sport journalist, or if you just are a real soccer fan… this is your place.

SOCCERMASH.com was born with the idea of helping thousands or millions of feminine and male players who are constantly searching the opportunity in major leagues, or just making contacts for a lifetime. It is also a place to find and create professional and business opportunities related to soccer.

If you are a soccer player and you are looking for great agents, coaches and clubs to contact you, you can upload some videos and ensure that they see you play through an extensive multimedia gallery shared by the entire network. The more times get your videos voted by users, the more chances you will have to be seen and booked, and your video will come up of position on the multimedia gallery. You will have a statistical measure to find out if a professional agent has voted or seen your video.

If you are an agent you can find players by ending contract date, age, position, club, country, city and much more, and specially, to have classified in one place videos daily ranked of new players.

If you really like to know about soccer, you will have access of the unique soccer encyclopedic database and in constant growth uploaded by the users because the players profiles are updated by the users themselves, and you are already part of this big encyclopedia! Also you can create your own profiles and edit your favorite players.

SOCCERMASH.com is the premier open worldwide encyclopedia of soccer and you will be a part of it just by registering.

This web site, is created for us; who one day laugh, rejoice and another suffer and even cry, and share the same feeling and passion which is more than a sport, called SOCCER.
</p>
        	  <p></p>
        	  <p>\"Where is that player who became my friend during my neighborhood soccer team in my youth? What ever happened to that team mate you didn´t like in your first professional team, but whom you learned so much from?

Or your first coach? Or that person who believed in you that today would be a kind of Sport Director?

As a result of these questions SOCCERMASH.com was born, with the idea of helping all those hundreds, thousands or millions of players, which constantly send e-mails, resumes or links to videos, of players, begging for a chance, a test... Something.

This web site, is created for us; who one day laugh, rejoice and another suffer and even cry.

For us, who live a life in this, called SOCCER.

For us it's just life.\"

For all of us!"); ?></p>
</div>
      </div><!--END helpitem-->
      
     
      
     

	</div><!--END central-->
</div>
<div class="cleared"></div>
<script>
$(document).ready(function(){
$('.holdtitle').click(function(){
							//alert('llama');
							var a = $(this).attr('title');
							//alert('valor a:' + a);
							var innerCont = $('.'+a);
							//alert('innercont:' + innerCont);
							innerCont.slideToggle('fast');
							var t = '#'+a; 
							//alert(t);
							$(''+t+'').toggleClass('open');
							
							$('help').height($('help').height('helpsection'));
});


$('#closingHlp').click(function(){
							 $('#help').fadeOut(); 	
							 return false;													 
});
});
</script>