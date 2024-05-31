<?php
require './conexion.php';
// Crear la consulta SQL
$sql = "SELECT * FROM `programarhora`";

// Ejecutar la consulta y obtener el resultado
$result = $conn->query($sql);

// Obtener la fecha actual y la hora actual en formato DateTime
date_default_timezone_set('America/Bogota');
$currentDateTime = new DateTime();

// Recorrer los resultados y mostrarlos
while ($row = $result->fetch_assoc()) {
    $ledNumber = $row['id'];
    $encendido = $row['h_encendido'];
    $apagado = $row['h_apagado'];
    $estado = $row['estado1'];
    $estado2 = $row['estado2'];
    // Convertir las horas de encendido y apagado a objetos DateTime
    $startTime = DateTime::createFromFormat('H:i:s', $encendido);
    $endTime = DateTime::createFromFormat('H:i:s', $apagado);

    // Comparar las horas de encendido y apagado considerando la posibilidad de cambio de día

    // El rango de tiempo está dentro del mismo día
    $isWithinRange = $currentDateTime >= $startTime && $currentDateTime <= $endTime;


    if ($isWithinRange && $estado == 1) {
        // La hora actual está dentro del rango startTime - endTime

        // Actualizar el estado del LED
        $updateSql = "UPDATE registro SET `estado`  = '1' WHERE `id`=  $ledNumber";
        $conn->query($updateSql);

        $estado2 = 1;
        $updateScheduleSql = "UPDATE `programarhora` SET `estado2` = 1 WHERE `id` = $ledNumber";
        $conn->query($updateScheduleSql);
    } else {
        if ($estado2 == 1) {
            $updateScheduleSql = "UPDATE `programarhora` SET `estado2` = 0 WHERE `id` = $ledNumber";
            $conn->query($updateScheduleSql);

            $updateSql3 = "UPDATE registro SET `estado`  = '0' WHERE `id`=  $ledNumber";
            
            $conn->query($updateSql3);
        }
    }
}

// Cerrar la conexión
$conn->close();
