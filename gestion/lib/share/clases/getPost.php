<?php
//////////// GET POST receive///////////////
if (count($_POST))
{
	while (list($key, $val) = each($_POST))
	{
		$$key = $val;
	}
}
if (count($_GET))
{
	while (list($key, $val) = each($_GET))
	{
		$$key = $val;
	}
}
?>