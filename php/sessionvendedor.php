<?php

session_start();
if (!isset($_SESSION['usuario'])) {
    if ($session['usuario'] == 'u') {
        header("Location: ../php/catalogo.php");
    } elseif ($session['usuario'] == '') {
        session_destroy();
    }
}



?>