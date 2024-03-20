<?php
include '../conexion.php';

// Función para registrar un nuevo usuario
function registrarUsuario($conn, $correo, $contraseña) {
    $correo = $conn->real_escape_string($correo);
    $contraseña = $conn->real_escape_string($contraseña);

    $contraseñaEncriptada = password_hash($contraseña, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuario (correo, contraseña) VALUES ('$correo', '$contraseñaEncriptada')";

    if ($conn->query($sql) === TRUE) {
        return true; 
    } else {
        return false; 
    }
}


// Función para iniciar sesión
function iniciarSesion($conn, $correo, $contraseña) {
    $correo = $conn->real_escape_string($correo);
    $contraseña = $conn->real_escape_string($contraseña);

    $sql = "SELECT * FROM usuario WHERE correo = '$correo'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($contraseña, $row['contraseña'])) {
            session_start();
            $_SESSION['usuario_id'] = $row['id'];
            return true; 
        }
    }
    return false; 
}
?>