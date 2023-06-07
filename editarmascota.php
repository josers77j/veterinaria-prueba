<?php
$id = $_GET["idUpdate"];
include_once 'conexion.php';
include_once 'login.php';
// Aquí debes agregar tu lógica para obtener los datos de la mascota según el ID

$host = "localhost";
$name = "veterinaria";
$usuario = "root";
$contrasena = "";
$conexion = new ConexionPDO($host, $name, $usuario, $contrasena);
$conexion->conectar();

$query = "SELECT * FROM mascota WHERE id = :id";
$statement = $conexion->getConnection()->prepare($query);
$statement->bindParam(':id', $id);
$statement->execute();
$mascota = $statement->fetch(PDO::FETCH_ASSOC);

// Luego, puedes asignar los valores de la mascota a las variables correspondientes
$nombreMascota = $mascota['nombre'];
$edadMascota = $mascota['edad'];
$razaMascota = $mascota['raza'];
$colorMascota = $mascota['color'];
$sexoMascota = $mascota['sexo'];

// Si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $nuevoNombre = $_POST["mascota"];
    $nuevaEdad = $_POST["edad"];
    $nuevaRaza = $_POST["raza"];
    $nuevoColor = $_POST["color"];
    $nuevoSexo = $_POST["sexo"];

    // Realizar la actualización en la base de datos
    $query = "UPDATE mascota SET nombre = :nombre, edad = :edad, raza = :raza, color = :color, sexo = :sexo WHERE id = :id";
    $statement = $conexion->getConnection()->prepare($query);
    $statement->bindParam(':nombre', $nuevoNombre);
    $statement->bindParam(':edad', $nuevaEdad);
    $statement->bindParam(':raza', $nuevaRaza);
    $statement->bindParam(':color', $nuevoColor);
    $statement->bindParam(':sexo', $nuevoSexo);
    $statement->bindParam(':id', $id);
    
    if ($statement->execute()) {
        // La actualización se realizó con éxito
        header("location: viewmascota.php");
    } else {
        // Ocurrió un error durante la actualización
        echo "Error al actualizar la mascota";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
    <title>Editar Mascota</title>
</head>
<body>
<section style="width:800px; margin:0 auto;">
<form action="" method="POST">

  <div class="form-group">
    <label>Nombre Mascota</label>
    <input type="text" class="form-control" name="mascota" placeholder="Caramelo" value="<?php echo $nombreMascota; ?>">
  </div>
 
  <div class="form-group">
    <label>Edad:</label>
    <input type="numeric" class="form-control" name="edad" placeholder="6" value="<?php echo $edadMascota; ?>">
  </div>

  <div class="form-group">
    <label>Raza:</label>
    <input type="text" class="form-control" name="raza" placeholder="Labrador" value="<?php echo $razaMascota; ?>">
  </div>

  <div class="form-group">
    <label>Color:</label>
    <input type="text" class="form-control" name="color" placeholder="Negro" value="<?php echo $colorMascota; ?>">
  </div>

  <div class="form-group">
    <label>Sexo:</label>
    <input type="text" class="form-control" name="sexo" placeholder="Macho" value="<?php echo $sexoMascota; ?>">
  </div>

  <br>
  <br>
  <button type="submit" class="btn btn-primary">Guardar</button>
</form>
</section>
</body>
</html>
