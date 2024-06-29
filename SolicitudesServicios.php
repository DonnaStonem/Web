<?php
session_start();

// Incluir el archivo de conexión PDO
include 'db_connection.php';

// Obtener el IdCliente de la sesión
$clienteId = $_SESSION['IdCliente'];

// Consulta para obtener las solicitudes del cliente que tiene la sesión iniciada junto con la información adicional
$query = "SELECT s.IdSolicitud, s.ClienteId, t.NombreServicio, s.CodigoPostalId, cp.Municipio, cp.Asenta, s.Calle, s.NumExt, s.NumInt, s.EstadoSolicitud, s.FechaSolicitud,
                 c.Nombre, c.ApPaterno, c.ApMaterno, c.NumeTel, c.CorreoElectronico 
          FROM Solicitud s
          JOIN tiposervicio t ON s.TipoServicioId = t.IdTipoServicio
          JOIN codigopostal cp ON s.CodigoPostalId = cp.IdCodigoPostal
          JOIN clientes c ON s.ClienteId = c.IdCliente
          WHERE S.EstadoSolicitud = 'Solicitado'";
$stmt = $pdo->prepare($query);
//$stmt->bindParam(':clienteId', $clienteId, PDO::PARAM_INT);
$stmt->execute();
$solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <title>Listado de Solicitudes</title>
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
    <h1>Listado de Solicitudes</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Id Solicitud</th>
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
                <th>Estado</th>
                <th>Fecha de Solicitud</th>
                <th>Asignarme a mi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($solicitudes as $solicitud): ?>
                <tr>
                    <td><?php echo htmlspecialchars($solicitud['IdSolicitud']); ?></td>
                    <td><?php echo htmlspecialchars($solicitud['Nombre']); ?></td>
                    <td><?php echo htmlspecialchars($solicitud['ApPaterno']); ?></td>
                    <td><?php echo htmlspecialchars($solicitud['ApMaterno']); ?></td>
                    <td><?php echo htmlspecialchars($solicitud['NumeTel']); ?></td>
                    <td><?php echo htmlspecialchars($solicitud['CorreoElectronico']); ?></td>
                    <td><?php echo htmlspecialchars($solicitud['NombreServicio']); ?></td>
                    <td><?php echo htmlspecialchars($solicitud['Municipio']); ?></td>
                    <td><?php echo htmlspecialchars($solicitud['Asenta']); ?></td>
                    <td><?php echo htmlspecialchars($solicitud['Calle']); ?></td>
                    <td><?php echo htmlspecialchars($solicitud['NumExt']); ?></td>
                    <td><?php echo htmlspecialchars($solicitud['NumInt']); ?></td>
                    <td><?php echo htmlspecialchars($solicitud['EstadoSolicitud']); ?></td>
                    <td><?php echo htmlspecialchars($solicitud['FechaSolicitud']); ?></td>
                    <td>
                       <form action="registrarServicio.php" method="post">
                            <input type="hidden" name="IdSolicitud" value="<?php echo $solicitud['IdSolicitud']; ?>">
                            <button type="submit">Tomar</button>
                        </form>                         
                    
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Pago de Solicitud</h2>
            <form id="paymentForm" action="procesarPago.php" method="post">
                <input type="hidden" name="IdSolicitud" id="modalIdSolicitud">
                <label for="Tarjeta">Tarjeta:</label>
                <input type="text" id="Tarjeta" name="Tarjeta" required><br>
                <label for="FechaVencimiento">Fecha de Vencimiento:</label>
                <input type="text" id="FechaVencimiento" name="FechaVencimiento" required><br>
                <label for="Referencia">Referencia:</label>
                <input type="text" id="Referencia" name="Referencia" required><br>
                <label for="Monto">Monto:</label>
                <input type="text" id="Monto" name="Monto" required><br>
                <input type="submit" value="Pagar">
            </form>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // Function to open the modal
        function openModal(idSolicitud) {
            document.getElementById("modalIdSolicitud").value = idSolicitud;
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
