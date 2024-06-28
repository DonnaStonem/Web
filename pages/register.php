<?php
session_start();
require 'db_connection.php'; // El archivo con la cadena de conexión

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apPaterno = $_POST['apPaterno'];
    $apMaterno = $_POST['apMaterno'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Verifica si el email ya está registrado
    $stmt = $pdo->prepare('SELECT * FROM Clientes WHERE CorreoElectronico = :email UNION SELECT * FROM Usuarios WHERE CorreoElectronico = :email');
    $stmt->execute(['email' => $email]);
    $existingUser = $stmt->fetch();

    if ($existingUser) {
        $_SESSION['MensajeEmail'] = 'Este correo ya está registrado';
        header('Location: register.php');
        exit();
    }

    // Hashear la contraseña antes de guardarla
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Guarda el nuevo cliente
    $stmt = $pdo->prepare('INSERT INTO Clientes (Nombre, ApPaterno, ApMaterno, NumeTel, CorreoElectronico, Contrasena) VALUES (:nombre, :apPaterno, :apMaterno, :telefono, :email, :password)');
    $stmt->execute([
        'nombre' => $nombre,
        'apPaterno' => $apPaterno,
        'apMaterno' => $apMaterno,
        'telefono' => $telefono,
        'email' => $email,
        'password' => $hashedPassword
    ]);

    $_SESSION['MensajeRegistro'] = 'Cuenta creada con éxito';
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./../css/style.css" rel="stylesheet">
    <title>Registro</title>
</head>

<body>
    <?php
    include ("./../elementos_base/header.php");
    imprimir_header_no_index();
    ?>

    <p><?php echo isset($_SESSION['MensajeEmail']) ? $_SESSION['MensajeEmail'] : ''; ?></p>

    <section>
        <div class="formularioInicio">
            <form class="formularioRegistro" id="registerForm" action="register.php" method="post">
                <h1>Register</h1>

                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" required maxlength="50">

                <label for="apPaterno">Apellido Paterno</label>
                <input type="text" id="apPaterno" name="apPaterno" placeholder="Apellido Paterno" required
                    maxlength="50">

                <label for="apMaterno">Apellido Materno</label>
                <input type="text" id="apMaterno" name="apMaterno" placeholder="Apellido Materno" required
                    maxlength="50">

                <label for="telefono">Número Telefónico</label>
                <input type="number" id="telefono" name="telefono" placeholder="Número Telefónico" required
                    maxlength="10">

                <label for="email">Ingrese su email</label>
                <input type="email" id="email" name="email" placeholder="Correo" required maxlength="50">

                <label for="password">Crear contraseña</label>
                <input type="password" id="password" name="password" placeholder="Contraseña" required maxlength="50"
                    minlength="8">

                <label for="confirmPassword">Confirmar contraseña</label>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirmar contraseña"
                    required maxlength="50" minlength="8">

                <input class="submit" type="submit" value="Enter">

                <div id="errorMessage" class="error"></div>
            </form>
        </div>
    </section>

    <script src="js/Register.js"></script>
</body>

</html>