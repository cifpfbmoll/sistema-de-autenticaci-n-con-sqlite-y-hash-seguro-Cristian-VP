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

    try {
        $db = conectar();
        $stmt = $db->prepare('SELECT id, usuario, password FROM usuarios WHERE usuario = ?');
        $stmt->execute([$usuario]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($clave, $row['password'])) {
            // Login correcto
            $_SESSION['user'] = [
                'id' => $row['id'],
                'usuario' => $row['usuario']
            ];
            header('Location: dashboard.php');
            exit;
        } else {
            $_SESSION['error'] = 'Usuario o contraseña incorrectos.';
            header('Location: index.php');
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error en el servidor.';
        header('Location: index.php');
        exit;
    }
}

// Si se accede por GET, redirigir al index
header('Location: index.php');
exit;
?>
