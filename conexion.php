<?php
$servername = "localhost";  // Cambia si usas un servidor remoto
$username = "root";         // El usuario que configuraste
$password = "";             // La contraseña que configuraste
$dbname = "quiniela_futbol";

// Crear la conexión
$conn = new mysqli($servername, $user, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
