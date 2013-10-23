<?PHP
	################################################
	## Funciones para el manejo de Fechas y horas ##
	################################################
	
	# Valida una fecha (Formato esperado: System "00000000")
	function ValidateDate($dDate = false, $sFormat = 'user', $bInvalidDateMoreCurrent = false)
	{
		switch ($sFormat)
		{
			case 'user': $sReg = "(0[1-9]|[12][0-9]|3[01])[/](0[1-9]|1[012])[/](19|20)[0-9]{2}"; break;
			case 'ansi': $sReg = "(19|20)[0-9]{2}[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])"; break;
			default: $sReg = "(19|20)[0-9]{2}(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])"; break;
		}
		if (ereg($sReg, $dDate))
		{ 
			if ($bInvalidDateMoreCurrent && (DATE_GetCurrentDate() < $dDate)) return false;
			return true;
		}
		else
		{
			return false;
		}
		/*
		if ($dDate)
		{
			$iDay   = DATE_GetDay($dDate);
			$iMonth = DATE_GetMonth($dDate);
			$iYear  = DATE_GetYear($dDate);
			if ($iDay < 1 || $iDay > 31 || $iDay > DATE_GetMonthDays($iMonth)) return false;
			if ($iMonth < 1 || $iMonth > 12) 	return false;
			if ($iYear < 1 || $iYear > 9999) 	return false;

			if ($bInvalidDateMoreCurrent && (DATE_GetCurrentDate() < $dDate)) return false;
			return true;
		}
		return false;
		*/
	}#ValidateDate()


	# Valida una hora (Formato esperado: System "00:00:00")
	function ValidateTime($dTime = false, $bInvalidDateMoreCurrent = false)
	{
		if (ereg("(0[1-9]|[0123456789][0-60])[:](0[1-9]|[0123456789][0-60])[:](0[1-9]|[0123456789][0-60])", $dTime))
		{ 
			return true;
		}
		else
		{
			return false;
		}
		/*
		if ($dDate)
		{
			$iDay   = DATE_GetDay($dDate);
			$iMonth = DATE_GetMonth($dDate);
			$iYear  = DATE_GetYear($dDate);
			if ($iDay < 1 || $iDay > 31 || $iDay > DATE_GetMonthDays($iMonth)) return false;
			if ($iMonth < 1 || $iMonth > 12) 	return false;
			if ($iYear < 1 || $iYear > 9999) 	return false;

			if ($bInvalidDateMoreCurrent && (DATE_GetCurrentDate() < $dDate)) return false;
			return true;
		}
		return false;
		*/
	}#ValidateDate()
	
	function parseSpanishTime($sDate){
		if(!$sDate) return false;
		
		$iTime = explode("/", $sDate);
		return sprintf("%s/%s/%s", $iTime[1], $iTime[0], $iTime[2]);
	}
	
	function TIME_strtotime($sStr){
		return strtotime(parseSpanishTime($sStr));
	}
	
	function TIME_IsDate( $sStr )
	{
		$Stamp = TIME_strtotime($sStr);
		$Month = date( 'm', $Stamp );
		$Day   = date( 'd', $Stamp );
		$Year  = date( 'Y', $Stamp );
		
		return checkdate( $Month, $Day, $Year );
	}
	
	# Retorna la hora actual
	function TIME_GetCurrentTime($sFormat = 'system')
	{
		$tTime = date('His', time() - (3600));
		switch($sFormat)
		{
			case 'ansi':
			case 'user':
				$tTime = TIME_FormatAsUser($tTime);
				break;
		}
		return $tTime;
	}#Time_GetCurrentTime()


	# Retorna la hora en formato usuario
	function TIME_FormatAsSystem($tTime = '00:00:00')
	{
		return str_replace(':', '', $tTime);
	}#TIME_FormatAsSystem()


	# Retorna la hora en formato usuario
	function TIME_FormatAsUser($tTime = '000000')
	{
		return substr($tTime, 0, 2) . ':' . substr($tTime, 2, 2) . ':' . substr($tTime, 4, 2);
	}#TIME_FormatAsUser()


	# Retorna la hora en formato usuario
	function TIME_RewriteAsUser($tTime = '00:00:00')
	{
		$aTime = explode(':', $tTime);
		return str_pad($aTime[0], 2, '0', STR_PAD_LEFT) . ':' . str_pad($aTime[1], 2, '0', STR_PAD_LEFT) . ':' . str_pad($aTime[2], 2, '0', STR_PAD_LEFT);
	}#TIME_FormatAsUser()


	function TIME_SumarHoras($sTime1, $sTime2)
	{
		$aTime1 = explode(':', $sTime1);
		$aTime2 = explode(':', $sTime2);

		$aResult = array($aTime1[0]+$aTime2[0], $aTime1[1]+$aTime2[1], $aTime1[2]+$aTime2[2]);

		if ($aResult[2] >= 60)
		{
			$aResult[2] = $aResult[2] - 60;
			$aResult[1]++;
		}
		if ($aResult[1] >= 60)
		{
			$aResult[1] = $aResult[1] - 60;
			$aResult[0]++;
		}
		if ($aResult[0] < 10 && $aResult[0] > 0) $aResult[0] = '0' . $aResult[0];
		if ($aResult[1] < 10 && $aResult[1] > 0) $aResult[1] = '0' . $aResult[1];
		if ($aResult[2] < 10 && $aResult[2] > 0) $aResult[2] = '0' . $aResult[2];
		return TIME_RewriteAsUser(implode(':', $aResult));
	}#TIME_SumarHoras()


	function TIME_RestarHoras($sTime1, $sTime2)
	{
		$aTime1 = explode(':', $sTime1);
		$aTime2 = explode(':', $sTime2);

		$sMkTime1 = mktime($aTime1[0], $aTime1[1], $aTime1[2]);
		$sMkTime2 = mktime($aTime2[0], $aTime2[1], $aTime2[2]);

		if ($sMkTime1 > $sMkTime2)
		{
			return TIME_RewriteAsUser(date("H:i:s", strtotime("00:00:00") + strtotime($sTime1) - strtotime($sTime2))); 
		}
		else
		{
			return '-' . TIME_RewriteAsUser(date("H:i:s", strtotime("00:00:00") + strtotime($sTime2) - strtotime($sTime1))); 
		}
	}#TIME_RestarHoras()

	# Retorna la fecha actual en el formato indicado
	function DATE_GetCurrentDate($sFormat = 'system', $iTime = false)
	{
		$dDate = date('Ymd', time() + (($iTime) ? $iTime : 0));

		switch($sFormat){
			case 'user_text':
				$dDate = DATE_System2UserText($dDate);
				break;
			case 'user':
				$dDate = DATE_System2User($dDate);
				break;
			case 'ansi':
				$dDate = DATE_System2Ansi($dDate);
				break;
		}
		return $dDate;
	}#DATE_GetCurrentDate()


	# Retorna la fecha y hora actual
	function DATETIME_GetCurrentDateTime($sFormat = NULL)
	{
		$dtSource = date('YmdHis', time());
		if ($sFormat) $dtSource = DATETIME_SystemTo($dtSource, $sFormat);
		return $dtSource;
	}#DATETIME_GetCurrentDateTime()


	# Retorna la fecha y hora del formato Ansi al formato indicado
	function DATETIME_AnsiTo($dtSource = NULL, $sFormat = 'system')
	{
		switch($sFormat)
		{
			case 'system':
				$dtSource = str_replace('-', '', substr($dtSource, 0, 10)) . str_replace(':', '', substr($dtSource, 11, 0));
				break;

			case 'user':
				$dtSource = DATE_Ansi2User(substr($dtSource, 0, 10)) . ' ' . substr($dtSource, 11, 19);
				break;
		}
		return $dtSource;
	}#DATETIME_AnsiTo()


	# Retorna la fecha y hora del formato System al formato indicado
	function DATETIME_SystemTo($dtSource = NULL, $sFormat = 'ansi')
	{
		switch($sFormat)
		{
			case 'ansi':
				$dtSource = substr($dtSource, 0, 4) . '-' . substr($dtSource, 4, 2) . '-' . substr($dtSource, 6, 2) . ' ' . substr($dtSource, 8, 2) . ':' . substr($dtSource, 10, 2) . ':' . substr($dtSource, 12, 2);
				break;

			case 'user':
				$dtSource = DATE_System2User(substr($dtSource, 0, 10)) . ' ' . substr($dtSource, 8, 2) . ':' . substr($dtSource, 10, 2) . ':' . substr($dtSource, 12, 2);
				break;
		}
		return $dtSource;
	}#DATETIME_FormatTo()


	# Retorna un texto con la fecha formateada con el nombre del día y del mes
	function DATE_System2UserText($dDate = '00000000')
	{
		$t_sDate = date("w d m Y", mktime(0, 0, 0, substr($dDate, 4, 2), substr($dDate, 6, 2), substr($dDate, 0, 4)));

		list($iDay, $iDayNumber, $iMonth, $iYear) = explode (" ", $t_sDate, 4);
		$sDate = SYSTEM_DATE_FormatUserText;
		$sDate = str_replace('#nombre_dia#', 	DATE_GetDayName($iDay), 		$sDate);
		$sDate = str_replace('#dia#', 				$iDayNumber, 								$sDate);
		$sDate = str_replace('#nombre_mes#', 	DATE_GetMonthName($iMonth), $sDate);
		$sDate = str_replace('#anio#', 				$iYear, 										$sDate);
		return $sDate;
	}#DATE_System2UserText();


	# Retorna una fecha de formato Usuario a formato Ansi
	function DATE_Ansi2User($sDate = '0000-00-00')
	{
		list($iYear, $iMonth, $iDay) = explode('-', $sDate);
		$sDate = SYSTEM_DATE_FormatUser;
		$sDate = str_replace('#dia#', 	str_pad($iDay , 2, '0', STR_PAD_LEFT), 		$sDate);
		$sDate = str_replace('#mes#', 	str_pad($iMonth, 2, '0', STR_PAD_LEFT), 	$sDate);
		$sDate = str_replace('#anio#', 	str_pad($iYear , 4, '0', STR_PAD_LEFT), 	$sDate);
		return $sDate;
	}#DATE_Ansi2User()


	# Retorna una fecha de formato Usuario a formato System
	function DATE_Ansi2System($sDate = '0000-00-00')
	{
		return str_replace('-', '', $sDate);
	}#DATE_Ansi2System()


	# Retorna una fecha de formato System a formato Ansi
	function DATE_System2Ansi($dDate = '00000000')
	{
		return substr($dDate, 0, 4) . '-' . substr($dDate, 4, 2) . '-' . substr($dDate, 6, 2);
	}#DATE_System2Ansi()


	# Retorna una fecha de formato System a formato Usuario
	function DATE_System2User($dDate = '00000000')
	{
		$sDate = SYSTEM_DATE_FormatUser;
		$sDate = str_replace('#dia#', 	str_pad(DATE_GetDay($dDate), 		2, '0', STR_PAD_LEFT), $sDate);
		$sDate = str_replace('#mes#', 	str_pad(DATE_GetMonth($dDate), 	2, '0', STR_PAD_LEFT), $sDate);
		$sDate = str_replace('#anio#', 	str_pad(DATE_GetYear($dDate), 	2, '0', STR_PAD_LEFT), $sDate);
		return $sDate;
	}#DATE_System2User()


	# Retorna una fecha de formato Usuario a formato Ansi
	function DATE_User2Ansi($sDate = '00/00/0000')
	{
		list($iDay, $iMonth, $iYear) = explode('/', $sDate);
		$dAnsi = str_pad($iYear , 4, '0', STR_PAD_LEFT) . '-' . str_pad($iMonth, 2, '0', STR_PAD_LEFT) .'-' . str_pad($iDay , 2, '0', STR_PAD_LEFT);
		return $dAnsi;
	}#DATE_User2Ansi()


	# Retorna una fecha de formato Usuario a formato System
	function DATE_User2System($sDate = '00/00/0000')
	{
		list($iDay, $iMonth, $iYear) = explode('/', $sDate);
		$dAnsi = str_pad($iYear , 4, '0', STR_PAD_LEFT) . str_pad($iMonth, 2, '0', STR_PAD_LEFT) . str_pad($iDay , 2, '0', STR_PAD_LEFT);
		return $dAnsi;
	}#DATE_User2System()


	# Retorna el día de la fecha pasada como parámetro (Formato esperado: System "00000000")
	function DATE_GetDay($dDate = '00000000')
	{
		return substr($dDate, 6, 2);
	}#DATE_GetDay()


	# Retorna el mes de la fecha pasada como parámetro (Formato esperado: System "00000000")
	function DATE_GetMonth($dDate = '00000000')
	{
		return substr($dDate, 4, 2);
	}#DATE_GetMonth()


	# Retorna el año de la fecha pasada como parámetro (Formato esperado: System "00000000")
	function DATE_GetYear($dDate = '00000000')
	{
		return substr($dDate, 0, 4);
	}#DATE_GetYear()


	# Retorna el día actual
	function DATE_GetCurrentDay()
	{
		return DATE_GetDay(DATE_GetCurrentDate());
	}#DATE_GetCurrentDay()


	# Retorna el mes actual
	function DATE_GetCurrentMonth()
	{
		return DATE_GetMonth(DATE_GetCurrentDate());
	}#DATE_GetCurrentMonth()


	# Retorna el año actual
	function DATE_GetCurrentYear()
	{
		return DATE_GetYear(DATE_GetCurrentDate());
	}#DATE_GetCurrentYear()


	# Retorna el nombre del día pasado como parámetro, en el lengusje específico del sistema
	function DATE_GetDayName($iDay = 0)
	{
		$aDay['es'][0] = 'Domingo';
		$aDay['es'][1] = 'Lunes';
		$aDay['es'][2] = 'Martes';
		$aDay['es'][3] = 'Miércoles';
		$aDay['es'][4] = 'Jueves';
		$aDay['es'][5] = 'Viernes';
		$aDay['es'][6] = 'Sábado';
		return $aDay[SYSTEM_Language][$iDay];
	}#DATE_GetDayName()


	# Retorna el nombre del mes pasado como parámetro, en el lengusje específico del sistema
	function DATE_GetMonthName($iMonth = 1)
	{
		$iMonth = (integer) $iMonth;
		$aMonth['es'][1] = 'Enero'; 		$aMonth['es'][2] = 'Febrero'; 		$aMonth['es'][3] = 'Marzo';
		$aMonth['es'][4] = 'Abril'; 		$aMonth['es'][5] = 'Mayo'; 				$aMonth['es'][6] = 'Junio';
		$aMonth['es'][7] = 'Julio'; 		$aMonth['es'][8] = 'Agosto'; 			$aMonth['es'][9] = 'Septiembre';
		$aMonth['es'][10] = 'Octubre'; 	$aMonth['es'][11] = 'Noviembre'; 	$aMonth['es'][12] = 'Diciembre';
		return $aMonth[SYSTEM_Language][$iMonth];
	}#DATE_GetMonthName()


	# Retorna la cantidad de días del mes pasado como parámetro
	function DATE_GetMonthDays($iMonth = 1)
	{
		$iMonth = (integer) $iMonth;
		$aMonth[1] = 31; $aMonth[2] = 29; $aMonth[3] = 31; $aMonth[4] = 30;
		$aMonth[5] = 31; $aMonth[6] = 30; $aMonth[7] = 31; $aMonth[8] = 31;
		$aMonth[9] = 30; $aMonth[10] = 31; $aMonth[11] = 30; $aMonth[12] = 31;
		return $aMonth[$iMonth];
	}#DATE_GetMonthDays()

?>