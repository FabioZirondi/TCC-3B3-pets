<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../php/pagina_de_login.php"); 
    exit(); 
}

if ($_SESSION['usuario'] == 'u') {
    header("Location: ../php/catalogo.php"); 
    exit(); 
}



?>
