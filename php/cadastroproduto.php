<?php
// importa as variáveis do html
$nome = $_POST['nome'];
$email = $_POST['email'];
$usersenha = $_POST['senha'];
$numero = $_POST['numero'];

// conexão com banco de dados
include_once("../php/conexao.php");

$nome = mysqli_real_escape_string($conn, $nome);
$email = mysqli_real_escape_string($conn, $email);
$senha = mysqli_real_escape_string($conn, $senha);
$numero = mysqli_real_escape_string($conn, $numero);

// Verifica se algum campo está vazio
if (empty($nome) || empty($email) || empty($usersenha)) {
    echo "Erro: Todos os campos obrigatórios devem estar preenchidos.";
    exit;
}

// Verifica se o e-mail já está em uso
$email_query = "SELECT * FROM usuario WHERE email = '$email'";
$email_result = mysqli_query($conn, $email_query);

if (mysqli_num_rows($email_result) > 0) {
    echo "Erro: Este produtos já está cadastrado.";
    exit;
}

// criptografia
$options = ['cost' => 10];
$senha_hash = password_hash($usersenha, PASSWORD_DEFAULT, $options);

// Inserção do vendedor no banco de dados
$stmt = "INSERT INTO produto (urlImg, titulo, descricao, preco, horario,) VALUES ('$nome', '$email', '$senha_hash', '$numero', '$nomeemp', '$cnpj', 'v')";


// Inserção do usuário no banco de dados
session_start();

if (mysqli_query($conn, $stmt)) {
    $_SESSION['usuario'] = $tipo_usuario;

    if ($_SESSION['usuario'] == "u") {
        header("Location: ../php/catalogo.php");
    } elseif ($_SESSION['usuario'] == "v") {
        header("Location: ../php/telavendedor.php");
    }
} else {
    echo "Erro ao cadastrar-se <br>" . mysqli_error($conn);
    echo "<br><a href='../php/homepage.php'>Voltar</a>";
}

mysqli_close($conn);
?>