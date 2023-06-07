<?php
session_start();

// if($_SESSION['usuario']=== null){
//     header('Location:index.php');
// }

include_once 'conexion.php';

$conexion = new ConexionPDO($host, $dbname, $usuario, $contrasena);
$conexion->conectar();

$id = $_GET['idDelete'];
echo $id;
try {
    $query = "DELETE FROM mascota WHERE id=:id";
    $statement = $conexion->getConnection()->prepare($query);
    $statement->bindParam(':id', $id);
    $statement->execute();

    // Redireccionar o mostrar un mensaje de éxito
    header("Location: viewmascota.php");
    exit();
} catch (PDOException $e) {
    echo "Error al insertar los datos: " . $e->getMessage();
}
$conexion->desconectar();

?>

