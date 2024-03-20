<?php
include_once '../controllers/Controller.php';

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    if (empty($correo) || empty($contraseña)) {
        echo "Por favor, complete todos los campos.";
    } else {

        $registroExitoso = registrarUsuario($conn, $correo, $contraseña);
        
        if ($registroExitoso) {
            header("Location: ../index.php");
            exit(); 
        } else {
            echo "Error al registrar el usuario.";
        }
    }
}

?>