<?php

class conexion{
	
	// Función constructora, se conecta a penas se crea el objeto.
	function __construct()
	{
		//$this->conn = mysql_connect('mysql50-92.wc2.dfw1.stabletransit.com','585593_soccerT','soccerTest123');
		$this->conn = mysql_connect('72.3.204.247','585593_soccerT','soccerTest123');
	  	mysql_select_db('585593_soccermashTest',$this->conn);
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

}
?>