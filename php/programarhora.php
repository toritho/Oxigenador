<?php
$bombaId = $_GET['id'];

require_once '../conexion.php';

//Obtiene los datos de la bomba seleccionada

//reliza consulta
$sql = "SELECT id, h_encendido, h_apagado FROM programarhora WHERE id= $bombaId";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo "No se encontraron datos para la bomba con ID $bombaId";
}

$conn->close();
?>