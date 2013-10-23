<?php
//////////////////////Reqiure necesary files////////////////////////////////////////////////
$dir='';
require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/nucleo/nucleo.php');
require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/lib_util.inc.php');

class rssClass {


	
	
	
	////////////////SELECT - SELECTS data////////////////
	function selectProfile($fields,$whereSel){
				
		$tableProfile='ax_rssNews';
		
		$registros=$this->selProf($fields,$tableProfile,$whereSel);	
		return $registros;
		
		
	}


///////////////SELECT the register/////////////////////////////
	

	
		private function selProf($fields,$tableProfile,$whereSel){
	
			$bd2=new conexion();
			
				
			$sSQL_Select = GenerateSelect($fields,$tableProfile,$whereSel);
			
			$registros = $bd2->query($sSQL_Select);
			
			//echo 'select profile: ',$sSQL_Select;
			
						
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
//////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////select from generalRegister////////////////////////////


////////////////SELECT  General- SELECTS data////////////////
	function selectGen($fields,$whereSel){
				
		$tableProfile="ax_generalRegister";
		
		$registros=$this->selGen($fields,$tableProfile,$whereSel);	
		return $registros;
		
		
	}


///////////////SELECT the register/////////////////////////////
		private function selGen($fields,$tableProfile,$whereSel){
	
			$bd4=new conexion();
			
			$sSQL_Select = GenerateSelect($fields,$tableProfile,$whereSel);
			
			$registros = $bd4->query($sSQL_Select);
			
			//echo $sSQL_Select;
			
			return $registros;
	}




////////////////UPDATE GenReg ////////////////
	function upGeneral($fields,$whereUp){

		$tableProfile="ax_generalRegister";

		if($this->upGen($tableProfile,$fields,$whereUp)){
			return true;
		}else{
			return false;
		}
		
		
		
	}


///////////////UPDATE the register/////////////////////////////
	

	
	private	function upGen($tableProfile,$fields,$whereUp){
	
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



///////////////////////PAGINATION///////////////////////////////////////////////////

/////////////////////Paginate General//////////////////////////////////////////////
	
		function paginateGen($page=1,$restrict=NULL,$var1=array(),$cant=1){
		
			$tableProfile="ax_generalRegister";
			//$tableProfile=$this->selectTable($profileId);
			
			$bd=new conexion();
				
			$bd->query("SELECT id FROM $tableProfile $restrict");
			
			$array = mostrarPaginadoSebaSearchPeople($bd->n,$page,$cant,$var1);	
			
			list($paginado, $inicio) = $array;	
			
			return "$inicio,$paginado";
			

		
		}//pagination



/////////////////////Paginate by profile//////////////////////////////////////////////
	
		function paginate($profileId,$page=1,$restrict=NULL,$var1=array(),$cant=1,$advProfile){
		
			$tableProfile="ax_generalRegister";
			//$tableProfile=$this->selectTable($profileId);
			
			$bd=new conexion();
				
			$bd->query("SELECT id FROM $tableProfile $restrict");
			
			if($advProfile==1){
				$array = mostrarPaginadoSebaSearchPlayer($bd->n,$page,$cant,$var1);
			}elseif($advProfile==2){
				$array = mostrarPaginadoSebaSearchCoach($bd->n,$page,$cant,$var1);
			}elseif($advProfile==3){
				$array = mostrarPaginadoSebaSearchAgent($bd->n,$page,$cant,$var1);	
			}elseif($advProfile==4){
				$array = mostrarPaginadoSebaSearchScout($bd->n,$page,$cant,$var1);	
			}elseif($advProfile==5){
				$array = mostrarPaginadoSebaSearchLawyer($bd->n,$page,$cant,$var1);	
			}elseif($advProfile==6){
				$array = mostrarPaginadoSebaSearchHealth($bd->n,$page,$cant,$var1);	
			}elseif($advProfile==7){
				$array = mostrarPaginadoSebaSearchDirector($bd->n,$page,$cant,$var1);	
			}elseif($advProfile==8){
				$array = mostrarPaginadoSebaSearchFan($bd->n,$page,$cant,$var1);	
			}elseif($advProfile==9){
				$array = mostrarPaginadoSebaSearchJournalist($bd->n,$page,$cant,$var1);	
			}
			
			list($paginado, $inicio) = $array;	
			
			return "$inicio,$paginado";
			

		
		}//pagination



}//class


?>
