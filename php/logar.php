<?php
$email = $_POST['email'];
$senhalogar = $_POST['senha'];

include_once('../php/conexao.php');

$email = mysqli_real_escape_string($conn, $email);

$stmtlogin = "SELECT * FROM usuario WHERE email = '$email'";
$resultado = mysqli_query($conn, $stmtlogin);

if ($resultado) {
    if (mysqli_num_rows($resultado) > 0) {
        $row = mysqli_fetch_assoc($resultado);
        if (password_verify($senhalogar, $row['senha'])) {
            session_start();
            $_SESSION['usuario'] = $row['nome'];
            header("Location: ../php/catalogo.php");
            exit;
        } else {
            echo "Senha incorreta";
        }
    } else {
        echo "Usuário não encontrado. Acesso negado.";
    }
} else {
    echo "Erro na consulta: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
