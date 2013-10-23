<?php
//////////////////////Reqiure necesary files////////////////////////////////////////////////
			$dir='';
			require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/nucleo/nucleo.php');
			require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/lib_util.inc.php');
			require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/nucleo/funciones.php');	
			
			/////////////////Require function selectTable()///////////////
			//require_once('../../lib/share/clases/tableProfileSelector.php');



class VideoComment {


	
	
	/////////////////Function to select table Video by profile///////////////////////////////
	/*private function selectTable($profileId){
	
			if($profileId<7){
				$tableProfile='ax_videoPlayer';
			}elseif($profileId<13){
				$tableProfile='ax_videoCoach';
			}elseif($profileId<16){
				$tableProfile='ax_videoAgent';
			}elseif($profileId==16){
				$tableProfile='ax_videoScout';
			}elseif($profileId==17){
				$tableProfile='ax_videoLawyer';
			}elseif($profileId<20){
				$tableProfile='ax_videoManager';
			}elseif($profileId<23){
				$tableProfile='ax_videoMedic';
			}elseif($profileId==23){
				$tableProfile='ax_videoFan';
			}elseif($profileId==24){
				$tableProfile='ax_videoJournalist';
			}elseif($profileId==25){
				$tableProfile='ax_videoSelection';
			}elseif($profileId==26){
				$tableProfile='ax_videoClub';
			}elseif($profileId==27){
				$tableProfile='ax_videoCompany';
			}
			
			return $tableProfile;
		
		}*/
	
	
	
	
	
	
	////////////////SELECT - SELECTS data////////////////
	function selectVideoComment($fields,$whereSel,$orderSel='id desc'){
				
		//$tableProfile=$this->selectTable($profileId);
		$tableProfile='ax_videoComment';
		
		$registros=$this->selVidComment($fields,$tableProfile,$whereSel,$orderSel);	
		return $registros;
		
		
	}


///////////////SELECT the register/////////////////////////////
	
	
		private function selVidComment($fields,$tableProfile,$whereSel,$orderSel){
	
			$bd2=new conexion();
							
			$sSQL_Select = GenerateSelect($fields,$tableProfile,$whereSel,$orderSel);
			
			$registros = $bd2->query($sSQL_Select);
			
			//echo $sSQL_Select;
			
			return $registros;
			
			

	}//selProf
	
	
	
	///////////////////////PAGINATION///////////////////////////////////////////////////
	
		function paginate($profileId,$page=1,$restrict=NULL,$var1=array(),$cant=1){
		
			//$tableProfile=$this->selectTable($profileId);
			$tableProfile='ax_videoComment';
			
			$bd=new conexion();
				
			$bd->query("SELECT id FROM $tableProfile WHERE active='1' $restrict");
			$array = mostrarPaginadoSebaComment($bd->n,$page,$cant,$var1);
			list($paginado, $inicio) = $array;	
			
			return "$inicio,$paginado";
			

		
		}//pagination

	
	
	
	
	
	
	
	
	
////////////////ADD - Check where to insert the data////////////////
	function addVideoComment($fields){
				
		//$tableProfile=$this->selectTable($profileId);
		$tableProfile='ax_videoComment';
		if($this->addVidComment($tableProfile,$fields)){
			return true;
		}else{
			return false;
		}
		
		
		
	}
	
	
///////////////Inserts the register into de tabl/////////////////////////////
	

	
		function addVidComment($tableProfile,$fields){
			
			
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
	function upVideoComment($fields,$whereUp){
				
		//$tableProfile=$this->selectTable($profileId);
		$tableProfile='ax_videoComment';
		
		if($this->upVidComment($tableProfile,$fields,$whereUp)){
			return true;
		}else{
			return false;
		}
		
		
		
	}


///////////////UPDATE the register/////////////////////////////
	

	
	private	function upVidComment($tableProfile,$fields,$whereUp){
	
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
	function delVideoComment($whereDel){
			
			//$tableProfile=$this->selectTable($profileId);
			$tableProfile='ax_videoComment';
			
		if($this->delVidComment($tableProfile,$whereDel)){
			return true;
		}else{
			return false;
		}
		
		
		
	}


///////////////Delete the register/////////////////////////////
	

	
		function delVidComment($tableProfile,$whereDel){
	
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
