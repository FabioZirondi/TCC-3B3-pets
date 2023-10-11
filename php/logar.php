<?php
session_start();

include_once('../php/conexao.php');

$email = $_POST['email'];
$senha = $_POST['senha'];


$email = mysqli_real_escape_string($conn, $email);

// Consulta nas tabelas 'usuario' e 'vendedor'
$stmtlogin_usuario = "SELECT * FROM usuario WHERE email = ?";
$stmtlogin_vendedor = "SELECT * FROM vendedor WHERE email = ?";

if ($stmt = mysqli_prepare($conn, $stmtlogin_usuario)) {
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultado_usuario = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
}

if ($stmt = mysqli_prepare($conn, $stmtlogin_vendedor)) {
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultado_vendedor = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
}

if ($resultado_usuario || $resultado_vendedor) {
    // Verifica se encontrou um registro em alguma das tabelas
    $usuario_encontrado = mysqli_num_rows($resultado_usuario) > 0;
    $vendedor_encontrado = mysqli_num_rows($resultado_vendedor) > 0;

    if ($usuario_encontrado || $vendedor_encontrado) {
        $row = ($usuario_encontrado) ? mysqli_fetch_assoc($resultado_usuario) : mysqli_fetch_assoc($resultado_vendedor);
        $hashed_password = $row['senha'];

        if (password_verify($senha, $hashed_password)) {
            // Autenticação bem-sucedida
            $codigo_vendedor = $row['cod'];
            $email_vendedor = $row['email'];
            $nome = $row['nome'];
            $usuario_tipo = ($usuario_encontrado) ? 'u' : 'v';

            $_SESSION['codigo_vendedor'] = $codigo_vendedor;
            $_SESSION['email_vendedor'] = $email_vendedor;
            $_SESSION['nome'] = $nome;
            $_SESSION['usuario'] = $usuario_tipo;

            $_SESSION['codigo_usuario_vendedor'] = $codigo_vendedor;
            if ($usuario_tipo == "u") {
                header("Location: ../php/catalogo.php");
            } elseif ($usuario_tipo == "v") {
                header("Location: ../php/telavendedor.php");
            }
            exit;
        } else {
            $_SESSION['email_vendedor'] = '';
            $erro = "Senha incorreta!";
        }
    } else {
        $_SESSION['email_vendedor'] = '';
        $erro = "Usuário não encontrado!";
    }
} else {
    echo "Erro na consulta: " . mysqli_error($conn);
}

mysqli_close($conn);

if (isset($erro)) {
    header("Location: ../php/login.php?erro=" . urlencode($erro));
    exit;
}
?>