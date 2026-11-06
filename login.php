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
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuario</title>
    
</head>
<body>

<div class="container">
    <h2>Iniciar Sesión</h2>

    <?php if (!empty($mensaje)): ?>
        <div class="<?php echo $clase_mensaje; ?>">
            <?php echo htmlspecialchars($mensaje); ?>
        </div>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <div class="form-group">
            <label for="usuario">Nombre de Usuario:</label>
            <input type="text" id="usuario" name="usuario" value="<?php echo htmlspecialchars($usuario_capturado); ?>">
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password">
        </div>

        <button type="submit">Ingresar</button>
    </form>

    <div class="ayuda">
        <strong>Datos para probar en XAMPP:</strong><br>
         Usuario: <code>juan123</code><br>
         Contraseña válida: <code>secreto123</code>
    </div>
</div>

</body>
</html>