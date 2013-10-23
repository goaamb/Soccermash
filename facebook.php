 <?php
	$cache_expire = 60 * 60 * 24 * 365;
	header ( "Pragma: public" );
	header ( "Cache-Control: max-age=" . $cache_expire );
	header ( 'Expires: ' . gmdate ( 'D, d M Y H:i:s', time () + $cache_expire ) . ' GMT' );
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/css; charset=utf-8" />
<script src="http://connect.facebook.net/en_US/all.js"></script>

</head>
<body>
	<div id="fb-root"></div>
	<script>
  window.fbAsyncInit = function() {
	  FB.init({
		     appId      : '282708345122917',
		     channelUrl : 'http://www.soccermash.com/facebook.php', 
		     status     : true, 
		     cookie     : true, 
		     xfbml      : true
		   });
	  FB.login(function(response) {
		   if (response.authResponse) {
			   
		   } else {
		     console.log('User cancelled login or did not fully authorize.');
		   }
		 }, {scope: 'email'});
	  
  };

  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     d.getElementsByTagName('head')[0].appendChild(js);
   }(document));
 function fql(query){
	 FB.api(
			  {
			    method: 'fql.query',
			    query: query//'SELECT aid FROM album WHERE owner=me()'
			  },
			  function(response) {
				  if(response && response.length>0){
					  for ( var i = 0; i < response.length; i++) {
						  console.log(response[i]);	
					}
			    	
				  }else{
					  console.log("error")
					  }
			  }
			);
	 }

 </script>
 <textarea onblur="fql(this.value)"></textarea>
</body>
</html>