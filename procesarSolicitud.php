<?php
session_start();

// Incluir el archivo de conexi�n PDO
include 'db_connection.php';

// Verificar si se env�an todos los datos necesarios
if (isset($_POST['asenta']) && isset($_POST['Calle']) && isset($_POST['NumExt']) && isset($_POST['NumInt'])) {
    $clienteId = $_SESSION['IdCliente'];  // Asumiendo que el id del cliente est� en la sesi�n
    $tipoServicioNombre = $_SESSION['TipoServicio'];  // Obteniendo el nombre del tipo de servicio de la sesi�n
    $asenta = $_POST['asenta'];
    $calle = $_POST['Calle'];
    $numExt = $_POST['NumExt'];
    $numInt = $_POST['NumInt'];

    // Obtener el IdTipoServicio basado en el NombreServicio
    $queryTipoServicio = "SELECT IdTipoServicio FROM tiposervicio WHERE NombreServicio = :nombreServicio LIMIT 1";
    $stmtTipoServicio = $pdo->prepare($queryTipoServicio);
    $stmtTipoServicio->bindParam(':nombreServicio', $tipoServicioNombre, PDO::PARAM_STR);
    $stmtTipoServicio->execute();
    $tipoServicio = $stmtTipoServicio->fetch(PDO::FETCH_ASSOC);

    if ($tipoServicio) {
        $tipoServicioId = $tipoServicio['IdTipoServicio'];

        // Obtener el CodigoPostalId basado en la Asenta seleccionada
        $query = "SELECT IdCodigoPostal FROM codigopostal WHERE Asenta = :asenta LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':asenta', $asenta, PDO::PARAM_STR);
        $stmt->execute();
        $codigoPostal = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($codigoPostal) {
            $codigoPostalId = $codigoPostal['IdCodigoPostal'];

            // Insertar los datos en la tabla Solicitud
            $queryInsert = "INSERT INTO Solicitud (ClienteId, TipoServicioId, CodigoPostalId, Calle, NumExt, NumInt, EstadoSolicitud, FechaSolicitud) 
                            VALUES (:clienteId, :tipoServicioId, :codigoPostalId, :calle, :numExt, :numInt, 'Solicitado', NOW())";
            $stmtInsert = $pdo->prepare($queryInsert);
            $stmtInsert->bindParam(':clienteId', $clienteId, PDO::PARAM_INT);
            $stmtInsert->bindParam(':tipoServicioId', $tipoServicioId, PDO::PARAM_INT);
            $stmtInsert->bindParam(':codigoPostalId', $codigoPostalId, PDO::PARAM_INT);
            $stmtInsert->bindParam(':calle', $calle, PDO::PARAM_STR);
            $stmtInsert->bindParam(':numExt', $numExt, PDO::PARAM_STR);
            $stmtInsert->bindParam(':numInt', $numInt, PDO::PARAM_STR);

            if ($stmtInsert->execute()) {
                // Redirigir a una p�gina de �xito o mostrar un mensaje
                header('Location: SolicitarServicio.php');
                exit();
            } else {
                // Manejar el error de inserci�n
                echo "Error al procesar la solicitud. Por favor, int�ntelo de nuevo.";
            }
        } else {
            // Manejar el error si no se encuentra el CodigoPostalId
            echo "No se encontr� el c�digo postal para la asenta seleccionada.";
        }
    } else {
        // Manejar el error si no se encuentra el IdTipoServicio
        echo "No se encontr� el tipo de servicio seleccionado.";
    }
} else {
    // Manejar el error si faltan datos en el formulario
    echo "Faltan datos en el formulario. Por favor, complete todos los campos.";
}
?>
