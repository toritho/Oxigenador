<?php
// Verificar si se ha enviado el ID de la bomba
if(isset($_POST['id'])) {
    // Obtener el ID de la bomba desde la solicitud POST
    $id = $_POST['id'];

    require_once '../conexion.php';

    // Consulta SQL para eliminar la bomba
    $sql = "DELETE FROM registro WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // La bomba se eliminó correctamente
        echo "Bomba eliminada exitosamente";
    } else {
        // Error al eliminar la bomba
        echo "Error al eliminar la bomba: " . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
} else {
    // Si no se proporcionó el ID de la bomba, mostrar un mensaje de error
    echo "Error: No se proporcionó el ID de la bomba";
}
?>
