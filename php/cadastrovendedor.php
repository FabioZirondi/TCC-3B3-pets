<?php
// importa as variáveis do html
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$usersenha = isset($_POST['senha']) ? $_POST['senha'] : '';
$numero = $_POST['numero'];
$cnpj = $_POST['cnpj'];
$nomeemp = $_POST['nomeemp'];

echo "$nome";
echo "$email";
echo "$usersenha";
echo "$numero";
echo "$cnpj";
echo "$nomeemp";

// faz conexão com banco de dados
include_once("../php/conexao.php");

$nome = mysqli_real_escape_string($conn, $nome);
$email = mysqli_real_escape_string($conn, $email);
$usersenha = mysqli_real_escape_string($conn, $usersenha);
$numero = mysqli_real_escape_string($conn, $numero);
$cnpj = mysqli_real_escape_string($conn, $cnpj);
$nomeemp = mysqli_real_escape_string($conn, $nomeemp);

// Verifica se algum campo está vazio
if (empty($nome) || empty($email) || empty($usersenha) || empty($numero) || empty($cnpj) || empty($nomeemp)){
    echo "Erro: Todos os campos devem estar preenchidos.";
    exit;
}

// Verifica se o e-mail já está em uso na tabela 'usuario'
$email_query_usuario = "SELECT * FROM usuario WHERE email = '$email'";
$email_result_usuario = mysqli_query($conn, $email_query_usuario);

// Verifica se o e-mail já está em uso na tabela 'vendedor'
$email_query_vendedor = "SELECT * FROM vendedor WHERE email = '$email'";
$email_result_vendedor = mysqli_query($conn, $email_query_vendedor);

if (mysqli_num_rows($email_result_usuario) > 0 || mysqli_num_rows($email_result_vendedor) > 0) {
    echo "Erro: Este e-mail já está cadastrado.";
    exit;
}

// Criação do hash da senha
$options = ['cost' => 10,];
$senha_hash = password_hash($usersenha, PASSWORD_DEFAULT, $options);

// Inserção do usuário na tabela 'usuario'
$stmt = "INSERT INTO vendedor (nome, email, senha, telefone, cnpj, nomeemp) VALUES ('$nome', '$email', '$senha_hash', '$numero', '$cnpj', '$nomeemp')";

session_start();

if (mysqli_query($conn, $stmt)) {
    $_SESSION['usuario'] = $nome;
    header('Location: ../php/catalogo.php');
} else {
    echo "Erro ao cadastrar-se <br>" . mysqli_error($conn);
    echo "<br><a href='../php/homepage.php'>Voltar</a>";
}

mysqli_close($conn);
?>
