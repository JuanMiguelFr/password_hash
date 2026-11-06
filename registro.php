<?php
$errores = [];
$mensaje_exito = "";
$nombre = "";
$usuario = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre'] ?? '');
    $usuario = trim($_POST['usuario'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($nombre) || empty($usuario) || empty($password) || empty($confirm_password)) {
        $errores[] = "Todos los campos son obligatorios.";
    }

    if (!empty($password) && strlen($password) < 6) {
        $errores[] = "La contraseña debe tener al menos 6 caracteres.";
    }

    if ($password !== $confirm_password) {
        $errores[] = "La contraseña y la confirmación no coinciden.";
    }

    if (empty($errores)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

       
        $mensaje_exito = "¡Registro exitoso! El usuario se ha guardado de forma segura.";
        
        $nombre = "";
        $usuario = "";
    }
}
?>