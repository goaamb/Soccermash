
<script>
var lorem = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vulputate metus ut lacus lacinia condimentum. Cras convallis fermentum ante, id mattis sem egestas at. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec in sollicitudin leo. Phasellus dapibus lobortis mollis. Praesent pretium blandit lacus, a vulputate nibh laoreet ac. Praesent rutrum convallis neque vitae consectetur."; 
</script>

<div id="wall">
<div id="writeArea"><textarea class="writeWall" id="wrtMain" title="Write a public message in this wall" name="writeWall">Write a public message in this wall</textarea>
<input type="submit" value="PUBLISH" name="#" id="#"  />
</div>

<div id="holdComments">
	<div id="wallBar"><span>Wall</span></div>
  
  <!--////-->
  <div class="individualComm">
	<div class="photoSpeaker">
                <img src="img/userLoginPage/photo2.jpg" width="51" height="51" title="user name" alt="#" />
     </div><!--photoSpeaker-->
     <div class="mainContent">
	 <span class="deleteThis" title="Delete this comment"></span>
                     <div class="name">User Name</div>
                     <div class="wrotte"> 
                     <script>document.write(lorem);</script>
                     </div>
                     <div class="commenTools">
                     	<span class="date">DD/MM/AAAA - HH:MM |</span>
                     	<span class="addComment"><a href="#" title="Add a comment"> Comment |</a></span>
                     	<span class="icheck" title="Check this comment"></span>
    </div><!--commenTools-->
                     
                     <div class="whoCheck">
                     <span class="imgCheck" title="Who checked it?"></span>
                     <p><a class="linkWall" title="See this profile">You</a> and <a class="linkWall" title="See this profile">$user</a> checked it.</p></div><!--whocheck-->
                     
                     <div class="seeComments">
                     <span class="imgComment" title="See all comments"></span>
                     <p><a class="linkWall" title="Show all comments for this post">See others $N comments.</a></p>
                     </div><!--seecomments-->
 
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
													 <script>document.write(lorem);</script>
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
                     
                    <div class="writeAnswer">
                    	<div id="writeArea">
												<textarea  title="Write a comment" class="yourAnswer" id="wrtSec"  name="writeAnswer">Write a comment and press Enter to publish</textarea>
											</div>
                    </div><!--writeAns--> 
    </div><!--maincontent--> 
    <div class="setClear"></div>                
  </div><!--individualComm-->
  <!--////-->
  
    
  
</div><!--holdComments-->
<div id="seePrevious"><p><a title="See previous messages" href="#">Previous</a></p></div>

</div><!--END wall-->
