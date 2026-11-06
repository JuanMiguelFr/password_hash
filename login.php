<?php
$usuarios_registrados = [
    'juan123' => [
        'nombre' => 'Juan Pérez',
        'password_hash' => '$2y$10$vE6mP6n.S2sZcW.Hn6Iom.ZfF9rW9oX9WvFmGfR6u1A0Xz5G6YJ3m'
    ]
];

$mensaje = "";
$clase_mensaje = "";
$usuario_capturado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_capturado = trim($_POST['usuario'] ?? '');
    $password_capturada = $_POST['password'] ?? '';

    if (empty($usuario_capturado) || empty($password_capturada)) {
        $mensaje = "Por favor, llena todos los campos.";
        $clase_mensaje = "error";
    } else {
        if (array_key_exists($usuario_capturado, $usuarios_registrados)) {
            
            $hash = $usuarios_registrados[$usuario_capturado]['password_hash'];

            if (password_verify($password_capturada, $hash)) {
                $mensaje = "¡Bienvenido! Acceso autorizado para " . $usuarios_registrados[$usuario_capturado]['nombre'] . ".";
                $clase_mensaje = "exito";
            } else {
                $mensaje = "Contraseña incorrecta. Acceso rechazado.";
                $clase_mensaje = "error";
            }
        } else {
            $mensaje = "El nombre de usuario no se encuentra registrado. Acceso rechazado.";
            $clase_mensaje = "error";
        }
    }
}
?>