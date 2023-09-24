<?php
include_once("../php/conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['produto_id'])) {
    // Recupere o ID do produto do formulário
    $produto_id = $_POST['produto_id'];

    // Execute uma consulta SQL para excluir o produto com base no ID
    $sql = "DELETE FROM produtos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $produto_id);

    if ($stmt->execute()) {
        // Produto excluído com sucesso, você pode redirecionar de volta para a página do vendedor ou fazer qualquer outra ação necessária
        header("Location: telavendedor.php");
        exit;
    } else {
        // Se ocorrer um erro durante a exclusão
        $erro = "Erro ao apagar o produto: " . $stmt->error;
        if (isset($erro)) {
            header("Location: telavendedor.php?erro=" . urlencode($erro));
            exit;
        }
        exit;
    }

    $stmt->close();
} else {
    $erro = "ID do produto não foi fornecido.";
    if (isset($erro)) {
        header("Location: telavendedor.php?erro=" . urlencode($erro));
        exit;
    }
    exit;
}

$conn->close();
?>
