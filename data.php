<?php


require_once('./php/encendidoprogramado.php');




// Configuración de la conexión a la base de datos (debes completar con tus propios datos)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "b-oxigenador";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);


// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener el estado del dispositivo (suponiendo que el dispositivo tiene un identificador único, como un ID)
$id = 1; // Cambia esto por el ID de tu dispositivo
$sql = "SELECT estado FROM registro WHERE id = 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Si se encontraron resultados, obtener el estado
    while($row = $result->fetch_assoc()) {
        $estado = $row["estado"];
        echo $estado; // Devuelve solo el valor del estado
    }
} else {
    echo "No se encontraron resultados para el dispositivo con ID: $id";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
