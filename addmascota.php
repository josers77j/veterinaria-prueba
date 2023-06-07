<?php
session_start();

if($_SESSION['usuario']=== null){
  header('Location:index.php');
}

include_once 'conexion.php';

$conexion = new ConexionPDO($host, $dbname, $usuario, $contrasena);
$conexion->conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $mascota = $_POST['mascota'];
    $edad = $_POST['edad'];
    $raza = $_POST['raza'];
    $color = $_POST['color'];
    $sexo = $_POST['sexo'];
    // Insertar los datos en la base de datos
    try {
        $query = "INSERT INTO mascotas (mascota, edad, raza, color, sexo) VALUES (:mascota, :edad, :raza, :color, :sexo)";
        $statement = $conexion->getConnection()->prepare($query);
        $statement->bindParam(':mascota', $mascota);
        $statement->bindParam(':edad', $edad);
        $statement->bindParam(':raza', $raza);
        $statement->bindParam(':color', $color);
        $statement->bindParam(':sexo', $sexo);
       
        $statement->execute();

        // Redireccionar o mostrar un mensaje de éxito
        header("Location: viewmascota.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al insertar los datos: " . $e->getMessage();
    }
}
$conexion->desconectar();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
    <title>Agregar Mascotas</title>
</head>
<body>
<section style="width:800px; margin:0 auto;">
<form action="addmascota.php" method="POST">

  <div class="form-group">
    <label >Nombre Mascota</label>
    <input type="text" class="form-control" name="mascota" placeholder="Caramelo">
  </div>
 
  <div class="form-group">
    <label >Edad: </label>
    <input type="numeric" class="form-control" name="edad" placeholder="6">
  </div>

  <div class="form-group">
    <label>Raza: </label>
    <input type="text" class="form-control" name="raza" placeholder="6">
  </div>

  <div class="form-group">
    <label >Color: </label>
    <input type="text" class="form-control" name="color" placeholder="6">
  </div>

  <div class="form-group">
    <label >Sexo: </label>
    <input type="text" class="form-control" name="sexo" placeholder="6">
  </div>


<br>
<br>
  <button type="submit" class="btn btn-primary">Guardar</button>
</form>
</section>
</body>
</html>