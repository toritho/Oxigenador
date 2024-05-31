<?php

//php para el boton guardar datos 

// Conexión a la base de datos (ajusta los valores según tu configuración)
require_once '../conexion.php';

// Recibe los datos del cliente
$bombaId = $_POST['bombaId'];
$horaEncendido = $_POST['horaEncendido'];
$horaApagado = $_POST['horaApagado'];
$regla = $_POST['regla'];
$regla  = filter_var($regla , FILTER_VALIDATE_BOOLEAN);
$regla = $regla  ? 1 :0;

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
        $sql = "UPDATE programarhora SET h_encendido = '$horaEncendido', h_apagado = '$horaApagado', estado1='$regla' WHERE id = $bombaId";
    } else {
        // Si el registro no existe, realizar un INSERT
        $sql = "INSERT INTO programarhora (id, h_encendido, h_apagado,estado1,estado2) VALUES ($bombaId, '$horaEncendido', '$horaApagado','$regla','$regla')";
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

