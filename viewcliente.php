<?php
session_start();

if($_SESSION['username']=== null){
    header('Location:index.php');
}

include_once 'conexion.php';
include_once 'login.php';

$host = "localhost";
$name = "dbveterinaria";
$usuario = "root";
$contrasena = "";
$conexion = new ConexionPDO($host, $name, $usuario, $contrasena);
$conexion->conectar();

$query = "SELECT * FROM dueñomascota";
$statement = $conexion->getConnection()->query($query);
$cliente = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
    <title>Cliente</title>
</head>
<body>
<section style="width:800px; margin:0 auto;">
<a href='addmascota.php' class='btn btn-primary'>Nuevo Cliente</a>
    <table class="table" >
        <tr>
            <th >ID</th>
            <th>nombre</th>
            <th>apellido</th>
            <th>direccion</th>
            <th>telefono</th>
           
            <th></th>
        </tr>
        <tbody>
            <?php
        foreach ($cliente as $clientes) {
                echo "<tr>";
                echo "<td>".$clientes['id']."</td>";
                echo "<td>".$clientes['nombre']."</td>";
                echo "<td>".$clientes['apellido']."</td>";
                echo "<td>".$clientes['direccion']."</td>";
                echo "<td>".$clientes['telefono']."</td>";
                echo "<td><a href='' class='btn btn-success'>Modificar</a></td>";
                echo "<td><form action='eliminarmascota.php' method='POST'>
                        <input type='text' name='id' value='".$clientes['id']."' hidden >
                       <input type='submit' class='btn btn-danger' value='Eliminar'>
                       </form></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</section>
</body>
</html>
