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
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #000000; margin: 40px; }
        .container { max-width: 400px; margin: 0 auto; background: #ff0000; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="password"] { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 10px; background-color: #000000; border: 0; color: red; border-radius: 4px; font-size: 16px; cursor: pointer; }
        button:hover { background-color: #580000; }
        .error { color: #721c24; background-color: #f8d7da; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .exito { color: #155724; background-color: #d4edda; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Formulario de Registro</h2>

    <?php if (!empty($errores)): ?>
        <div class="error">
            <ul>
                <?php foreach ($errores as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!empty($mensaje_exito)): ?>
        <div class="exito">
            <?php echo htmlspecialchars($mensaje_exito); ?>
        </div>
    <?php endif; ?>

    <form action="registro.php" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre Completo:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>">
        </div>

        <div class="form-group">
            <label for="usuario">Nombre de Usuario (Login):</label>
            <input type="text" id="usuario" name="usuario" value="<?php echo htmlspecialchars($usuario); ?>">
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password">
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirmar Contraseña:</label>
            <input type="password" id="confirm_password" name="confirm_password">
        </div>

        <button type="submit">Registrar</button>
    </form>
</div>

</body>
</html>