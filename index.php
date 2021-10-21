<?php

include('db.php');

$error = [
  'usuario' => '',
  'clave' => ''
];
if (!empty($_POST)) :


  if (!isset($_POST['usuario']) || empty($_POST['usuario'])) :
    $error['usuario'] = 'Campo Obligatorio';
  endif;

  if (!isset($_POST['clave']) || empty($_POST['clave'])) :
    $error['clave'] = 'Campo Obligatorio';
  endif;

  if (empty($error['usuario']) && empty($error['clave'])) :
    //redirect lo access login
    $sql = 'SELECT * FROM usuario where nickname = "' . htmlspecialchars(trim($_POST['usuario'])) . '" 
      AND password = "' . htmlspecialchars(trim($_POST['clave'])) . '"';
    $usuario_existe = $mysqli->query($sql);

    if ($usuario_existe && $usuario_existe->num_rows > 0) :
      session_start();

      $usuario = null;

      if ($usuario_existe->num_rows > 1) :
        $error['usuario'] = 'existe más de un resultado';
      else :
        $usuario = $usuario_existe->fetch_assoc();
        $mysqli->close();
        $_SESSION['usuario'] = $usuario;
        header('Location:/is_loged.php');
      endif;

    else :
      $error['usuario'] = 'usuario o clave incorrecto';
    endif;


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


  <form action="index.php" method="POST">
    <div>
      <label>Nombre de usuario</label>
      <input type="text" name="usuario">
      <?php if (!empty($error['usuario'])) : ?>
        <small><?= $error['usuario'] ?></small>
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
      <button type="submit">Ingresar</button>
      <a href="registro.php">Registrar</a>
    </div>
  </form>

</body>

</html>