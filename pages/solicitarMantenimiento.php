<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../css/style.css">
    <link rel="stylesheet" href="./../css/normalize.css">
    <title>Document</title>
</head>

<body>
    <?php
    include ("./../elementos_base/header.php");
    imprimir_header_no_index();
    ?>
    <h1>Solicitar servicio</h1>
    <h2>Mantenimiento preventivo y lavado de tinacos</h2>

    <section>
        <div class="info-service">
            <p>En Plumber, ofrecemos un servicio completo de mantenimiento preventivo y lavado de tinacos para asegurar
                la calidad y pureza de su agua. Nuestro equipo profesional utiliza productos y técnicas de limpieza de
                alta
                eficiencia, garantizando la eliminación de sedimentos y bacterias. Mantenga su tinaco en óptimas
                condiciones
                y prolongue su vida útil con nuestro servicio confiable y seguro.</p>
            <p>Utilizamos estos materiales:</p>
            <ul>
                <li>1 Filtro de tinaco</li>
                <li>1 Litro de solución sanitizante antibacterial</li>
                <li>1 Cepillo con extensor</li>
            </ul>
        </div>

        <div class="formularioServicio">
            <form action="#" method="post">
                <label for="servicio">Servicio</label>
                <select name="servicio" id="servicio" required>
                    <option value="mantenimiento">Mantenimiento preventivo</option>
                    <option value="lavado">Lavado de tinaco</option>
                    <option value="reparacion">Reparación de fuga a fuga</option>
                    <option value="instalacion">Instalación de calentador de agua</option>
                </select>

                <label for="nombre">Nombre Completo</label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
                <label for="calleForm">Calle</label>
                <input type="text" id="calle" name="calle" placeholder="Calle y no. exterior" required>

                <label for="ciudadForm">Ciudad</label>
                <input type="text" id="ciudad" name="ciudad" placeholder="Ciudad" required>

                <label for="codigoPostal">Código Postal</label>
                <input type="number" id="codigoPostal" name="codigoPostal" placeholder="Codigo postal" required><br>

                <input class="subForm" type="submit" value="Enviar">

            </form>
        </div>
    </section>
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