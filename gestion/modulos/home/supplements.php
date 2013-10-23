<div id="msgSender">

<h2 id="emailTitle"><? print $_IDIOMA->traducir("Message"); ?></h2>
<div>
  <form id="emailSender" method="">
    <!-- 	
    <div>
    <label for="destineMail">To:</label><input id="destineMail" type="text" disabled="disabled" title="Sending to..." />
    </div>
    -->
    <div>
    <textarea id="bodyMsg" name="bodyMsg" title="<? print $_IDIOMA->traducir("Text of message"); ?>"></textarea>
    </div>
    <div>
    <input  type="button"  id="sendEmail" value="<? print $_IDIOMA->traducir("SEND"); ?>" alt="<? print $_IDIOMA->traducir("SEND"); ?>" onclick="JS_enviarMsj(); return false;"/>
    <!-- <input id="dontSend" type="button" value="CANCEL" /> -->
    </div>
  </form>
</div>
<div style="clear:both;width: 100%;"></div>
</div>

<div id="msgViewer">

<h2 id="emailTitle"><? print $_IDIOMA->traducir("Messages received"); ?></h2>
<ul id="msgThread">



<?php

 $i=1;
 foreach($aCantMsj as $aMsj){	#msj sin leer
	$iIdOtherUserSend=$aMsj['idUserSend'];
 ?>
  <li>
  	<div class="eachMsg">

  	<div class="photoCol"><img src="photoGeneral/small/small_photoPerfil_SM_<?php echo $aMsj['idUserSend'];?>" width="51" height="51" title="<?php echo $aNamesSend[$i-1]?>" alt="#" /></div>
      <div class="txtCol">
      	<div id="msg<?php echo $i;?>" class="headerMsg">
		<form id="msg<?php echo $i;?>" >
			<div class="from">From: <?php echo $aNamesSend[$i-1]. ' '.$aApesSend[$i-1];?></div>
	     			<!--<div class="subject">Subject</div>-->
			<input  type="hidden" name="kleyDcSEJSud"  value="<?=$aMsj['idMsj'];?>"/>
			<input type="hidden" name="TleyRcPkSpUuE" value="msjo" />
		</form>	
        </div>
		<div class="msgholder msg<?php echo $i;?>"><?php echo $aMsj['txtMsj'];?>
       
 	    <span id="reply<?php echo $i;?>" class="replyMsg"><? print $_IDIOMA->traducir("Reply"); ?></span>
            <div id="divReply<?php echo $i;?>" class="replySender reply<?php echo $i;?>">
            <div>
          	<label for="bodyMsg2"><? print $_IDIOMA->traducir("Reply"); ?>:</label>
	   	<form id="replyMsjSender" method="">
		    <input  type="hidden" name="kleyRcEkSmUud" value="<?=$aMsj['idUserSend'];?>"/>
		    <input  type="hidden" name="kleyMcSkJmud"  value="<?=$aMsj['idMsj'];?>"/>	
		    <input class="idMsgSaw" type="hidden" name="divReply" value="<?php echo 'divReply'.$i;?>"/>
        
		    <textarea id="bodyMsg2" name="bodyMsg2" title="<? print $_IDIOMA->traducir("Text of message"); ?>"></textarea>
	    </div>
		    <div>
		    <input  type="button"  id="sendEmail2" value="<? print $_IDIOMA->traducir("SEND"); ?>" alt="<? print $_IDIOMA->traducir("SEND"); ?>" onclick="JS_enviarReplyMsj(); return false;"/>
            <!--<input id="dontSend2" type="button" value="CANCEL" />-->
	   </form>
            </div>
        </div><!--replySender-->
        </div><!--msgholder-->
      </div>
  	</div>  
  </li>
 <?php $i++;}#foreach

 foreach($aCantRta as $aRta){	#msj de rta sin leer
	$iIdOtherUserReply=$aRta['idUserReply'];
 ?>
  <li>
  	<div class="eachMsg">

  	<div class="photoCol"><img src="photoGeneral/small/small_photoPerfil_SM_<?php echo $aRta['idUserReply'];?>" width="51" height="51" title="<?php echo $aNamesSend[$i-1]?>" alt="#" /></div>
      <div class="txtCol">
      	<div id="msg<?php echo $i;?>" class="headerMsg">
	    <form id="msg<?php echo $i;?>" >
        	<div class="from"><? print $_IDIOMA->traducir("Reply From"); ?>: <?php echo $aNamesSend[$i-1]. ' '.$aApesSend[$i-1];?></div>
     			<!--<div class="subject">Subject</div>-->
		<input type="hidden" name="kleyDcSEJSud" value="<?=$aRta['idMsjReply'];?>" />
		<input type="hidden" name="TleyRcPkSpUuE" value="rply" />
            </form>
        </div>
		<div class="msgholder msg<?php echo $i;?>"><?php echo $aRta['txtMsjReply'];?>
       
 	    <span id="reply<?php echo $i;?>" class="replyMsg"><? print $_IDIOMA->traducir("Reply"); ?></span>
            <div id="divReply<?php echo $i;?>" class="replySender reply<?php echo $i;?>">
            <div>
          	<label for="bodyMsg2"><? print $_IDIOMA->traducir("Reply"); ?>:</label>
	   <form id="replyMsjSender" method="">
		    <input type="hidden" name="kleyRcEkSmUud" value="<?=$aRta['idUserReply'];?>" />
		    <input type="hidden" name="kleyMcSkJmud"  value="<?=$aMsj['idMsjSent'];?>"   />	
		    <input type="hidden"  name="divReply"     value="<?php echo 'divReply'.$i;?>"/>
		    <textarea id="bodyMsg2" name="bodyMsg2" title="<? print $_IDIOMA->traducir("Text of message"); ?>Text of message"></textarea>
	    				</div>
		    <div>
		    <input  type="button"  id="sendEmail2" value="<? print $_IDIOMA->traducir("SEND"); ?>" alt="<? print $_IDIOMA->traducir("SEND"); ?>" onclick="JS_enviarReplyMsj(); return false;"/>
           <!-- <input id="dontSend2" type="button" value="CANCEL" />-->
	   </form>
            </div>
        </div><!--replySender-->
        </div><!--msgholder-->
      </div>
  	</div>  
  </li>






 <?php $i++;}#foreach?> 
</ul>
</div>



<div id="errorRep">
	<h2 id="emailTitle"><? print $_IDIOMA->traducir("Report an error"); ?><!--<span id="errorIcon"></span>--></h2>
<div>
  <form id="errorReport" method="">
    <div id="msjErrorReport">
    <p><? print $_IDIOMA->traducir("Hello! If you have found an error in this social network, please let us know and we will evaluate the case to resolve it. Thank you!"); ?>. </p>
    </div>
    <div>
    <label for="bodyError"><? print $_IDIOMA->traducir("Please, write the issue below:"); ?>:</label><textarea id="bodyError" name="bodyError" title="<? print $_IDIOMA->traducir("Thanks for helping to improve your network!"); ?>"></textarea>
    </div>
    <div>
    <input  type="button"  id="sendEmail" value="<? print $_IDIOMA->traducir("SEND"); ?>" alt="<? print $_IDIOMA->traducir("SEND"); ?>" onclick="JS_enviarError(); return false;"/>
    <!--<input id="dontSend" type="button" value="CANCEL" />-->
    </div>
  </form>
</div>
<div style="clear:both;width: 100%;"></div>
</div>
