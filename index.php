<?php
session_start();
include_once 'conexion.php';
include_once 'login.php';

$conexion = new ConexionPDO($host, $name, $usuario, $contrasena);
$conexion->conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   echo $usuario = $_POST['username'];
   echo  $password = MD5($_POST['password']);

    $login = new Login($conexion);


    if ($login->login($usuario, $password)) {
          $_SESSION['username']=$usuario;
         header("Location: dash.php");
        exit();
    } else {
         $error_message = "Nombre de usuario o contraseña incorrectos.";
    }
}

$conexion->desconectar();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Inicio session </title>
</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Inicio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

    </nav>

    <div class="container"><br>
        <div class="row justify-content-center">
            <div class="col-5 p-5 bg-white shadow-lg rounded">
                <h3>Inicio </h3>
                <hr>
                <form method="POST" action="index.php">
                    <div class="form-group">
                        <label for="user">Usuario</label>
                        <input id="username" class="form-control" type="text" name="username">
                    </div>
                    <div class="form-group">
                        <label for="pass">Contraseña</label>
                        <input id="password" class="form-control" type="password" name="password">
                    </div><br>
                    <button class="btn btn-primary" id="login" name="login" type="submit">Entrar</button>
                </form>
            </div>


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>