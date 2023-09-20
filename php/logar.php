<?php
session_start();

$email = $_POST['email'];
$senhalogar = $_POST['senha'];

include_once('../php/conexao.php');

$email = mysqli_real_escape_string($conn, $email);

// Consulta nas tabelas 'usuario' e 'vendedor'
$stmtlogin_usuario = "SELECT * FROM usuario WHERE email = '$email'";
$stmtlogin_vendedor = "SELECT * FROM vendedor WHERE email = '$email'";

$resultado_usuario = mysqli_query($conn, $stmtlogin_usuario);
$resultado_vendedor = mysqli_query($conn, $stmtlogin_vendedor);

if ($resultado_usuario || $resultado_vendedor) {
    // Verifica se encontrou um registro em alguma das tabelas
    $usuario_encontrado = mysqli_num_rows($resultado_usuario) > 0;
    $vendedor_encontrado = mysqli_num_rows($resultado_vendedor) > 0;

    if ($usuario_encontrado || $vendedor_encontrado) {
        if ($usuario_encontrado) {
            $row = mysqli_fetch_assoc($resultado_usuario);
        } else {
            $row = mysqli_fetch_assoc($resultado_vendedor);

            $_SESSION['codigo_vendedor'] = $row['cod'];
        }

        if (password_verify($senhalogar, $row['senha'])) {

            // Defina a variável de sessão 'usuario' com base no tipo encontrado
            $_SESSION['usuario'] = $usuario_encontrado ? 'u' : 'v';

            if ($_SESSION['usuario'] == "u") {
                header("Location: ../php/catalogo.php");
            } elseif ($_SESSION['usuario'] == "v") {
                header("Location: ../php/telavendedor.php");
            }
            exit;
        } else {
            $erro = "Senha incorreta!";
            if (isset($erro)) {
                header("Location: ../php/login.php?erro=" . urlencode($erro));
                exit;
            }
        }
    } else {
        $erro = "Usuário não encontrado!";
        if (isset($erro)) {
            header("Location: ../php/login.php?erro=" . urlencode($erro));
            exit;
        }
    }
} else {
    echo "Erro na consulta: " . mysqli_error($conn);
}

mysqli_close($conn);
?>