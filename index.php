<?php
// Página de login (estética similar a la de Google, versión simple)
session_start();
// Recuperar mensajes flash desde la sesión (si los hubiera)
$message = $_SESSION['message'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['message'], $_SESSION['error']);
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Iniciar sesión</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <main class="login-container">
    <div class="login-card">
      <div class="logo">MiCuenta</div>
      <h1>Inicia sesión</h1>
      <p class="subtitle">Usa tu cuenta para continuar</p>

      <?php if (!empty($message)): ?>
        <div class="message"><?=htmlspecialchars($message)?></div>
      <?php endif; ?>
      <?php if (!empty($error)): ?>
        <div class="error"><?=htmlspecialchars($error)?></div>
      <?php endif; ?>

      <form action="login.php" method="post" class="login-form">
        <label for="usuario">Correo o usuario</label>
        <input id="usuario" name="usuario" type="text" required autofocus>

        <label for="clave">Contraseña</label>
        <input id="clave" name="clave" type="password" required>

        <button type="submit" class="btn">Siguiente</button>
      </form>

      <div class="links">
        <a href="registro.php">Crear cuenta</a>
      </div>

      <footer class="footer-note">¿Problemas para acceder? <a href="#">Ayuda</a></footer>
    </div>
  </main>
</body>
</html>
