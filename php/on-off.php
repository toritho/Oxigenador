<?php
// Incluir el archivo de conexión
require './data.php';

// Lógica para cambiar el estado cuando se presiona el botón
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['toggle_bomba'])) {
        // Cambiar el estado de la bomba
        $nuevo_estado = ($_POST['estado_actual'] == 1) ? 0 : 1;

        // Actualizar el estado en la base de datos (sustituye 'nombre_tabla' y 'id_bomba' según tu estructura)
        $actualizar_sql = "UPDATE nombre_tabla SET estado = $nuevo_estado WHERE id = id_bomba";
        $conn->query($actualizar_sql);
    }
}

// Cerrar la conexión
$conn->close();
?>