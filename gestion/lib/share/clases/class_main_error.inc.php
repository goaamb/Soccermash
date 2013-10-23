<?PHP
class CLASS_MainError extends CLASS_Main
{

	var $_aError = array();
	var $sName = '[SITE :: Administrador de Errores] ';

	function CLASS_MainError()
	{
		$this->CLASS_Main();
		$this->_LoadErrorList();
		return true;
	}#CLASS_MainError()

	function SetError($mId = false, $sFile = '', $iLine = 0, $mP1 = false, $mP2 = false, $mP3 = false, $mP4 = false, $mP5 = false)
	{
		if (isset($this->_aError[$mId]))
		{
			if ($this->_aError[$mId]['type'] == 1)
			{
				$sMessage = $this->_aError[$mId]['dsc'];
				$sMessage = str_replace("#p1#", htmlentities($mP1), $sMessage);
				$sMessage = str_replace("#p2#", htmlentities($mP2), $sMessage);
				$sMessage = str_replace("#p3#", htmlentities($mP3), $sMessage);
				$sMessage = str_replace("#p4#", htmlentities($mP4), $sMessage);
				$sMessage = str_replace("#p5#", htmlentities($mP5), $sMessage);

				$sObject = "<strong>File: </strong>$sFile. <br /><strong>Line: </strong>$iLine";
				$this->StopCritical($mId, $sObject, $sMessage);
			}
		}
		else
		{
			$this->StopCritical('unknown');
		}
	}#SetError()

	function _LoadErrorList()
	{
		$this->_aError['unknown']                          = array('type' => 1, 'dsc' => 'Error desconocido.');
		$this->_aError['FILE_Read2Var_NoRead']             = array('type' => 1, 'dsc' => 'No se pudo leer el archivo #p1#.');
		$this->_aError['FILE_Read2Var_NoExists']           = array('type' => 1, 'dsc' => 'El archivo #p1# no existe.');
		#SITE_oDbm
		$this->_aError['SITE_oDB_CantConnect']            = array('type' => 1, 'dsc' => 'No se pudo conectar al Servidor de Base de Datos #p2#||DBM_ID: #p1#||ServerError:#p3#');
		$this->_aError['SITE_oDB_CantSelectDb']           = array('type' => 1, 'dsc' => 'No se pudo seleccionar la Base de Datos #p2#||DBM_ID: #p1#||ServerError:#p3#');
		$this->_aError['SITE_oDB_QueryError']             = array('type' => 1, 'dsc' => 'Error al ejecutar una consulta en el servidor. ||DBM_Id: #p4#.||Error No #p1# : #p2#.||Sentecia SQL que generó el error: #p3#');
		$this->_aError['SITE_oDB_DbmIdAbsent']            = array('type' => 1, 'dsc' => 'No indicó el ID del DBM con el que quiere operar.');
		$this->_aError['SITE_oDB_DbmIdNoExists']          = array('type' => 1, 'dsc' => 'No existe ninguna Base de Datos registrada con el DBM ID #p1#.');
		$this->_aError['SITE_oDB_ResultsIdAbsent']        = array('type' => 1, 'dsc' => 'No indicó el ID de Resultados.');
		$this->_aError['SITE_oDB_ResultsIdNoExists']      = array('type' => 1, 'dsc' => 'El ID de Resultados que indicó no es válido o no existe.');
		$this->_aError['SITE_oDB_DbmTypeNotValid']        = array('type' => 1, 'dsc' => 'El tipo de base de datos que indicó no es válido.');
	}#_LoadErrorList()


	function StopCritical($sCode = '', $sObject = '', $sMessage = '')
	{
		$hPage = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">';
		$hPage .= '<html><head>';
		$hPage .= '<title>' . $this->sName . '</title>';
		$hPage .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
		$hPage .= '<style type="text/css">';
		$hPage .= '.SITEPgFoot {font-family: Tahoma, Helvetica, Verdana, Arial, sans-serif; font-size: 10px; font-weight: normal; color: #FFFFFF;} ';
		$hPage .= '.SITEPgFootTxtNml {font-family: Tahoma, Helvetica, Verdana, Arial, sans-serif; font-size: 10px; font-weight: normal; color: #FFFFFF;} ';
		$hPage .= '.SITEPgHeaderTxtNml { font-family: Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; color: #FFFFFF;} ';
		$hPage .= '.SITEPgBodyTxtNml { font-family: Tahoma, Helvetica, Verdana, Arial, sans-serif; font-size: 12px; font-weight: normal; color: #003366; line-height: 22px;} ';
		$hPage .= '.SITEWdgFormLblTxtNml {font-family: Tahoma, Helvetica, Verdana, Arial, sans-serif; font-size: 11px; font-weight: normal; color: #000000;} ';
		$hPage .= '.SITEWdgFormFldTxtNml {font-family: Tahoma, Helvetica, Verdana, Arial, sans-serif; font-size: 11px; font-weight: normal; color: #003366;} ';
		$hPage .= '</style>';
		$hPage .= '</head>';
		$hPage .= '<body>';
		$hPage .= '<TABLE width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">';
		$hPage .= '<TR><TD align="center" valign="center">';
		$hPage .= '<TABLE bgcolor="#92C100" cellpadding="1" cellspacing="1"><TR><TD bgcolor="#FFFFFF">';
		$hPage .= '<table width="450" border="0" align="center" cellpadding="2" cellspacing="0">';
		$hPage .= '<tr><td height="30" bgcolor="#92C100"><div align="center" class="SITEPgHeaderTxtNml">' . $this->sName . '</div></td></tr>';
		$hPage .= '<tr height="1"><td height="1" bgcolor="#92C100"></td></tr>';
		$hPage .= '<tr><td><div align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">';
		$hPage .= '<tr><td>&nbsp;</td></tr>';
		$hPage .= '<tr><td><p class="SITEPgBodyTxtNml">Se encontró un error grave y no se pudo finalizar su requerimiento.</p>';
		$hPage .= '<p class="SITEPgBodyTxtNml">Detalle del error:</p>';
		$hPage .= '<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">';
		$hPage .= '<tr>';
		$hPage .= '<td width="100" height="20" bgcolor="#CFE967"><div align="right" class="SITEWdgFormFldTxtNml"><p class="SITEWdgFormLblTxtNml">C&oacute;digo:</p></div></td>';
		$hPage .= '<td height="20" bgcolor="#F7F7F7"><div align="left" class="SITEWdgFormFldTxtNml">'.$sCode.'</div></td>';
		$hPage .= '</tr><tr>';
		$hPage .= '<td width="100" height="20" bgcolor="#CFE967"><div align="right" class="SITEWdgFormLblTxtNml">Objeto:</div></td>';
		$hPage .= '<td height="20" bgcolor="#F7F7F7"><div align="left" class="SITEWdgFormFldTxtNml">'.$sObject.'</div></td>';
		$hPage .= '</tr><tr>';
		$hPage .= '<td width="100" height="20" bgcolor="#CFE967"><div align="right" class="SITEWdgFormLblTxtNml">Descripci&oacute;n:</div></td>';
		$hPage .= '<td height="20" bgcolor="#F7F7F7"><div align="left" class="SITEWdgFormFldTxtNml">' . str_replace('||', '<BR>', $sMessage) . '</div></td>';
		$hPage .= '</tr>';
		$hPage .= '<tr>';
		$hPage .= '</table>';
		$hPage .= '<p class="SITEPgBodyTxtNml">Sepa disculpar las molestias ocasionadas.</p></td></tr>';
		$hPage .= '<tr><td>&nbsp;</td></tr></table></div></td></tr>';
		$hPage .= '<tr><td height="30" bgcolor="#92C100"><div align="center" class="SITEPgFoot">SITE Versión ' . SITE_EngineVersion . '.' . SITE_EnginRevision . ' :: Framwork</div></td></tr>';
		$hPage .= '</TABLE>';
		$hPage .= '</TD></TR></TABLE>';
		$hPage .= '</TD></TR></TABLE>';
		$hPage .= '</body></html>';

		echo $hPage;
		echo $this->DumpArray(debug_backtrace());
		exit;
	}#END StopCritical()


	/**
	@method:: DumpArray
	@parameters:: +array : $aArray
	@desc:: Descompone un array
	**/
	function DumpArray($aArray = array()){

		static $iCallBack = 0;

		$hArray = '<br /><hr /><br />';
		
		$hArray .= '<TABLE width="100%" border="1" cellpadding="1" cellspacing="0" align="center">';
		$hArray .= '<TR><TD><I>Clave</I></TD><TD><I>Valor</I></TD></TR>';

		foreach($aArray as $sKey => $sVal){
			$hArray .= '<TR>';
			$hArray .= '<TD><TT><B>'.$sKey.'</B><I>('.gettype($sVal).')</I></TT></TD>';
			if (gettype($sVal) != 'array'){
				$hArray .= '<TD><TT> '.(gettype($sVal) == 'boolean' ? ($sVal == true ? 'true' : 'false') : (gettype($sVal) == 'NULL' ? '<I>NULL</I>' : $sVal )) . '</TT></TD>';
			}else{
				$hArray .= '<TD>'.$this->DumpArray($sVal).'</TD>';
			}
			$hArray .= '</TR>';
		}
		$hArray .= '</TABLE>';

		$iCallBack++;
		if ($iCallBack == 1000){
			die ('Llamada recursiva exedidas'); exit;
		}

		return $hArray;

	}#END DumpArray()

}#CLASS_MainError{}
?>