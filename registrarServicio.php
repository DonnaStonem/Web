<?php
session_start();

// Incluir el archivo de conexi�n PDO
include 'db_connection.php';

// Verificar si se recibi� la solicitud de POST desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $solicitudId = $_POST['IdSolicitud'];
    $usuarioId = $_SESSION['IdUsuario']; // Obtener el IdUsuario de la sesi�n
    $fechaIniciada = date('Y-m-d H:i:s'); // Fecha y hora actual
    $horasServicio = 0;  // Ejemplo de n�mero de horas
    $fotos = 'Ruta';  

    // Iniciar una transacci�n
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

        // Confirmar la transacci�n
        $pdo->commit();
        
        // Redireccionar a la p�gina de origen (o donde desees despu�s de tomar el servicio)
        header('Location: servicio.php');
        exit();
    } catch (Exception $e) {
        // Si hay un error, revertir la transacci�n
        $pdo->rollBack();
        // Manejar el error (mostrar un mensaje, registrar el error, etc.)
        echo "Error: " . $e->getMessage();
    }
}
?>
