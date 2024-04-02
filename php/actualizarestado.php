<?php
// Conexión a la base de datos
require_once '../conexion.php';

// Obtener el ID y el estado desde la solicitud POST
$id = $_POST['id'];
$estado = $_POST['estado'];

// Actualizar el estado en la base de datos
$sql = "UPDATE registro SET estado = $estado WHERE id = $id";
if ($conn->query($sql) === TRUE) {
  echo json_encode(['success' => true]);
} else {
  echo json_encode(['success' => false]);
}

$conn->close();
?>
