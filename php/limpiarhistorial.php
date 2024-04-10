<?php
// Conexión a la base de datos
require_once 'conexion.php';

// Query para eliminar todos los registros de la tabla de historial
$query = "DELETE FROM historial";

// Ejecutar la consulta
if(mysqli_query($conexion, $query)) {
    // La consulta se ejecutó con éxito
    echo "Historial limpiado exitosamente";
} else {
    // Error al ejecutar la consulta
    echo "Error al limpiar el historial: " . mysqli_error($conexion);
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
