<?php

$nome = $_GET['nome'];
$raca = $_GET['raca'];
$anonascimento = $_GET['anonascimento'];
$peso = $_GET['peso'];
$cor = $_GET['cor'];

include_once("conexao.php");

$stmt = "insert into tbanimais values (null, $nome', '$raca', $anonascimento, $peso, '$cor');";

if (mysqli_query($conn, $stmt)) {

    header('Location: telaexibir.php');

} else {

    echo "Erro ao cadastrar animal.<br>" . mysqli_error($conn);
    echo "<br><a href='telacadastro.php'>Voltar</a>";
}

mysqli_close($conn);
?>