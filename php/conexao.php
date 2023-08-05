<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$bd = "bdanimais";

$conn = mysqli_connect($servidor, $usuario, $senha, $bd);

if(!$conn) {
    die("Falha de conexão: " . mysqli_connect_error());
}
?>