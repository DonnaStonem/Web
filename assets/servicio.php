<?php
session_start();
require 'db_connection.php'; // El archivo con la cadena de conexión

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['TipoServicio'])) {
        $tipoServicio = $_GET['TipoServicio'];
        $idCliente = $_SESSION['IdCliente'] ?? null;
        $nombreCliente = $_SESSION['NombreCliente'] ?? null;

        if ($idCliente !== null) {
            $_SESSION['TipoServicio'] = $tipoServicio;
            //header('Location: solicitarservicio.php?TipoServicio=$tipoServicio');
            header('Location: solicitarservicio.php?view=solicitar');
            exit();
        } else {
            header('Location: login.php');
            exit();
        }
    }
}

$view = $_GET['view'] ?? 'list';
$tipoServicio = $_SESSION['TipoServicio'] ?? null;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <title>Servicios</title>
</head>
<body>
    <nav>
        <ul class="nav">
            <li class="nav-left"><a href="index.php"><img src="assets/plumber.png" alt="plumber">Plumber</a></li>
            <li><a href="servicios.php">Services</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>

    <!-- Mostrar el idCliente en el HTML -->
    <div class="debug">
        <pre><?php echo isset($_SESSION['IdCliente']) ? $_SESSION['IdCliente'] : 'No ID available'; ?></pre>
    </div>

    <?php if ($view == 'list'): ?>
    <h1>Services</h1>
    <section>
        <div class="cards">
            <figure>
                <img src="assets/waterTank.jpg" alt="tinaco">
                <div class="serviceInfo">
                    <a href="servicio.php?TipoServicio=Mantenimiento">
                        <h2>Mantenimiento preventivo y lavado de tinacos</h2>
                        <p>
                            En Plumber, ofrecemos un servicio completo de mantenimiento preventivo y lavado de tinacos
                            para asegurar la calidad y pureza de su agua. Nuestro equipo profesional utiliza productos y
                            técnicas de limpieza de alta eficiencia, garantizando la eliminación de sedimentos y
                            bacterias. Mantenga su tinaco en óptimas condiciones y prolongue su vida útil con nuestro
                            servicio confiable y seguro.
                        </p>
                        <ul>
                            <li>1 Filtro de tinaco</li>
                            <li>1 Litro de solución sanitizante antibacterial</li>
                            <li>1 Cepillo con extensor</li>
                        </ul>
                    </a>
                </div>
            </figure>

            <figure>
                <img src="assets/fugaDeAgua.jpg" alt="fugaDeAgua">
                <div class="serviceInfo">
                    <a href="servicio.php?TipoServicio=Fuga">
                        <h2>Reparación de fuga de agua</h2>
                        <p>
                            En Plumber, nos especializamos en la reparación de fugas de agua, asegurando una solución
                            rápida y efectiva. Nuestro equipo experto localiza y repara fugas en tuberías y sistemas
                            hidráulicos, minimizando el daño y el desperdicio de agua. Confíe en nosotros para un
                            servicio profesional y duradero que protegerá su propiedad y reducirá sus costos.
                        </p>
                        <ul>
                            <li>3 metros de tubo de cobre de 1/2 pulgada</li>
                            <li>5 codos de 1/2 pulgada</li>
                            <li>2 metros de soldadura</li>
                            <li>1 tubo de gas butano de 1/2 litro</li>
                        </ul>
                    </a>
                </div>
            </figure>

            <figure>
                <img src="assets/calentadorDeAgua.jpg" alt="calentadorDeAgua">
                <div class="serviceInfo">
                    <a href="servicio.php?TipoServicio=Instalacion">
                        <h2>Instalación de calentador de agua</h2>
                        <p>
                            En Plumber, ofrecemos servicios profesionales de instalación de calentadores de agua para su
                            hogar o negocio. Nuestros técnicos certificados garantizan una instalación segura y
                            eficiente, asegurando un rendimiento óptimo y prolongando la vida útil de su equipo.
                            Disfrute de agua caliente sin preocupaciones con nuestra atención experta y personalizada.
                        </p>
                        <ul>
                            <li>1 kit de mangueras de agua caliente, fría y gas</li>
                            <li>1 rollo de cinta teflón</li>
                            <li>2 válvulas de presión inversa de 1/2 pulgada</li>
                        </ul>
                    </a>
                </div>
            </figure>
        </div>
    </section>
    <?php elseif ($view == 'solicitar' && $tipoServicio !== null): ?>
    <h1>Solicitar Servicio: <?php echo htmlspecialchars($tipoServicio); ?></h1>
    <section>
        <div class="formularioSolicitud">
            <form action="process_solicitud.php" method="post">
                <input type="hidden" name="tipoServicio" value="<?php echo htmlspecialchars($tipoServicio); ?>">
                <!-- Campos adicionales para la solicitud del servicio -->
                <input type="submit" value="Solicitar">
            </form>
        </div>
    </section>
    <?php endif; ?>

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
