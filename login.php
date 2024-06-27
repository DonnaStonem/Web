<?php
session_start();
require 'db_connection.php'; // El archivo con la cadena de conexión

function loginUser($email, $password, $pdo) {
    $stmt = $pdo->prepare('SELECT * FROM Usuarios WHERE CorreoElectronico = :email');
    $stmt->execute(['email' => $email]);
    $usuario = $stmt->fetch();

    $stmt = $pdo->prepare('SELECT * FROM Clientes WHERE CorreoElectronico = :email');
    $stmt->execute(['email' => $email]);
    $cliente = $stmt->fetch();

    if (($usuario === false || $usuario['Contrasena'] !== $password) && ($cliente === false || $cliente['Contrasena'] !== $password)) {
        $_SESSION['error'] = 'Usuario o contraseña incorrectos.';
        header('Location: login.php');
        exit();
    } elseif ($cliente !== false && $cliente['Contrasena'] === $password) {
        $_SESSION['Rol'] = 'Cliente';
        $_SESSION['IdCliente'] = $cliente['IdCliente'];
        $_SESSION['NombreCliente'] = $cliente['Nombre'] . ' ' . $cliente['ApPaterno'] . ' ' . $cliente['ApMaterno'];
        header('Location: home.php');
        exit();
    } elseif ($usuario !== false && $usuario['Contrasena'] === $password) {
        $_SESSION['Rol'] = $usuario['Rol'];
        $_SESSION['IdUsuario'] = $usuario['IdUsuario'];
        $_SESSION['NombreUsuario'] = $usuario['Nombre'] . ' ' . $usuario['ApPaterno'] . ' ' . $usuario['ApMaterno'];
        if ($usuario['Rol'] === 'Gerente') {
            header('Location: gerente/crear_usuario.php');
        } elseif ($usuario['Rol'] === 'Tecnico') {
            header('Location: tecnico/solicitudes.php');
        }
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['Email'];
    $password = $_POST['password'];
    loginUser($email, $password, $pdo);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <nav>
        <ul class="nav">
            <li class="nav-left"><a href="index.php"><img src="assets/plumber.png" alt="plumber">Plumber</a></li>
            <li><a href="servicios.php">Services</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>

    <p><?php echo isset($_SESSION['MensajeRegistro']) ? $_SESSION['MensajeRegistro'] : ''; ?></p>

    <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
    <?php endif; ?>

    <section>
        <div class="formularioInicio">
            <form action="login.php" method="post">
                <h1>Iniciar sesión</h1>
                <label for="email">Ingrese su correo electrónico</label>
                <input type="email" id="email" name="Email" placeholder="correo" required>

                <label for="password">Ingrese su contraseña</label>
                <input type="password" id="password" name="password" placeholder="Contraseña" required>

                <input class="submit" type="submit" value="Enter">
            </form>
        </div>
    </section>
    <footer>
        <h2>Formulario de Quejas y Sugerencias</h2>
        <form action="">

            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Correo</label>
            <input type="email" id="email" name="email" required>

            <label for="type">Tipo de mensaje:</label>
            <select name="type" id="type" required>
                <option value="queja">Queja</option>
                <option value="sugerencia">Sugerencia</option>
            </select>

            <label for="message">Mensaje:</label>
            <textarea name="message" id="message" rows="5" required></textarea>

            <input class="submit" type="submit" value="Enter">

        </form>
        <p>© All rights reserved</p>
    </footer>
</body>
</html>
