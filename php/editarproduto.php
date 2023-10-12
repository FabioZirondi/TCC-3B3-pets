<?php
session_start();

include_once("../php/conexao.php");

//busca o cod do vendedor para referenciar com os produtos
if(isset($_POST['produto_id'])){
    $id_produto = $_POST['produto_id'];

// Informações do produto
$nomeproduto = $_POST['nomeprod'];
$descricao = $_POST['desc'];
$preco = $_POST['preco'];

// Imagem
$nome_imagem_original = $_FILES['imagem']['name'];
$tipo_imagem = $_FILES['imagem']['type'];
$tamanho_imagem = $_FILES['imagem']['size'];

//Horários 

$horarios = $_POST['horarios'];
$dia = $_POST['dia'];


$nomeproduto = mysqli_real_escape_string($conn, $nomeproduto);
$descricao = mysqli_real_escape_string($conn, $descricao);
$preco = mysqli_real_escape_string($conn, $preco);
$nome_imagem_original = mysqli_real_escape_string($conn, $nome_imagem_original);
$tipo_imagem = mysqli_real_escape_string($conn, $tipo_imagem);
$tamanho_imagem = mysqli_real_escape_string($conn, $tamanho_imagem);
$dia = mysqli_real_escape_string($conn, $dia);

if (empty($nomeproduto) || empty($descricao) || empty($preco) || empty($nome_imagem_original) || empty($tipo_imagem) || empty($tamanho_imagem)) {
    $erro = "Todos os campos obrigatórios devem estar preenchidos." . $stmt->error;
    header("Location: ../php/cadastroprodutohtml.php?erro=" . urlencode($erro));
    exit;
}

$sql = "SELECT * FROM produtos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_produto);
$stmt->execute();
$result = $stmt->get_result();

$sql_update_produto = "UPDATE produtos SET nome_produto=?, descricao=?, preco=?, imagem_nome_uniq=? WHERE id=?";
$stmt_update_produto = $conn->prepare($sql_update_produto);
$stmt_update_produto->bind_param("ssssi", $nomeproduto, $descricao, $preco, $nome_imagem_original, $id_produto);
$stmt_update_produto->execute();
$stmt_update_produto->close();

// Excluir horários antigos associados a este produto
$sql_delete_horarios = "DELETE FROM horarios_disponiveis WHERE id_produto=?";
$stmt_delete_horarios = $conn->prepare($sql_delete_horarios);
$stmt_delete_horarios->bind_param("i", $id_produto);
$stmt_delete_horarios->execute();
$stmt_delete_horarios->close();

// Inserir novos horários associados a este produto
foreach ($horarios as $horario) {
    $sql_inserir_horario = "INSERT INTO horarios_disponiveis (id_produto, data_agendamento, horario, status) VALUES (?, ?, ?, 'D')";
    $stmt_inserir_horario = $conn->prepare($sql_inserir_horario);
    $stmt_inserir_horario->bind_param("iss", $id_produto, $dia, $horario);
    $stmt_inserir_horario->execute();
    $stmt_inserir_horario->close();
}
}else{
    $erro = "deu tudo errado " . $stmt->error;
        if (isset($erro)) {
            header("Location: editarprodutohtml.php?erro=" . urlencode($erro));
            exit;
        }
}

// Redirecionar para a página de edição com mensagem de sucesso
header("Location: ../php/editarprodutohtml.php?id_produto=$id_produto&sucesso=" . urlencode("Produto editado com sucesso."));
exit;

$stmt->close();