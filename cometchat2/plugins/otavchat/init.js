<?php
		if (file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR."lang/".$lang.".php")) {
			include dirname(__FILE__).DIRECTORY_SEPARATOR."lang/".$lang.".php";
		} else {
			include dirname(__FILE__).DIRECTORY_SEPARATOR."lang/en.php";
		}

		foreach ($otavchat_language as $i => $l) {
			$otavchat_language[$i] = str_replace("'", "\'", $l);
		}
?>

/*
 * CometChat
 * Copyright (c) 2011 Inscripts - support@cometchat.com | http://www.cometchat.com | http://www.inscripts.com
*/

(function($){   
  
	$.ccotavchat = (function () {

		var title = '<?php echo $otavchat_language[0];?>';
		var lastcall = 0;

        return {

			getTitle: function() {
				return title;	
			},

			init: function (id) {
				var currenttime = new Date();
				currenttime = parseInt(currenttime.getTime()/1000);
				if (currenttime-lastcall > 10) {
					baseUrl = $.cometchat.getBaseUrl();
					$.post(baseUrl+'plugins/otavchat/index.php?action=request', {to: id});
					lastcall = currenttime;
				} else {
					alert('<?php echo $otavchat_language[1];?>');
				}
			},

			accept: function (id,grp) {
				baseUrl = $.cometchat.getBaseUrl();
				$.post(baseUrl+'plugins/otavchat/index.php?action=accept', {to: id,grp: grp});
				var w = window.open (baseUrl+'plugins/otavchat/index.php?action=call&grp='+grp, 'audiovideochat',"status=0,toolbar=0,menubar=0,directories=0,resizable=1,location=0,status=0,scrollbars=0, width=300,height=330"); 
				w.focus();
			},

			accept_fid: function (id,grp) {
				baseUrl = $.cometchat.getBaseUrl();
				var w =window.open (baseUrl+'plugins/otavchat/index.php?action=call&grp='+grp, 'audiovideochat',"status=0,toolbar=0,menubar=0,directories=0,resizable=1,location=0,status=0,scrollbars=0, width=300,height=330");
				w.focus();
			}

        };
    })();
 
})(jqcc);