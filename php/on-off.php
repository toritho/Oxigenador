<?php
require_once '../conexion.php';

// Obtener el ID del botón desde la solicitud POST
$id = $_POST['id'];

// Consulta para obtener el estado actual
$sql = "SELECT estado FROM registro WHERE id = $id";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
  $fila = $resultado->fetch_assoc();
  $estado = $fila['estado'];
  echo $estado; // Devuelve solo el número del estado (1 o 0)
} else {
  echo "0"; // Si no se encuentra un estado, devolver 0 (asumiendo que 0 sea el estado por defecto)
}

$conn->close();
?>
