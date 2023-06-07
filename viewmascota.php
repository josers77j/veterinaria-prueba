<?php
session_start();

// if($_SESSION['username']=== null){
//     header('Location:index.php');
// }

include_once 'conexion.php';
include_once 'login.php';

$host = "localhost";
$name = "veterinaria";
$usuario = "root";
$contrasena = "";
$conexion = new ConexionPDO($host, $name, $usuario, $contrasena);
$conexion->conectar();

$query = "SELECT * FROM mascota";
$statement = $conexion->getConnection()->query($query);
$mascotas = $statement->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
    <title>Mascotas</title>
</head>
<body>
<section style="width:800px; margin:0 auto;">
<a href='addmascota.php' class='btn btn-primary'>Nueva mascota</a>
    <table class="table" >
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Raza</th>
            <th>Sexo</th>
            <th>Edad</th>
        </tr>
        <tbody>
            <?php foreach ($mascotas as $mascota): ?>
                <tr>
                    <td><?php echo $mascota['id']; ?></td>
                    <td><?php echo $mascota['nombre']; ?></td>
                    <td><?php echo $mascota['raza']; ?></td>
                    <td><?php echo $mascota['sexo']; ?></td>
                    <td>
                        <a href="editarmascota.php?idUpdate=<?php echo $mascota['id']; ?>" class="btn btn-success">Modificar</a>
                        <a href="eliminar.php?idDelete=<?php echo $mascota['id']; ?>" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
</body>
</html>
