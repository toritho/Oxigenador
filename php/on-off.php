<?php
require_once '../conexion.php';

// Obtener el ID del botón desde la solicitud POST
$id = $_POST['id'];

// Consulta para obtener el estado actual
$sql = "SELECT estado FROM registro WHERE id = $id";
$resultado = $conn->query($sql);

echo json_encode($resultado);

$conn->close();
?>
