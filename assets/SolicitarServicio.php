<?php
session_start();

// Verificar si hay un tipo de servicio seleccionado
if (!isset($_SESSION['TipoServicio'])) {
    header('Location: login.php'); // Redirigir si no hay tipo de servicio en sesión
    exit();
}

$tipoServicio = $_SESSION['TipoServicio'];

// Verificar si hay resultados de búsqueda en la sesión
$municipio = isset($_SESSION['municipio']) ? $_SESSION['municipio'] : null;
$asentas = isset($_SESSION['asentas']) ? $_SESSION['asentas'] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <title>Solicitar servicio</title>
</head>
<body>
    <nav>
        <ul class="nav">
            <li class="nav-left"><a href="index.php"><img src="assets/plumber.png" alt="plumber">Plumber</a></li>
            <li><a href="servicios.php">Services</a></li>
            <li><a href="ServiciosSolicitados.php">Servicios solicitados</a></li>
        </ul>
    </nav>
    <h1>Solicitar servicio</h1>

    <?php if ($tipoServicio == "Fuga"): ?>
    <h2>Fuga de agua</h2>
    <section class="SolicitarFuga">
        <div class="info-service">
            <div class="inf">
                <p>
                    En Plumber, nos especializamos en la reparación de fugas de agua, asegurando una solución rápida y
                    efectiva. Nuestro equipo experto localiza y repara fugas en tuberías y sistemas hidráulicos, minimizando el daño y
                    el desperdicio de agua. Confíe en nosotros para un servicio profesional y duradero que protegerá su
                    propiedad y reducirá sus costos.
                </p>
                <ul>
                    <li>3 metros de tubo de cobre de 1/2 pulgada</li>
                    <li>5 codos de 1/2 pulgada</li>
                    <li>2 metros de soldadura</li>
                    <li>1 tubo de gas butano de 1/2 litro</li>
                </ul>
            </div>
        </div>
    </section>
    <?php elseif ($tipoServicio == "Mantenimiento"): ?>
    <h2>Mantenimiento preventivo y lavado de tinacos</h2>
    <section class="SolicitarMantenimiento">
        <div class="info-service">
            <p>
                En Plumber, ofrecemos un servicio completo de mantenimiento preventivo y lavado de tinacos para asegurar
                la calidad y pureza de su agua. Nuestro equipo profesional utiliza productos y técnicas de limpieza de alta
                eficiencia, garantizando la eliminación de sedimentos y bacterias. Mantenga su tinaco en óptimas
                condiciones y prolongue su vida útil con nuestro servicio confiable y seguro.
            </p>
            <p>Utilizamos estos materiales:</p>
            <ul>
                <li>1 Filtro de tinaco</li>
                <li>1 Litro de solución sanitizante antibacterial</li>
                <li>1 Cepillo con extensor</li>
            </ul>
        </div>
    </section>
    <?php elseif ($tipoServicio == "Instalacion"): ?>
    <h2>Instalación de calentador de agua</h2>
    <section class="SolicitarInstalacion">
        <div class="info-service">
            <p>
                En Plumber, ofrecemos servicios profesionales de instalación de calentadores de agua para su hogar o negocio.
                Nuestros técnicos certificados garantizan una instalación segura y eficiente, asegurando un rendimiento
                óptimo y prolongando la vida útil de su equipo. Disfrute de agua caliente sin preocupaciones con nuestra
                atención experta y personalizada.
            </p>
            <ul>
                <li>1 Kit de mangueras de agua caliente, fría y gas</li>
                <li>1 Rollo de cinta teflón</li>
                <li>2 Válvulas de presión inversa de 1/2 pulgada</li>
            </ul>
        </div>
    </section>
    <?php endif; ?>

    <div class="formularioServicio">
        <form action="process_Busqueda.php" method="post">
            <label for="codigoPostal">Código Postal</label>
            <input type="number" id="codigoPostal" name="codigoPostal" placeholder="Código postal" required><br>
            <input class="subForm" type="submit" value="Buscar">
        </form>

       <?php if ($municipio && $asentas): ?>
            <form action="procesarSolicitud.php" method="post">
                <label for="municipio">Municipio: <?php echo htmlspecialchars($municipio); ?></label>
                <label for="asenta">Asenta:</label>
                <br>
                <select name="asenta" id="asenta" required>
                    <?php foreach ($asentas as $asenta): ?>
                        <option value="<?php echo htmlspecialchars($asenta); ?>"><?php echo htmlspecialchars($asenta); ?></option>
                    <?php endforeach; ?>
                </select>
                <br>
                <label for="Calle">Calle</label>
                <input type="text" id="Calle" name="Calle" placeholder="Calle" required><br>

                <label for="NumExt">Número exterior</label>
                <input type="text" id="NumExt" name="NumExt" placeholder="Número exterior" required><br>
    
                <label for="NumInt">Número interior</label>
                <input type="text" id="NumInt" name="NumInt" placeholder="Número interior" required><br>

                <input type="submit" value="Solicitar">
            </form>
        <?php endif; ?>

    </div>

    <br><br><br><br><br><br><br><br><br>
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
