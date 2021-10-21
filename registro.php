<?php

include('db.php');

$error = [
  'usuario' => '',
  'correo' => '',
  'clave' => ''
];
$success = false;

if (!empty($_POST)) :

  if (!isset($_POST['usuario']) || empty($_POST['usuario'])) :
    $error['usuario'] = 'Campo Obligatorio';
  endif;

  if (!isset($_POST['correo']) || empty($_POST['correo'])) :
    $error['correo'] = 'Campo Obligatorio';
  endif;

  if (!isset($_POST['clave']) || empty($_POST['clave'])) :
    $error['clave'] = 'Campo Obligatorio';
  endif;

  if (empty($error['usuario']) && empty($error['correo']) && empty($error['clave'])) :
    //redirect lo access login
    $sql = 'INSERT INTO usuario(nickname,password,correo) values(
      "' . htmlspecialchars(trim($_POST['usuario'])) . '",
      "' . htmlspecialchars(trim($_POST['clave'])) . '",
      "' . htmlspecialchars(trim($_POST['correo'])) . '");';

    if (!$mysqli->query($sql)) {
      $error['usuario'] = '[' . $mysqli->errno . '] ' . $mysqli->error;
    } else {
      $success = true;
    }
    $mysqli->close();
  endif;
endif;


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ingreso de Usuarios</title>
</head>

<body>

  <?php if (!$success) : ?>
    <form action="registro.php" method="POST">
      <div>
        <label>Nombre de usuario</label>
        <input type="text" name="usuario">
        <?php if (!empty($error['usuario'])) : ?>
          <small><?= $error['usuario'] ?></small>
        <?php endif; ?>
      </div>

      <div>
        <label>Correo</label>
        <input type="correo" name="correo">
        <?php if (!empty($error['correo'])) : ?>
          <small><?= $error['correo'] ?></small>
        <?php endif; ?>
      </div>

      <div>
        <label>Clave de usuario</label>
        <input type="password" name="clave">
        <?php if (!empty($error['clave'])) : ?>
          <small><?= $error['clave'] ?></small>
        <?php endif; ?>
      </div>

      <div>
        <button type="submit">Registro</button>
        <a href="index.php">ir al login</a>
      </div>
    </form>
  <?php else : ?>
    <h1>Usuario creado con éxito</h1>
    <a href="/">ir al login</a>
  <?php endif; ?>
</body>

</html>