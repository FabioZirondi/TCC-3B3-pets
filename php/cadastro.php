<?php
// importa as variáveis do html
$nome = $_POST['nome'];
$email = $_POST['email'];
$usersenha = $_POST['senha'];
$numero = $_POST['numero'];
$cnpj = $_POST['cnpj'];
$nomeemp = $_POST['nomeemp'];
$tipo_usuario = isset($_POST['vendedor']) && $_POST['vendedor'] === 'v' ? 'v' : 'u';

// faz conexão com banco de dados
include_once("../php/conexao.php");

$nome = mysqli_real_escape_string($conn, $nome);
$email = mysqli_real_escape_string($conn, $email);
$senha = mysqli_real_escape_string($conn, $senha);
$numero = mysqli_real_escape_string($conn, $numero);
$cnpj = mysqli_real_escape_string($conn, $cnpj);
$nomeemp = mysqli_real_escape_string($conn, $nomeemp);

// Verifica se algum campo está vazio
if (empty($nome) || empty($email) || empty($usersenha)) {
    echo "Erro: Todos os campos obrigatórios devem estar preenchidos.";
    exit;
}

// Verifica se o e-mail já está em uso
$email_query = "SELECT * FROM usuario WHERE email = '$email'";
$email_query_vendedor = "SELECT * FROM vendedor WHERE email = '$email'";
$email_result = mysqli_query($conn, $email_query);
$email_result_vendedor = mysqli_query($conn, $email_query_vendedor);

if (mysqli_num_rows($email_result) > 0 || mysqli_num_rows($email_result_vendedor) > 0) {
    echo "Erro: Este e-mail já está cadastrado.";
    exit;
}

// Criação do hash da senha
$options = ['cost' => 10];
$senha_hash = password_hash($usersenha, PASSWORD_DEFAULT, $options);

if ($tipo_usuario === 'v') {
    // Se for um vendedor, verifique os campos relevantes
    if (empty($numero) || empty($nomeemp) || empty($cnpj)) {
        echo "Erro: Todos os campos obrigatórios para vendedores devem estar preenchidos.";
        exit;
    }
    // Inserção do vendedor no banco de dados
    $stmt = "INSERT INTO vendedor (nome, email, senha, telefone, nomeemp, cnpj, tipo) VALUES ('$nome', '$email', '$senha_hash', '$numero', '$nomeemp', '$cnpj', 'v')";
} elseif ($tipo_usuario === 'u') {
    // Se for um usuário normal
    $stmt = "INSERT INTO usuario (nome, email, senha, tipo) VALUES ('$nome', '$email', '$senha_hash', 'u')";
} else {
    // Tipo de usuário inválido
    echo "Erro: Tipo de usuário inválido.";
    exit;
}

// Inserção do usuário no banco de dados
if (mysqli_query($conn, $stmt)) {
    // Recupere o ID (ou código) recém-gerado a partir do banco de dados
    $novo_id = mysqli_insert_id($conn);

    session_start();
    $_SESSION['usuario'] = $tipo_usuario;
    

    if ($_SESSION['usuario'] == "u") {
        header("Location: ../php/catalogo.php");
    } elseif ($_SESSION['usuario'] == "v") {
        $_SESSION['codigo_vendedor'] = $novo_id; 
        $_SESSION['email'] = $email;// Armazena o código do vendedor na sessão
        header("Location: ../php/telavendedor.php");
    }
} else {
    echo "Erro ao cadastrar-se <br>" . mysqli_error($conn);
    echo "<br><a href='../php/homepage.php'>Voltar</a>";
}

mysqli_close($conn);
?>
