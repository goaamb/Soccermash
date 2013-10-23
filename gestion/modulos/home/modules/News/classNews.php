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
				$fields=array('idPlayer'=>$idUser,'title'=>$_POST['addTitleag'],'description'=>$_POST['addDescriptionag'],'hidden'=>'Visible','date'=>date("Y-m-d"));
				//echo "Fields: <br />";
				$jug= new news();
				if($jug->addNews($idProfile,$fields)) {//(ProfileId,Campos)
					echo 'Hubo un error, por favor intentelo mas tarde, Muchas Gracias';
				}else{
					echo 'Haz agregado datos en Honores! Recuerda que puedes editarlos, borrarlos o simplemente ocultarlos!';
				}
				break;
			case 'edit':
				$field=$_POST['field'];$idrow=(int)$_POST['idRow'];$val=(is_numeric($_POST['val']) ? (int)$_POST['val'] : $_POST['val']);
				$fields=array($field => $val,'date'=>date("Y-m-d"));
				$jug=new news();
				if($jug->editNews($idUser,$idProfile,$fields,$idrow)){
					echo "Se ha editado su informacion correctamente";
				}else{
					echo "Hubo un error, por favor intentelo mas tarde, Muchas Gracias";
				}
				break;
			
			case 'editHidden':
				$jug=new news();
				$jug->editHidden($idUser,$idProfile);
			
			
			break;
			case 'editVisible':
				$jug=new news();
				$jug->editVisible($idUser,$idProfile);
			
			
			break;
				
			case 'delet':
				//echo "Fields: <br />";
				//var_dump($fields);
				$jug=new news();
				$idRow=(int)$_POST['idRow'];
				if($jug->deleteNews($idUser,$idProfile,$idRow)){
					echo "Se ha editado su informacion correctamente";
				}else{
					echo "Hubo un error, por favor intentelo mas tarde, Muchas Gracias";
				}
				break;
				
				
}


class news{



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
	global $SITE_oDB;	
$this->oDB =& $SITE_oDB;
}

	////////////////////////ADD//////////////////////////////	
	
	function addNews($profileId,$fields){
	
	$table=selectTable($profileId);
	$anexo='New';
	$tableProfile=$table.$anexo;
		
		if($this->addNws($tableProfile,$fields)){
			return true;
		}else{
			return false;
		}
	}

	function addNws($table,$fields){
	
		$sSQL_Insert = GenerateInsert($table,$fields);
	
	
		$DB_Result = $this->oDB->Query($sSQL_Insert);
	}

	
	////////////////////////EDIT//////////////////////////////	
	function editHidden($idUser,$profileId){
		$table=selectTable($profileId);
		$anexo='New';
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
		$anexo='New';
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
	
	function editNews($idUser,$profileId,$fields,$idrow){
		
		$table=selectTable($profileId);
		$anexo='New';
		$tableProfile=$table.$anexo;
		
		if($this->editNws($tableProfile,$fields,$idrow,$idUser)){
		
			return true;
		}else{
			return false;
		}
	}
		
	
	function editNws($tableProfile,$fields,$idrow,$idUser){
	
		$sSQL_Update = GenerateUpdate($tableProfile,$fields, "id=".$idrow." AND idPLayer=".$idUser);
		$DB_Result = $this->oDB->Query($sSQL_Update);
		
	}
	
		
	function deleteNews($idUser,$profileId,$idRow){
		
		$table=selectTable($profileId);
		$anexo='New';
		$tableProfile=$table.$anexo;
		
		//var_dump($tableProfile);
		//var_dump($idRow);
		//var_dump($idUser);
		if($this->deleteNws($tableProfile,$idRow,$idUser)){
			return true;
		}else{
			return false;
		}
	}
	
	function deleteNws($table,$idRow,$idUser){
		$sSQL_Delete = GenerateDelete($table,$idRow,$idUser);
		
		return $DB_Result = $this->oDB->Query($sSQL_Delete);
	}

	function country($table){
		$sSQL_Select = ("SELECT * FROM ax_country");
		return $DB_Result = $this->oDB->Query($sSQL_Select);
	
	}
	
}

?>