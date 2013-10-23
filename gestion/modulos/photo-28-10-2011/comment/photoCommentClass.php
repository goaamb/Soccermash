<?php
//////////////////////Reqiure necesary files////////////////////////////////////////////////
			$dir='';
			require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/nucleo/nucleo.php');
			require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/lib_util.inc.php');
			require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/nucleo/funciones.php');	
			
			/////////////////Require function selectTable()///////////////
			//require_once('../../lib/share/clases/tableProfileSelector.php');



class PhotoComment {


	
	
	/////////////////Function to select table Photo by profile///////////////////////////////
	/*private function selectTable($profileId){
	
			if($profileId<7){
				$tableProfile='ax_PhotoPlayer';
			}elseif($profileId<13){
				$tableProfile='ax_PhotoCoach';
			}elseif($profileId<16){
				$tableProfile='ax_PhotoAgent';
			}elseif($profileId==16){
				$tableProfile='ax_PhotoScout';
			}elseif($profileId==17){
				$tableProfile='ax_PhotoLawyer';
			}elseif($profileId<20){
				$tableProfile='ax_PhotoManager';
			}elseif($profileId<23){
				$tableProfile='ax_PhotoMedic';
			}elseif($profileId==23){
				$tableProfile='ax_PhotoFan';
			}elseif($profileId==24){
				$tableProfile='ax_PhotoJournalist';
			}elseif($profileId==25){
				$tableProfile='ax_PhotoSelection';
			}elseif($profileId==26){
				$tableProfile='ax_PhotoClub';
			}elseif($profileId==27){
				$tableProfile='ax_PhotoCompany';
			}
			
			return $tableProfile;
		
		}*/
	
	
	
	
	
	
	////////////////SELECT - SELECTS data////////////////
	function selectPhotoComment($fields,$whereSel,$orderSel='id desc'){
				
		//$tableProfile=$this->selectTable($profileId);
		$tableProfile='ax_photoComment';
		
		$registros=$this->selPhoComment($fields,$tableProfile,$whereSel,$orderSel);	
		return $registros;
		
		
	}


///////////////SELECT the register/////////////////////////////
	
	
		private function selPhoComment($fields,$tableProfile,$whereSel,$orderSel){
	
			$bd2=new conexion();
							
			$sSQL_Select = GenerateSelect($fields,$tableProfile,$whereSel,$orderSel);
			
			$registros = $bd2->query($sSQL_Select);
			
			//echo $sSQL_Select;
			
			return $registros;
			
			

	}//selProf
	
	
	
	///////////////////////PAGINATION///////////////////////////////////////////////////
	
		function paginate($profileId,$page=1,$restrict=NULL,$var1=array(),$cant=1){
		
			//$tableProfile=$this->selectTable($profileId);
			$tableProfile='ax_photoComment';
			
			$bd=new conexion();
				
			$bd->query("SELECT id FROM $tableProfile WHERE active='1' $restrict");
			$array = mostrarPaginadoSebaCommentPhoto($bd->n,$page,$cant,$var1);
			list($paginado, $inicio) = $array;	
			
			return "$inicio,$paginado";
			

		
		}//pagination

	
	
	
	
	
	
	
	
	
////////////////ADD - Check where to insert the data////////////////
	function addPhotoComment($fields){
				
		//$tableProfile=$this->selectTable($profileId);
		$tableProfile='ax_photoComment';
		if($this->addPhoComment($tableProfile,$fields)){
			return true;
		}else{
			return false;
		}
		
		
		
	}
	
	
///////////////Inserts the register into de tabl/////////////////////////////
	

	
		function addPhoComment($tableProfile,$fields){
			
			
			$bd2=new conexion();
			$sSQL_Insert = GenerateInsert($tableProfile,$fields);
			
			$bd2->query($sSQL_Insert);
				
			//echo 'sql: ',$sSQL_Insert;
			return true;
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
	function upPhotoComment($fields,$whereUp){
				
		//$tableProfile=$this->selectTable($profileId);
		$tableProfile='ax_photoComment';
		
		if($this->upPhoComment($tableProfile,$fields,$whereUp)){
			return true;
		}else{
			return false;
		}
		
		
		
	}


///////////////UPDATE the register/////////////////////////////
	

	
	private	function upPhoComment($tableProfile,$fields,$whereUp){
	
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
	function delPhotoComment($whereDel){
			
			//$tableProfile=$this->selectTable($profileId);
			$tableProfile='ax_photoComment';
			
		if($this->delPhoComment($tableProfile,$whereDel)){
			return true;
		}else{
			return false;
		}
		
		
		
	}


///////////////Delete the register/////////////////////////////
	

	
		function delPhoComment($tableProfile,$whereDel){
	
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














}//class


?>
