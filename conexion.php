<?php 

$host = "localhost";
$name = "veterinaria";
$usuario = "root";
$contrasena = "";

class ConexionPDO {
    private $host;
    private $dbname;
    private $usuario;
    private $contrasena;
    private $conexion;

    public function __construct($host, $dbname, $usuario, $contrasena) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->usuario = $usuario;
        $this->contrasena = $contrasena;
    }
    public function conectar() {
        try {
            $opciones = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            $this->conexion = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->usuario, $this->contrasena,$opciones);
            if ($this->conexion != null) {
                 // echo "conectado";
            }else{
                // echo "desconectado";
            }
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            die();
        }
    }  
    public function getConnection() {
        return $this->conexion;
    }
    public function desconectar() {
        $this->conexion = null;
        // echo "desconectado";
    }
}
?>