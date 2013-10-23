<?php
//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 

//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/lib/site_ini.php");
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/site_ini.php");






$type=$_POST['type'];
$idUser=(int)$_POST['idUser'];
$idProfile=(int)$_POST['idProfile'];

//var_dump($idUser);
//var_dump($idProfile);


switch($type){
			case 'add':
				$fields=array('idPlayer'=>$idUser,'observation'=>$_POST['observation'],'date'=>date("Y-m-d"));
				
				$jug= new observation();
				if($jug->addObservation($idProfile,$fields)) {
					//echo 'Hubo un error, por favor intentelo mas tarde, Muchas Gracias';
				}else{
					//echo 'Haz agregado datos en Honores! Recuerda que puedes editarlos, borrarlos o simplemente ocultarlos!';
				}
				break;
			case 'edit':
				$field=$_POST['field'];$idrow=(int)$_POST['idRow'];$val=(is_numeric($_POST['val']) ? (int)$_POST['val'] : $_POST['val']);
				$fields=array($field => $val,'date'=>date("Y-m-d"));
				echo "Fields: <br />";
				//var_dump($fields);
				$jug=new observation();
				if($jug->editObservation($idUser,$idProfile,$fields,$idrow)){
					echo $_IDIOMA->traducir("Your information has been Edited correctly");
				}else{
					echo $_IDIOMA->traducir("There was an error, please try later, Thank You");
				}
				break;
			
			case 'editHidden':
				$jug=new observation();
				$jug->editHidden($idUser,$idProfile);
			
			
			break;
			case 'editVisible':
				$jug=new observation();
				$jug->editVisible($idUser,$idProfile);
			
			
			break;
			
			case 'delet':
				echo "Fields: <br />";
				//var_dump($fields);
				$jug=new observation();
				$idRow=(int)$_POST['idRow'];
				if($jug->deleteObservation($idUser,$idProfile,$idRow)){
					echo $_IDIOMA->traducir("Your information has been Edited correctly");
				}else{
					echo $_IDIOMA->traducir("There was an error, please try later, Thank You");
				}
				break;
			
				
}


class observation{



      /* public function filterParameters($array) {
       
            
            if(is_array($array)) {
                
                foreach($array as $key => $value) {
                    
                    if(is_array($array[$key]))
            
                        $array[$key] = $this->filterParameters($array[$key]);
               
            
                    if(is_string($array[$key]))
            
                        $array[$key] = mysql_real_escape_string($array[$key]);
                }           
            }
            
            if(is_string($array))
            
                $array = mysql_real_escape_string($array);
           
            
            return $array;
       
        }*/


function __construct(){
	//require_once("gestion/lib/share/clases/lib_util.inc.php");
	//require_once("gestion/lib/share/clases/class_db.inc.php");

global $SITE_oDB;	
$this->oDB =& $SITE_oDB;
}

	////////////////////////ADD//////////////////////////////	
	
	function addObservation($profileId,$fields){

	$table=selectTable($profileId);
	$anexo='Observation';
	$tableProfile=$table.$anexo;
		
		if($this->addObs($tableProfile,$fields)){
			return true;
		}else{
			return false;
		}
	}

	function addObs($table,$fields){
	//var_dump($table);
	//var_dump($fields);
		$sSQL_Insert = GenerateInsert($table,$fields);
		//var_dump($sSQL_Insert);
		$DB_Result = $this->oDB->Query($sSQL_Insert);
		var_dump($DB_Result);
	}
	

	////////////////////////EDIT//////////////////////////////	
	
	function editHidden($idUser,$profileId){
		$table=selectTable($profileId);
		$anexo='Observation';
		$tableProfile=$table.$anexo;
		
		if($this->editHid($tableProfile,$idUser)){
			return true;
		}else{
			return false;
		}
		
	}
	
	function editHid($tableProfile,$idUser){
	    $fields=array('Hidden' => 'Hidden');
		$sSQL_Update = GenerateUpdate($tableProfile,$fields, " idPlayer=".$idUser);
		$DB_Result = $this->oDB->Query($sSQL_Update);
	}
	
	function editVisible($idUser,$profileId){
		$table=selectTable($profileId);
		$anexo='Observation';
		$tableProfile=$table.$anexo;
		
		if($this->editVis($tableProfile,$idUser)){
			return true;
		}else{
			return false;
		}
		
	}
	
	function editVis($tableProfile,$idUser){
	    $fields=array('Hidden' => 'Visible');
		$sSQL_Update = GenerateUpdate($tableProfile,$fields, " idPlayer=".$idUser);
		$DB_Result = $this->oDB->Query($sSQL_Update);
	}	
	
	
	function editObservation($idUser,$profileId,$fields,$idrow){		
		$table=selectTable($profileId);
		$anexo='Observation';
		$tableProfile=$table.$anexo;
		
		if($this->editObs($tableProfile,$fields,$idrow,$idUser)){
			return true;
		}else{
			return false;
		}
	}
	
	function editObs($tableProfile,$fields,$idrow,$idUser){
		$sSQL_Update = GenerateUpdate($tableProfile,$fields, "id=".$idrow." AND idPLayer=".$idUser);
		$DB_Result = $this->oDB->Query($sSQL_Update);


		
	}
	
	function deleteObservation($idUser,$profileId,$idRow){
	
		$table=selectTable($profileId);
		$anexo='Observation';
		$tableProfile=$table.$anexo;
		
		//var_dump($tableProfile);
		//var_dump($idRow);
		//var_dump($idUser);
		if($this->deleteObs($tableProfile,$idRow,$idUser)){
			return true;
		}else{
			return false;
		}
	}
	
	function deleteObs($table,$idRow,$idUser){
		$sSQL_Delete = GenerateDelete($table,$idRow,$idUser);
		
		$DB_Result = $this->oDB->Query($sSQL_Delete);
	}


	function country($table){
		$sSQL_Select = ("SELECT * FROM ax_country");
		$DB_Result = $this->oDB->Query($sSQL_Select);
	
	}
	
}

?>