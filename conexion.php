<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "b-oxigenador";

$conn = new mysqli($servername, $username, $password, $database);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
