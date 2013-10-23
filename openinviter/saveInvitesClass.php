<?php
//////////////////////Reqiure necesary files////////////////////////////////////////////////
$dir='';
require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/nucleo/nucleo.php');
require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/lib_util.inc.php');

class saveInvite {


	
	////////////////SELECT - SELECTS data////////////////
	function selectProfile($fields,$whereSel){
				
		$tableProfile='ax_remindContacts';
		
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
	function addProfile($fields){
				
		$tableProfile='ax_remindContacts';
		
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
			
		
		
	
	}
	
	


/////////////////////////////////////////////////////////////////////////////////////////////




////////////////UPDATE - Check where to insert the data////////////////
	function upProfile($fields,$whereUp){
				
		$tableProfile='ax_remindContacts';
		
		
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
	function delProfile($whereDel){
				
			$tableProfile='ax_remindContacts';
		
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
					
				
				
	 }











}//class


?>
