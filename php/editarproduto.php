<?php
session_start();
include_once("../php/conexao.php");

if (isset($_POST['produto_id'])) {
    $id_produto = $_POST['produto_id'];

    // Verifica se a imagem antiga existe no banco de dados
    $sql_select_imagem = "SELECT imagem_nome_uniq FROM produtos WHERE id = ?";
    $stmt_select_imagem = $conn->prepare($sql_select_imagem);
    $stmt_select_imagem->bind_param("i", $id_produto);
    $stmt_select_imagem->execute();
    $stmt_select_imagem->bind_result($imagem_antiga);
    $stmt_select_imagem->fetch();
    $stmt_select_imagem->close();

    // Se a imagem antiga existir, apaga o arquivo da pasta
    if (!empty($imagem_antiga)) {
        $caminho_imagem_antiga = "../imagemprodutos/" . $imagem_antiga;
        if (file_exists($caminho_imagem_antiga)) {
            unlink($caminho_imagem_antiga);
        }
    }
    // Informações do produto
    $nomeproduto = mysqli_real_escape_string($conn, $_POST['nomeprod']);
    $descricao = mysqli_real_escape_string($conn, $_POST['desc']);
    $preco = mysqli_real_escape_string($conn, $_POST['preco']);

    // Imagem
    $nome_imagem_original = $_FILES['imagem']['name'];
    $nome_imagem = uniqid() . '_' . $nome_imagem_original;
    $caminho_imagem = "../imagemprodutos/" . $nome_imagem;

    // Horários 
    $horarios = $_POST['horarios'];
    $dia = mysqli_real_escape_string($conn, $_POST['dia']);

    if (empty($nomeproduto) || empty($descricao) || empty($preco) || empty($nome_imagem_original)) {
        $erro = "Todos os campos obrigatórios devem estar preenchidos.";
        header("Location: ../php/cadastroprodutohtml.php?erro=" . urlencode($erro));
        exit;
    }

    // Move a imagem para a pasta de destino
    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_imagem)) {
        // Atualiza o banco de dados com as novas informações
        $sql_update_produto = "UPDATE produtos SET nome_produto=?, descricao=?, preco=?, imagem_nome_uniq=? WHERE id=?";
        $stmt_update_produto = $conn->prepare($sql_update_produto);
        $stmt_update_produto->bind_param("ssssi", $nomeproduto, $descricao, $preco, $nome_imagem, $id_produto);
        $stmt_update_produto->execute();
        $stmt_update_produto->close();

        // Excluir horários antigos associados a este produto
        $sql_delete_horarios = "DELETE FROM horarios_disponiveis WHERE id_produto=?";
        $stmt_delete_horarios = $conn->prepare($sql_delete_horarios);
        $stmt_delete_horarios->bind_param("i", $id_produto);
        $stmt_delete_horarios->execute();
        $stmt_delete_horarios->close();

        // Inserir novos horários associados a este produto

        $dia_formatado = date('d/m/y', strtotime($dia));

        foreach ($horarios as $horario) {
            $sql_inserir_horario = "INSERT INTO horarios_disponiveis (id_produto, data_agendamento, horario, status) VALUES (?, ?, ?, 'D')";
            $stmt_inserir_horario = $conn->prepare($sql_inserir_horario);
            $stmt_inserir_horario->bind_param("iss", $id_produto, $dia_formatado, $horario);
            $stmt_inserir_horario->execute();
            $stmt_inserir_horario->close();
        }

        // Redirecionar para a página de edição com mensagem de sucesso
        header("Location: ../php/editarprodutohtml.php?id_produto=$id_produto&sucesso=" . urlencode("Produto editado com sucesso."));
        exit;
    } else {
        $erro = "Erro ao enviar a imagem para a pasta de destino.";
        header("Location: ../php/cadastroprodutohtml.php?erro=" . urlencode($erro));
        exit;
    }
} else {
    $erro = "ID do produto não especificado.";
    header("Location: editarprodutohtml.php?erro=" . urlencode($erro));
    exit;
}

$conn->close();
?>