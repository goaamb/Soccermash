<?php
//////////////////////Reqiure necesary files////////////////////////////////////////////////
$dir='';
require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/nucleo/nucleo.php');
require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/lib_util.inc.php');

class Institution {


	
	
	/////////////////Function to select table by profile///////////////////////////////
	private function selectTable($profileId){
	
			
			if($profileId==25){
				$tableProfile='ax_federation';
			}elseif($profileId==26){
				$tableProfile='ax_club';
			}elseif($profileId==27){
				$tableProfile='ax_company';
			}
			 
			return $tableProfile;
		
		}
	
	
	
	
	
	
	////////////////SELECT - SELECTS data////////////////
	function selectProfile($profileId,$fields,$whereSel){
				
		$tableProfile=$this->selectTable($profileId);
		
		$registros=$this->selProf($fields,$tableProfile,$whereSel);	
		return $registros;
		
		
	}


///////////////SELECT the register/////////////////////////////
	

	
		private function selProf($fields,$tableProfile,$whereSel){
	
			$bd2=new conexion();
			
				
			$sSQL_Select = GenerateSelect($fields,$tableProfile,$whereSel);
			
			$registros = $bd2->query($sSQL_Select);
			
		//	echo $sSQL_Select;
			
			return $registros;
			
			

	}

	
	
	
	
	
	
	
	
	
////////////////ADD - Check where to insert the data////////////////
	function addProfile($profileId,$fields){
				
		$tableProfile=$this->selectTable($profileId);
		
		if($this->addProf($tableProfile,$fields)){
			return true;
		}else{
			return false;
		}
		
		
		
	}
	
	
///////////////Inserts the register into de tabl/////////////////////////////
	

	
		function addProf($tableProfile,$fields){
			
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
	function upProfile($profileId,$fields,$whereUp){
				
		$tableProfile=$this->selectTable($profileId);
		
		
		if($this->upProf($tableProfile,$fields,$whereUp)){
			return true;
		}else{
			return false;
		}
		
		
		
	}


///////////////UPDATE the register/////////////////////////////
	

	
	private	function upProf($tableProfile,$fields,$whereUp){
	
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
	function delProfile($profileId,$whereDel){
				
			$tableProfile=$this->selectTable($profileId);
		
		if($this->delProf($tableProfile,$whereDel)){
			return true;
		}else{
			return false;
		}
		
		
		
	}


///////////////Delete the register/////////////////////////////
	

	
		function delProf($tableProfile,$whereDel){
	
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
/////////////////////////////Paginate/////////////////////////////////////////////////////////////




/////////////////////Paginate by profile//////////////////////////////////////////////
	
		function paginate($page=1,$restrict=NULL,$var1=array(),$cant=1,$advProfile){
		
			
			//$tableProfile=$this->selectTable($profileId);
			
			$bd=new conexion();
				
			
			
			if($advProfile==25){
				$tableProfile="ax_federation";
				$bd->query("SELECT id FROM $tableProfile $restrict");
				$array = mostrarPaginadoSebaSearchFederation($bd->n,$page,$cant,$var1);
			}elseif($advProfile==26){
				$tableProfile="ax_club";
				$bd->query("SELECT id FROM $tableProfile $restrict");
				$array = mostrarPaginadoSebaSearchClub($bd->n,$page,$cant,$var1);
			}elseif($advProfile==27){
				$tableProfile="ax_company";
				$bd->query("SELECT id FROM $tableProfile $restrict");
				$array = mostrarPaginadoSebaSearchCompany($bd->n,$page,$cant,$var1);	
			}
			
			list($paginado, $inicio) = $array;	
						
			return "$inicio,$paginado";
			
			
			
			

		
		}//pagination








}//class


?>
