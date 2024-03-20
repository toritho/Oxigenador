<?php

include '../controllers/Controller.php';

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    if (empty($correo) || empty($contraseña)) {
        echo "Por favor, complete todos los campos.";
    } else {
        $sesionIniciada = iniciarSesion($conn, $correo, $contraseña);

        if ($sesionIniciada) {    
            header("Location: ../html/inicio.html");
            exit(); 
        } else {
            echo "Credenciales incorrectas. Inténtalo de nuevo.";
        }
    }
}
?>
