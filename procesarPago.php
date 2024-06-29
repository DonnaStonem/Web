<?php
session_start();

// Incluir el archivo de conexión PDO
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $solicitudId = $_POST['IdSolicitud'];
    $tarjeta = $_POST['Tarjeta'];
    $fechaVencimiento = $_POST['FechaVencimiento'];
    $referencia = $_POST['Referencia'];
    $monto = $_POST['Monto'];
    $fechaPago = date('Y-m-d H:i:s'); // Fecha y hora actual

    try {
        // Iniciar una transacción
        $pdo->beginTransaction();

        // Obtener el IdServicio relacionado con la IdSolicitud
        $queryServicio = "SELECT IdServicio FROM servicio WHERE SolicitudId = :solicitudId";
        $stmtServicio = $pdo->prepare($queryServicio);
        $stmtServicio->bindParam(':solicitudId', $solicitudId, PDO::PARAM_INT);
        $stmtServicio->execute();
        $servicio = $stmtServicio->fetch(PDO::FETCH_ASSOC);

        if ($servicio) {
            $servicioId = $servicio['IdServicio'];

            // Insertar datos en la tabla pago
            $queryPago = "INSERT INTO pago (ServicioId, Tarjeta, FechaVencimiento, Referencia, Monto, FechaPago) 
                          VALUES (:servicioId, :tarjeta, :fechaVencimiento, :referencia, :monto, :fechaPago)";
            $stmtPago = $pdo->prepare($queryPago);
            $stmtPago->execute([
                ':servicioId' => $servicioId,
                ':tarjeta' => $tarjeta,
                ':fechaVencimiento' => $fechaVencimiento,
                ':referencia' => $referencia,
                ':monto' => $monto,
                ':fechaPago' => $fechaPago
            ]);

            // Actualizar el EstadoSolicitud en la tabla Solicitud a "Pagado"
            $queryActualizarSolicitud = "UPDATE Solicitud SET EstadoSolicitud = 'Pagado' WHERE IdSolicitud = :solicitudId";
            $stmtActualizarSolicitud = $pdo->prepare($queryActualizarSolicitud);
            $stmtActualizarSolicitud->bindParam(':solicitudId', $solicitudId, PDO::PARAM_INT);
            $stmtActualizarSolicitud->execute();

            // Confirmar la transacción
            $pdo->commit();

            // Redireccionar a una página de éxito (o donde desees después del pago)
            header('Location: ServiciosSolicitados.php');
            exit();
        } else {
            throw new Exception("No se encontró el servicio relacionado con la solicitud.");
        }
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
}
?>
