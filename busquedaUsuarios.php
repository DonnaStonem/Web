<?php
session_start();

// Incluir el archivo de conexi�n PDO
include 'db_connection.php';

// Funci�n para realizar una b�squeda personalizada de usuarios
function busquedaUsuarios($roles, $Nombre, $ApPaterno, $ApMaterno) {
    global $pdo;

    // Construir la consulta SQL basada en los par�metros recibidos
    $query = "SELECT * FROM Usuarios WHERE 1";

    $params = [];

    if (!empty($roles)) {
        $query .= " AND Rol = :roles";
        $params[':roles'] = $roles;
    }
    if (!empty($Nombre)) {
        $query .= " AND Nombre = :nombre";
        $params[':nombre'] = $Nombre;
    }
    if (!empty($ApPaterno)) {
        $query .= " AND ApPaterno = :ap_paterno";
        $params[':ap_paterno'] = $ApPaterno;
    }
    if (!empty($ApMaterno)) {
        $query .= " AND ApMaterno = :ap_materno";
        $params[':ap_materno'] = $ApMaterno;
    }

    $query .= " ORDER BY IdUsuario DESC LIMIT 30";

    // Preparar y ejecutar la consulta SQL
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Redireccionar de vuelta a la p�gina principal con los resultados de la b�squeda
    $_SESSION['usuarios'] = $usuarios; // Guardar resultados en sesi�n para mostrar en la p�gina CrearUsuarios.php
    header('Location: CrearUsuarios.php');
    exit();
}

// Procesar la b�squeda si se envi� un formulario POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roles = isset($_POST['roles']) ? $_POST['roles'] : '';
    $Nombre = isset($_POST['Nombre']) ? $_POST['Nombre'] : '';
    $ApPaterno = isset($_POST['PrimerApellido']) ? $_POST['PrimerApellido'] : '';
    $ApMaterno = isset($_POST['SegundoApellido']) ? $_POST['SegundoApellido'] : '';

    // Llamar a la funci�n de b�squeda de usuarios
    busquedaUsuarios($roles, $Nombre, $ApPaterno, $ApMaterno);
} else {
    // Si no se recibi� un formulario POST, redireccionar a la p�gina principal
    header('Location: CrearUsuarios.php');
    exit();
}
?>
