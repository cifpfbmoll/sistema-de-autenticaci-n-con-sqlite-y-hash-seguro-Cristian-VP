<?php
function conectar() {
    try {
        $dir = __DIR__ . '/database';
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $db = new PDO('sqlite:' . $dir . '/usuarios.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die('Error de conexión: ' . $e->getMessage());
    }
}
?>

