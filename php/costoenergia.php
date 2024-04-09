<?php

require_once '../conexion.php';

// Valor monetario por hora
$valor_monetario_por_hora = $_POST['valor'];;

// ID de registro y fecha proporcionados por el usuario (reemplaza estos valores según tus necesidades)
$id_registro = $_POST['id'];;
$fecha_consulta = $_POST['fecha'];;

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
    
    // Calcular el costo
    $costo = ($tiempo_total / 3600) * $valor_monetario_por_hora; // Convertir el tiempo total de segundos a horas
    
    // Agregar resultados al array de respuesta
    $response['tiempo_transcurrido'] = gmdate("H:i:s", $tiempo_total);
    $response['costo_total'] = $costo;
    
} else {
    $response['error'] = "No se encontraron registros para el ID de registro y la fecha proporcionados.";
}

// Convertir array de respuesta a JSON y mostrarlo
echo json_encode($response);

$conn->close();

?>
