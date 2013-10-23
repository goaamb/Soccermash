<?php


	/////////////////////////////////////Mostrar Paginado seba People////////////////////////////
	function mostrarPaginadoSebaSearchPeople($totalRegistros,$paginaActual,$limiteRegistros,$variablesGet)
	{
		if (!$paginaActual)
		{
			$inicio = 0;
			$paginaActual = 1;
		}
		else
		{
			$inicio = ($paginaActual - 1) * $limiteRegistros;
		}
		
		$totalPaginas = ceil($totalRegistros / $limiteRegistros);
		
			
			
			if(!empty($variablesGet[5])){//strgToSearch
				$v5="<input type='hidden' name='strgToSearch' value='".$variablesGet[5]."' />";
			}else{
				$v5="";
			}
			if(!empty($variablesGet[6])){//storeSelectProfile
				$v6="<input type='hidden' name='storeSelectProfile' value='".$variablesGet[6]."' />";
			}else{
				$v6="";
			}
			
			
	
		
		/*if ($totalPaginas >= 1)
		{
			for ($i=1; $i<=$totalPaginas; $i++)
			{
				if ($paginaActual == $i)
				{
					$paginado .= "<span>$paginaActual</span>";
				}
				else
				{	
				$paginado .="<form name='p1' id='p1' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".$i."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6</form>";
				$paginado .= '<a href=\'javascript:;\' onclick=\'document.getElementById(\"p1\").submit();\'>'.$i.'</a>';
				}
			}
		}*/
		if (($paginaActual - 1) > 0)
		{				
				$paginado .="<form name='f2' id='f2' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($paginaActual - 1)."' />$v5 $v6</form>";
				$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"f2\").submit();\'>previous</a></span>';

		}
		if (($paginaActual + 1) <= $totalPaginas)
		{
			
			$paginado .="<form name='e3' id='e3' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($paginaActual + 1)."' />$v5 $v6</form>";
			$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"e3\").submit();\'>more results</a></span>';
			//"<a target='iframeSearch' method='POST' href='gestion/modulos/home/findAll.php?pageNum=" . ($paginaActual + 1) . $v0.$v1.$v2.$v3.$v4.$v5.$v6 . "'>&gt;</a>";
		}
		
		$array = array($paginado,$inicio);
		return $array;
	}
	
	
	/////////////////////////////////////Mostrar Paginado seba Club////////////////////////////
	function mostrarPaginadoSebaSearchClub($totalRegistros,$paginaActual,$limiteRegistros,$variablesGet)
	{
		if (!$paginaActual)
		{
			$inicio = 0;
			$paginaActual = 1;
		}
		else
		{
			$inicio = ($paginaActual - 1) * $limiteRegistros;
		}
		
		$totalPaginas = ceil($totalRegistros / $limiteRegistros);
		
			
			if(!empty($variablesGet[2])){//club
				$v2="<input type='hidden' name='club' value='".$variablesGet[2]."' />";
			}else{
				$v2="";
			}
			if(!empty($variablesGet[3])){//federation
				$v3="<input type='hidden' name='federation' value='".$variablesGet[3]."' />";
			}else{
				$v3="";
			}
				if(!empty($variablesGet[4])){//company
				$v4="<input type='hidden' name='company' value='".$variablesGet[4]."' />";
			}else{
				$v4="";
			}
			if(!empty($variablesGet[5])){//strgToSearch
				$v5="<input type='hidden' name='strgToSearch' value='".$variablesGet[5]."' />";
			}else{
				$v5="";
			}
			if(!empty($variablesGet[6])){//storeSelectProfile
				$v6="<input type='hidden' name='storeSelectProfile' value='".$variablesGet[6]."' />";
			}else{
				$v6="";
			}
			
			
	
		
		/*if ($totalPaginas >= 1)
		{
			for ($i=1; $i<=$totalPaginas; $i++)
			{
				if ($paginaActual == $i)
				{
					$paginado .= "<span>$paginaActual</span>";
				}
				else
				{	
				$paginado .="<form name='p1' id='p1' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".$i."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6</form>";
				$paginado .= '<a href=\'javascript:;\' onclick=\'document.getElementById(\"p1\").submit();\'>'.$i.'</a>';
				}
			}
		}*/
		if (($paginaActual - 1) > 0)
		{				
				$paginado .="<form name='f2' id='f2' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($paginaActual - 1)."' />$v2 $v3 $v4 $v5 $v6</form>";
				$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"f2\").submit();\'>previous</a></span>';

		}
		if (($paginaActual + 1) <= $totalPaginas)
		{
			
			$paginado .="<form name='e3' id='e3' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($paginaActual + 1)."' />$v2 $v3 $v4 $v5 $v6</form>";
			$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"e3\").submit();\'>more results</a></span>';
			//"<a target='iframeSearch' method='POST' href='gestion/modulos/home/findAll.php?pageNum=" . ($paginaActual + 1) . $v0.$v1.$v2.$v3.$v4.$v5.$v6 . "'>&gt;</a>";
		}
		
		$array = array($paginado,$inicio);
		return $array;
	}
	
	
	/////////////////////////////////////Mostrar Paginado seba Company////////////////////////////
	function mostrarPaginadoSebaSearchCompany($totalRegistros,$paginaActual,$limiteRegistros,$variablesGet)
	{
		if (!$paginaActual)
		{
			$inicio = 0;
			$paginaActual = 1;
		}
		else
		{
			$inicio = ($paginaActual - 1) * $limiteRegistros;
		}
		
		$totalPaginas = ceil($totalRegistros / $limiteRegistros);
		
			
			if(!empty($variablesGet[2])){//club
				$v2="<input type='hidden' name='club' value='".$variablesGet[2]."' />";
			}else{
				$v2="";
			}
			if(!empty($variablesGet[3])){//federation
				$v3="<input type='hidden' name='federation' value='".$variablesGet[3]."' />";
			}else{
				$v3="";
			}
				if(!empty($variablesGet[4])){//company
				$v4="<input type='hidden' name='company' value='".$variablesGet[4]."' />";
			}else{
				$v4="";
			}
			if(!empty($variablesGet[5])){//strgToSearch
				$v5="<input type='hidden' name='strgToSearch' value='".$variablesGet[5]."' />";
			}else{
				$v5="";
			}
			if(!empty($variablesGet[6])){//storeSelectProfile
				$v6="<input type='hidden' name='storeSelectProfile' value='".$variablesGet[6]."' />";
			}else{
				$v6="";
			}
			
			
	
		
		/*if ($totalPaginas >= 1)
		{
			for ($i=1; $i<=$totalPaginas; $i++)
			{
				if ($paginaActual == $i)
				{
					$paginado .= "<span>$paginaActual</span>";
				}
				else
				{	
				$paginado .="<form name='p1' id='p1' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".$i."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6</form>";
				$paginado .= '<a href=\'javascript:;\' onclick=\'document.getElementById(\"p1\").submit();\'>'.$i.'</a>';
				}
			}
		}*/
		if (($paginaActual - 1) > 0)
		{				
				$paginado .="<form name='fc2' id='fc2' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNumCompany' value='".($paginaActual - 1)."' />$v2 $v3 $v4 $v5 $v6</form>";
				$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"fc2\").submit();\'>previous</a></span>';

		}
		if (($paginaActual + 1) <= $totalPaginas)
		{
			
			$paginado .="<form name='ec3' id='ec3' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNumCompany' value='".($paginaActual + 1)."' />$v2 $v3 $v4 $v5 $v6</form>";
			$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"ec3\").submit();\'>more results</a></span>';
			//"<a target='iframeSearch' method='POST' href='gestion/modulos/home/findAll.php?pageNum=" . ($paginaActual + 1) . $v0.$v1.$v2.$v3.$v4.$v5.$v6 . "'>&gt;</a>";
		}
		
		$array = array($paginado,$inicio);
		return $array;
	}
	
	/////////////////////////////////////Mostrar Paginado seba Federation////////////////////////////
	function mostrarPaginadoSebaSearchFederation($totalRegistros,$paginaActual,$limiteRegistros,$variablesGet)
	{
		if (!$paginaActual)
		{
			$inicio = 0;
			$paginaActual = 1;
		}
		else
		{
			$inicio = ($paginaActual - 1) * $limiteRegistros;
		}
		
		$totalPaginas = ceil($totalRegistros / $limiteRegistros);
		
			
			if(!empty($variablesGet[2])){//club
				$v2="<input type='hidden' name='club' value='".$variablesGet[2]."' />";
			}else{
				$v2="";
			}
			if(!empty($variablesGet[3])){//federation
				$v3="<input type='hidden' name='federation' value='".$variablesGet[3]."' />";
			}else{
				$v3="";
			}
				if(!empty($variablesGet[4])){//company
				$v4="<input type='hidden' name='company' value='".$variablesGet[4]."' />";
			}else{
				$v4="";
			}
			if(!empty($variablesGet[5])){//strgToSearch
				$v5="<input type='hidden' name='strgToSearch' value='".$variablesGet[5]."' />";
			}else{
				$v5="";
			}
			if(!empty($variablesGet[6])){//storeSelectProfile
				$v6="<input type='hidden' name='storeSelectProfile' value='".$variablesGet[6]."' />";
			}else{
				$v6="";
			}
			
			
	
		
		/*if ($totalPaginas >= 1)
		{
			for ($i=1; $i<=$totalPaginas; $i++)
			{
				if ($paginaActual == $i)
				{
					$paginado .= "<span>$paginaActual</span>";
				}
				else
				{	
				$paginado .="<form name='p1' id='p1' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".$i."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6</form>";
				$paginado .= '<a href=\'javascript:;\' onclick=\'document.getElementById(\"p1\").submit();\'>'.$i.'</a>';
				}
			}
		}*/
		if (($paginaActual - 1) > 0)
		{				
				$paginado .="<form name='ff2' id='ff2' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNumFederation' value='".($paginaActual - 1)."' />$v2 $v3 $v4 $v5 $v6</form>";
				$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"ff2\").submit();\'>previous</a></span>';

		}
		if (($paginaActual + 1) <= $totalPaginas)
		{
			
			$paginado .="<form name='ef3' id='ef3' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNumFederation' value='".($paginaActual + 1)."' />$v2 $v3 $v4 $v5 $v6</form>";
			$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"ef3\").submit();\'>more results</a></span>';
			//"<a target='iframeSearch' method='POST' href='gestion/modulos/home/findAll.php?pageNum=" . ($paginaActual + 1) . $v0.$v1.$v2.$v3.$v4.$v5.$v6 . "'>&gt;</a>";
		}
		
		$array = array($paginado,$inicio);
		return $array;
	}
	
	
	
	
	
	/////////////////////////////////////Mostrar Paginado seba Player////////////////////////////
	function mostrarPaginadoSebaSearchPlayer($totalRegistros,$paginaActual,$limiteRegistros,$variablesGet)
	{
		if (!$paginaActual)
		{
			$inicio = 0;
			$paginaActual = 1;
		}
		else
		{
			$inicio = ($paginaActual - 1) * $limiteRegistros;
		}
		
		$totalPaginas = ceil($totalRegistros / $limiteRegistros);
		
			if(!empty($variablesGet[0])){//pyundcontr
				$v0="<input type='hidden' name='pyundcontr' value='".$variablesGet[0]."' />";
			}else{
				$v0="";
			}
			if(!empty($variablesGet[1])){//pywthoutcontr
				$v1="<input type='hidden' name='pywthoutcontr' value='".$variablesGet[1]."' />";
			}else{
				$v1="";
			}
			if(!empty($variablesGet[2])){//amtpy
				$v2="<input type='hidden' name='amtpy' value='".$variablesGet[2]."' />";
			}else{
				$v2="";
			}
			if(!empty($variablesGet[3])){//countrySearch
				$v3="<input type='hidden' name='countrySearch' value='".$variablesGet[3]."' />";
			}else{
				$v3="";
			}
			if(!empty($variablesGet[4])){//ageSearch
				$v4="<input type='hidden' name='ageSearch' value='".$variablesGet[4]."' />";
			}else{
				$v4="";
			}
			if(!empty($variablesGet[5])){//strgToSearch
				$v5="<input type='hidden' name='strgToSearch' value='".$variablesGet[5]."' />";
			}else{
				$v5="";
			}
			if(!empty($variablesGet[6])){//storeSelectADVProfile
				$v6="<input type='hidden' name='storeSelectADVProfile' value='".$variablesGet[6]."' />";
			}else{
				$v6="";
			}
			if(!empty($variablesGet[7])){//xply
				$v7="<input type='hidden' name='xply' value='".$variablesGet[7]."' />";
			}else{
				$v7="";
			}
			if(!empty($variablesGet[8])){//clubSearch
				$v8="<input type='hidden' name='clubSearch' value='".$variablesGet[8]."' />";
			}else{
				$v8="";
			}
			if(!empty($variablesGet[9])){//endcontdatSearch
				$v9="<input type='hidden' name='endcontdatSearch' value='".$variablesGet[9]."' />";
			}else{
				$v9="";
			}
			if(!empty($variablesGet[10])){//position0
				$v10="<input type='hidden' name='position0' value='".$variablesGet[10]."' />";
			}else{
				$v10="";
			}
			if(!empty($variablesGet[11])){//position1
				$v11="<input type='hidden' name='position1' value='".$variablesGet[11]."' />";
			}else{
				$v11="";
			}
			if(!empty($variablesGet[12])){//position2
				$v12="<input type='hidden' name='position2' value='".$variablesGet[12]."' />";
			}else{
				$v12="";
			}
			if(!empty($variablesGet[13])){//position3
				$v13="<input type='hidden' name='position3' value='".$variablesGet[13]."' />";
			}else{
				$v13="";
			}
			if(!empty($variablesGet[14])){//position4
				$v14="<input type='hidden' name='position4' value='".$variablesGet[14]."' />";
			}else{
				$v14="";
			}
			if(!empty($variablesGet[15])){//position5
				$v15="<input type='hidden' name='position5' value='".$variablesGet[15]."' />";
			}else{
				$v15="";
			}
			if(!empty($variablesGet[16])){//position6
				$v16="<input type='hidden' name='position6' value='".$variablesGet[16]."' />";
			}else{
				$v16="";
			}
			if(!empty($variablesGet[17])){//position7
				$v17="<input type='hidden' name='position7' value='".$variablesGet[17]."' />";
			}else{
				$v17="";
			}
			if(!empty($variablesGet[18])){//position8
				$v18="<input type='hidden' name='position8' value='".$variablesGet[18]."' />";
			}else{
				$v18="";
			}
			if(!empty($variablesGet[19])){//position9
				$v19="<input type='hidden' name='position9' value='".$variablesGet[19]."' />";
			}else{
				$v19="";
			}
			if(!empty($variablesGet[20])){//position10
				$v20="<input type='hidden' name='position10' value='".$variablesGet[20]."' />";
			}else{
				$v20="";
			}
			
			
	
		
		/*if ($totalPaginas >= 1)
		{
			for ($i=1; $i<=$totalPaginas; $i++)
			{
				if ($paginaActual == $i)
				{
					$paginado .= "<span>$paginaActual</span>";
				}
				else
				{	
				$paginado .="<form name='p1' id='p1' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".$i."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6</form>";
				$paginado .= '<a href=\'javascript:;\' onclick=\'document.getElementById(\"p1\").submit();\'>'.$i.'</a>';
				}
			}
		}*/
		if (($paginaActual - 1) > 0)
		{				
				$paginado .="<form name='f2' id='f2' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($paginaActual - 1)."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6 $v7 $v8 $v9 $v10 $v11 $v12 $v13 $v14 $v15 $v16 $v17 $v18 $v19 $v20</form>";
				$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"f2\").submit();\'>previous</a></span>';

		}
		if (($paginaActual + 1) <= $totalPaginas)
		{
			
			$paginado .="<form name='e3' id='e3' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($paginaActual + 1)."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6 $v7 $v8 $v9 $v10 $v11 $v12 $v13 $v14 $v15 $v16 $v17 $v18 $v19 $v20</form>";
			$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"e3\").submit();\'>more results</a></span>';
			//"<a target='iframeSearch' method='POST' href='gestion/modulos/home/findAll.php?pageNum=" . ($paginaActual + 1) . $v0.$v1.$v2.$v3.$v4.$v5.$v6 . "'>&gt;</a>";
		}
		
		$array = array($paginado,$inicio);
		return $array;
	}
	
	
	/////////////////////////////////////Mostrar Paginado seba Coach////////////////////////////
	function mostrarPaginadoSebaSearchCoach($totalRegistros,$paginaActual,$limiteRegistros,$variablesGet)
	{
		if (!$paginaActual)
		{
			$inicio = 0;
			$paginaActual = 1;
		}
		else
		{
			$inicio = ($paginaActual - 1) * $limiteRegistros;
		}
		
		$totalPaginas = ceil($totalRegistros / $limiteRegistros);
		
			if(!empty($variablesGet[0])){//coachUC
				$v0="<input type='hidden' name='coachUC' value='".$variablesGet[0]."' />";
			}else{
				$v0="";
			}
			if(!empty($variablesGet[1])){//coachWOC
				$v1="<input type='hidden' name='coachWOC' value='".$variablesGet[1]."' />";
			}else{
				$v1="";
			}
			if(!empty($variablesGet[2])){//gkeeperUC
				$v2="<input type='hidden' name='gkeeperUC' value='".$variablesGet[2]."' />";
			}else{
				$v2="";
			}
			if(!empty($variablesGet[3])){//countrySearch
				$v3="<input type='hidden' name='countrySearch8' value='".$variablesGet[3]."' />";
			}else{
				$v3="";
			}
			if(!empty($variablesGet[4])){//ageSearch
				$v4="<input type='hidden' name='ageSearch' value='".$variablesGet[4]."' />";
			}else{
				$v4="";
			}
			if(!empty($variablesGet[5])){//strgToSearch
				$v5="<input type='hidden' name='strgToSearch' value='".$variablesGet[5]."' />";
			}else{
				$v5="";
			}
			if(!empty($variablesGet[6])){//storeSelectADVProfile
				$v6="<input type='hidden' name='storeSelectADVProfile' value='".$variablesGet[6]."' />";
			}else{
				$v6="";
			}
			if(!empty($variablesGet[7])){//gkeeperWC
				$v7="<input type='hidden' name='gkeeperWC' value='".$variablesGet[7]."' />";
			}else{
				$v7="";
			}
			if(!empty($variablesGet[8])){//physUC
				$v8="<input type='hidden' name='physUC' value='".$variablesGet[8]."' />";
			}else{
				$v8="";
			}
			if(!empty($variablesGet[9])){//physWOC
				$v9="<input type='hidden' name='physWOC' value='".$variablesGet[9]."' />";
			}else{
				$v9="";
			}
			if(!empty($variablesGet[10])){//clubSearch
				$v10="<input type='hidden' name='clubSearch2' value='".$variablesGet[10]."' />";
			}else{
				$v10="";
			}
			if(!empty($variablesGet[11])){//endcontdatSearch
				$v11="<input type='hidden' name='endcontdatSearch2' value='".$variablesGet[11]."' />";
			}else{
				$v11="";
			}
			
			
	
		
		/*if ($totalPaginas >= 1)
		{
			for ($i=1; $i<=$totalPaginas; $i++)
			{
				if ($paginaActual == $i)
				{
					$paginado .= "<span>$paginaActual</span>";
				}
				else
				{	
				$paginado .="<form name='p1' id='p1' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".$i."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6</form>";
				$paginado .= '<a href=\'javascript:;\' onclick=\'document.getElementById(\"p1\").submit();\'>'.$i.'</a>';
				}
			}
		}*/
		if (($paginaActual - 1) > 0)
		{				
				$paginado .="<form name='f2' id='f2' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($paginaActual - 1)."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6 $v7 $v8 $v9 $v10 $v11</form>";
				$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"f2\").submit();\'>previous</a></span>';

		}
		if (($paginaActual + 1) <= $totalPaginas)
		{
			
			$paginado .="<form name='e3' id='e3' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($paginaActual + 1)."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6 $v7 $v8 $v9 $v10 $v11</form>";
			$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"e3\").submit();\'>more results</a></span>';
			//"<a target='iframeSearch' method='POST' href='gestion/modulos/home/findAll.php?pageNum=" . ($paginaActual + 1) . $v0.$v1.$v2.$v3.$v4.$v5.$v6 . "'>&gt;</a>";
		}
		
		$array = array($paginado,$inicio);
		return $array;
	}
	
	
	/////////////////////////////////////Mostrar Paginado seba Agents////////////////////////////
	function mostrarPaginadoSebaSearchAgent($totalRegistros,$paginaActual,$limiteRegistros,$variablesGet)
	{
		if (!$paginaActual)
		{
			$inicio = 0;
			$paginaActual = 1;
		}
		else
		{
			$inicio = ($paginaActual - 1) * $limiteRegistros;
		}
		
		$totalPaginas = ceil($totalRegistros / $limiteRegistros);
		
			if(!empty($variablesGet[0])){//agfifa
				$v0="<input type='hidden' name='agfifa' value='".$variablesGet[0]."' />";
			}else{
				$v0="";
			}
			if(!empty($variablesGet[1])){//aguefa
				$v1="<input type='hidden' name='aguefa' value='".$variablesGet[1]."' />";
			}else{
				$v1="";
			}
			if(!empty($variablesGet[2])){//aauth
				$v2="<input type='hidden' name='aauth' value='".$variablesGet[2]."' />";
			}else{
				$v2="";
			}
			if(!empty($variablesGet[3])){//aauth
				$v3="<input type='hidden' name='countrySearch17' value='".$variablesGet[3]."' />";
			}else{
				$v3="";
			}
			if(!empty($variablesGet[4])){//aauth
				$v4="<input type='hidden' name='ageSearch' value='".$variablesGet[4]."' />";
			}else{
				$v4="";
			}
			if(!empty($variablesGet[5])){//aauth
				$v5="<input type='hidden' name='strgToSearch' value='".$variablesGet[5]."' />";
			}else{
				$v5="";
			}
			if(!empty($variablesGet[6])){//aauth
				$v6="<input type='hidden' name='storeSelectADVProfile' value='".$variablesGet[6]."' />";
			}else{
				$v6="";
			}
			
			
	
		
		/*if ($totalPaginas >= 1)
		{
			for ($i=1; $i<=$totalPaginas; $i++)
			{
				if ($paginaActual == $i)
				{
					$paginado .= "<span>$paginaActual</span>";
				}
				else
				{	
				$paginado .="<form name='p1' id='p1' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".$i."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6</form>";
				$paginado .= '<a href=\'javascript:;\' onclick=\'document.getElementById(\"p1\").submit();\'>'.$i.'</a>';
				}
			}
		}*/
		if (($paginaActual - 1) > 0)
		{				
				$paginado .="<form name='f2' id='f2' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($paginaActual - 1)."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6</form>";
				$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"f2\").submit();\'>previous</a></span>';

		}
		if (($paginaActual + 1) <= $totalPaginas)
		{
			
			$paginado .="<form name='e3' id='e3' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($paginaActual + 1)."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6</form>";
			$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"e3\").submit();\'>more results</a></span>';
			//"<a target='iframeSearch' method='POST' href='gestion/modulos/home/findAll.php?pageNum=" . ($paginaActual + 1) . $v0.$v1.$v2.$v3.$v4.$v5.$v6 . "'>&gt;</a>";
		}
		
		$array = array($paginado,$inicio);
		return $array;
	}
	
	
	/////////////////////////////////////Mostrar Paginado seba Scout////////////////////////////
	function mostrarPaginadoSebaSearchScout($totalRegistros,$paginaActual,$limiteRegistros,$variablesGet)
	{
		if (!$paginaActual)
		{
			$inicio = 0;
			$paginaActual = 1;
		}
		else
		{
			$inicio = ($paginaActual - 1) * $limiteRegistros;
		}
		
		$totalPaginas = ceil($totalRegistros / $limiteRegistros);
		
			
			
			
			if(!empty($variablesGet[3])){//countrySearch
				$v3="<input type='hidden' name='countrySearch4' value='".$variablesGet[3]."' />";
			}else{
				$v3="";
			}
			if(!empty($variablesGet[4])){//ageSearch
				$v4="<input type='hidden' name='ageSearch' value='".$variablesGet[4]."' />";
			}else{
				$v4="";
			}
			if(!empty($variablesGet[5])){//strgToSearch
				$v5="<input type='hidden' name='strgToSearch' value='".$variablesGet[5]."' />";
			}else{
				$v5="";
			}
			if(!empty($variablesGet[6])){//storeSelectADVProfile
				$v6="<input type='hidden' name='storeSelectADVProfile' value='".$variablesGet[6]."' />";
			}else{
				$v6="";
			}
			
			
	
		
		/*if ($totalPaginas >= 1)
		{
			for ($i=1; $i<=$totalPaginas; $i++)
			{
				if ($paginaActual == $i)
				{
					$paginado .= "<span>$paginaActual</span>";
				}
				else
				{	
				$paginado .="<form name='p1' id='p1' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".$i."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6</form>";
				$paginado .= '<a href=\'javascript:;\' onclick=\'document.getElementById(\"p1\").submit();\'>'.$i.'</a>';
				}
			}
		}*/
		if (($paginaActual - 1) > 0)
		{				
				$paginado .="<form name='f2' id='f2' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($paginaActual - 1)."' />$v3 $v4 $v5 $v6</form>";
				$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"f2\").submit();\'>previous</a></span>';

		}
		if (($paginaActual + 1) <= $totalPaginas)
		{
			
			$paginado .="<form name='e3' id='e3' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($paginaActual + 1)."' />$v3 $v4 $v5 $v6</form>";
			$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"e3\").submit();\'>more results</a></span>';
			//"<a target='iframeSearch' method='POST' href='gestion/modulos/home/findAll.php?pageNum=" . ($paginaActual + 1) . $v0.$v1.$v2.$v3.$v4.$v5.$v6 . "'>&gt;</a>";
		}
		
		$array = array($paginado,$inicio);
		return $array;
	}
	
	/////////////////////////////////////Mostrar Paginado seba Lawyer////////////////////////////
	function mostrarPaginadoSebaSearchLawyer($totalRegistros,$paginaActual,$limiteRegistros,$variablesGet)
	{
		if (!$paginaActual)
		{
			$inicio = 0;
			$paginaActual = 1;
		}
		else
		{
			$inicio = ($paginaActual - 1) * $limiteRegistros;
		}
		
		$totalPaginas = ceil($totalRegistros / $limiteRegistros);
		
			
			
			
			if(!empty($variablesGet[3])){//countrySearch
				$v3="<input type='hidden' name='countrySearch5' value='".$variablesGet[3]."' />";
			}else{
				$v3="";
			}
			if(!empty($variablesGet[4])){//ageSearch
				$v4="<input type='hidden' name='ageSearch' value='".$variablesGet[4]."' />";
			}else{
				$v4="";
			}
			if(!empty($variablesGet[5])){//strgToSearch
				$v5="<input type='hidden' name='strgToSearch' value='".$variablesGet[5]."' />";
			}else{
				$v5="";
			}
			if(!empty($variablesGet[6])){//storeSelectADVProfile
				$v6="<input type='hidden' name='storeSelectADVProfile' value='".$variablesGet[6]."' />";
			}else{
				$v6="";
			}
			
			
	
		
		/*if ($totalPaginas >= 1)
		{
			for ($i=1; $i<=$totalPaginas; $i++)
			{
				if ($paginaActual == $i)
				{
					$paginado .= "<span>$paginaActual</span>";
				}
				else
				{	
				$paginado .="<form name='p1' id='p1' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".$i."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6</form>";
				$paginado .= '<a href=\'javascript:;\' onclick=\'document.getElementById(\"p1\").submit();\'>'.$i.'</a>';
				}
			}
		}*/
		if (($paginaActual - 1) > 0)
		{				
				$paginado .="<form name='f2' id='f2' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($paginaActual - 1)."' />$v3 $v4 $v5 $v6</form>";
				$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"f2\").submit();\'>previous</a></span>';

		}
		if (($paginaActual + 1) <= $totalPaginas)
		{
			
			$paginado .="<form name='e3' id='e3' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($paginaActual + 1)."' />$v3 $v4 $v5 $v6</form>";
			$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"e3\").submit();\'>more results</a></span>';
			//"<a target='iframeSearch' method='POST' href='gestion/modulos/home/findAll.php?pageNum=" . ($paginaActual + 1) . $v0.$v1.$v2.$v3.$v4.$v5.$v6 . "'>&gt;</a>";
		}
		
		$array = array($paginado,$inicio);
		return $array;
	}
	
	
	/////////////////////////////////////Mostrar Paginado seba Health////////////////////////////
	function mostrarPaginadoSebaSearchHealth($totalRegistros,$paginaActual,$limiteRegistros,$variablesGet)
	{
		if (!$paginaActual)
		{
			$inicio = 0;
			$paginaActual = 1;
		}
		else
		{
			$inicio = ($paginaActual - 1) * $limiteRegistros;
		}
		
		$totalPaginas = ceil($totalRegistros / $limiteRegistros);
		
			if(!empty($variablesGet[0])){//nutr
				$v0="<input type='hidden' name='nutr' value='".$variablesGet[0]."' />";
			}else{
				$v0="";
			}
			if(!empty($variablesGet[1])){//sptmedic
				$v1="<input type='hidden' name='sptmedic' value='".$variablesGet[1]."' />";
			}else{
				$v1="";
			}
			if(!empty($variablesGet[2])){//mssgt
				$v2="<input type='hidden' name='mssgt' value='".$variablesGet[2]."' />";
			}else{
				$v2="";
			}
			if(!empty($variablesGet[3])){//countrySearch
				$v3="<input type='hidden' name='countrySearch2' value='".$variablesGet[3]."' />";
			}else{
				$v3="";
			}
			if(!empty($variablesGet[4])){//ageSearch
				$v4="<input type='hidden' name='ageSearch' value='".$variablesGet[4]."' />";
			}else{
				$v4="";
			}
			if(!empty($variablesGet[5])){//strgToSearch
				$v5="<input type='hidden' name='strgToSearch' value='".$variablesGet[5]."' />";
			}else{
				$v5="";
			}
			if(!empty($variablesGet[6])){//storeSelectADVProfile
				$v6="<input type='hidden' name='storeSelectADVProfile' value='".$variablesGet[6]."' />";
			}else{
				$v6="";
			}
			
			
	
		
		/*if ($totalPaginas >= 1)
		{
			for ($i=1; $i<=$totalPaginas; $i++)
			{
				if ($paginaActual == $i)
				{
					$paginado .= "<span>$paginaActual</span>";
				}
				else
				{	
				$paginado .="<form name='p1' id='p1' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".$i."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6</form>";
				$paginado .= '<a href=\'javascript:;\' onclick=\'document.getElementById(\"p1\").submit();\'>'.$i.'</a>';
				}
			}
		}*/
		if (($paginaActual - 1) > 0)
		{				
				$paginado .="<form name='f2' id='f2' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($paginaActual - 1)."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6</form>";
				$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"f2\").submit();\'>previous</a></span>';

		}
		if (($paginaActual + 1) <= $totalPaginas)
		{
			
			$paginado .="<form name='e3' id='e3' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($paginaActual + 1)."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6</form>";
			$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"e3\").submit();\'>more results</a></span>';
			//"<a target='iframeSearch' method='POST' href='gestion/modulos/home/findAll.php?pageNum=" . ($paginaActual + 1) . $v0.$v1.$v2.$v3.$v4.$v5.$v6 . "'>&gt;</a>";
		}
		
		$array = array($paginado,$inicio);
		return $array;
	}
		
	
	/////////////////////////////////////Mostrar Paginado seba Sport director////////////////////////////
	function mostrarPaginadoSebaSearchDirector($totalRegistros,$paginaActual,$limiteRegistros,$variablesGet)
	{
		if (!$paginaActual)
		{
			$inicio = 0;
			$paginaActual = 1;
		}
		else
		{
			$inicio = ($paginaActual - 1) * $limiteRegistros;
		}
		
		$totalPaginas = ceil($totalRegistros / $limiteRegistros);
		
			if(!empty($variablesGet[0])){//sptdir
				$v0="<input type='hidden' name='sptdir' value='".$variablesGet[0]."' />";
			}else{
				$v0="";
			}
			if(!empty($variablesGet[1])){//tcnsec
				$v1="<input type='hidden' name='tcnsec' value='".$variablesGet[1]."' />";
			}else{
				$v1="";
			}
			/*if(!empty($variablesGet[2])){//mssgt
				$v2="<input type='hidden' name='mssgt' value='".$variablesGet[2]."' />";
			}else{
				$v2="";
			}*/
			if(!empty($variablesGet[3])){//countrySearch
				$v3="<input type='hidden' name='countrySearch3' value='".$variablesGet[3]."' />";
			}else{
				$v3="";
			}
			if(!empty($variablesGet[4])){//ageSearch
				$v4="<input type='hidden' name='ageSearch' value='".$variablesGet[4]."' />";
			}else{
				$v4="";
			}
			if(!empty($variablesGet[5])){//strgToSearch
				$v5="<input type='hidden' name='strgToSearch' value='".$variablesGet[5]."' />";
			}else{
				$v5="";
			}
			if(!empty($variablesGet[6])){//storeSelectADVProfile
				$v6="<input type='hidden' name='storeSelectADVProfile' value='".$variablesGet[6]."' />";
			}else{
				$v6="";
			}
			
			
	
		
		/*if ($totalPaginas >= 1)
		{
			for ($i=1; $i<=$totalPaginas; $i++)
			{
				if ($paginaActual == $i)
				{
					$paginado .= "<span>$paginaActual</span>";
				}
				else
				{	
				$paginado .="<form name='p1' id='p1' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".$i."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6</form>";
				$paginado .= '<a href=\'javascript:;\' onclick=\'document.getElementById(\"p1\").submit();\'>'.$i.'</a>';
				}
			}
		}*/
		if (($paginaActual - 1) > 0)
		{				
				$paginado .="<form name='f2' id='f2' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($paginaActual - 1)."' />$v0 $v1 $v3 $v4 $v5 $v6</form>";
				$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"f2\").submit();\'>previous</a></span>';

		}
		if (($paginaActual + 1) <= $totalPaginas)
		{
			
			$paginado .="<form name='e3' id='e3' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($paginaActual + 1)."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6</form>";
			$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"e3\").submit();\'>more results</a></span>';
			//"<a target='iframeSearch' method='POST' href='gestion/modulos/home/findAll.php?pageNum=" . ($paginaActual + 1) . $v0.$v1.$v2.$v3.$v4.$v5.$v6 . "'>&gt;</a>";
		}
		
		$array = array($paginado,$inicio);
		return $array;
	}
	
	
	/////////////////////////////////////Mostrar Paginado seba Fan////////////////////////////
	function mostrarPaginadoSebaSearchFan($totalRegistros,$paginaActual,$limiteRegistros,$variablesGet)
	{
		if (!$paginaActual)
		{
			$inicio = 0;
			$paginaActual = 1;
		}
		else
		{
			$inicio = ($paginaActual - 1) * $limiteRegistros;
		}
		
		$totalPaginas = ceil($totalRegistros / $limiteRegistros);
		
			
			
			
			if(!empty($variablesGet[3])){//countrySearch
				$v3="<input type='hidden' name='countrySearch7' value='".$variablesGet[3]."' />";
			}else{
				$v3="";
			}
			if(!empty($variablesGet[4])){//ageSearch
				$v4="<input type='hidden' name='ageSearch' value='".$variablesGet[4]."' />";
			}else{
				$v4="";
			}
			if(!empty($variablesGet[5])){//strgToSearch
				$v5="<input type='hidden' name='strgToSearch' value='".$variablesGet[5]."' />";
			}else{
				$v5="";
			}
			if(!empty($variablesGet[6])){//storeSelectADVProfile
				$v6="<input type='hidden' name='storeSelectADVProfile' value='".$variablesGet[6]."' />";
			}else{
				$v6="";
			}
			
			
	
		
		/*if ($totalPaginas >= 1)
		{
			for ($i=1; $i<=$totalPaginas; $i++)
			{
				if ($paginaActual == $i)
				{
					$paginado .= "<span>$paginaActual</span>";
				}
				else
				{	
				$paginado .="<form name='p1' id='p1' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".$i."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6</form>";
				$paginado .= '<a href=\'javascript:;\' onclick=\'document.getElementById(\"p1\").submit();\'>'.$i.'</a>';
				}
			}
		}*/
		if (($paginaActual - 1) > 0)
		{				
				$paginado .="<form name='f2' id='f2' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($paginaActual - 1)."' />$v3 $v4 $v5 $v6</form>";
				$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"f2\").submit();\'>previous</a></span>';

		}
		if (($paginaActual + 1) <= $totalPaginas)
		{
			
			$paginado .="<form name='e3' id='e3' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($paginaActual + 1)."' />$v3 $v4 $v5 $v6</form>";
			$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"e3\").submit();\'>more results</a></span>';
			//"<a target='iframeSearch' method='POST' href='gestion/modulos/home/findAll.php?pageNum=" . ($paginaActual + 1) . $v0.$v1.$v2.$v3.$v4.$v5.$v6 . "'>&gt;</a>";
		}
		
		$array = array($paginado,$inicio);
		return $array;
	}
	
	
	/////////////////////////////////////Mostrar Paginado seba Journalist////////////////////////////
	function mostrarPaginadoSebaSearchJournalist($totalRegistros,$paginaActual,$limiteRegistros,$variablesGet)
	{
		if (!$paginaActual)
		{
			$inicio = 0;
			$paginaActual = 1;
		}
		else
		{
			$inicio = ($paginaActual - 1) * $limiteRegistros;
		}
		
		$totalPaginas = ceil($totalRegistros / $limiteRegistros);
		
			
			
			
			if(!empty($variablesGet[3])){//countrySearch
				$v3="<input type='hidden' name='countrySearch6' value='".$variablesGet[3]."' />";
			}else{
				$v3="";
			}
			if(!empty($variablesGet[4])){//ageSearch
				$v4="<input type='hidden' name='ageSearch' value='".$variablesGet[4]."' />";
			}else{
				$v4="";
			}
			if(!empty($variablesGet[5])){//strgToSearch
				$v5="<input type='hidden' name='strgToSearch' value='".$variablesGet[5]."' />";
			}else{
				$v5="";
			}
			if(!empty($variablesGet[6])){//storeSelectADVProfile
				$v6="<input type='hidden' name='storeSelectADVProfile' value='".$variablesGet[6]."' />";
			}else{
				$v6="";
			}
			
			
	
		
		/*if ($totalPaginas >= 1)
		{
			for ($i=1; $i<=$totalPaginas; $i++)
			{
				if ($paginaActual == $i)
				{
					$paginado .= "<span>$paginaActual</span>";
				}
				else
				{	
				$paginado .="<form name='p1' id='p1' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".$i."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6</form>";
				$paginado .= '<a href=\'javascript:;\' onclick=\'document.getElementById(\"p1\").submit();\'>'.$i.'</a>';
				}
			}
		}*/
		if (($paginaActual - 1) > 0)
		{				
				$paginado .="<form name='f2' id='f2' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($paginaActual - 1)."' />$v3 $v4 $v5 $v6</form>";
				$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"f2\").submit();\'>previous</a></span>';

		}
		if (($paginaActual + 1) <= $totalPaginas)
		{
			
			$paginado .="<form name='e3' id='e3' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($paginaActual + 1)."' />$v3 $v4 $v5 $v6</form>";
			$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"e3\").submit();\'>more results</a></span>';
			//"<a target='iframeSearch' method='POST' href='gestion/modulos/home/findAll.php?pageNum=" . ($paginaActual + 1) . $v0.$v1.$v2.$v3.$v4.$v5.$v6 . "'>&gt;</a>";
		}
		
		$array = array($paginado,$inicio);
		return $array;
	}
	
	/////////////////////////////////////Mostrar Paginado seba search Videos////////////////////////////
	function mostrarPaginadoSebaSearchVideos($totalRegistros,$paginaActual,$limiteRegistros,$variablesGet)
	{
		if (!$paginaActual)
		{
			$inicio = 0;
			$paginaActual = 1;
		}
		else
		{
			$inicio = ($paginaActual - 1) * $limiteRegistros;
		}
		
		$totalPaginas = ceil($totalRegistros / $limiteRegistros);
		
			if(!empty($variablesGet[3])){//photo
				$v3="<input type='hidden' name='photo' value='".$variablesGet[3]."' />";
			}else{
				$v3="";
			}
			if(!empty($variablesGet[4])){//video
				$v4="<input type='hidden' name='video' value='".$variablesGet[4]."' />";
			}else{
				$v4="";
			}
			if(!empty($variablesGet[5])){//strgToSearch
				$v5="<input type='hidden' name='strgToSearch' value='".$variablesGet[5]."' />";
			}else{
				$v5="";
			}
			if(!empty($variablesGet[6])){//storeSelectProfile
				$v6="<input type='hidden' name='storeSelectProfile' value='".$variablesGet[6]."' />";
			}else{
				$v6="";
			}
			
			
	
		
		/*if ($totalPaginas >= 1)
		{
			for ($i=1; $i<=$totalPaginas; $i++)
			{
				if ($paginaActual == $i)
				{
					$paginado .= "<span>$paginaActual</span>";
				}
				else
				{	
				$paginado .="<form name='p1' id='p1' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".$i."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6</form>";
				$paginado .= '<a href=\'javascript:;\' onclick=\'document.getElementById(\"p1\").submit();\'>'.$i.'</a>';
				}
			}
		}*/
		if (($paginaActual - 1) > 0)
		{				
				$paginado .="<form name='f2' id='f2' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($paginaActual - 1)."' />$v3 $v4 $v5 $v6</form>";
				$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"f2\").submit();\'>previous</a></span>';

		}
		if (($paginaActual + 1) <= $totalPaginas)
		{
			
			$paginado .="<form name='e3' id='e3' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($paginaActual + 1)."' />$v3 $v4 $v5 $v6</form>";
			$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"e3\").submit();\'>more results</a></span>';
			//"<a target='iframeSearch' method='POST' href='gestion/modulos/home/findAll.php?pageNum=" . ($paginaActual + 1) . $v0.$v1.$v2.$v3.$v4.$v5.$v6 . "'>&gt;</a>";
		}
		
		$array = array($paginado,$inicio);
		return $array;
	}
	
	/////////////////////////////////////Mostrar Paginado seba search Photos////////////////////////////
	function mostrarPaginadoSebaSearchPhotos($totalRegistros,$paginaActual,$limiteRegistros,$variablesGet)
	{
		if (!$paginaActual)
		{
			$inicio = 0;
			$paginaActual = 1;
		}
		else
		{
			$inicio = ($paginaActual - 1) * $limiteRegistros;
		}
		
		$totalPaginas = ceil($totalRegistros / $limiteRegistros);
		
			if(!empty($variablesGet[3])){//photo
				$v3="<input type='hidden' name='photo' value='".$variablesGet[3]."' />";
			}else{
				$v3="";
			}
			if(!empty($variablesGet[4])){//video
				$v4="<input type='hidden' name='video' value='".$variablesGet[4]."' />";
			}else{
				$v4="";
			}
			if(!empty($variablesGet[5])){//strgToSearch
				$v5="<input type='hidden' name='strgToSearch' value='".$variablesGet[5]."' />";
			}else{
				$v5="";
			}
			if(!empty($variablesGet[6])){//storeSelectProfile
				$v6="<input type='hidden' name='storeSelectProfile' value='".$variablesGet[6]."' />";
			}else{
				$v6="";
			}
			
			
	
		
		/*if ($totalPaginas >= 1)
		{
			for ($i=1; $i<=$totalPaginas; $i++)
			{
				if ($paginaActual == $i)
				{
					$paginado .= "<span>$paginaActual</span>";
				}
				else
				{	
				$paginado .="<form name='p1' id='p1' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".$i."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6</form>";
				$paginado .= '<a href=\'javascript:;\' onclick=\'document.getElementById(\"p1\").submit();\'>'.$i.'</a>';
				}
			}
		}*/
		if (($paginaActual - 1) > 0)
		{				
				$paginado .="<form name='fh2' id='fh2' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNumPhoto' value='".($paginaActual - 1)."' />$v3 $v4 $v5 $v6</form>";
				$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"fh2\").submit();\'>previous</a></span>';

		}
		if (($paginaActual + 1) <= $totalPaginas)
		{
			
			$paginado .="<form name='eh3' id='eh3' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNumPhoto' value='".($paginaActual + 1)."' />$v3 $v4 $v5 $v6</form>";
			$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"eh3\").submit();\'>more results</a></span>';
			//"<a target='iframeSearch' method='POST' href='gestion/modulos/home/findAll.php?pageNum=" . ($paginaActual + 1) . $v0.$v1.$v2.$v3.$v4.$v5.$v6 . "'>&gt;</a>";
		}
		
		$array = array($paginado,$inicio);
		return $array;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	////////////////////////// Función paginado Seba Videos ///////////////////////////////////////
	function mostrarPaginadoSebaVideos($totalRegistros,$paginaActual,$limiteRegistros,$varGet)
	{
		//$paginado="";
		if (!$paginaActual)
		{
			$inicio = 0;
			$paginaActual = 1;
		}
		else
		{
			$inicio = ($paginaActual - 1) * $limiteRegistros;
		}
		
		$totalPaginas = ceil($totalRegistros / $limiteRegistros);
		
		
			
			?>
			<script type="text/javascript">
			var iUp=new Array();
			iUp.push('<? echo $varGet[0]; ?>');
			iUp.push('<? echo $varGet[1]; ?>');
			iUp.push('<? echo $varGet[2]; ?>');
			iUp.push('<? echo $varGet[3]; ?>');
			iUp.push('<? echo $varGet[4]; ?>');
			iUp.push('<? echo $varGet[5]; ?>');
			iUp.push('<? echo $varGet[6]; ?>');
			iUp.push('<? echo $varGet[7]; ?>');	
						
			var iUp2=new Array();
			iUp2.push('<? echo $varGet[0]; ?>');
			iUp2.push('<? echo $varGet[1]; ?>');
			iUp2.push('<? echo $varGet[2]; ?>');
			iUp2.push('<? echo $varGet[3]; ?>');
			iUp2.push('<? echo $varGet[4]; ?>');
			iUp2.push('<? echo $varGet[5]; ?>');
			iUp2.push('<? echo $varGet[6]; ?>');
			iUp2.push('<? echo $varGet[7]; ?>');	
			</script>		
			<? 
			
		
		
		if (($paginaActual - 1) > 0)
		{
			?>
			<script type="text/javascript">
			iUp2[7]='<? echo base64_encode($paginaActual-1); ?>';	
			</script>		
			<? 
			
			$paginado .= "<a onclick='loadVideosPaginate(iUp2);' href='javascript:;'>previous</a>  ";
		}
		
		
		/*if ($totalPaginas >= 1)
		{	
			
			for ($i=1; $i<=$totalPaginas; $i++)
			{
				if ($paginaActual == $i)
				{
					$paginado .= "<spam>$paginaActual</spam> ";
				}
				else
				{
					?>
					<script type="text/javascript">
					var iUp3<? echo $i; ?>=new Array();
					iUp3<? echo $i; ?>.push('<? echo $varGet[0]; ?>');
					iUp3<? echo $i; ?>.push('<? echo $varGet[1]; ?>');
					iUp3<? echo $i; ?>.push('<? echo $varGet[2]; ?>');
					iUp3<? echo $i; ?>.push('<? echo $varGet[3]; ?>');
					iUp3<? echo $i; ?>.push('<? echo $varGet[4]; ?>');
					iUp3<? echo $i; ?>.push('<? echo $varGet[5]; ?>');
					iUp3<? echo $i; ?>.push('<? echo $varGet[6]; ?>');
					iUp3<? echo $i; ?>.push('<? echo base64_encode($i); ?>');	
					</script>		
					<?
								
					$paginado .= "<a onclick='loadVideosPaginate(iUp3".$i.");' href='javascript:;'>$i</a> ";
				}
			}
		}*/
		
		if (($paginaActual + 1) <= $totalPaginas)
		{
    		//echo $var_Get[0],'-',$var_Get[1];		
			
					
			?>
			<script type="text/javascript">
			iUp[7]='<? echo base64_encode($paginaActual+1); ?>';	
			</script>		
			<? 
			
			//$paginado .=  "<a onclick='videoProfile(\"".($i-1)."\");' href='javascript:;'>Siguiente</a>";
			$paginado .=  "<a onclick='loadVideosPaginate(iUp);' href='javascript:;'>more videos</a>";


			
		}
		
		$array = array($paginado,$inicio);
		return $array;
	}
	
	
	////////////////////////// Función paginado Seba Photos ///////////////////////////////////////
	function mostrarPaginadoSebaPhotos($totalRegistros,$paginaActual,$limiteRegistros,$varGet)
	{
		//$paginado="";
		if (!$paginaActual)
		{
			$inicio = 0;
			$paginaActual = 1;
		}
		else
		{
			$inicio = ($paginaActual - 1) * $limiteRegistros;
		}
		
		$totalPaginas = ceil($totalRegistros / $limiteRegistros);
		
		
			
			?>
			<script type="text/javascript">
			var pUp=new Array();
			pUp.push('<? echo $varGet[0]; ?>');
			pUp.push('<? echo $varGet[1]; ?>');
			pUp.push('<? echo $varGet[2]; ?>');
			pUp.push('<? echo $varGet[3]; ?>');
			pUp.push('<? echo $varGet[4]; ?>');
			pUp.push('<? echo $varGet[5]; ?>');
			pUp.push('<? echo $varGet[6]; ?>');
			pUp.push('<? echo $varGet[7]; ?>');	
						
			var pUp2=new Array();
			pUp2.push('<? echo $varGet[0]; ?>');
			pUp2.push('<? echo $varGet[1]; ?>');
			pUp2.push('<? echo $varGet[2]; ?>');
			pUp2.push('<? echo $varGet[3]; ?>');
			pUp2.push('<? echo $varGet[4]; ?>');
			pUp2.push('<? echo $varGet[5]; ?>');
			pUp2.push('<? echo $varGet[6]; ?>');
			pUp2.push('<? echo $varGet[7]; ?>');	
			</script>		
			<? 
			
		
		
		if (($paginaActual - 1) > 0)
		{
			?>
			<script type="text/javascript">
			pUp2[7]='<? echo base64_encode($paginaActual-1); ?>';	
			</script>		
			<? 
			
			$paginado .= "<a onclick='loadPhotosPaginate(pUp2);' href='javascript:;'>previous</a>  ";
		}
		
		
		/*if ($totalPaginas >= 1)
		{	
			
			for ($i=1; $i<=$totalPaginas; $i++)
			{
				if ($paginaActual == $i)
				{
					$paginado .= "<spam>$paginaActual</spam> ";
				}
				else
				{
					?>
					<script type="text/javascript">
					var pUp3<? echo $i; ?>=new Array();
					pUp3<? echo $i; ?>.push('<? echo $varGet[0]; ?>');
					pUp3<? echo $i; ?>.push('<? echo $varGet[1]; ?>');
					pUp3<? echo $i; ?>.push('<? echo $varGet[2]; ?>');
					pUp3<? echo $i; ?>.push('<? echo $varGet[3]; ?>');
					pUp3<? echo $i; ?>.push('<? echo $varGet[4]; ?>');
					pUp3<? echo $i; ?>.push('<? echo $varGet[5]; ?>');
					pUp3<? echo $i; ?>.push('<? echo $varGet[6]; ?>');
					pUp3<? echo $i; ?>.push('<? echo base64_encode($i); ?>');	
					</script>		
					<?
								
					$paginado .= "<a onclick='loadPhotosPaginate(pUp3".$i.");' href='javascript:;'>$i</a> ";
				}
			}
		}*/
		
		if (($paginaActual + 1) <= $totalPaginas)
		{
    		//echo $var_Get[0],'-',$var_Get[1];		
			
					
			?>
			<script type="text/javascript">
			pUp[7]='<? echo base64_encode($paginaActual+1); ?>';	
			</script>		
			<? 
			
			//$paginado .=  "<a onclick='videoProfile(\"".($i-1)."\");' href='javascript:;'>Siguiente</a>";
			$paginado .=  "<a onclick='loadPhotosPaginate(pUp);' href='javascript:;'>more photos</a>";


			
		}
		
		$array = array($paginado,$inicio);
		return $array;
	}
	
	
	////////////////////////// Función paginado Seba Comment Videos///////////////////////////////////////
	function mostrarPaginadoSebaComment($totalRegistros,$paginaActual,$limiteRegistros,$variablesGet)
	{
		//$paginado="";
		if (!$paginaActual)
		{
			$inicio = 0;
			$paginaActual = 1;
		}
		else
		{
			$inicio = ($paginaActual - 1) * $limiteRegistros;
		}
		
		$totalPaginas = ceil($totalRegistros / $limiteRegistros);
		
		if ($variablesGet)
		{	
			//$variableGet=$variablesGet;
			//$variablesGet = "&" . $variablesGet;
			?>
			<script type="text/javascript">
			var aUpvNpN=new Array();
			aUpvNpN.push('<? echo $variablesGet[0]; ?>');
			aUpvNpN.push('<? echo $variablesGet[1]; ?>');
			aUpvNpN.push('<? echo $variablesGet[2]; ?>');
			aUpvNpN.push('<? echo $variablesGet[3]; ?>');
			aUpvNpN.push('<? echo $variablesGet[4]; ?>');
			aUpvNpN.push('<? echo $variablesGet[5]; ?>');
			aUpvNpN.push('<? echo $variablesGet[6]; ?>');
			aUpvNpN.push('<? echo $variablesGet[7]; ?>');	
			
			var aUpvNpN2=new Array();
			aUpvNpN2.push('<? echo $variablesGet[0]; ?>');
			aUpvNpN2.push('<? echo $variablesGet[1]; ?>');
			aUpvNpN2.push('<? echo $variablesGet[2]; ?>');
			aUpvNpN2.push('<? echo $variablesGet[3]; ?>');
			aUpvNpN2.push('<? echo $variablesGet[4]; ?>');
			aUpvNpN2.push('<? echo $variablesGet[5]; ?>');
			aUpvNpN2.push('<? echo $variablesGet[6]; ?>');
			aUpvNpN2.push('<? echo $variablesGet[7]; ?>');
		
			</script>		
			
			
			<? 
						
		}
		
		if (($paginaActual - 1) > 0)
		{
					
					?>
					<script type="text/javascript">
					aUpvNpN2[5]='<? echo base64_encode($paginaActual-1); ?>';
					</script>		
					<? 	
						
			
			
			$paginado .= "<a onclick='loadComment(aUpvNpN2);' href='javascript:;'>previous</a>  ";
		}
		
		
		
		/*if ($totalPaginas >= 1)
		{	
			
			for ($i=1; $i<=$totalPaginas; $i++)
			{
				if ($paginaActual == $i)
				{
					$paginado .= "<spam>$paginaActual</spam> ";
				}
				else
				{
					
					?>
					<script type="text/javascript">
					var aUpvNpN3<? echo $i; ?>=new Array();
					aUpvNpN3<? echo $i; ?>.push('<? echo $variablesGet[0]; ?>');
					aUpvNpN3<? echo $i; ?>.push('<? echo $variablesGet[1]; ?>');
					aUpvNpN3<? echo $i; ?>.push('<? echo $variablesGet[2]; ?>');
					aUpvNpN3<? echo $i; ?>.push('<? echo $variablesGet[3]; ?>');
					aUpvNpN3<? echo $i; ?>.push('<? echo $variablesGet[4]; ?>');
					aUpvNpN3<? echo $i; ?>.push('<? echo base64_encode($i);?>');
					aUpvNpN3<? echo $i; ?>.push('<? echo $variablesGet[6]; ?>');
					</script>		
					<? 	
					
					
					$paginado .= "<a onclick='loadComment(aUpvNpN3".$i.");' href='javascript:;'>$i</a> ";
				}
			}
		}*/
		
		if (($paginaActual + 1) <= $totalPaginas)
		{
    		//echo $var_Get[0],'-',$var_Get[1];		
			
					?>
					<script type="text/javascript">
					aUpvNpN[5]='<? echo base64_encode($paginaActual+1); ?>';
					</script>		
					<?
					
			//$paginado .=  "<a onclick='videoProfile(\"".($i-1)."\");' href='javascript:;'>Siguiente</a>";
			$paginado .=  "<a onclick='loadComment(aUpvNpN);' href='javascript:;'>more comments</a>";


			
		}
		
		$array = array($paginado,$inicio);
		return $array;
	}
	
	

	///////////////////////// Función paginado Seba Comment Photos///////////////////////////////////////
	function mostrarPaginadoSebaCommentPhoto($totalRegistros,$paginaActual,$limiteRegistros,$variablesGet)
	{
		//$paginado="";
		if (!$paginaActual)
		{
			$inicio = 0;
			$paginaActual = 1;
		}
		else
		{
			$inicio = ($paginaActual - 1) * $limiteRegistros;
		}
		
		$totalPaginas = ceil($totalRegistros / $limiteRegistros);
		
		if ($variablesGet)
		{	
			//$variableGet=$variablesGet;
			//$variablesGet = "&" . $variablesGet;
			?>
			<script type="text/javascript">
			var aUpvNpN=new Array();
			aUpvNpN.push('<? echo $variablesGet[0]; ?>');
			aUpvNpN.push('<? echo $variablesGet[1]; ?>');
			aUpvNpN.push('<? echo $variablesGet[2]; ?>');
			aUpvNpN.push('<? echo $variablesGet[3]; ?>');
			aUpvNpN.push('<? echo $variablesGet[4]; ?>');
			aUpvNpN.push('<? echo $variablesGet[5]; ?>');
			aUpvNpN.push('<? echo $variablesGet[6]; ?>');
			aUpvNpN.push('<? echo $variablesGet[7]; ?>');		
			
			var aUpvNpN2=new Array();
			aUpvNpN2.push('<? echo $variablesGet[0]; ?>');
			aUpvNpN2.push('<? echo $variablesGet[1]; ?>');
			aUpvNpN2.push('<? echo $variablesGet[2]; ?>');
			aUpvNpN2.push('<? echo $variablesGet[3]; ?>');
			aUpvNpN2.push('<? echo $variablesGet[4]; ?>');
			aUpvNpN2.push('<? echo $variablesGet[5]; ?>');
			aUpvNpN2.push('<? echo $variablesGet[6]; ?>');
			aUpvNpN2.push('<? echo $variablesGet[7]; ?>');
		
			</script>		
			
			
			<? 
						
		}
		
		if (($paginaActual - 1) > 0)
		{
					
					?>
					<script type="text/javascript">
					aUpvNpN2[5]='<? echo base64_encode($paginaActual-1); ?>';
					</script>		
					<? 	
						
			
			
			$paginado .= "<a onclick='loadCommentPhoto(aUpvNpN2);' href='javascript:;'>previous</a>  ";
		}
		
		
		
		/*if ($totalPaginas >= 1)
		{	
			
			for ($i=1; $i<=$totalPaginas; $i++)
			{
				if ($paginaActual == $i)
				{
					$paginado .= "<spam>$paginaActual</spam> ";
				}
				else
				{
					
					?>
					<script type="text/javascript">
					var aUpvNpN3<? echo $i; ?>=new Array();
					aUpvNpN3<? echo $i; ?>.push('<? echo $variablesGet[0]; ?>');
					aUpvNpN3<? echo $i; ?>.push('<? echo $variablesGet[1]; ?>');
					aUpvNpN3<? echo $i; ?>.push('<? echo $variablesGet[2]; ?>');
					aUpvNpN3<? echo $i; ?>.push('<? echo $variablesGet[3]; ?>');
					aUpvNpN3<? echo $i; ?>.push('<? echo $variablesGet[4]; ?>');
					aUpvNpN3<? echo $i; ?>.push('<? echo base64_encode($i);?>');
					aUpvNpN3<? echo $i; ?>.push('<? echo $variablesGet[6]; ?>');
					</script>		
					<? 	
					
					
					$paginado .= "<a onclick='loadCommentPhoto(aUpvNpN3".$i.");' href='javascript:;'>$i</a> ";
				}
			}
		}*/
		
		if (($paginaActual + 1) <= $totalPaginas)
		{
    		//echo $var_Get[0],'-',$var_Get[1];		
			
					?>
					<script type="text/javascript">
					aUpvNpN[5]='<? echo base64_encode($paginaActual+1); ?>';
					</script>		
					<?
					
			//$paginado .=  "<a onclick='videoProfile(\"".($i-1)."\");' href='javascript:;'>Siguiente</a>";
			$paginado .=  "<a onclick='loadCommentPhoto(aUpvNpN);' href='javascript:;'>more comments</a>";


			
		}
		
		$array = array($paginado,$inicio);
		return $array;
	}
	
	
	
	
	
	
	//////Move the img to center thumb//////////
	function moveImg($w,$h,$path)
	{
		
		
		$aSize=@getimagesize($path);
		//echo $_SERVER['DOCUMENT_ROOT'].$dir."/".$imgPhoto;
		//var_dump($aSize);
		
		if($aSize[0]>$w){
			$moveLeft='style="margin-left:-'.(($aSize[0]-$w)/2).'px;"';
		}else{
			$moveLeft='';
		}
		
		
		/*if($aSize[1]>$h){
			$moveTop='margin-top:-'.(($aSize[1]-$h)/2).';';
		}else{
			$moveTop='';
			
		}*/
		$moveTop='';
		return @array($moveLeft,$moveTop);
		
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
// Función paginado
	function mostrarPaginado($totalRegistros,$paginaActual,$limiteRegistros,$variablesGet)
	{
			
		if (!$paginaActual)
		{
			$inicio = 0;
			$paginaActual = 1;
		}
		else
		{
			$inicio = ($paginaActual - 1) * $limiteRegistros;
		}
		
		$totalPaginas = ceil($totalRegistros / $limiteRegistros);
		
				
		if ($variablesGet)
		{
			$variablesGet = "&" . $variablesGet;
		}
		if ($totalPaginas >= 1)
		{
			$paginado='';
			for ($i=1; $i<=$totalPaginas; $i++)
			{
				if ($paginaActual == $i)
				{
					
					$paginado .= "<strong>$paginaActual</strong>";
				}
				else
				{
					$paginado .= " <a href='?pagina=$i" . $variablesGet . "'>$i</a> ";
				}
			}
		}
		if (($paginaActual - 1) > 0)
		{
			$paginado .= "<a href='?" . "pagina=" . ($paginaActual - 1) . $variablesGet . "'> Anterior </a>";
		}
		if (($paginaActual + 1) <= $totalPaginas)
		{
			$paginado .= "<a href='?" . "pagina=" . ($paginaActual + 1) . $variablesGet . "'> Siguiente </a>";
		}
		
		$array = array($paginado,$inicio);
		return $array;
	}
	

///////////////////////strip_tag+substr/////////////////////
	function sub($texto,$fin)
	{
		$cadena=strip_tags(substr($texto,0,$fin)) . "...";
		return $cadena;
	}	
///////////////////////ut/////////////////////
	function ut($texto)
	{
		$txt=utf8_decode($texto);
		return $txt;
	}	
	
	
?>