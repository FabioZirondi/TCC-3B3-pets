<?php
include_once("../php/verificaSession.php");
include '../php/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupere os dados do formulário enviado
    $id_produto = $_POST['id_produto']; // Suponha que este dado seja enviado via POST
    $id_usuario = $_SESSION['cod']; // Suponha que você obtenha o ID do usuário da sessão
    $data_agendamento = $_POST['data_agendamento']; // Suponha que este dado seja enviado via POST

    // Verifique a disponibilidade do horário na tabela horarios_disponiveis
    // Implemente a lógica para verificar se o horário está disponível

    // Se o horário estiver disponível, insira o agendamento na tabela agendamentos
    $status = 'P'; // Supondo que 'P' representa 'Pendente'
    $sql = "INSERT INTO agendamentos (id_produto, id_usuario, data_agendamento, status) VALUES ('$id_produto', '$id_usuario', '$data_agendamento', '$status')";

    if ($conn->query($sql) === TRUE) {
        // Agendamento bem-sucedido, redirecione para uma página de confirmação
        header("Location: confirmacao_agendamento.php");
        exit();
    } else {
        // Erro ao inserir agendamento
        echo "Erro ao agendar o produto: " . $conn->error;
    }
} else {
    // Método de requisição inválido, redirecione para a página do catálogo
    header("Location: catalogo.php");
    exit();
}
?>
