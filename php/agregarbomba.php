<?php
require_once '../conexion.php';

// Obtener el ID del botón desde la solicitud POST


// Obtener los datos enviados desde el formulario
$nombre = $_POST['nombre'];
$estado = $_POST['estado'];

// Preparar y ejecutar la consulta SQL para insertar los datos en la tabla
$sql = "INSERT INTO registro (nombre, estado) VALUES ('$nombre', '$estado')";
echo($sql);

if ($conn->query($sql) === TRUE) {
    echo "Bomba agregada correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();