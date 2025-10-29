<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
    $clave = isset($_POST['clave']) ? $_POST['clave'] : '';

    if ($usuario === '' || $clave === '') {
        $_SESSION['error'] = 'Rellena usuario y contraseña.';
        header('Location: index.php');
        exit;
    }

    $hash = password_hash($clave, PASSWORD_DEFAULT);

    try {
        $db = conectar();
        $stmt = $db->prepare('INSERT INTO usuarios (usuario, password) VALUES (?, ?)');
        $stmt->execute([$usuario, $hash]);
        $_SESSION['message'] = 'Usuario registrado correctamente. Ya puedes iniciar sesión.';
        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        // Manejo simple de error para usuario duplicado
        if (strpos($e->getMessage(), 'UNIQUE') !== false) {
            $_SESSION['error'] = 'El usuario ya existe.';
        } else {
            $_SESSION['error'] = 'Error al registrar usuario.';
        }
        header('Location: index.php');
        exit;
    }
}
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Crear cuenta</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <main class="login-container">
    <div class="login-card">
      <div class="logo">MiCuenta</div>
      <h1>Crear cuenta</h1>
      <p class="subtitle">Regístrate para usar la aplicación</p>

      <form action="registro.php" method="post" class="login-form">
        <label for="usuario">Usuario</label>
        <input id="usuario" name="usuario" type="text" required autofocus>

        <label for="clave">Contraseña</label>
        <input id="clave" name="clave" type="password" required>

        <button type="submit" class="btn">Crear cuenta</button>
      </form>

      <div class="links">
        <a href="index.php">Volver al inicio</a>
      </div>
    </div>
  </main>
</body>
</html>
