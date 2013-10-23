<?php
// FUNCIONES DE CONVERSION DE NUMEROS A LETRAS.

function centimos()
{
	global $importe_parcial;

	$importe_parcial = number_format($importe_parcial, 2, ".", "") * 100;

	if ($importe_parcial > 0)
		$num_letra = __(" con ") . decena_centimos($importe_parcial);
	else
		$num_letra = "";

	return $num_letra;
}

function unidad_centimos($numero)
{
	switch ($numero)
	{
		case 9:
		{
			$num_letra = __("nueve centavos");
			break;
		}
		case 8:
		{
			$num_letra = __("ocho centavos");
			break;
		}
		case 7:
		{
			$num_letra = __("siete centavos");
			break;
		}
		case 6:
		{
			$num_letra = __("seis centavos");
			break;
		}
		case 5:
		{
			$num_letra = __("cinco centavos");
			break;
		}
		case 4:
		{
			$num_letra = __("cuatro centavos");
			break;
		}
		case 3:
		{
			$num_letra = __("tres centavos");
			break;
		}
		case 2:
		{
			$num_letra = __("dos centavos");
			break;
		}
		case 1:
		{
			$num_letra = __("un centavo");
			break;
		}
	}
	return $num_letra;
}

function decena_centimos($numero)
{
	if ($numero >= 10)
	{
		if ($numero >= 90 && $numero <= 99)
		{
			  if ($numero == 90)
				  return __("noventa centavos");
			  else if ($numero == 91)
				  return __("noventa y un centavos");
			  else
				  return __("noventa y ").unidad_centimos($numero - 90);
		}
		if ($numero >= 80 && $numero <= 89)
		{
			if ($numero == 80)
				return __("ochenta centavos");
			else if ($numero == 81)
				return __("ochenta y un centavos");
			else
				return __("ochenta y ").unidad_centimos($numero - 80);
		}
		if ($numero >= 70 && $numero <= 79)
		{
			if ($numero == 70)
				return __("setenta centavos");
			else if ($numero == 71)
				return __("setenta y un centavos");
			else
				return __("setenta y ").unidad_centimos($numero - 70);
		}
		if ($numero >= 60 && $numero <= 69)
		{
			if ($numero == 60)
				return __("sesenta centavos");
			else if ($numero == 61)
				return __("sesenta y un centavos");
			else
				return __("sesenta y ").unidad_centimos($numero - 60);
		}
		if ($numero >= 50 && $numero <= 59)
		{
			if ($numero == 50)
				return __("cincuenta centavos");
			else if ($numero == 51)
				return __("cincuenta y un centavos");
			else
				return __("cincuenta y ").unidad_centimos($numero - 50);
		}
		if ($numero >= 40 && $numero <= 49)
		{
			if ($numero == 40)
				return __("cuarenta centavos");
			else if ($numero == 41)
				return __("cuarenta y un centavos");
			else
				return __("cuarenta y ").unidad_centimos($numero - 40);
		}
		if ($numero >= 30 && $numero <= 39)
		{
			if ($numero == 30)
				return __("treinta centavos");
			else if ($numero == 91)
				return __("treinta y un centavos");
			else
				return __("treinta y ").unidad_centimos($numero - 30);
		}
		if ($numero >= 20 && $numero <= 29)
		{
			if ($numero == 20)
				return __("veinte centavos");
			else if ($numero == 21)
				return __("veintiun centavos");
			else
				return __("veinti").unidad_centimos($numero - 20);
		}
		if ($numero >= 10 && $numero <= 19)
		{
			if ($numero == 10)
				return __("diez centavos");
			else if ($numero == 11)
				return __("once centavos");
			else if ($numero == 11)
				return __("doce centavos");
			else if ($numero == 11)
				return __("trece centavos");
			else if ($numero == 11)
				return __("catorce centavos");
			else if ($numero == 11)
				return __("quince centavos");
			else if ($numero == 11)
				return __("dieciseis centavos");
			else if ($numero == 11)
				return __("diecisiete centavos");
			else if ($numero == 11)
				return __("dieciocho centavos");
			else if ($numero == 11)
				return __("diecinueve centavos");
		}
	}
	else
		return unidad_centimos($numero);
}

function unidad($numero)
{
	switch ($numero)
	{
		case 9:
		{
			$num = __("nueve");
			break;
		}
		case 8:
		{
			$num = __("ocho");
			break;
		}
		case 7:
		{
			$num = __("siete");
			break;
		}
		case 6:
		{
			$num = __("seis");
			break;
		}
		case 5:
		{
			$num = __("cinco");
			break;
		}
		case 4:
		{
			$num = __("cuatro");
			break;
		}
		case 3:
		{
			$num = __("tres");
			break;
		}
		case 2:
		{
			$num = __("dos");
			break;
		}
		case 1:
		{
			$num = __("uno");
			break;
		}
	}
	return $num;
}

function decena($numero)
{
	if ($numero >= 90 && $numero <= 99)
	{
		$num_letra = __("noventa") . " ";
		
		if ($numero > 90)
			$num_letra = $num_letra."y ".unidad($numero - 90);
	}
	else if ($numero >= 80 && $numero <= 89)
	{
		$num_letra = __("ochenta") . " ";
		
		if ($numero > 80)
			$num_letra = $num_letra."y ".unidad($numero - 80);
	}
	else if ($numero >= 70 && $numero <= 79)
	{
			$num_letra = __("setenta") . " ";
		
		if ($numero > 70)
			$num_letra = $num_letra."y ".unidad($numero - 70);
	}
	else if ($numero >= 60 && $numero <= 69)
	{
		$num_letra = __("sesenta") . " ";
		
		if ($numero > 60)
			$num_letra = $num_letra."y ".unidad($numero - 60);
	}
	else if ($numero >= 50 && $numero <= 59)
	{
		$num_letra = __("cincuenta") . " ";
		
		if ($numero > 50)
			$num_letra = $num_letra."y ".unidad($numero - 50);
	}
	else if ($numero >= 40 && $numero <= 49)
	{
		$num_letra = __("cuarenta") . " ";
		
		if ($numero > 40)
			$num_letra = $num_letra."y ".unidad($numero - 40);
	}
	else if ($numero >= 30 && $numero <= 39)
	{
		$num_letra = __("treinta") . " ";
		
		if ($numero > 30)
			$num_letra = $num_letra."y ".unidad($numero - 30);
	}
	else if ($numero >= 20 && $numero <= 29)
	{
		if ($numero == 20)
			$num_letra = __("veinte") . " ";
		else
			$num_letra = __("veinti").unidad($numero - 20);
	}
	else if ($numero >= 10 && $numero <= 19)
	{
		switch ($numero)
		{
			case 10:
			{
				$num_letra = __("diez") . " ";
				break;
			}
			case 11:
			{
				$num_letra = __("once") . " ";
				break;
			}
			case 12:
			{
				$num_letra = __("doce") . " ";
				break;
			}
			case 13:
			{
				$num_letra = __("trece") . " ";
				break;
			}
			case 14:
			{
				$num_letra = __("catorce") . " ";
				break;
			}
			case 15:
			{
				$num_letra = __("quince") . " ";
				break;
			}
			case 16:
			{
				$num_letra = __("dieciseis") . " ";
				break;
			}
			case 17:
			{
				$num_letra = __("diecisiete") . " ";
				break;
			}
			case 18:
			{
				$num_letra = __("dieciocho") . " ";
				break;
			}
			case 19:
			{
				$num_letra = __("diecinueve") . " ";
				break;
			}
		}
	}
	else
		$num_letra = unidad($numero);

	return $num_letra;
}

function centena($numero)
{
	if ($numero >= 100)
	{
		if ($numero >= 900 & $numero <= 999)
		{
			$num_letra = __("novecientos") . " ";
			
			if ($numero > 900)
				$num_letra = $num_letra.decena($numero - 900);
		}
		else if ($numero >= 800 && $numero <= 899)
		{
			$num_letra = __("ochocientos") . " ";
			
			if ($numero > 800)
				$num_letra = $num_letra.decena($numero - 800);
		}
		else if ($numero >= 700 && $numero <= 799)
		{
			$num_letra = __("setecientos") . " ";
			
			if ($numero > 700)
				$num_letra = $num_letra.decena($numero - 700);
		}
		else if ($numero >= 600 && $numero <= 699)
		{
			$num_letra = __("seiscientos") . " ";
			
			if ($numero > 600)
				$num_letra = $num_letra.decena($numero - 600);
		}
		else if ($numero >= 500 && $numero <= 599)
		{
			$num_letra = __("quinientos") . " ";
			
			if ($numero > 500)
				$num_letra = $num_letra.decena($numero - 500);
		}
		else if ($numero >= 400 && $numero <= 499)
		{
			$num_letra = __("cuatrocientos") . " ";
			
			if ($numero > 400)
				$num_letra = $num_letra.decena($numero - 400);
		}
		else if ($numero >= 300 && $numero <= 399)
		{
			$num_letra = __("trescientos") . " ";
			
			if ($numero > 300)
				$num_letra = $num_letra.decena($numero - 300);
		}
		else if ($numero >= 200 && $numero <= 299)
		{
			$num_letra = __("doscientos") . " ";
			
			if ($numero > 200)
				$num_letra = $num_letra.decena($numero - 200);
		}
		else if ($numero >= 100 && $numero <= 199)
		{
			if ($numero == 100)
				$num_letra = __("cien") . " ";
			else
				$num_letra = __("ciento") . " " .decena($numero - 100);
		}
	}
	else
		$num_letra = decena($numero);
	
	return $num_letra;
}

function cien()
{
	global $importe_parcial;
	
	$parcial = 0; $car = 0;
	
	while (substr($importe_parcial, 0, 1) == 0)
		$importe_parcial = substr($importe_parcial, 1, strlen($importe_parcial) - 1);
	
	if ($importe_parcial >= 1 && $importe_parcial <= 9.99)
		$car = 1;
	else if ($importe_parcial >= 10 && $importe_parcial <= 99.99)
		$car = 2;
	else if ($importe_parcial >= 100 && $importe_parcial <= 999.99)
		$car = 3;
	
	$parcial = substr($importe_parcial, 0, $car);
	$importe_parcial = substr($importe_parcial, $car);
	
	$num_letra = centena($parcial).centimos();
	
	return $num_letra;
}

function cien_mil()
{
	global $importe_parcial;
	
	$parcial = 0; $car = 0;
	
	while (substr($importe_parcial, 0, 1) == 0)
		$importe_parcial = substr($importe_parcial, 1, strlen($importe_parcial) - 1);
	
	if ($importe_parcial >= 1000 && $importe_parcial <= 9999.99)
		$car = 1;
	else if ($importe_parcial >= 10000 && $importe_parcial <= 99999.99)
		$car = 2;
	else if ($importe_parcial >= 100000 && $importe_parcial <= 999999.99)
		$car = 3;
	
	$parcial = substr($importe_parcial, 0, $car);
	$importe_parcial = substr($importe_parcial, $car);
	
	if ($parcial > 0)
	{
		if ($parcial == 1)
			$num_letra = __("mil") . " ";
		else
			$num_letra = centena($parcial). " " . __("mil") . " ";
	}
	
	return $num_letra;
}


function millon()
{
	global $importe_parcial;
	
	$parcial = 0; $car = 0;
	
	while (substr($importe_parcial, 0, 1) == 0)
		$importe_parcial = substr($importe_parcial, 1, strlen($importe_parcial) - 1);
	
	if ($importe_parcial >= 1000000 && $importe_parcial <= 9999999.99)
		$car = 1;
	else if ($importe_parcial >= 10000000 && $importe_parcial <= 99999999.99)
		$car = 2;
	else if ($importe_parcial >= 100000000 && $importe_parcial <= 999999999.99)
		$car = 3;
	
	$parcial = substr($importe_parcial, 0, $car);
	$importe_parcial = substr($importe_parcial, $car);
	
	if ($parcial == 1)
		$num_letras = __("un millón") . " ";
	else
		$num_letras = centena($parcial)." " . __("millones") . " ";
	
	return $num_letras;
}

function Number2Char($numero)
{
	global $importe_parcial;

	$importe_parcial = $numero;

	if ($numero < 1000000000)
	{
		if ($numero >= 1000000 && $numero <= 999999999.99)
			$num_letras = millon().cien_mil().cien();
		else if ($numero >= 1000 && $numero <= 999999.99)
			$num_letras = cien_mil().cien();
		else if ($numero >= 1 && $numero <= 999.99)
			$num_letras = cien();
		else if ($numero >= 0.01 && $numero <= 0.99)
		{
			if ($numero == 0.01)
				$num_letras = __("un centavo");
			else
				$num_letras = Number2Char(($numero * 100)."/100")." " . __("centavos");
		}
	}
	return $num_letras;
}
?>
