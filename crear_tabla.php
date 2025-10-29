<?php
// Crea la tabla usuarios si no existe
include 'conexion.php';
try {
    $db = conectar();
    $db->exec("CREATE TABLE IF NOT EXISTS usuarios (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        usuario TEXT UNIQUE,
        password TEXT NOT NULL
    )");
    echo "Base de datos y tabla creadas correctamente.\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

