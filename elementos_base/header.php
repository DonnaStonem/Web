<?php

function imprimir_header_no_index()
{
    $header = "
    <header>
        <a href=\"./../index.php\" class=\"logo\">
            <img src=\"./../assets/plumber.png\" alt=\"logo\">
            <h2 class=\"logo-nombre\">Plumber</h2>
        </a>

        <nav>
            <a href=\"./../index.php\">Plumber</a>
            <a href=\"./notification.php\">Notification</a>
            <a href=\"./servicio.php\">Services</a>
            <a href=\"./user.php\">User</a>
            <a href=\"./register.php\">Register</a>
            <a href=\"./login.php\">Login</a>

        </nav>
    </header>
    ";
    echo $header;
}
?>