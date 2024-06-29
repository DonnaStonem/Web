<?php
session_start();

// Incluir el archivo de conexi�n PDO
include 'db_connection.php';

// Verificar si se envi� el c�digo postal desde el formulario anterior
if (isset($_POST['codigoPostal'])) {
    $codigoPostal = $_POST['codigoPostal'];

    // Preparar la consulta para obtener el municipio y las asentas
    $query = "SELECT Municipio, Asenta FROM codigopostal WHERE Codigo = :codigoPostal";

    // Preparar la sentencia
    $stmt = $pdo->prepare($query);

    // Bind de par�metros
    $stmt->bindParam(':codigoPostal', $codigoPostal, PDO::PARAM_INT);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener resultados
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontraron resultados
    if ($result) {
        $municipio = $result['Municipio'];
        $asentas = []; // Aqu� se guardar�n todas las asentas encontradas

        // Obtener todas las asentas relacionadas al c�digo postal
        $queryAsentas = "SELECT DISTINCT Asenta FROM codigopostal WHERE Codigo = :codigoPostal";
        $stmtAsentas = $pdo->prepare($queryAsentas);
        $stmtAsentas->bindParam(':codigoPostal', $codigoPostal, PDO::PARAM_INT);
        $stmtAsentas->execute();

        // Recorrer los resultados y almacenar en el array $asentas
        while ($row = $stmtAsentas->fetch(PDO::FETCH_ASSOC)) {
            $asentas[] = $row['Asenta'];
        }

        // Guardar resultados en la sesi�n
        $_SESSION['municipio'] = $municipio;
        $_SESSION['asentas'] = $asentas;
    } else {
        // No se encontr� ning�n resultado para el c�digo postal
        // Manejar el error o mensaje correspondiente
        $_SESSION['municipio'] = null;
        $_SESSION['asentas'] = [];
    }
}

// Redirigir de nuevo a Solicitar servicio.php
header('Location: SolicitarServicio.php');
exit();
?>
