<?php
session_start();
// Proteger la página: sólo usuarios autenticados
if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = 'Debes iniciar sesión para acceder.';
    header('Location: index.php');
    exit;
}
$user = $_SESSION['user'];
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <main class="login-container">
    <div class="login-card">
      <div class="logo">MiCuenta</div>
      <h1>Bienvenido, <?=htmlspecialchars($user['usuario'])?></h1>
      <p class="subtitle">Has iniciado sesión correctamente.</p>

      <div style="text-align:center;margin-top:18px;">
        <a href="logout.php" class="btn">Cerrar sesión</a>
      </div>
    </div>
  </main>
</body>
</html>

