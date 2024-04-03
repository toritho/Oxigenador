<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha enviado un nombre para la bomba
    if(isset($_POST['nombreBomba'])) {
        // Obtener el nombre de la bomba enviado desde el formulario
        $nombreBomba = $_POST['nombreBomba'];

        // Conexión a la base de datos (modifica estos valores según tu configuración)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "b-oxigenador";

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Preparar la consulta SQL para insertar la bomba
        $sql = "INSERT INTO bombas (nombre) VALUES (?)";

        // Preparar y ejecutar la consulta
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $nombreBomba);
            if ($stmt->execute()) {
                echo json_encode(array("success" => true, "message" => "La bomba se agregó correctamente."));
            } else {
                echo json_encode(array("success" => false, "message" => "Error al agregar la bomba: " . $conn->error));
            }
            $stmt->close();
        } else {
            echo json_encode(array("success" => false, "message" => "Error de preparación de la consulta: " . $conn->error));
        }

        // Cerrar la conexión
        $conn->close();
    } else {
        echo json_encode(array("success" => false, "message" => "No se proporcionó un nombre para la bomba."));
    }
} else {
    // Si no se envió una solicitud POST, mostrar un mensaje de error
    echo json_encode(array("success" => false, "message" => "Solicitud no válida."));
}
?>
