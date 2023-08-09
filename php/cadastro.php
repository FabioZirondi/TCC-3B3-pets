<?php
// importa as variáveis do html
$nome = $_POST['nome'];
$email = $_POST['email'];
$usersenha = $_POST['senha'];

// faz conexão com banco de dados
include_once("../php/conexao.php");

$nome = mysqli_real_escape_string($conn, $nome);
$email = mysqli_real_escape_string($conn, $email);
$senha = mysqli_real_escape_string($conn, $senha);

// Verifica se algum campo está vazio
if (empty($nome) || empty($email) || empty($usersenha)) {
    echo "Erro: Todos os campos devem estar preenchidos.";
    exit;
}

// Verifica se o e-mail já está em uso
$email_query = "SELECT * FROM usuario WHERE email = '$email'";
$email_result = mysqli_query($conn, $email_query);

if (mysqli_num_rows($email_result) > 0) {
    echo "Erro: Este e-mail já está cadastrado.";
    exit;
}

// Criação do hash da senha
$senha_hash = password_hash($usersenha, PASSWORD_DEFAULT);

// Inserção do usuário no banco de dados
$stmt = "INSERT INTO usuario (nome, email, senha) VALUES ('$nome', '$email', '$senha_hash')";


if (mysqli_query($conn, $stmt)) {
    header('Location: ../php/catalogo.php');
} else {
    echo "Erro ao cadastrar-se <br>" . mysqli_error($conn);
    echo "<br><a href='../php/homepage.php'>Voltar</a>";
}

mysqli_close($conn);

?>
