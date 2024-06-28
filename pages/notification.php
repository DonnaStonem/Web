<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../css/style.css">
    <link rel="stylesheet" href="./../css/normalize.css">

</head>

<body>
    <?php
    include ("./../elementos_base/header.php");
    imprimir_header_no_index();
    ?>

    <main>

    </main>
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