<?php 
/**
 * Clase Connection. Conecta a base de datos a partir de los datos proporcionados al constructor.
 * @author Luismi
 *
 */
class Connection {
    const ERROR_DB = "Error al conectar a la base de datos.";
    
	private $host;
	private $database;
	private $user;
	private $pass;
	
	private $mysqli;
	
	function __construct($host, $database, $user, $pass) {
        $this->host = $host;
        $this->database = $database;
        $this->user = $user;
        $this->pass = $pass;
    }
    
    /**
     * Devuelve una conexión activa.
     */
    public function getConnection() {
        $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->database);
        if(mysqli_connect_errno()) {
            throw new Exception(self::ERROR_DB);
        } else {
            $this->mysqli->query("SET NAMES 'utf8'");
        }
        
        return $this->mysqli;
    }    
}
?>