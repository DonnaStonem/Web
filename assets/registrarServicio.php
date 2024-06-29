<?php
session_start();

// Incluir el archivo de conexión PDO
include 'db_connection.php';

// Verificar si se recibió la solicitud de POST desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $solicitudId = $_POST['IdSolicitud'];
    $usuarioId = $_SESSION['IdUsuario']; // Obtener el IdUsuario de la sesión
    $fechaIniciada = date('Y-m-d H:i:s'); // Fecha y hora actual
    $horasServicio = 0;  // Ejemplo de número de horas
    $fotos = 'Ruta';  

    // Iniciar una transacción
    $pdo->beginTransaction();

    try {
        // Insertar datos en la tabla servicio
        $query = "INSERT INTO servicio (SolicitudId, UsuarioId, FechaIniciada, FechaFinalizada, HorasServicio, Fotos) 
                  VALUES (:solicitudId, :usuarioId, :fechaIniciada, :fechaFinalizada, :horasServicio, :fotos)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':solicitudId' => $solicitudId,
            ':usuarioId' => $usuarioId,
            ':fechaIniciada' => $fechaIniciada,
            ':fechaFinalizada' => $fechaIniciada,
            ':horasServicio' => $horasServicio,
            ':fotos' => $fotos
        ]);

        // Actualizar el estado de la solicitud a "En proceso"
        $updateQuery = "UPDATE Solicitud SET EstadoSolicitud = 'En proceso' WHERE IdSolicitud = :solicitudId";
        $updateStmt = $pdo->prepare($updateQuery);
        $updateStmt->execute([':solicitudId' => $solicitudId]);

        // Confirmar la transacción
        $pdo->commit();
        
        // Redireccionar a la página de origen (o donde desees después de tomar el servicio)
        header('Location: servicio.php');
        exit();
    } catch (Exception $e) {
        // Si hay un error, revertir la transacción
        $pdo->rollBack();
        // Manejar el error (mostrar un mensaje, registrar el error, etc.)
        echo "Error: " . $e->getMessage();
    }
}
?>
