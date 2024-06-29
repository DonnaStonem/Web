<?php
session_start();

// Incluir el archivo de conexión PDO
include 'db_connection.php';

// Verificar si se envían todos los datos necesarios
if (isset($_POST['asenta']) && isset($_POST['Calle']) && isset($_POST['NumExt']) && isset($_POST['NumInt'])) {
    $clienteId = $_SESSION['IdCliente'];  // Asumiendo que el id del cliente está en la sesión
    $tipoServicioNombre = $_SESSION['TipoServicio'];  // Obteniendo el nombre del tipo de servicio de la sesión
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
                // Redirigir a una página de éxito o mostrar un mensaje
                header('Location: SolicitarServicio.php');
                exit();
            } else {
                // Manejar el error de inserción
                echo "Error al procesar la solicitud. Por favor, inténtelo de nuevo.";
            }
        } else {
            // Manejar el error si no se encuentra el CodigoPostalId
            echo "No se encontró el código postal para la asenta seleccionada.";
        }
    } else {
        // Manejar el error si no se encuentra el IdTipoServicio
        echo "No se encontró el tipo de servicio seleccionado.";
    }
} else {
    // Manejar el error si faltan datos en el formulario
    echo "Faltan datos en el formulario. Por favor, complete todos los campos.";
}
?>
