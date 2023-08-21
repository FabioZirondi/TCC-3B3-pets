<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../php/HomePage.php");
}
?>