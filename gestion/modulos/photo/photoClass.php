<?php
//////////////////////Reqiure necesary files////////////////////////////////////////////////
			$dir='';
			require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/nucleo/nucleo.php');
			require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/lib_util.inc.php');
			require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/nucleo/funciones.php');	
			
			/////////////////Require function selectTable()///////////////
			//require_once('../../lib/share/clases/tableProfileSelector.php');



class Photo {


	
	
	/////////////////Function to select table Photo by profile///////////////////////////////
	private function selectTable($profileId){
	
			if($profileId<7){
				$tableProfile='ax_photoPlayer';
			}elseif($profileId<13){
				$tableProfile='ax_photoCoach';
			}elseif($profileId<16){
				$tableProfile='ax_photoAgent';
			}elseif($profileId==16){
				$tableProfile='ax_photoScout';
			}elseif($profileId==17){
				$tableProfile='ax_photoLawyer';
			}elseif($profileId<20){
				$tableProfile='ax_photoManager';
			}elseif($profileId<23){
				$tableProfile='ax_photoMedic';
			}elseif($profileId==23){
				$tableProfile='ax_photoFan';
			}elseif($profileId==24){
				$tableProfile='ax_photoJournalist';
			}elseif($profileId==25){
				$tableProfile='ax_photoFederation';
			}elseif($profileId==26){
				$tableProfile='ax_photoClub';
			}elseif($profileId==27){
				$tableProfile='ax_photoCompany';
			}
			
			return $tableProfile;
		
		}
	
	
	
	
	
	
	////////////////SELECT - SELECTS data////////////////
	function selectPhoto($profileId,$fields,$whereSel,$orderSel='id desc'){
				
		//$tableProfile=$this->selectTable($profileId);
		$tableProfile='ax_photoUpload';
		
		$registros=$this->selPho($fields,$tableProfile,$whereSel,$orderSel);	
		return $registros;
		
		
	}


///////////////SELECT the register/////////////////////////////
	
	
	
		private function selPho($fields,$tableProfile,$whereSel,$orderSel){
	
			$bd2=new conexion();
							
			$sSQL_Select = GenerateSelect($fields,$tableProfile,$whereSel,$orderSel);
			
			$registros = $bd2->query($sSQL_Select);
			
			//echo $sSQL_Select;
			
			return $registros;
			
			

	}//selProf
	
	
	
	///////////////////////PAGINATION///////////////////////////////////////////////////
	
		function paginate($profileId,$page=1,$restrict=NULL,$var1=array(),$cant=1){
		
			//$tableProfile=$this->selectTable($profileId);
			$tableProfile='ax_photoUpload';
			
			$bd=new conexion();
				
			$bd->query("SELECT id FROM $tableProfile WHERE active='1' $restrict");
			$array = mostrarPaginadoSebaPhotos($bd->n,$page,$cant,$var1);
			list($paginado, $inicio) = $array;	
			
			return "$inicio,$paginado";
			

		
		}//pagination

	
	
	
	
	
	
	
	
	
////////////////ADD - Check where to insert the data////////////////
	function addPhoto($fields){
				
		//$tableProfile=$this->selectTable($profileId);
		$tableProfile='ax_photoUpload';
		if($this->addPho($tableProfile,$fields)){
			return true;
		}else{
			return false;
		}
		
		
		
	}
	
	
///////////////Inserts the register into de tabl/////////////////////////////
	

	
		function addPho($tableProfile,$fields){
			
			$bd2=new conexion();
			$sSQL_Insert = GenerateInsert($tableProfile,$fields);
			
			$bd2->query($sSQL_Insert);
				return true;
			//echo 'sql: ',$sSQL_Insert;
			
		/*	require_once('../../lib/share/clases/lib_util.inc.php');
			require_once('../../lib/share/clases/class_db.inc.php');
				
			$sSQL_Insert = GenerateInsert($tableProfile,$fields);
				//if ($DB_Result = $this->oDB->Query($sSQL_Insert))
				$oS = new CLASS_DB();$oS->Connect();
				if ($DB_Result = $oS->Query($sSQL_Insert))
				{
					return true;
				}*/
				
				
			/*$sSQL_Insert = GenerateInsert($tableProfile,$fields);
			if ($DB_Result = $this->oDB->Query($sSQL_Insert))
			  {
			  return true;
			  }
			  
			  return false;
				*/
		
	
	}
	
	


/////////////////////////////////////////////////////////////////////////////////////////////




////////////////UPDATE - Check where to insert the data////////////////
	function upPhoto($fields,$whereUp){
				
		//$tableProfile=$this->selectTable($profileId);
		$tableProfile='ax_photoUpload';
		
		if($this->upPho($tableProfile,$fields,$whereUp)){
			return true;
		}else{
			return false;
		}
		
		
		
	}


///////////////UPDATE the register/////////////////////////////
	

	
	private	function upPho($tableProfile,$fields,$whereUp){
	
			$bd2=new conexion();
				
			$sSQL_Update = GenerateUpdate($tableProfile,$fields,$whereUp);

			//echo 'update: ',$sSQL_Update;
			$bd2->query($sSQL_Update);
			return true;
			
			//var_dump($sSQL_Update);
			
				
				/*$oS = new CLASS_DB();$oS->Connect();
				if ($DB_Result = $oS->Query($sSQL_Update))
				{
					return true;
				}*/
		
	

	}




////////////////////////////////////////////////////////////////////////////////////////////





////////////////Delete - Check where to insert the data////////////////
	function delPhoto($whereDel){
			
			//$tableProfile=$this->selectTable($profileId);
			$tableProfile='ax_photoUpload';
			
		if($this->delPho($tableProfile,$whereDel)){
			return true;
		}else{
			return false;
		}
		
		
		
	}


///////////////Delete the register/////////////////////////////
	

	
		function delPho($tableProfile,$whereDel){
	
			$bd2=new conexion();
				
			$sSQL_Delete = "DELETE FROM " . $tableProfile . " WHERE $whereDel";
				
			$bd2->query($sSQL_Delete);
			return true;
					
				//if ($DB_Result = $this->oDB->Query($sSQL_Insert))
				/*$oS = new CLASS_DB();$oS->Connect();
				if ($DB_Result = $oS->Query($sSQL_Delete))
				{
					return true;
				}*/
				
	 }








//////////////////////////////////////////////////////////////////////////////////////////////////





///////////////////////PAGINATION Search///////////////////////////////////////////////////
	
		function paginateSearchPhotos($profileId,$page=1,$restrict=NULL,$var1=array(),$cant=1){
		
			//$tableProfile=$this->selectTable($profileId);
			$tableProfile='ax_photoUpload';
				
			
			$bd=new conexion();
				
			$bd->query("SELECT id FROM $tableProfile $restrict");
			
			
					
			$array = mostrarPaginadoSebaSearchPhotos($bd->n,$page,$cant,$var1);
			list($paginado, $inicio) = $array;	
			
			return "$inicio,$paginado";
			

		
		}//pagination









}//class


?>
