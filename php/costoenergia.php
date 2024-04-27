<?php

require_once '../conexion.php';

// Precio del kilovatio por hora
$precio_kilovatio_por_hora = ($_POST['valor']);

// ID de registro y fecha proporcionados por el usuario (reemplaza estos valores según tus necesidades)
$id_registro = $_POST['id'];
$fecha_consulta = $_POST['fecha'];

// Consulta SQL para obtener los datos necesarios
$sql = "SELECT id_registro, fecha, hora, estado FROM historial WHERE id_registro = $id_registro AND fecha = '$fecha_consulta' ORDER BY hora";

$result = $conn->query($sql);

$response = array();

if ($result->num_rows > 0) {
    $estado_anterior = null;
    $hora_anterior = null;
    $tiempo_total = 0;
    $primer_cambio = true;
    
    while ($row = $result->fetch_assoc()) {
        if ($estado_anterior !== null && $estado_anterior != $row['estado']) {
            if (!$primer_cambio) {
                $tiempo_transcurrido = strtotime($row['hora']) - strtotime($hora_anterior);
                $tiempo_total += $tiempo_transcurrido;
            } else {
                $primer_cambio = false;
            }
        }
        
        $estado_anterior = $row['estado'];
        $hora_anterior = $row['hora'];
    }
    
    // Convertir el tiempo total de segundos a horas
    $tiempo_total_horas = $tiempo_total / 3600;

    
    // Calcular el costo multiplicando el precio del kilovatio por hora por el tiempo total en horas
    $costo = $precio_kilovatio_por_hora * $tiempo_total_horas;
    
    
    // Agregar resultados al array de respuesta
    $response['costo_total'] = $precio_kilovatio_por_hora * $tiempo_total_horas;
    
    
} else {
    $response['error'] = "No se encontraron registros para el ID de registro y la fecha proporcionados.";
}

// Convertir array de respuesta a JSON y mostrarlo
echo json_encode($response);

$conn->close();

?>
