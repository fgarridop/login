<?php
ob_start();
session_start();
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : false;
var_dump($usuario);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $usuario ? 'Usuario Logeado' : 'Sin acceso' ?></title>
</head>

<body>
  <h1><?= $usuario ? 'Usuario Logeado' : 'Usuario sin acceso' ?></h1>
  <?php if (!$usuario) : ?>
    <a href="/">Volver</a>
  <?php else : ?>
    <a href="/salir.php">Salir</a>
  <?php endif ?>
</body>

</html>