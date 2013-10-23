<?php  error_reporting(0); ?>
<script type="text/javascript" src="css_browser_selector.js"></script>
<script type="text/javascript" src="css/stylesForLogin.css"></script>


<style type="text/css">
.chrome #newUser select optgroup {
        background-color:#6c9679;
        color:white; 
       }
       .chrome option{
        color:#000000;
       }
       .gecko #newUser select optgroup {
        background-color:#6c9679;
        color:white;
       }
       .gecko option{
        color:#000000;
        background-color:#FFFFFF;
       }
       .ie #newUser select optgroup {
        background-color:#6c9679;
        color:white;
       }
       .ie option{
        color:#000000;
        background-color:#FFFFFF;
       }
       .opera #newUser select optgroup {
        color:#6c9679;
       }
       .opera option{
        color:#000000;
        background-color:#FFFFFF;
       }
       .safari #newUser select optgroup {
        color:white;#6c9679;
        background-color:#6c9679;
       }
       .safari option{
        color:#000000;
        background-color:#FFFFFF;
       }

input{
font-family:Verdana;
color:grey;
font-size:12px;
}

#profiletype{
font-family:Verdana;
color:grey;
font-size:12px;
}


#signUpBttn{
background:url(../img/boton-sign-up-reposo.png)  50% 50% repeat-x;
color:#666666;
height:28px;
text-align:center;
border:0px;
float:right;
width:64px;
margin-right:4px;
}
#signUpBttn:hover{
background:url(../img/boton-sign-up-over.png) 50% 50% repeat-x;
border:0px;
margin-right:7px;
}

</style>


<script type="text/javascript" src="js/jquery.js"></script>
<script>




        



$(document).ready(function(){
	//alert("asd");
var seleccion;
 $("select").change(function () {
          seleccion = 'cambio';
 })
		
		$('#signUpBttn').click(function() {
		//alert("clikeaste");
		
		if(seleccion == 'cambio'){
		//	alert(seleccion);
		}else{
			alert("Please select your profile");
			return (false);
		}
		
		if($("#firstName").val().length == 0){
		alert("Please enter your name");
		return (false);
		}
		if($("#lastName").val().length == 0){
		alert("Please enter your last name");
		return (false);
		}
		if($("#emailNewUser").val().length == 0){
		alert("Please enter your email");
		return (false);
		}
		if($("#repeatEmail").val().length == 0){
		alert("Please repeat your email");
		return (false);
		}
		if($("#repeatEmail").val() != $("#emailNewUser").val()){
		alert("The emails must match");
		return (false);
		}		
		if($("#newUserPass").val().length == 0){
		alert("You must enter a password");
		return (false);
		}
	})
	/*$("#signUpBttn").click(function(){
		alert("Enviando");
	});
	*/
	//if($("#firstName").val().length == 0 && $("#lastName").val().length == 0 && $("#emailNewUser").val().length == 0 && $("#repeatEmail").val().length == 0 && $("#newUserPass").val().length == 0 && $("#newUserPass").val().length == 0){
	
	})
</script>

<?php

$val1=$_REQUEST['profiletype'];
$val2=$_REQUEST['name'];
$val3=$_REQUEST['surename'];
$val4=$_REQUEST['email'];
$val5=$_REQUEST['email2'];
$val6=$_REQUEST['password'];



$vieneraiz = 1;
require_once ("searchown/comun.php");
function LoginForm($error = '') {
	
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>Soccermash login</title>

	<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>

	<script type="text/javascript" src="js/jquery-ui-1.8.11.custom.min.js"></script>

	<script src="js/scripts.js" type="text/javascript"></script>

	 <link href="css/custom-theme/jquery-ui-1.8.11.custom.css" rel="stylesheet" type="text/css" media="screen" />

	<link href="css/stylesForLogin.css" type="text/css" rel="stylesheet" media="screen" /> 

	 <link href="css/reset-min.css" type="text/css" rel="stylesheet" media="screen" />

	</head>



	<body>

		<div id="wrapper">	

			<img src="img/Banner.png" style="margin-left:12px; margin-top:10px;"/>

							<div id="newUser">

							<form id="formNewUser" action="http://www.soccermash.com/facebooklogin2.php" method="POST">          

       <table>

       

       <tr>

       <td></td>
        </tr>

   

       

       <td width="110" style="text-align:right"><label for="ProfileType">Profile Type</label></td>
 <span style="font-family:Helvetica;font-size:16;color:#999999;">'; if (! empty ( $error )) {
  
  echo $error ;
 
 }
 echo '</span>
       <td><select id="profiletype" name="profiletype" class="select inputbox">

         <option value="">Select</option>

			<optgroup label="Players">
				<option value="1">Players under contract</option>
				<option value="3">Players without contract</option>
				<option value="5">Woman players under contract</option>
				<option value="6">Woman players without contract</option>
				<option value="4">Amateur Players</option>

				<option value="7">Ex-players</option>
			</optgroup>
			<optgroup label="Coaches">
				<option value="8">Coaches under contract</option>
				<option value="9">Coaches without contract</option>
				<option value="29">Goalkeeper coaches</option>
				<option value="16">Physical trainers</option>

			</optgroup>
			<optgroup label="Agents">
				<option value="12">Licensed FIFA agents</option>
				<option value="28">UEFA Match agents</option>
				<!-- Andres Grosso -->
				<option value="10">Authorized agents</option>
			</optgroup>
			<optgroup label="Scouting">

				<option value="30">Scounting</option>
			</optgroup>
			<optgroup label="Lawyers">
				<option value="11">Lawyers</option>
			</optgroup>
			<optgroup label="Sport Management">
				<option value="13">Sport directors</option>

				<option value="14">Technical secretaries</option>
			</optgroup>
			<optgroup label="Sport Health">
				<option value="31">Sport doctors</option>
				<option value="15">Nutritionists</option>
				<option value="17">Massagists</option>
			</optgroup>

			<optgroup label="Fans">
				<option value="2">Fans</option>
			</optgroup>
		</select></td>
        </tr>

        <tr>

       <td width="110" style="text-align:right"><label for="firstName">First Name</label></td>

       <td><input type="text" value="'; echo $val2; 
       echo '" id="firstName" name="name" tabindex="" /></td>
        </tr>

        <tr>

       <td width="110" style="text-align:right"><label for="lastName">Last Name</label></td>

       <td><input type="text" value="'; echo $val3; 
       echo '"   id="lastName" name="surename" tabindex="" /></td>
        </tr>

        <tr>

       <td width="110" style="text-align:right"><label for="emailNewUser">Email</label></td>

       <td><input type="text"  value="'; echo $val4; 
       echo '"  id="emailNewUser" name="email" tabindex="" /></td>
        </tr>

        <tr>

       <td width="110" style="text-align:right"><label for="repeatEmail">Repeat your Email</label></td>

       <td><input type="text" value="'; echo $val5; 
       echo '"  id="repeatEmail" name="email2" tabindex="" /></td>
        </tr>

        <tr>

       <td width="110" style="text-align:right"><label for="newUserPass">Password</label></td>

       <td><input type="password" value="'; echo $val6; 
       echo '" id="newUserPass"  name="password" tabindex="" /></td>
        </tr>

        <tr>

       <td></td>

       <td><input type="submit"  name="register" id="signUpBttn" value="Sign Up"  alt="Sign Up" tabindex="" /></td>

       <td>&nbsp;</td>
        </tr>

         <tr>
<!-- <td colspan="2" style="color:grey">Why do I need to provide this?</td> -->

       <td class="tdWidth"></td>
        </tr>

        <tr>
       
       <td class="tdWidth" style="font-family:Verdana; font-size:12; font-weight:bold; color:#999999"><br /><br /> <br /><br /><br /><br />        </tr>
      </table>

      </form>

					</div>

		</div>

	</body>

	</html>';

}
if (isset ( $_POST ['register'] )) {
	
	$error = '';
	
	
	
	
	$name = $_POST ['name'];
	
	$surename = $_POST ['surename'];
	
	$email = $_POST ['email'];
	
	$email2 = $_POST ['email2'];
	
	if ($email != $email2)
		
		$error .= 'Emails diferentes<br />';
	
	$password = md5 ( $_POST ['password'] );
	
	$profiletype = $_POST ['profiletype'];
	
	$arreglo = array ($name, $surename, $email, $email2, $password, $profiletype );
	
	foreach ( $arreglo as $asd ) {
		
		if (empty ( $asd )) {
			
			$error = 'Debes completar todos los datos<br />';
			
			//echo "no guarda " . var_dump ( $arreglo );
		
		}
	
	}
	
	/*if(empty($_POST['termsOfUse'])){
	$error.='Debes aceptar terminos y condiciones de uso';
	}*/
	
	if (! empty ( $error )) {
		
		LoginForm ( $error );
	
	} else {
		$user = new JUser ();
		$authorize = &JFactory::getACL ();
		$document = &JFactory::getDocument ();
		$_POST ["password2"] = $_POST ["password"];
		$password=$_POST ["password"];
		$_POST ["username"] = $_POST ["email"];
		if (! $user->bind ( $_POST, 'usertype' )) {
			JError::raiseError ( 500, $user->getError () );
		}
		$user->set ( 'popup', '1' );
		$user->set ( 'id', 0 );
		$user->set ( 'facebook',1);
		$newUsertype = 'Registered';
		$user->set ( 'usertype', $newUsertype );
		$user->set ( 'gid', $authorize->get_group_id ( '', $newUsertype, 'ARO' ) );
		$date = &JFactory::getDate ();
		$user->set ( 'registerDate', $date->toMySQL () );
		if (! $user->save ()) {
			echo $user->getError ();
			return false;
		}
		$mainframe = &JFactory::getApplication ();
		$options = array ();
		$options ['remember'] = false;
		$options ['return'] = "";
		
		$credentials = array ();
		$credentials ['username'] = $_POST ["email"];
		$credentials ['password'] = $password;
		setcookie ( "noglobo", "", null, "/" );
		//preform the login action
		setcookie ( "globo", "1", null, "/" );
		//preform the login action
		$error = $mainframe->login ( $credentials, $options );
		if (! JError::isError ( $error )) {
			// Redirect if the return url is not registration or login
			$return = 'thanksfacebook.html';
			$mainframe->redirect ( $return );
		} else {
			$return = 'facebooklogin.php';
			$mainframe->redirect ( $return );
		}
		//echo "Guardado";
		/*
		mysql_connect ( "localhost", "socadmin", "rXTn%HIrBeRp" );
		mysql_select_db ( "socadmin_joom");
		$sql="INSERT INTO jos_user ('id','name','username','email','password','usertype','block','sendEmail','gid','registerDate','lastvisitDate','activation','params','profiletype','creado','popup')
							VALUES ('',$firstName,$emailNewUser,$newUserPass,'Registered',1,0,18,$date,'0000-00-00 00:00:00',$activation,'fb',$profileType,$WTF?,0)";
		mysql_query($sql) or die("Error: ".mysql_error());
	*/
	}

} else {
	
	//echo "No Guardo";
	
	LoginForm ();

}

?>