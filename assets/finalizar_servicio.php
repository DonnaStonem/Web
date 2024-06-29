<?php
session_start();

// Incluir el archivo de conexión PDO
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $idServicio = $_POST['IdServicio'];
    $foto = $_FILES['file'];

    // Validar y procesar la imagen
    $targetDir = "uploads/"; // Directorio donde se guardarán las imágenes
    $targetFile = $targetDir . basename($foto["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Verificar si el archivo es una imagen real
    $check = getimagesize($foto["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "El archivo no es una imagen.";
        $uploadOk = 0;
    }

    // Verificar si el archivo ya existe
    if (file_exists($targetFile)) {
        echo "Lo siento, el archivo ya existe.";
        $uploadOk = 0;
    }

    // Limitar el tamaño del archivo (ejemplo: 5MB máximo)
    if ($foto["size"] > 5000000) {
        echo "Lo siento, tu archivo es demasiado grande.";
        $uploadOk = 0;
    }

    // Permitir solo ciertos formatos de archivo
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
        $uploadOk = 0;
    }

    // Verificar si $uploadOk es 0 por algún error
    if ($uploadOk == 0) {
        echo "Lo siento, tu archivo no fue subido.";
    // Si todo está bien, intentar subir el archivo
    } else {
        if (move_uploaded_file($foto["tmp_name"], $targetFile)) {
            // Obtener la fecha y hora actual
            $fechaFinalizada = date('Y-m-d H:i:s');

            // Obtener la fecha de inicio para calcular las horas de servicio
            $query = "SELECT FechaIniciada FROM servicio WHERE IdServicio = :idServicio";
            $stmt = $pdo->prepare($query);
            $stmt->execute([':idServicio' => $idServicio]);
            $servicio = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($servicio) {
                $fechaIniciada = $servicio['FechaIniciada'];
                $datetime1 = new DateTime($fechaIniciada);
                $datetime2 = new DateTime($fechaFinalizada);
                $interval = $datetime1->diff($datetime2);
                $horasServicio = $interval->h + ($interval->days * 24);

                // Actualizar la base de datos con la ruta de la imagen, fecha finalizada y horas de servicio
                $query = "UPDATE servicio 
                          SET Fotos = :foto, FechaFinalizada = :fechaFinalizada, HorasServicio = :horasServicio 
                          WHERE IdServicio = :idServicio";
                $stmt = $pdo->prepare($query);
                $stmt->execute([
                    ':foto' => $targetFile, 
                    ':fechaFinalizada' => $fechaFinalizada, 
                    ':horasServicio' => $horasServicio, 
                    ':idServicio' => $idServicio
                ]);

                // Actualizar el estado de la solicitud a "Finalizado"
                $query = "UPDATE Solicitud s
                          JOIN servicio sv ON s.IdSolicitud = sv.SolicitudId
                          SET s.EstadoSolicitud = 'Finalizado'
                          WHERE sv.IdServicio = :idServicio";
                $stmt = $pdo->prepare($query);
                $stmt->execute([':idServicio' => $idServicio]);

                echo "El archivo ". htmlspecialchars(basename($foto["name"])). " ha sido subido.";
                // Redireccionar a la página de servicios
                header('Location: serviciosFinalizados.php');
                exit();
            } else {
                echo "No se encontró el servicio con el ID especificado.";
            }
        } else {
            echo "Lo siento, hubo un error al subir tu archivo.";
        }
    }
}
?>
