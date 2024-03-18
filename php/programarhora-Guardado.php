<?php

//php para el boton guardar datos 

// Conexión a la base de datos (ajusta los valores según tu configuración)
require_once '../conexion.php';

// Recibe los datos del cliente
$bombaId = $_POST['bombaId'];
$horaEncendido = $_POST['horaEncendido'];
$horaApagado = $_POST['horaApagado'];

// Validación adicional si es necesario




// Verificar si el registro ya existe
$sqlCheckExistence = "SELECT COUNT(*) as count FROM programarhora WHERE id = $bombaId";
//echo($sqlCheckExistence);
$resultCheckExistence = $conn->query($sqlCheckExistence);

if ($resultCheckExistence->num_rows > 0) {
    $rowExistence = $resultCheckExistence->fetch_assoc();
    $count = $rowExistence['count'];

    if ($count > 0) {
        // Si el registro ya existe, realizar un UPDATE
        $sql = "UPDATE programarhora SET h_encendido = '$horaEncendido', h_apagado = '$horaApagado' WHERE id = $bombaId";
    } else {
        // Si el registro no existe, realizar un INSERT
        $sql = "INSERT INTO programarhora (id, h_encendido, h_apagado) VALUES ($bombaId, '$horaEncendido', '$horaApagado')";
    }
} else {
    echo json_encode(['error' => 'Error al verificar la existencia del registro: ' . $conn->error]);
    exit;
}

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => 'Datos guardados correctamente']);
} else {
    echo json_encode(['error' => 'Error al guardar datos: ' . $conn->error]);
}

$conn->close();
?>

