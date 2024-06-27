<?php
// usuariosController.php

// Conexión a la base de datos
require_once 'conexion.php'; // Asegúrate de cambiar 'conexion.php' por el nombre correcto de tu archivo de conexión

session_start(); // Iniciar sesión

// Función para obtener las cuentas de usuarios
function obtenerCuentas() {
    global $conn;
    $query = "SELECT * FROM Usuarios ORDER BY IdUsuario DESC LIMIT 30"; // Ejemplo de consulta SQL, ajusta según tu estructura de base de datos
    $resultado = mysqli_query($conn, $query);

    $cuentas = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $cuentas[] = $fila;
    }

    return $cuentas;
}

// Función para crear un nuevo usuario
function crearUsuario($Nombre, $PrimerApellido, $SegundoApellido, $Telefono, $roles, $Correo) {
    global $conn;

    // Generar ID de 6 dígitos
    $id = mt_rand(100000, 999999);

    // Verificar si el correo ya está registrado
    $query_verificar = "SELECT * FROM Usuarios WHERE CorreoElectronico = '$Correo'";
    $resultado_verificar = mysqli_query($conn, $query_verificar);

    if (mysqli_num_rows($resultado_verificar) > 0) {
        $_SESSION['MensajeEmail'] = "Este correo ya está registrado";
        return false;
    }

    // Generar contraseña aleatoria
    $caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*";
    $contrasena = '';
    for ($i = 0; $i < 10; $i++) {
        $contrasena .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }

    // Insertar nuevo usuario en la base de datos
    $query_insertar = "INSERT INTO Usuarios (IdUsuario, Nombre, ApPaterno, ApMaterno, NumeTel, CorreoElectronico, Contrasena, Rol)
                       VALUES ('$id', '$Nombre', '$PrimerApellido', '$SegundoApellido', '$Telefono', '$Correo', '$contrasena', '$roles')";

    if (mysqli_query($conn, $query_insertar)) {
        return true;
    } else {
        echo "Error: " . $query_insertar . "
<br>" . mysqli_error($conn);
        return false;
    }
}

// Función para realizar una búsqueda personalizada de usuarios
function busquedaUsuarios($roles, $Nombre, $ApPaterno, $ApMaterno) {
    global $conn;

    $query = "SELECT * FROM Usuarios WHERE 1";

    if (!empty($roles)) {
        $query .= " AND Rol = '$roles'";
    }
    if (!empty($Nombre)) {
        $query .= " AND Nombre = '$Nombre'";
    }
    if (!empty($ApPaterno)) {
        $query .= " AND ApPaterno = '$ApPaterno'";
    }
    if (!empty($ApMaterno)) {
        $query .= " AND ApMaterno = '$ApMaterno'";
    }

    $query .= " ORDER BY IdUsuario DESC LIMIT 30";

    $resultado = mysqli_query($conn, $query);

    $usuarios = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $usuarios[] = $fila;
    }

    return $usuarios;
}

// Acciones del controlador
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Mostrar la página CrearCuentas
    $cuentas = obtenerCuentas();
    include 'CrearCuentas.php'; // Incluir la vista correspondiente
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Crear un nuevo usuario
    $Nombre = $_POST['Nombre'];
    $PrimerApellido = $_POST['PrimerApellido'];
    $SegundoApellido = $_POST['SegundoApellido'];
    $Telefono = $_POST['Telefono'];
    $roles = $_POST['roles'];
    $Correo = $_POST['Correo'];

    if (crearUsuario($Nombre, $PrimerApellido, $SegundoApellido, $Telefono, $roles, $Correo)) {
        header('Location: usuariosController.php'); // Redireccionar después de crear el usuario
        exit();
    } else {
        // Error al crear usuario, volver a la página con mensaje de error
        header('Location: usuariosController.php'); // Puedes ajustar esta redirección según tu lógica
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Plumber</title>

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles -->
    <link href="css/CrearUsuario.css" rel="stylesheet">
</head>

<body id="page-top">
    <div class="container">
        <?php if (isset($_SESSION['MensajeEmail'])) : ?>
        <p><?php echo $_SESSION['MensajeEmail']; ?></p>
        <?php unset($_SESSION['MensajeEmail']); ?>
        <?php endif; ?>

        <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#NuevaCuenta">
            <i class="fa-solid fa-folder-plus"></i> <span>Crear cuenta</span>
        </a>

        <h2>Cuentas</h2>

        <form class="BotonesPaginacion" action="usuariosController.php" method="post">
            <div class="ElementoCrearUsuairo">
                <label for="rol">Rol:</label>
                <select name="roles">
                    <option value="">Todos</option>
                    <option value="Gerente">Gerente</option>
                    <option value="Tecnico">Tecnico</option>
                </select>
            </div>

            <div class="BotonFlecha">
                <label for="Nombre">Nombre:</label>
                <input type="text" name="Nombre">
            </div>

            <div class="BotonFlecha">
                <label for="ApPaterno">Apellido Paterno:</label>
                <input type="text" name="PrimerApellido">
            </div>

            <div class="BotonFlecha">
                <label for="ApMaterno">Apellido Materno:</label>
                <input type="text" name="SegundoApellido">
            </div>

            <button class="BotonBuscar" type="submit">Buscar</button>
        </form>

        <div class="divTabla">
            <table class="tablaUsuarios">
                <tr class="tituloUsuarios">
                    <th>ID Cuenta</th>
                    <th>CorreoElectronico</th>
                    <th>Contraseña</th>
                    <th>Nombre</th>
                    <th>Primer Apellido</th>
                    <th>Segundo Apellido</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                </tr>
                <?php foreach ($cuentas as $cuenta) : ?>
                <tr class="contenidoUsuarios">
                    <td><?php echo $cuenta['IdUsuario']; ?></td>
                    <td><?php echo $cuenta['CorreoElectronico']; ?></td>
                    <td><?php echo $cuenta['Contrasena']; ?></td>
                    <td><?php echo $cuenta['Nombre']; ?></td>
                    <td><?php echo $cuenta['ApPaterno']; ?></td>
                    <td><?php echo $cuenta['ApMaterno']; ?></td>
                    <td><?php echo $cuenta['NumeTel']; ?></td>
                    <td><?php echo $cuenta['Rol']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <div class="modal fade" id="NuevaCuenta">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <form action="usuariosController.php" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6>Crear Cuenta</h6>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="ElementoCrearUsuairo">
                                <label for="Correo">Correo electrónico:</label>
                                <input type="email" name="Correo" required>
                            </div>

                            <div class="ElementoCrearUsuairo">
                                <label for="Nombre">Nombre(s):</label>
                                <input type="text" name="Nombre" required>
                            </div>

                            <div class="ElementoCrearUsuairo">
                                <label for="PrimerApellido">Apellido Paterno:</label>
                                <input type="text" name="PrimerApellido" required>
                            </div>

                            <div class="ElementoCrearUsuairo">
                                <label for="SegundoApellido">Apellido Materno:</label>
                                <input type="text" name="SegundoApellido" required>
                            </div>

                            <div class="ElementoCrearUsuairo">
                                <label for="Telefono">Número telefónico:</label>
                                <input type="tel" name="Telefono" required maxlength="10">
                            </div>

                            <div class="ElementoCrearUsuairo">
                                <label for="roles">Rol:</label>
                                <select name="roles" required>
                                    <option value="Gerente">Gerente</option>
                                    <option value="Tecnico">Técnico</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning">Crear</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery y Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
