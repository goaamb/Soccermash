<?PHP
define ('dSTRING', 		1);
define ('dTEXT', 			2);
define ('dINTEGER', 	3);
define ('dFLOAT', 		4);
define ('dBOOLEAN', 	5);
define ('dDATE', 			6);
define ('dTIME', 			8);
define ('dDATETIME', 	7);
define ('dARRAY', 		9);


class DATE_Types
{
	function FILTER_As($sType = dSTRING, $mValue)
	{
		switch($sType){
			case dSTRING: 	return DATE_Types::FILTER_AsString($mValue); 		break;
			case dTEXT: 		return DATE_Types::FILTER_AsText($mValue); 			break;
			case dINTEGER: 	return DATE_Types::FILTER_AsInteger($mValue); 	break;
			case dFLOAT: 		return DATE_Types::FILTER_AsFloat($mValue); 		break;
			case dBOOLEAN: 	return DATE_Types::FILTER_AsBoolean($mValue); 	break;
			case dDATE: 		return DATE_Types::FILTER_AsDate($mValue); 			break;
			case dTIME: 		return DATE_Types::FILTER_AsTime($mValue); 			break;
			case dDATETIME: return DATE_Types::FILTER_AsDataTime($mValue); 	break;
			case dARRAY: 		return DATE_Types::FILTER_AsArray($mValue); 		break;
		}
	}#FILER_As()

	
	function FILTER_AsString($mIn = NULL)
	{
		$sIn = trim($mIn); // Quita espacios sobrantes al principio y al final
		$sIn = str_replace("\n", '', $sIn); //  Nueva línea
		$sIn = str_replace("\r", '', $sIn); //  Retorno de carro
		$sIn = str_replace("\t", '', $sIn); //  Tabulación horizontal
		return (string) $sIn;
	}#FILTER_AsString()

	function FILTER_AsText($mIn = NULL)
	{
		$tIn = trim($mIn);
		return (string) $tIn;
	}#END FILTER_AsText()

	function FILTER_AsBoolean($mIn = NULL)
	{
		return (boolean) $mIn;
	}#FILTER_AsBoolean()

	function FILTER_AsInteger($mIn = NULL)
	{
		return (integer) $mIn;
	}#FILTER_AsInteger()

 	function FILTER_AsFloat($mIn = NULL)
	{
		return (real) $mIn;
	}#FILTER_AsFloat()


	function FILTER_AsDate($mVl = NULL)
	{
		if (is_array($mVl))
		{
			$iDay   = isset($mVl['day'])   ? (int) $mVl['day'] 		: 0;
			$iMonth = isset($mVl['month']) ? (int) $mVl['month'] 	: 0;
			$iYear  = isset($mVl['year'])  ? (int) $mVl['year'] 	: 0;
		}
		else
		{
			$aTmpDate = split('[/.-]', $mVl);
			$iDay   = isset($aTmpDate[0]) ? (int) $aTmpDate[0] : 0;
			$iMonth = isset($aTmpDate[1]) ? (int) $aTmpDate[1] : 0;
			$iYear  = isset($aTmpDate[2]) ? (int) $aTmpDate[2] : 0;
		}

		if ($iYear >= 0 && $iYear <= 50) 			$iYear = '20' . str_pad((string) $iYear, 2, '0', STR_PAD_LEFT);
		elseif($iYear > 50 && $iYear <= 99)		$iYear = '19' . str_pad((string) $iYear, 2, '0', STR_PAD_LEFT);
		elseif($iYear > 99 && $iYear <= 9999) $iYear = str_pad((string) $iYear, 4, '0', STR_PAD_LEFT);
		else 																	$iYear = '0000';

		if ($iMonth < 1 || $iMonth > 12 || $iDay < 1 || $iDay > 31)
		{
			$iDay 	= 0;
			$iMonth = 0;
			$iYear 	= 0;
		}
		return str_pad($iYear, 4, '0', STR_PAD_LEFT) . str_pad($iMonth, 2, '0', STR_PAD_LEFT) . str_pad($iDay, 2, '0', STR_PAD_LEFT);

	}#FILTER_AsDate()


	function FILTER_AsArray($mValues = array(), $sType = dSTRING)
	{
		$aArray = array();
		if (gettype($mValues) == 'array')
		{
			foreach($mValues as $mKey => $mValue)
			{
				$aArray[$mKey] = DATE_Types::FILTER_As($sType, $mValue);
			}
		}
		return $aArray;
	}#FILTER_AsArray()

}#DATE_Types()
?>