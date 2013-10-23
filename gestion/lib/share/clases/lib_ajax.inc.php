<?PHP
	function generateElement($sKey, $sValue, $sType, $mPropiedades = '')
	{
		if (is_array($mPropiedades))
		{
			$sPropiedades = '';
			foreach ($mPropiedades as $sPropId => $sPropValue)
			{
				$sPropiedades .= $sPropId . '="' . $sPropValue . '" ';
			}
		}
		else
		{
			$sPropiedades = $mPropiedades;
		}
		switch($sType)
		{
			case 'innerHTML': return "<$sKey $sPropiedades>$sValue</$sKey>\n";
		}
	}#generateElement()


	function showErrors($aForm, $aErrors, &$oRespuesta)
	{
		foreach ($aForm as $sFormId => $sValue)
		{
			$oRespuesta->addRemove("error_$sFormId");
		}
		$oRespuesta->addScriptCall("JS_setMesageForm", ___('No se puede enviar el formulario porque contiene errores. Revise los campos marcados y vuelva a enviarlo.'));
		foreach ($aErrors as $sErrorId => $sError)
		{
			$oRespuesta->addInsertAfter($sErrorId, 'p', "error_$sErrorId");
			$oRespuesta->addAssign("error_$sErrorId", "className", "formError");
			$oRespuesta->addAssign("error_$sErrorId", "innerHTML", $sError);
		}
	}#showErrors()


	function Array2Select($aOptions, $sLabelName, $sLabelValue, $aPropiedades = NULL)
	{
		$sContent = '';
		if (!is_null($aPropiedades) && sizeof($aPropiedades) > 0) $sContent .= '<select name="' . $aPropiedades['nombre'] . '" id="' . $aPropiedades['nombre'] . '" ' . (isset($aPropiedades['onchange']) ? 'onchange="' . $aPropiedades['onchange'] . '"' : '') . '>';
		if (sizeof($aOptions) > 0)
		{
			foreach ($aOptions as $iOpt => $aOption)
			{
				$sContent .= generateElement('option', $aOption[$sLabelName], 'innerHTML', array('value' => $aOption[$sLabelValue]));
			}
		}
		else
		{
			$sContent .= generateElement('option', __(' -- No hay elementos -- '), 'innerHTML');
		}
		if (!is_null($aPropiedades) && sizeof($aPropiedades) > 0) $sContent .= '</select>';
		return $sContent;
	}#Array2Select()


	function Array2Grid($aFilas = NULL, $aHeaders = NULL)
	{
		$sContent = '<div class="loading">' . ___('Cargando') . '...</div>';
		$sContent .= '<table id="cntListHeader" cellspacing="0">';
		if (!is_null($aHeaders))
		{
			$sContent .= '<thead>';

			$sRows = '';
			foreach ($aHeaders as $sNameCol => $iWidth)
			{
				$sRows .= generateElement('th', $sNameCol, 'innerHTML', array('width' => $iWidth . '%'));
			}
			$sContent .= generateElement('tr', $sRows, 'innerHTML');
			$sContent .= '</thead>';
		}

		$sContent .= '<tbody id="cntBodyList" >';
		if (!is_null($aFilas))
		{
			foreach ($aFilas as $iRowId => $aFila)
			{
				$sRow = '';
				foreach ($aFila as $aDato)
				{
					switch($aDato[0])
					{
						case 'common':
							$sRow .= generateElement('td', implode('<br />', array_slice($aDato, 1, count($aDato))), 'innerHTML');
							break;

						case 'imagen':
							$sRow .= '<img src="' . $aDato [1] . '" width="' . $aDato [2] . '" height="' . $aDato [3] . '" />';
							break;
						
						case 'link':
							$sRow .= generateElement('td', '<a href="' . $aDato [1] . '" title="' . $aDato [2] . '">' . $aDato [2] . '</a>', 'innerHTML');
							break;

						case 'order':
							# $aDato[1] = orden actual
							# $aDato[2] = total registros
							# $aDato[3] = funcion llamada para setear el orden
							$sSelect = '<select onchange="' . $aDato[3] . '">';
							if ($aDato[1] == 0){$aProp['value'] = 0; $aProp['selected'] = 'selected';$aProp['style'] = 'color:#FFF; background-color:#DD4D37;'; $sSelect .= generateElement('option', 0, 'innerHTML', $aProp);}
							for ($iIndex = 1; $iIndex<=$aDato[2]; $iIndex++)
							{
								$aProp = array(); $aProp['value'] = $iIndex; if ($iIndex == $aDato[1]){$aProp['selected'] = 'selected';$aProp['style'] = 'color:#006699; background-color:#DBECFD;';} $sSelect .= generateElement('option', $iIndex, 'innerHTML', $aProp);
							}
							if ($aDato[1] > $aDato[2])
							{
								for ($iIndex = $aDato[2]+1; $iIndex<=$aDato[1]; $iIndex++)
								{
									$aProp = array(); $aProp['value'] = $iIndex; if ($iIndex == $aDato[1]){$aProp['selected'] = 'selected';$aProp['style'] = 'color:#006699; background-color:#DBECFD;';} $sSelect .= generateElement('option', $iIndex, 'innerHTML', $aProp);
								}
							}
							$sSelect .= '</select>';
							$sRow .= generateElement('td', $sSelect, 'innerHTML');
							break;

						case 'visible':
							if ($aDato[1] == 1)
							{
								$sClassName = 'linkVisible'; $sTagName = ___('Clic para deshabilitar');
							}
							else
							{
								$sClassName = 'linkNoVisible'; $sTagName = ___('Clic para habilitar');
							}
							$sBoton = generateElement('button', '<span>' . $sTagName . '</span>', 'innerHTML', array('class' => $sClassName, 'onclick' => $aDato[2], 'title' => $sTagName));
							$sRow .= generateElement('td', $sBoton, 'innerHTML', array('class' => 'itemsActions'));
							break;

						case 'tooltip':
							$aDato[2]['class'] = 'wgtTooltip';
							$sRow .= generateElement('td', generateElement('a', $aDato[1] ,'innerHTML', $aDato[2]), 'innerHTML');
							break;

						case 'action':
							$aAcciones = array_slice($aDato, 1, count($aDato));
							$sBotones = '';
							foreach ($aAcciones as $aAccion)
							{
								$sFunction = '';
								switch($aAccion[0])
								{
									case 'print': 		$sClassName = 'linkImprimir'; 		$sTagName = ___('Imprimir'); 					break;
									case 'send': 		$sClassName = 'linkSend'; 				$sTagName = ___('Enviar por mail'); 		break;
									case 'edt': 		$sClassName = 'linkEdit'; 				$sTagName = ___('Editar'); 					$sFunction = 'JS_showCargando();';	break;
									case 'noedt': 		$sClassName = 'linkEditDisabled'; 	$sTagName = ___('No editable'); 				break;
									case 'del': 		$sClassName = 'linkDel'; 				$sTagName = ___('Eliminar'); 					break;
									case 'nodel': 		$sClassName = 'linkDelDisabled'; 	$sTagName = ___('No se elimina'); 			break;
									case 'ver': 		$sClassName = 'linkVer'; 				$sTagName = ___('Ver'); 						break;
									case 'gallery': 	$sClassName = 'linkGallery'; 			$sTagName = ___('Galeria de Imagenes'); 	break;
									case 'items': 	$sClassName = 'linkGallery'; 			$sTagName = ___('Ver'); 	break;
									case 'messages': 	$sClassName = 'linkMessages'; 		$sTagName = ___('Mensajes'); 					break;
								}
								$aPropiedades = array('class' => $sClassName, 'onclick' => $sFunction . $aAccion[1], 'title' => $sTagName);
								if (isset($aAccion[2])) foreach ($aAccion[2] as $mKey => $mVal) $aPropiedades[$mKey] = $mVal;
								$sBotones .= generateElement('button', '<span>' . $sTagName . '</span>', 'innerHTML', $aPropiedades);
							}
							$sRow .= generateElement('td', $sBotones, 'innerHTML', array('class' => 'itemsActions'));
							break;
					}
				}
				$sContent .= generateElement('tr', $sRow, 'innerHTML');
			}
		}
		else
		{
			$sContent .= generateElement('tr', '<td colspan="50">' . ___('No se ha recuperado ningún registro') . '</td>', 'innerHTML', array('align' => 'center'));
		}
		$sContent .= '</tbody>';
		$sContent .= '</table>';
		return $sContent;
	}#Array2Grid()


	function Array2Bas($aBas)
	{
		$aLista = array();

		if ($aBas['before'])
		{
			$aLista[] = generateElement('li', '<a href="' . getPermalink(SITE_CURRENT_Modulo, SITE_CURRENT_Page, $aBas['before']) . '" title="' . ___('Página anterior'). '">&lt;&lt;</a>', 'innerHTML', array('class' => 'nextpage'));
		}
		else
		{
			$aLista[] = generateElement('li', '&lt;&lt;', 'innerHTML', array('class' => 'disablepage'));
		}#página anterior

		//<li><span>...</span></li>
		foreach ($aBas['pages'] as $mLink)
		{
			if ($mLink)
			{
				if (!is_null($mLink['link']))
				{
					$aPropiedades['href'] = getPermalink(SITE_CURRENT_Modulo, SITE_CURRENT_Page, $mLink['link']);
					$aLista[] = generateElement('li', generateElement('a', $mLink['lbl'], 'innerHTML', $aPropiedades), 'innerHTML');
				}else
				{
					$aLista[] = generateElement('li', $mLink['lbl'], 'innerHTML', array('class' => 'currentpage'));
				}
			}
			else
			{
				$aLista[] = generateElement('li', '<span>...</span>', 'innerHTML');
			}
		}
		# end Parte media del paginador

		if ($aBas['next'])
		{
			$aLista[] = generateElement('li', '<a href="' . getPermalink(SITE_CURRENT_Modulo, SITE_CURRENT_Page, $aBas['next']) . '" title="' . ___('Página siguiente') . '">&gt;&gt;</a>', 'innerHTML', array('class' => 'nextpage'));
		}
		else
		{
			$aLista[] = generateElement('li', '&gt;&gt;', 'innerHTML', array('class' => 'disablepage'));
		}#siguiente página

		return generateElement('ul', implode("\n", $aLista) , 'innerHTML');
	}#Array2Bas()
?>