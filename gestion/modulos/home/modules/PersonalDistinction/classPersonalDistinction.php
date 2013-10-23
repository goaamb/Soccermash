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
			$distinction=$_POST['addDistinctionag'];
			$year=(int)$_POST['addYearag'];
			if($distinction == null || $year == null){
				echo "Please Fill al fields";
				return false;
			}
				$fields=array('idPlayer'=>$idUser,'distinction'=>$distinction,'year'=>$year,'date'=>date("Y-m-d"));
				//echo "Fields: <br />";
				$jug= new personalDistinction();
				if($jug->addPersonalDistinction($idProfile,$fields)) {
					//echo 'Hubo un error, por favor intentelo mas tarde, Muchas Gracias';
				}else{
					//echo 'Haz agregado datos en Honores! Recuerda que puedes editarlos, borrarlos o simplemente ocultarlos!';
				}
				break;
			case 'edit':
				$field=$_POST['field'];$idrow=(int)$_POST['idRow'];$val=(is_numeric($_POST['val']) ? (int)$_POST['val'] : $_POST['val']);
				$fields=array($field => $val,'date'=>date("Y-m-d"));
				
				//echo "Fields: <br />";
				//var_dump($fields);
				//die();
				$jug=new personalDistinction();
				if($jug->editPersonalDistinction($idUser,$idProfile,$fields,$idrow)){
					//echo "Se ha editado su informacion correctamente";
				}else{
					//echo "Hubo un error, por favor intentelo mas tarde, Muchas Gracias";
				}
				break;
			
			case 'editHidden':
				$jug=new personalDistinction();
				$jug->editHidden($idUser,$idProfile);
			
			
			break;
			case 'editVisible':
				$jug=new personalDistinction();
				$jug->editVisible($idUser,$idProfile);
			
			
			break;
			
			case 'delet':
				//echo "Fields: <br />";
				//var_dump($fields);
				$jug=new personalDistinction();
				$idRow=(int)$_POST['idRow'];
				if($jug->deletePersonalDistinction($idUser,$idProfile,$idRow)){
					//echo "Se ha editado su informacion correctamente";
				}else{
					//echo "Hubo un error, por favor intentelo mas tarde, Muchas Gracias";
				}
				break;
			
				
}


class personalDistinction{



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
	
	function addPersonalDistinction($profileId,$fields){

	$table=selectTable($profileId);
	$anexo='PersonalDistinction';
	$tableProfile=$table.$anexo;
	
		
		if($this->addPer($tableProfile,$fields)){
			return true;
		}else{
			return false;
		}
	}

	function addPer($table,$fields){
	
		//$camps->filterParameters($fields);
		$sSQL_Insert = GenerateInsert($table,$fields);
		$DB_Result = $this->oDB->Query($sSQL_Insert);
	
/*		$oS = new CLASS_DB();
		$oS->Connect();
		$sSQL_Insert = GenerateInsert($table,$fields);
		//var_dump($sSQL_Insert);
*/
/*				foreach ($fields as $ass){
					$ass=mysql_real_escape_string($ass);
				}
	*/
				
		//if ($DB_Result = $this->oDB->Query($sSQL_Insert))
	//	$DB_Result = $oS->Query($sSQL_Insert);
	}
	

	////////////////////////EDIT//////////////////////////////	
	
	
	function editHidden($idUser,$profileId){
		$table=selectTable($profileId);
		$anexo='PersonalDistinction';
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
		$anexo='PersonalDistinction';
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
	
					
	function editPersonalDistinction($idUser,$profileId,$fields,$idrow){
	
		$table=selectTable($profileId);
		$anexo='PersonalDistinction';
		$tableProfile=$table.$anexo;

		
	
		if($this->editPer($tableProfile,$fields,$idrow,$idUser)){
			return true;
		}else{
			return false;
		}
	}
	
	function editPer($tableProfile,$fields,$idrow,$idUser){

	$sSQL_Update = GenerateUpdate($tableProfile,$fields, "id=".$idrow." AND idPlayer=".$idUser);
	$DB_Result = $this->oDB->Query($sSQL_Update);
		echo "<br />Consulta: <br />";
		var_dump($sSQL_Update);
		echo "<br />DB_RESULT<br />";
		var_dump($DB_Result);
		die();
		/*		foreach ($fields as $ass){
					$ass=mysql_real_escape_string($ass);
				}
			*/
		//if ($DB_Result = $this->oDB->Query($sSQL_Insert))
		//$oS = new CLASS_DB();
		//$oS->Connect();
		//$DB_Result = $oS->Query($sSQL_Update);
		
	}
	
	function deletePersonalDistinction($idUser,$profileId,$idRow){
		
		$table=selectTable($profileId);
		$anexo='PersonalDistinction';
		$tableProfile=$table.$anexo;
		
		//var_dump($tableProfile);
//		var_dump($idRow);
		//var_dump($idUser);
		if($this->deletePer($tableProfile,$idRow,$idUser)){
			return true;
		}else{
			return false;
		}
	}
	
	function deletePer($table,$idRow,$idUser){
		$sSQL_Delete = GenerateDelete($table,$idRow,$idUser);
//		var_dump($sSQL_Delete);
		//$oS = new CLASS_DB();
		//$oS->Connect();
		$DB_Result = $this->oDB->Query($sSQL_Delete);
	}


	function country($table){
		$sSQL_Select = ("SELECT * FROM ax_country");
		//$oS = new CLASS_DB();
		//$oS->Connect();
		return $DB_Result = $this->oDB->Query($sSQL_Select);
	
	}
	
}

?>