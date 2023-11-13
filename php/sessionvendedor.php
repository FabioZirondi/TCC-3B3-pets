<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php"); 
    exit(); 
}

if ($_SESSION['usuario'] == 'u') {
    header("Location: ../php/catalogo.php"); 
    exit(); 
}
?>
