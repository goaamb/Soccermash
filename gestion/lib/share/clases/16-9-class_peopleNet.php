<?PHP
require_once('lib_util.inc.php');

class PeopleNet
{

/*
 +++++++:: Comment ::+++++++ 
	La clase PeopleNet maneja las relaciones de un usuario, con sus Follower/Following,
	y ademas con el modulo de Latest People.
	Tiene una estructura con ID del usuario,con campos Varchar que son serializados para
	usarse como array.
 +++++++:: MmCc ::+++++++ 
*/ 
 	// Global properties
	var $aErrores = array();
	var $sFields 	= NULL;
	var $oDBLP;

	// User Data
	var $iID 			= NULL;
	
	function __construct()
	{
		global $SITE_oDB ;

		$this->sFields ='id_user,latest_people,history_visit';#ax_latestPeople
		$this->sFieldsFollower ='id_user,follower,following,history_follower,history_following';#ax_follower
		$this->oDBLP =& $SITE_oDB ;
	}#LatestPeople()
 
	/* +++ Funcionalidades de Latest People +++
	 * ************************************
	*/
 	# Add main user the table ax_latestPeople
	function agregarUsuario($iIdUser)
	{
		$aUsuario=Array();
		#$aVectorVisit=Array(0,0,0,0,0,0,0,0,0);#Array de visitantes		
		$aVectorIds=Array(0,0,0,0,0,0,0,0,0);#Array de Ids visitantes
		$aVectorNames=Array('','','','','','','','','');#Array de Names visitantes
		$aVectorVisit=Array("id"=>$aVectorIds,"name"=>$aVectorNames);
		$aHistoryVisit=Array();#Array del historial de visitantes
		$aUsuario['latest_people']=serialize($aVectorVisit);#serializo p/ pasar a varchar
		$aUsuario['history_visit']=serialize($aHistoryVisit);#serializo p/ pasar a varchar
		$aUsuario['id_user']=$iIdUser;

		$sSQL_Insert = GenerateInsert(SITE_DB_TB_SystemLatestPeople, $aUsuario);
		if ($DB_Result = $this->oDBLP->Query($sSQL_Insert))
		{
			$bFollower=$this->agregarUserFollower($iIdUser);#add user ax_follower
			return true;
		}
		
		return false;
		
	}#agregarUsuarioLatestPeople()
 

 	
	#Return all my visiting
	function getAllVisit($iIdUSer){
		$aGetArray=Array();
		$aVectorVisit=Array();
		#get visiting
		$sSQL_Select = GenerateSelect($this->sFields, SITE_DB_TB_SystemLatestPeople, "id_user='$iIdUSer'");
		$DB_Result 	 = $this->oDBLP->Query($sSQL_Select);
		$aGetArray	 = $this->oDBLP->FetchRowAssoc($DB_Result);
		$aVectorVisit   =unserialize($aGetArray['latest_people']);
	
		#retorna el vector de latest people
		return $aVectorVisit; 
	}
	
	
	#Add visiting people
	function agregarVisit($iIdUSer,$iIdUserVisit){
		
		$bExist=$this->getExistLast($iIdUSer,$iIdUserVisit);
		return $bExist;
	
	}
 	
	#Return true ya en las ultimas visitas o si lo inserto con exito
	function getExistLast($iIdUSer,$iIdUserVisit){
		require_once('class_site.inc.php');
		global  $SITE;
		$SITE = new SITE();
		$aUserVisit = $SITE->getUsuario(NULL, "id='$iIdUSer'");
		$sNameVisit=$aUserVisit['name'];
		
		$aGetArray=Array();
		#query
		$sSQL_Select = GenerateSelect($this->sFields, SITE_DB_TB_SystemLatestPeople, "id_user='$iIdUserVisit'");
		$DB_Result 	 = $this->oDBLP->Query($sSQL_Select);
		$aGetArray	 = $this->oDBLP->FetchRowAssoc($DB_Result);
		
		#obtengo el array de visitantes & historial
		$aArrayVisit   =Array();
		$aHistoryVisit =Array();
		$aArrayVisit   =unserialize($aGetArray['latest_people']);
		$aVisitIds	   =$aArrayVisit['id'];  #get Array Ids of Visit
		$aVisitNames   =$aArrayVisit['name'];#get Array Names of Visit
		$aHistoryVisit =unserialize($aGetArray['history_visit']);

		$bExist=false;
		for($i=0;$i<sizeof($aVisitIds);$i++){
			if($aVisitIds[$i]==$iIdUSer){#si ya existe en las ultimas visitas
				$bExist=true;
			}
		}
		
		if(!$bExist){#no esta en las ultimas visitas
			$bPlace=false;
			for($i=0;$i<sizeof($aVisitIds);$i++){
				if($aVisitIds[$i]==0 && !$bPlace){#si hay lugar
					$aVisitIds[$i]=$iIdUSer;
					$aVisitNames[$i]=$sNameVisit;
					$bPlace=true;
				}
			}#for	
			if(!$bPlace){#no hay lugar en el vector de visitantes
				#Add position al final del vector IDs
		 		array_push($aVisitIds,$iIdUSer);
		 		#unset la 1er posicion del vector IDs
		 		$aQuita = array_shift($aVisitIds);
		 		#Add position al final del vector Names
		 		array_push($aVisitNames,$sNameVisit);
		 		#unset la 1er posicion del vector Names
		 		$aQuita = array_shift($aVisitNames);
			}
		}#$bExist
		else{#ya en las ultimas visitas
			return true;
		}
		
		#verifico si existe una visita en el historial de visitas
		$bHistory=false;
		for($j=0;$j<sizeof($aHistoryVisit);$j++){
			if($aHistoryVisit[$j]==$iIdUSer){#si ya existe en el historial
				$bHistory=true;
			}
		}
		if(!$bHistory){#no existe en el historial
			array_push($aHistoryVisit,$iIdUSer);
			#inserto de nuevo el vector de visitas & history_visit
			$aHistoryVisit=serialize($aHistoryVisit);
			$aGetArray['history_visit']=$aHistoryVisit;
		}else{#serializo y guardo el historial, sin modificarlo
			$aHistoryVisit=serialize($aHistoryVisit);
			$aGetArray['history_visit']=$aHistoryVisit;
		}

		#visitantes
		$aArrayVisit['id']			=$aVisitIds;
		$aArrayVisit['name']		=$aVisitNames;
		$aArrayVisit 				=serialize($aArrayVisit);
		$aGetArray['latest_people'] =$aArrayVisit;
		#visitantes
		#$aArrayVisit =serialize($aArrayVisit);
		#$aGetArray['latest_people']=$aArrayVisit;

		$sSQL_Update = GenerateUpdate(SITE_DB_TB_SystemLatestPeople, $aGetArray, "id_user='$iIdUserVisit'");
		$bresultUpdate= $this->oDBLP->Query($sSQL_Update);
		
		return $bresultUpdate;
		
	}
	

	
	/* +++ Funcionalidades de Followers +++
	 * ************************************
	 */
	
	# Add main user the table ax_follower::es el User ppal, se inserta una sola vez cdo se registra
	function agregarUserFollower($iIdUser)
	{
		$aUsuarioF		    		   = Array();
		$aFolloweres   	 			   = Array(276,0,0,0,0,0,0,0,0);#Array IDs de Followeres, sirve p Follower & Following:: 276=SoccerMash
		$aVectorFollower    		   = Array("id"=>$aFolloweres);
		$aUsuarioF['follower']		   = serialize($aVectorFollower);#serializo p/ pasar a varchar
		$aUsuarioF['following']		   = serialize($aVectorFollower);#
		
		$aHistory   	 			   = Array(276);#Array IDs de Histoy Followeres, sirve p Follower & Following
		$aHistoryFollower   		   = Array("id"=>$aHistory);
		$aUsuarioF['history_follower'] = serialize($aHistoryFollower);#
		$aUsuarioF['history_following']= serialize($aHistoryFollower);#
		
		$aUsuarioF['id_user']=$iIdUser;
		
		$sSQL_Insert = GenerateInsert(SITE_DB_TB_SystemFollower, $aUsuarioF);
		if ($DB_Result = $this->oDBLP->Query($sSQL_Insert))
		{
			#Add User a SoccerMash User=276
			$iIdUSerSM		= 276;
			#History
			$aHistorySM		= $this->getHistoryFollower($iIdUSerSM);
			$aHistoryIds	= $aHistorySM['id'];#get Array Ids of History Follower
			#Add position al final del vector Id
		 	array_push($aHistoryIds,$iIdUser);
		 	#Last 9
		 	$aLast9SM 		= $this->getAllFollower($iIdUSerSM);
		 	$aLast9SM		= $aLast9SM['id'];  #get Array Ids of Friends
		 	#Add position al final del vector Id
		 	array_push($aLast9SM,$iIdUser);
		 	#unset la 1er posicion del vector Id
		 	$aQuita 	= array_shift($aLast9SM);
		 	#Serialize
		 	$aUsuarioSM	= Array();
		 	$aUsuarioSM['history_follower'] = serialize($aHistoryIds);#History
			$aUsuarioSM['follower']			= serialize($aLast9SM);#Last 9
			#Query
			$sSQL_Insert = GenerateInsert(SITE_DB_TB_SystemFollower, $aUsuarioSM);
			if ($DB_Result = $this->oDBLP->Query($sSQL_Insert))
			{
					return true;
			}
		
		}
		
		return false;
		
	}#agregarUsuarioFollower()
	
	#Return all my last followers
	function getAllFollower($iIdUSer){
		$aGetArray=Array();
		$aVectorFollower=Array();
		#get followers
		$sSQL_Select = GenerateSelect($this->sFieldsFollower, SITE_DB_TB_SystemFollower, "id_user='$iIdUSer'");
		$DB_Result 	 = $this->oDBLP->Query($sSQL_Select);
		$aGetArray	 = $this->oDBLP->FetchRowAssoc($DB_Result);
		$aVectorFollower   =unserialize($aGetArray['follower']);
	
		#retorna el vector de Follower
		return $aVectorFollower; 
	}
 
	#Return all my last following
	function getAllFollowing($iIdUSer){
		$aGetArray=Array();
		$aVectorFollowing=Array();
		#get following
		$sSQL_Select = GenerateSelect($this->sFieldsFollower, SITE_DB_TB_SystemFollower, "id_user='$iIdUSer'");
		$DB_Result 	 = $this->oDBLP->Query($sSQL_Select);
		$aGetArray	 = $this->oDBLP->FetchRowAssoc($DB_Result);
		$aVectorFollowing   =unserialize($aGetArray['follower']);
	
		#retorna el vector de Following
		return $aVectorFollowing; 
	}
 	
	#Return all my History Follower
	function getHistoryFollower($iIdUSer){
		$aGetArray=Array();
		$aVectorHistoryFollower=Array();
		#get History follower
		$sSQL_Select = GenerateSelect($this->sFieldsFollower, SITE_DB_TB_SystemFollower, "id_user='$iIdUSer'");
		$DB_Result 	 = $this->oDBLP->Query($sSQL_Select);
		$aGetArray	 = $this->oDBLP->FetchRowAssoc($DB_Result);
		$aVectorHistoryFollower   =unserialize($aGetArray['history_follower']);
	
		#retorna el vector de History Follower
		return $aVectorHistoryFollower; 
	}
	
	#Return all my History Following
	function getHistoryFollowing($iIdUSer){
		$aGetArray=Array();
		$aVectorHistoryFollowing=Array();
		#get History following
		$sSQL_Select = GenerateSelect($this->sFieldsFollower, SITE_DB_TB_SystemFollower, "id_user='$iIdUSer'");
		$DB_Result 	 = $this->oDBLP->Query($sSQL_Select);
		$aGetArray	 = $this->oDBLP->FetchRowAssoc($DB_Result);
		$aVectorHistoryFollowing   =unserialize($aGetArray['history_follower']);
	
		#retorna el vector de History Following
		return $aVectorHistoryFollowing; 
	}
	
	
	#Add Follower, aca se agregan los followers de un usuario
	function agregarFollower($iIdUSer,$iIdFollower){
				
		$bExist=$this->getExistFollower($iIdUSer,$iIdFollower);
		#Dps sigue q lo actualize en Following del otro usuario al q sigue
		return $bExist;
	
	}
 	
	#Return true ya en las ultimos seguimientos o si lo inserto con exito
	function getExistFollower($iIdUser,$iIdFollower){

		$aGetArray=Array();
		#query
		$sSQL_Select = GenerateSelect($this->sFieldsFollower, SITE_DB_TB_SystemFollower, "id_user='$iIdUser'");
		$DB_Result 	 = $this->oDBLP->Query($sSQL_Select);
		$aGetArray	 = $this->oDBLP->FetchRowAssoc($DB_Result);
		
		#obtengo el array de follower & historial
		$aArrayFollower   = Array();
		$aHistoryFollower = Array();
		$aArrayFollower   = unserialize($aGetArray['follower']);
		$aFollowerIds	  = $aArrayFollower['id'];  #get Array Ids of Follower
		

		$aHistoryFollower = unserialize($aGetArray['history_follower']);
		$aHistoryIds	  = $aHistoryFollower['id'];#get Array Ids of History Follower
		

		$bExist=false;
		for($i=0;$i<sizeof($aFollowerIds);$i++){
			if($aFollowerIds[$i]==$iIdFollower){#si ya existe en las ultimos seguimientos
				$bExist=true;
			}
		}
		
		if(!$bExist){#no esta en las ultimos seguimientos
			$bPlace=false;
			for($i=0;$i<sizeof($aFollowerIds);$i++){
				if($aFollowerIds[$i]==0 && !$bPlace){#si hay lugar
					$aFollowerIds[$i]=$iIdFollower;    #save Id follower
					$bPlace=true;
				}
			}#for	
			if(!$bPlace){#no hay lugar en el vector de follower
				#Add position al final del vector Id
		 		array_push($aFollowerIds,$iIdFollower);
		 		#unset la 1er posicion del vector Id
		 		$aQuita = array_shift($aFollowerIds);
			}
		}#$bExist
		else{#ya en las ultimos seguimientos
			return true;
		}
		
		#verifico si existe una visita en el historial de follower
		$bHistoryFollower=false;
		for($j=0;$j<sizeof($aHistoryIds);$j++){
			if($aHistoryIds[$j]==$iIdFollower){#si ya existe en el historial Ids
				$bHistoryFollower=true;
			}
		}
		if(!$bHistoryFollower){#no existe en el historial
			array_push($aHistoryIds,$iIdFollower);#Id
			
			#inserto de nuevo el vector de history_follower
			$aHistoryFollower['id']=$aHistoryIds;
			$aHistoryFollower =serialize($aHistoryFollower);
			$aGetArray['history_follower']=$aHistoryFollower;

		}else{#serializo y guardo el historial, sin modificarlo
			
			$aHistoryFollower=serialize($aHistoryFollower);
			$aGetArray['history_follower']=$aHistoryFollower;
		}

		#Save followers
		$aArrayFollower['id']	= $aFollowerIds;
		$aArrayFollower 		= serialize($aArrayFollower);
		$aGetArray['follower']	= $aArrayFollower;
		
		$sSQL_Update = GenerateUpdate(SITE_DB_TB_SystemFollower, $aGetArray, "id_user='$iIdUser'");
		$bresultUpdate= $this->oDBLP->Query($sSQL_Update);
		
		#Following
		$iIdFollowing=$iIdFollower;
		#Add Following, user "A" agrega y lo sigue a user "B", pero user "B" ahora lo sigue user "A"-->lo registra
		$bFollowing=$this->agregarFollowing($iIdUser,$iIdFollowing);
		  
		
		return $bresultUpdate;
		
	}#getExistFollower

	
	#Add Following
	function agregarFollowing($iIdUser,$iIdFollowing){
	
		$aGetArray			= Array();
		$aFollowing			= Array();
		$aHistoryFollowing  = Array();
		#query
		$sSQL_Select 		= GenerateSelect($this->sFieldsFollower, SITE_DB_TB_SystemFollower, "id_user='$iIdFollowing'");
		$DB_Result 	 		= $this->oDBLP->Query($sSQL_Select);
		$aGetArray	 		= $this->oDBLP->FetchRowAssoc($DB_Result);
		$aFollowing  		= unserialize($aGetArray['follower']);
		$aFollowingIds	  	= $aFollowing['id'];  #get Array Ids of Following
		$aHistoryFollowing  = unserialize($aGetArray['history_follower']);
		$aHistoryIds	  	= $aHistoryFollowing['id'];#get Array Ids of History Following
		
		$bExist=false;
		for($i=0;$i<sizeof($aFollowingIds);$i++){
			if($aFollowingIds[$i]==$iIdUser){#si ya existe en las ultimos seguidores
				$bExist=true;
			}
		}
		
		if(!$bExist){#no esta en las ultimos seguimientos
			$bPlace=false;
			for($i=0;$i<sizeof($aFollowingIds);$i++){
				if($aFollowingIds[$i]==0 && !$bPlace){#si hay lugar
					$aFollowingIds[$i]=$iIdUser;
					$bPlace=true;
				}
			}#for	
			if(!$bPlace){#no hay lugar en el vector de following
				#Add position al final del vector Ids
		 		array_push($aFollowingIds,$iIdUser);
		 		#unset la 1er posicion del vector Ids following
		 		$aQuita = array_shift($aFollowingIds);
			}
		}#$bExist
		else{#ya en las ultimos seguidores
			return true;
		}
		
		#verifico si existe en el historial de following
		$bHistoryFollowing=false;
		for($j=0;$j<sizeof($aHistoryIds);$j++){
			if($aHistoryIds[$j]==$iIdUser){#si ya existe en el historial
				$bHistoryFollowing=true;
			}
		}
		
		if(!$bHistoryFollowing){#no esta en el historial
			array_push($aHistoryIds,$iIdUser);#id
			#inserto el new ID user en history_following
			$aHistoryFollowing['id']=$aHistoryIds;
			$aHistoryFollowing =serialize($aHistoryFollowing);
			$aGetArray['history_follower']=$aHistoryFollowing;
			
		}else{#guarda el vector sin modificar
			
			$aHistoryFollowing=serialize($aHistoryFollowing);
			$aGetArray['history_follower']=$aHistoryFollowing;
		}
		
		#Serializo el vector following c/ Id 
		$aFollowing['id']		=$aFollowingIds;
		$aFollowing 			=serialize($aFollowing);
		$aGetArray['follower']	=$aFollowing;
		
		#query
		$sSQL_Update = GenerateUpdate(SITE_DB_TB_SystemFollower, $aGetArray, "id_user='$iIdFollowing'");
		$bresultUpdate= $this->oDBLP->Query($sSQL_Update);
		
		return $bresultUpdate;
	}#agregarFollowing
	
	
	
	function  removeFollower($iIdUser,$iIdFriend){
		
		#DELETE My Friends
		$aGetArray=Array();
		
		$sSQL_Select = GenerateSelect($this->sFieldsFollower, SITE_DB_TB_SystemFollower, "id_user='$iIdUser'");
		$DB_Result 	 = $this->oDBLP->Query($sSQL_Select);
		$aGetArray	 = $this->oDBLP->FetchRowAssoc($DB_Result);
		
		#obtengo el array de follower & historial
		$aArrayFollower   = Array();
		$aHistoryFollower = Array();
		
		$aArrayFollower   = unserialize($aGetArray['follower']);	
		$aHistoryFollower = unserialize($aGetArray['history_follower']);
			
		$iKey = array_search($iIdFriend,$aHistoryFollower['id'],TRUE);
		if($iKey){
			unset($aHistoryFollower['id'][$iKey]);
		}
		$aHistoryFollower['id'] = array_values($aHistoryFollower['id']);#reordena el array
		
		#Last 9		
		$aFollowerIds	  = $aArrayFollower['id'];  #get Array Ids of Friends
		$aHistoryIds	  = $aHistoryFollower['id'];#get Array Ids of History Friends:Actualizados
		$iCantF= count($aHistoryIds);
			
		if($iCantF>=9){
			for($i=0;$i<9;$i++){
				$aFollowerIds[$i] = $aHistoryIds[$i];
			}
		}else{#tiene menos q 9
			
			for($i=0;$i<$iCantF;$i++){#completa con los q tiene
				$aFollowerIds[$i] = $aHistoryIds[$i];
			}

			for($j=$i;$j<9;$j++){#completo con -cero a los restante
				$aFollowerIds[$j] = 0;
			}

		}

		#Serialize	
			$aHistoryFollower['id'] 		= $aHistoryIds;
			$aHistoryFollower      		  	= serialize($aHistoryFollower);
			$aGetArray['history_follower']	= $aHistoryFollower;
		
			$aArrayFollower['id']			= $aFollowerIds;
			$aArrayFollower 				= serialize($aArrayFollower);
			$aGetArray['follower']			= $aArrayFollower;
		
		#Save My history_follower	&  last 9
		$sSQL_Update = GenerateUpdate(SITE_DB_TB_SystemFollower, $aGetArray, "id_user='$iIdUser'");
		$bresultUpdate= $this->oDBLP->Query($sSQL_Update);
		
			
		#DELETE Me of My friend
		$aGetArray=Array();
		
		$sSQL_Select = GenerateSelect($this->sFieldsFollower, SITE_DB_TB_SystemFollower, "id_user='$iIdFriend'");
		$DB_Result 	 = $this->oDBLP->Query($sSQL_Select);
		$aGetArray	 = $this->oDBLP->FetchRowAssoc($DB_Result);
		
		#obtengo el array de follower & historial
		$aArrayFollower   = Array();
		$aHistoryFollower = Array();
		
		$aArrayFollower   = unserialize($aGetArray['follower']);	
		$aHistoryFollower = unserialize($aGetArray['history_follower']);
		
		$iKey = array_search($iIdUser,$aHistoryFollower['id'],TRUE);
		if($iKey){
			unset($aHistoryFollower['id'][$iKey]);
		}

		#Last 9		
		$aFollowerIds	  = $aArrayFollower['id'];  #get Array Ids of Friends
		$aHistoryIds	  = $aHistoryFollower['id'];#get Array Ids of History Friends:Actualizados
		$iCantF= count($aHistoryIds);		
		if($iCantF>=9){
			for($i=0;$i<9;$i++){
				$aFollowerIds[$i] = $aHistoryIds[$i];
			}
		}else{#tiene menos q 9
			for($i=0;$i<$iCantF;$i++){#completa con los q tiene
				$aFollowerIds[$i] = $aHistoryIds[$i];
			}
			for($j=$i;$j<9;$j++){#completo con -cero a los restante
				$aFollowerIds[$j] = 0;
			}
		}

		#Serialize	
			$aHistoryFollower['id'] 		= $aHistoryIds;
			$aHistoryFollower      		  	= serialize($aHistoryFollower);
			$aGetArray['history_follower']	= $aHistoryFollower;
		
			$aArrayFollower['id']			= $aFollowerIds;
			$aArrayFollower 				= serialize($aArrayFollower);
			$aGetArray['follower']			= $aArrayFollower;
		
		#Save My history_follower		
		$sSQL_Update = GenerateUpdate(SITE_DB_TB_SystemFollower, $aGetArray, "id_user='$iIdFriend'");
		$bresultUpdate= $this->oDBLP->Query($sSQL_Update);
		
		return $bresultUpdate;
		
	}#removeFollower
	
}#end Class

/*
 * 
 * ClassBy Mcantero
 * MmCc
 */
 
?>
