<?php



//require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/share/clses/lib_util.inc.php");

class conexion{
 
 var $oDBLP;
 
 
 
 function __construct()
 {
 
  global $SITE_oDB;
  $this->oDBLP =& $SITE_oDB;
  mysql_query ("SET NAMES 'utf8'");
 /* $this->conn = mysql_connect('localhost','soccer_migracion','M16R4C10N');
    mysql_select_db('soccer_migracion',$this->conn);
  mysql_query ("SET NAMES 'utf8'");*/
 }
 

 function query($query)
 {
  $mysql_result = @mysql_query($query);
  $this->n = @mysql_num_rows($mysql_result);
  $this->a = @mysql_affected_rows();
  if($this->n)
   for($i=0;$i<$this->n;$i++) $taula[$i] = @mysql_fetch_object($mysql_result);
  else $taula = null;
  $this->v = $taula;
  if(  $this->n > 0  ) mysql_free_result($mysql_result);
  return $taula;
 }
 

 function __destruct()
 {
  @mysql_close($this->conn);
 }

}







/*

class conexion{
	
	
	// Función constructora, se conecta a penas se crea el objeto.
	function __construct()
	{
		$this->conn = mysql_connect('localhost','soccer_test','735750cc3r');
	  	mysql_select_db('soccer_test',$this->conn);
		mysql_query ("SET NAMES 'utf8'");
	}
	
	// Función query para ejecución de sentencias SQL.
	function query($query)
	{
		$mysql_result = @mysql_query($query);
		$this->n = @mysql_num_rows($mysql_result);
		$this->a = @mysql_affected_rows();
		if($this->n)
			for($i=0;$i<$this->n;$i++) $taula[$i] = @mysql_fetch_object($mysql_result);
		else $taula = null;
		$this->v = $taula;
		if(  $this->n > 0  ) mysql_free_result($mysql_result);
		return $taula;
	}
	
	// Función destructura, se desconecta con la base de datos.
	function __destruct()
	{
		@mysql_close($this->conn);
	}

}*/
?>