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
			
					$addCategoryag=(int)$_POST['addCategoryag'];

					$a1b22fhidden=(int)$_POST['a1b22fhidden'];

					//$addOtherClubag=htmlentities($_POST['addOtherClubag']);

					$addMatchesag=(int)$_POST['addMatchesag'];

					$addTitularag=(int)$_POST['addTitularag'];

					$addGoalsag=(int)$_POST['addGoalsag'];

					$addAssistsag=(int)$_POST['addAssistsag'];

					$addYellowCardsag=(int)$_POST['addYellowCardsag'];

					$addRedCardsag=(int)$_POST['addRedCardsag'];

					//$addSeasonag=htmlentities($_POST['addSeasonag']);

					$addYearOfSeasonag=(int)$_POST['addYearOfSeasonag'];

					//$addHiddenag=htmlentities($_POST['addHiddenag']);


				/*if($a1b22fhidden == null || $addOtherClubag == null)
				{
					echo "Please Fill all fiedls! Clubs";
				}*/
				if($addCategoryag == null || $addMatchesag == null || $addTitularag == null || $addGoalsag == null || $addAssistsag == null || $addYellowCardsag == null || $addRedCardsag == null || $addYearOfSeasonag == null)
				{
				echo "Please fill all fields";
				return false;
				}
				$fields=array('idPlayer'=>$idUser,'category'=>$addCategoryag,'clubOrAsociation'=>$a1b22fhidden,'matches'=>$addMatchesag,'titular'=>$addTitularag,'goals'=>$addGoalsag,'assists'=>$addAssistsag,'yellowCards'=>$addYellowCardsag,'redCards'=>$addRedCardsag,'year'=>$addYearOfSeasonag,'date'=>date("Y-m-d"));
				//echo "Fields: <br />";
				$jug= new Career();
				if($jug->addCareer($idProfile,$fields)) {
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
				$jug=new Career();
				if($jug->editCareer($idUser,$idProfile,$fields,$idrow)){
					//echo "Se ha editado su informacion correctamente";
				}else{
					//echo "Hubo un error, por favor intentelo mas tarde, Muchas Gracias";
				}
				break;
			case 'editHidden':
				$jug=new Career();
				$jug->editHidden($idUser,$idProfile);
			
			
			break;
			case 'editVisible':
				$jug=new Career();
				$jug->editVisible($idUser,$idProfile);
			
			
			break;
			//case 'selectVisibility':
				//$jug=new Career();
				//$jug->selectVisibility($idUser,$idProfile);
			
			
			break;
			
			
			
			case 'delet':
				//echo "Fields: <br />";
				//var_dump($fields);
				$jug=new Career();
				$idRow=(int)$_POST['idRow'];
				if($jug->deleteCareer($idUser,$idProfile,$idRow)){
					//echo "Se ha editado su informacion correctamente";
				}else{
					//echo "Hubo un error, por favor intentelo mas tarde, Muchas Gracias";
				}
				break;
			
				
}


class Career{



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
	

	/*function selectVisibility($idUser,$profileId){
		
		$table=selectTable($profileId);
		$anexo='Career';
		$tableProfile=$table.$anexo;
		var_dump($tableProfile);
		
		$sSQL_Select = ("SELECT hidden FROM $tableProfile where idPlayer=$idUser");
		var_dump($sSQL_Select);
		$DB_Result = $this->oDB->Query($sSQL_Select);
		var_dump($DB_Result);
		
	}
	*/
	function addCareer($profileId,$fields){

	$table=selectTable($profileId);
	$anexo='Career';
	$tableProfile=$table.$anexo;
		
		if($this->addCar($tableProfile,$fields)){
			return true;
		}else{
			return false;
		}
	}

	function addCar($table,$fields){
	
		//$camps->filterParameters($fields);
	
	//	$DB_Result = $oS->Query($sSQL_Insert);

//		$sSQL_Insert = GenerateInsert(SITE_DB_TB_SystemUsuarios, $aUsuario);
		$sSQL_Insert = GenerateInsert($table,$fields);
		$DB_Result = $this->oDB->Query($sSQL_Insert);

		//var_dump($sSQL_Insert);

/*				foreach ($fields as $ass){
					$ass=mysql_real_escape_string($ass);
				}
	*/
				
		//if ($DB_Result = $this->oDB->Query($sSQL_Insert))
	}
	

	////////////////////////EDIT//////////////////////////////	
					
	function editCareer($idUser,$profileId,$fields,$idrow){
		$table=selectTable($profileId);
		$anexo='Career';
		$tableProfile=$table.$anexo;
		
		if($this->editCar($tableProfile,$fields,$idrow,$idUser)){
			return true;
		}else{
			return false;
		}
	}
	
	function editCar($tableProfile,$fields,$idrow,$idUser){
		$sSQL_Update = GenerateUpdate($tableProfile,$fields, "id=".$idrow." AND idPLayer=".$idUser);
		$DB_Result = $this->oDB->Query($sSQL_Update);
	
	
	
		//echo "<br />Consulta: <br />";
		//var_dump($sSQL_Update);

		/*		foreach ($fields as $ass){
					$ass=mysql_real_escape_string($ass);
				}
			*/
		//if ($DB_Result = $this->oDB->Query($sSQL_Insert))

	}
	
	function editHidden($idUser,$profileId){
		$table=selectTable($profileId);
		$anexo='Career';
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
		$anexo='Career';
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
	
	function deleteCareer($idUser,$profileId,$idRow){
	
		$table=selectTable($profileId);
		$anexo='Career';
		$tableProfile=$table.$anexo;
		
		//var_dump($tableProfile);
		//var_dump($idRow);
		//var_dump($idUser);
		if($this->deleteCar($tableProfile,$idRow,$idUser)){
			return true;
		}else{
			return false;
		}
	}
	
	function deleteCar($table,$idRow,$idUser){

	
		$sSQL_Delete = GenerateDelete($table,$idRow,$idUser);
		$DB_Result = $this->oDB->Query($sSQL_Delete);
		
	}


	function country($table){
		$sSQL_Select = ("SELECT * FROM ax_country");
		$DB_Result = $this->oDB->Query($sSQL_Select);
		
	
	}
	
}

?>