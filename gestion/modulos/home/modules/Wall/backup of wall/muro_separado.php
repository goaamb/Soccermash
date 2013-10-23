
///////////////////////////ESTRUCUTRA GENERAL NO SE REPITE////////////////////////////////
<div id="wall">
<div id="writeArea"><textarea rows="auto" class="writeWall" id="wrtMain" title="Write a public message in this wall" name="writeWall">Write a public message in this wall</textarea>
<input type="submit" value="PUBLISH" name="#" id="#"  />
</div>

<div id="holdComments">
	<div id="wallBar"><span>Wall</span></div>
  
   <!--ACA CARGA EL CONTENIDO DINAMICO-->
  
    
  
</div><!--holdComments-->

<!--ACA LLAMADA A PREVIOUS-->

</div><!--END wall-->
  
//////////////////////END//////////////////////////////////////////////////////////////




//////////////////////////////////PREVIOUS//////////////////////////////////

<div id="seePrevious"><p><a title="See previous messages" href="#">Previous</a></p></div>  

/////////////////////////////END/////////////////////////////////////





////////////////////////CONTENIDO DINAMICO//////////////////////////

///////////////////////////CODIGO DE MENSAJE EN EL MURO///////////////////////////
 <!--////-->
  <div class="individualComm">
  	 <div class="photoSpeaker">
                <img src="img/userLoginPage/photo2.jpg" width="51" height="51" title="user name" alt="#" />
     </div><!--photoSpeaker-->
     <div class="mainContent">
     								 <span class="deleteThis" title="Delete this comment"></span> 
                     <div class="name">User Name</div>
                     <div class="wrotte">
                     	<!---ACA CARGA TEXTO DEL MENSAJE PRINCIPAL-->
                     </div><!--END WROTTE-->
                     
                     <div class="commenTools">
                     	<span class="date">DD/MM/AAAA - HH:MM |</span>
                     	<span class="addComment"><a href="#" title="Add a comment"> Comment |</a></span>
                     	<span class="icheck" title="Check this comment"></span>
    								 </div><!--commenTools-->
                     
                     <!--ACA LLAMA A WHO CHECK--->
                     
                     
                     
                     <!---ACA LLAMA A SEE COMMENTS--->
                     
 											
                      <!---ACA LLAMA A ANSWER--->
 										
                     
                    <!--ACA LLAMA A WRITEANSWER, 2 TEXTAREA-->
                    
                    
    </div><!--maincontent--> 
    <div class="setClear"></div>                
  </div><!--individualComm-->
  <!--////-->
  
///////////////////////////END CODIGO DE MENSAJE EN EL MURO///////////////////////////





////////////////////WHO CHECK//////////////////////////
<div class="whoCheck">
	<span class="imgCheck" title="Who checked it?"></span>
	<p><a class="linkWall" title="See this profile">You</a> and <a class="linkWall" title="See this profile">$user</a> checked it.</p>
</div><!--whocheck-->
/////////////////END WHO CHECK////////////////////




///////////////SEE COMMENTS////////////////////
<div class="seeComments">
	<span class="imgComment" title="See all comments"></span>
	<p><a class="linkWall" title="Show all comments for this post">See others $N comments.</a></p>
</div><!--seecomments-->
////////////////////////END SEE COMMENTS///////////////






///////////////////////////ANSWER////////////////////////////
<div class="answer">
<!---------------------------------------------------------------->
<div class="SUBindividualComm">
  <div class="photoSpeaker pSSUB">
    <img src="img/userLoginPage/photo2.jpg" width="51" height="51" title="user name" alt="#" />
  </div><!--photoSpeaker-->
  <div class="mainContent mCSUB">
    <span class="deleteThis2" title="Delete this comment"></span> 
    <div class="name">User Name</div>
    <div class="wrotte"> 
       <!--TEXTO DE LA RESPUESTA-->
    </div>
    <div class="commenTools">
      <span class="date">DD/MM/AAAA - HH:MM |</span>
      <span class="addComment"><a href="#" title="Add a comment"> Comment |</a></span>
      <span class="icheck" title="Check this comment"></span>
    </div>
  </div><!--SUBmainContent-->
</div><!--SUBindividualComm-->
<!---------------------------------------------------------------->
</div><!--answer-->

//////////////////////////END ANSWER////////////////////////






//////////////////////WRITEANSWER////////////////////////
<div class="writeAnswer">
<div id="writeArea">
  <textarea  title="Write a comment" class="yourAnswer" id="wrtSec"  name="writeAnswer">Write a comment and press Enter to publish</textarea>
  <div class="spacer"></div>
</div>
</div><!--writeAns--> 
///////////////////////END WRITEANSWER///////////////



