<?php

$nome = $_POST['nome'];
$email = $_POST['email'];
$usersenha = $_POST['senha'];

include_once("../php/conexao.php");

$nome = mysqli_real_escape_string($conn, $nome);
$email = mysqli_real_escape_string($conn, $email);
$senha = mysqli_real_escape_string($conn, $senha);

if (!empty($usersenha)) {
    $senha_hash = password_hash($usersenha, PASSWORD_DEFAULT);
    $stmt = "INSERT INTO usuario (nome, email, senha) VALUES ('$nome', '$email', '$senha_hash');";
} else {
    echo "Erro: A senha não pode estar vazia.";
    exit;
}

if (mysqli_query($conn, $stmt)) {
    header('Location: ../php/catalogo.php');
} else {
    echo "Erro ao cadastrar-se <br>" . mysqli_error($conn);
    echo "<br><a href='../php/homepage.php'>Voltar</a>";
}

mysqli_close($conn);
?>

