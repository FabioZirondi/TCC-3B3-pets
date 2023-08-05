<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$bd = "pets";

$conn = mysqli_connect($servidor, $usuario, $senha, $bd);

if(!$conn) {
    die("Falha de conexão: " . mysqli_connect_error());
}
?>