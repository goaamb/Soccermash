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
				$fields=array('idPlayer'=>$idUser,'category'=>$_POST['addCategoryag'],'title'=>$_POST['addTitleag'],'country'=>$_POST['a1b2fhidden'],'yearOf'=>(int)$_POST['addYearOfag'],'clubOrAsociation'=>(INT)$_POST['a1b22fhidden'],'otherClub'=>$_POST['addOtherClubag'],'date'=>date("Y-m-d"),'hidden'=>'Visible');
				echo "Fields: <br />";
				$jug= new honour();
				if($jug->addHonour($idProfile,$fields)) {
					echo 'Hubo un error, por favor intentelo mas tarde, Muchas Gracias';
				}else{
					echo 'Haz agregado datos en Honores! Recuerda que puedes editarlos, borrarlos o simplemente ocultarlos!';
				}
				break;
			case 'edit':
				$field=$_POST['field'];$idrow=(int)$_POST['idRow'];$val=(is_numeric($_POST['val']) ? (int)$_POST['val'] : $_POST['val']);
				$fields=array($field => $val,'date'=>date("Y-m-d"));
				echo "Fields: <br />";
				var_dump($fields);
				$jug=new honour();
				if($jug->editHonour($idUser,$idProfile,$fields,$idrow)){
					echo "Se ha editado su informacion correctamente";
				}else{
					echo "Hubo un error, por favor intentelo mas tarde, Muchas Gracias";
				}
				break;
			
			case 'selectHidden':
				$jug=new honour();
				$jug->selectHidden($idUser,$idProfile);
			break;
			
			
			case 'editHidden':
				$jug=new honour();
				$jug->editHidden($idUser,$idProfile);
			
			
			break;
			case 'editVisible':
				$jug=new honour();
				$jug->editVisible($idUser,$idProfile);
			
			
			break;
			
			case 'delet':
				echo "Fields: <br />";
				$jug=new honour();
				$idRow=(int)$_POST['idRow'];
				if($jug->deleteHonour($idUser,$idProfile,$idRow)){
					echo "Se ha editado su informacion correctamente";
				}else{
					echo "Hubo un error, por favor intentelo mas tarde, Muchas Gracias";
				}
				break;
			
				
}


class honour{



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
	
	function addHonour($profileId,$fields){

	$table=selectTable($profileId);
	$anexo='Honour';
	$tableProfile=$table.$anexo;
		
		if($this->addHon($tableProfile,$fields)){
			return true;
		}else{
			return false;
		}
	}

	function addHon($table,$fields){

		$sSQL_Insert = GenerateInsert($table,$fields);
	
	var_dump($sSQL_Insert);
	
		$DB_Result = $this->oDB->Query($sSQL_Insert);
		
	var_dump($DB_Result);
		
	}
	
	////////////////////////SELECT HIDDEN/////////////////////
	function selectHidden($idUser,$profileId){
		$table=selectTable($profileId);
		$anexo='Honour';
		$tableProfile=$table.$anexo;
		
		if($this->selectHid($tableProfile,$idUser)){
			return true;
		}else{
			return false;
		}
		
	}
	
	function selectHid($tableProfile,$idUser){
	    $sSQL_Update = GenerateUpdate($tableProfile,$fields, " hidden=Hidden");
		var_dump($sSQL_Update);
		$DB_Result = $this->oDB->Query($sSQL_Update);
		var_dump($DB_Result);
	}

	////////////////////////EDIT//////////////////////////////	
	function editHidden($idUser,$profileId){
		$table=selectTable($profileId);
		$anexo='Honour';
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
		$anexo='Honour';
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
					
	function editHonour($idUser,$profileId,$fields,$idrow){
		
		$table=selectTable($profileId);
		$anexo='Honour';
		$tableProfile=$table.$anexo;
		
		if($this->editHon($tableProfile,$fields,$idrow,$idUser)){
			return true;
		}else{
			return false;
		}
	}
	
	function editHon($tableProfile,$fields,$idrow,$idUser){
		$sSQL_Update = GenerateUpdate($tableProfile,$fields, "id=".$idrow." AND idPlayer=".$idUser);
		var_dump($sSQL_Update);
		$DB_Result = $this->oDB->Query($sSQL_Update);
		var_dump($DB_Result);
		
	}
	
	function deleteHonour($idUser,$profileId,$idRow){
		
		$table=selectTable($profileId);
		$anexo='Honour';
		$tableProfile=$table.$anexo;
		
		//var_dump($tableProfile);
		//var_dump($idRow);
		//var_dump($idUser);
		if($this->deleteHon($tableProfile,$idRow,$idUser)){
			return true;
		}else{
			return false;
		}
	}
	
	function deleteHon($table,$idRow,$idUser){
		$sSQL_Delete = GenerateDelete($table,$idRow,$idUser);
		
		return $DB_Result = $this->oDB->Query($sSQL_Delete);
		
	}


	function country($table){
		$sSQL_Select = ("SELECT * FROM ax_country");
		return $DB_Result = $this->oDB->Query($sSQL_Select);
	
	}
	
}

?>