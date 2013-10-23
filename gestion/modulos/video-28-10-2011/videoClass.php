<?php
//////////////////////Reqiure necesary files////////////////////////////////////////////////
			$dir='';
			require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/nucleo/nucleo.php');
			require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/lib_util.inc.php');
			require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/nucleo/funciones.php');	
			
			/////////////////Require function selectTable()///////////////
			//require_once('../../lib/share/clases/tableProfileSelector.php');



class Video {


	
	
	/////////////////Function to select table Video by profile///////////////////////////////
	private function selectTable($profileId){
	
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
				$tableProfile='ax_videoFederation';
			}elseif($profileId==26){
				$tableProfile='ax_videoClub';
			}elseif($profileId==27){
				$tableProfile='ax_videoCompany';
			}
			
			return $tableProfile;
		
		}
	
	
	
	
	
	
	////////////////SELECT - SELECTS data////////////////
	function selectVideo($profileId,$fields,$whereSel,$orderSel='id desc'){
				
		//$tableProfile=$this->selectTable($profileId);
		$tableProfile='ax_videoUpload';
		
		$registros=$this->selVid($fields,$tableProfile,$whereSel,$orderSel);	
		return $registros;
		
		
	}


///////////////SELECT the register/////////////////////////////
	
	
	
		private function selVid($fields,$tableProfile,$whereSel,$orderSel){
	
			$bd2=new conexion();
							
			$sSQL_Select = GenerateSelect($fields,$tableProfile,$whereSel,$orderSel);
			
			$registros = $bd2->query($sSQL_Select);
			
			//echo $sSQL_Select;
			
			return $registros;
			
			

	}//selProf
	
	
	
	///////////////////////PAGINATION///////////////////////////////////////////////////
	
		function paginate($profileId,$page=1,$restrict=NULL,$var1=array(),$cant=1){
		
			//$tableProfile=$this->selectTable($profileId);
			$tableProfile='ax_videoUpload';
			
			$bd=new conexion();
				
			$bd->query("SELECT id FROM $tableProfile WHERE active='1' $restrict");
			$array = mostrarPaginadoSebaVideos($bd->n,$page,$cant,$var1);
			list($paginado, $inicio) = $array;	
			
			return "$inicio,$paginado";
			

		
		}//pagination

	
	
	
	
	
	
	
	
	
////////////////ADD - Check where to insert the data////////////////
	function addVideo($fields){
				
		//$tableProfile=$this->selectTable($profileId);
		$tableProfile='ax_videoUpload';
		if($this->addVid($tableProfile,$fields)){
			return true;
		}else{
			return false;
		}
		
		
		
	}
	
	
///////////////Inserts the register into de tabl/////////////////////////////
	

	
		function addVid($tableProfile,$fields){
			
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
	function upVideo($fields,$whereUp){
				
		//$tableProfile=$this->selectTable($profileId);
		$tableProfile='ax_videoUpload';
		
		if($this->upVid($tableProfile,$fields,$whereUp)){
			return true;
		}else{
			return false;
		}
		
		
		
	}


///////////////UPDATE the register/////////////////////////////
	

	
	private	function upVid($tableProfile,$fields,$whereUp){
	
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
	function delVideo($whereDel){
			
			//$tableProfile=$this->selectTable($profileId);
			$tableProfile='ax_videoUpload';
			
		if($this->delVid($tableProfile,$whereDel)){
			return true;
		}else{
			return false;
		}
		
		
		
	}


///////////////Delete the register/////////////////////////////
	

	
		function delVid($tableProfile,$whereDel){
	
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
	
		function paginateSearchVideos($profileId,$page=1,$restrict=NULL,$var1=array(),$cant=1){
		
			//$tableProfile=$this->selectTable($profileId);
			$tableProfile='ax_videoUpload';
				
			
			$bd=new conexion();
				
			$bd->query("SELECT id FROM $tableProfile $restrict");
			
			
					
			$array = mostrarPaginadoSebaSearchVideos($bd->n,$page,$cant,$var1);
			list($paginado, $inicio) = $array;	
			
			return "$inicio,$paginado";
			

		
		}//pagination







}//class


?>
