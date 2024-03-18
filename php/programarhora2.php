<?php
require_once '../conexion.php';

//Obtiene los ocpciones del sect

//realiza consulta
$sql = "SELECT id, nombre FROM registro";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode($rows);
} else {
    echo "No se encontraron usuarios";
}

$conn->close();
?>
