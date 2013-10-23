<?php
require_once('cityListStyled.php');

 require_once $_SERVER["DOCUMENT_ROOT"]. '/gbase.php';
	 require_once $_GBASE. '/goaamb/idioma.php';
	if(class_exists("Idioma")){
		 $_IDIOMA=Idioma::darLenguaje();
	  }		
		

global $_IDIOMA;


$city=new CityList('cityId',$_IDIOMA->traducir("Select your City"),'textShowed3','showIT3','selector3',$_POST['country'],-30);



?>