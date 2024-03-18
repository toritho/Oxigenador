<?php
require_once '../conexion.php';


// Consulta para obtener datos de la tabla 'registro'
$sql = "SELECT id, nombre, estado FROM registro";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

// Devolver datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
