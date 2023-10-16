<?php
include_once("../php/conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['produto_id'])) {
    // Recupere o ID do produto do formulário
    $produto_id = $_POST['produto_id'];

    // Selecione o nome da imagem do banco de dados com base no ID do produto
    $sql_select_imagem = "SELECT imagem_nome_uniq FROM produtos WHERE id = ?";
    $stmt_select_imagem = $conn->prepare($sql_select_imagem);
    $stmt_select_imagem->bind_param("i", $produto_id);
    $stmt_select_imagem->execute();
    $stmt_select_imagem->bind_result($imagem_nome);
    $stmt_select_imagem->fetch();
    $stmt_select_imagem->close();

    // Caminho completo para o arquivo de imagem
    $caminho_imagem = "../imagemprodutos/" . $imagem_nome;

    // Delete os agendamentos relacionados ao produto
    $sql_apagar_agendamentos = "DELETE FROM agendamentos WHERE id_produto = ?";
    $stmt_apagar_agendamentos = $conn->prepare($sql_apagar_agendamentos);
    $stmt_apagar_agendamentos->bind_param("i", $produto_id);
    $stmt_apagar_agendamentos->execute();

    // Delete horários disponíveis relacionados ao produto
    $sql_apagar_horarios = "DELETE FROM horarios_disponiveis WHERE id_produto = ?";
    $stmt_apagar_horarios = $conn->prepare($sql_apagar_horarios);
    $stmt_apagar_horarios->bind_param("i", $produto_id);
    $stmt_apagar_horarios->execute();

    // Execute uma consulta SQL para excluir o produto com base no ID
    $sql = "DELETE FROM produtos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $produto_id);

    if ($stmt->execute()) {
        if (file_exists($caminho_imagem)) {
            unlink($caminho_imagem);
        }
        header("Location: telavendedor.php");
        exit;
    } else {
        $erro = "Erro ao apagar o produto: " . $stmt->error;
        if (isset($erro)) {
            header("Location: telavendedor.php?erro=" . urlencode($erro));
            exit;
        }
    }

    $stmt->close();
} else {
    $erro = "ID do produto não foi fornecido.";
    if (isset($erro)) {
        header("Location: telavendedor.php?erro=" . urlencode($erro));
        exit;
    }
}

$conn->close();
?>
