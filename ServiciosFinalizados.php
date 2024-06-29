<?php
session_start();

// Incluir el archivo de conexión PDO
include 'db_connection.php';

// Consulta para obtener todos los servicios junto con los detalles de la solicitud
$query = "SELECT s.IdServicio, s.SolicitudId, s.UsuarioId, s.FechaIniciada, s.FechaFinalizada, s.HorasServicio, s.Fotos, 
                 so.IdSolicitud, so.ClienteId, t.NombreServicio, so.CodigoPostalId, cp.Municipio, cp.Asenta, so.Calle, so.NumExt, so.NumInt, so.EstadoSolicitud, so.FechaSolicitud,
                 c.Nombre, c.ApPaterno, c.ApMaterno, c.NumeTel, c.CorreoElectronico, u.Nombre AS UsuarioNombre
          FROM servicio s
          JOIN Solicitud so ON s.SolicitudId = so.IdSolicitud
          JOIN tiposervicio t ON so.TipoServicioId = t.IdTipoServicio
          JOIN codigopostal cp ON so.CodigoPostalId = cp.IdCodigoPostal
          JOIN clientes c ON so.ClienteId = c.IdCliente
          JOIN usuarios u ON s.UsuarioId = u.IdUsuario
           WHERE s.HorasServicio > 0";
$stmt = $pdo->prepare($query);
$stmt->execute();
$servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <title>Servicios finalizados</title>

    <style>
        /* Estilos para el modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>



</head>
<body>
    <nav>
        <ul class="nav">
            <li class="nav-left"><a href="index.php"><img src="assets/plumber.png" alt="plumber">Plumber</a></li>
            <li><a href="serviciosAtentidos.php">Servicios en atención</a></li>
            <li><a href="serviciosFinalizados.php">Servicios finalizados</a></li>
             <li><a href="SolicitudesServicio.php">Solicitudes de servicio</a></li>
             <li><a href="index.html">Principal</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>
    <h1>Servicios finalizados</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Id Servicio</th>
                <th>Id Solicitud</th>
                <th>Usuario</th>
                <th>Fecha Iniciada</th>
                <th>Fecha Finalizada</th>
                <th>Horas de Servicio</th>
                <th>Nombre del Cliente</th>
                <th>Ap. Paterno</th>
                <th>Ap. Materno</th>
                <th>Teléfono</th>
                <th>Correo Electrónico</th>
                <th>Tipo de Servicio</th>
                <th>Municipio</th>
                <th>Asenta</th>
                <th>Calle</th>
                <th>Número Exterior</th>
                <th>Número Interior</th>
                <th>Fecha de Solicitud</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($servicios as $servicio): ?>
                <tr>
                    <td><?php echo htmlspecialchars($servicio['IdServicio']); ?></td>
                    <td><?php echo htmlspecialchars($servicio['SolicitudId']); ?></td>
                    <td><?php echo htmlspecialchars($servicio['UsuarioNombre']); ?></td>
                    <td><?php echo htmlspecialchars($servicio['FechaIniciada']); ?></td>
                    <td><?php echo htmlspecialchars($servicio['FechaFinalizada']); ?></td>
                    <td><?php echo htmlspecialchars($servicio['HorasServicio']); ?></td>
                    <td><?php echo htmlspecialchars($servicio['Nombre']); ?></td>
                    <td><?php echo htmlspecialchars($servicio['ApPaterno']); ?></td>
                    <td><?php echo htmlspecialchars($servicio['ApMaterno']); ?></td>
                    <td><?php echo htmlspecialchars($servicio['NumeTel']); ?></td>
                    <td><?php echo htmlspecialchars($servicio['CorreoElectronico']); ?></td>
                    <td><?php echo htmlspecialchars($servicio['NombreServicio']); ?></td>
                    <td><?php echo htmlspecialchars($servicio['Municipio']); ?></td>
                    <td><?php echo htmlspecialchars($servicio['Asenta']); ?></td>
                    <td><?php echo htmlspecialchars($servicio['Calle']); ?></td>
                    <td><?php echo htmlspecialchars($servicio['NumExt']); ?></td>
                    <td><?php echo htmlspecialchars($servicio['NumInt']); ?></td>
                    <td><?php echo htmlspecialchars($servicio['FechaSolicitud']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal para finalizar servicio -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Finalizar Servicio</h2>
            <form id="finalizarForm" action="finalizar_servicio.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="IdServicio" id="modalIdServicio">
                <label for="file">Subir Foto:</label>
                <input type="file" id="file" name="file" required><br>
                <input type="submit" value="Finalizar">
            </form>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // Function to open the modal
        function openModal(idServicio) {
            document.getElementById("modalIdServicio").value = idServicio;
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>



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
