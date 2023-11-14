<?php

$servidor = "db4free.net";
$usuario = "fahzibernardelli";
$senha = "fabio0010w";
$bd = "petvitrine";

$conn = mysqli_connect($servidor, $usuario, $senha, $bd);

if(!$conn) {
    die("Falha de conexão: " . mysqli_connect_error());
}
?>