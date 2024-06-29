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
          JOIN usuarios u ON s.UsuarioId = u.IdUsuario";
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
    <title>Listado de Servicios</title>
</head>
<body>
    <nav>
        <ul class="nav">
            <li class="nav-left"><a href="index.php"><img src="assets/plumber.png" alt="plumber">Plumber</a></li>
            <li><a href="CrearUsuarios.php">Usuarios</a></li>
            <li><a href="Almacen.php">Almacen</a></li>
            <li><a href="index.html">Principal</a></li>
            <li><a href="ServiciosTotales.php">Servicios totales</a></li>
        </ul>
    </nav>
    <h1>Listado de Servicios</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Id Servicio</th>
                <th>Id Solicitud</th>
                <th>Usuario</th>
                <th>Fecha Iniciada</th>
                <th>Fecha Finalizada</th>
                <th>Horas de Servicio</th>
                <th>Fotos</th>
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
                    <td><?php echo htmlspecialchars($servicio['Fotos']); ?></td>
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
                    <td><?php echo htmlspecialchars($servicio['EstadoSolicitud']); ?></td>
                    <td><?php echo htmlspecialchars($servicio['FechaSolicitud']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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
