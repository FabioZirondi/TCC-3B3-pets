<?php
include_once("../php/conexao.php");

session_start();

$id_usuario = $_SESSION['codigo_usuario_vendedor'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produto = $_POST['id_produto'];
    $horario = $_POST['horario'];
    $data_agendamento = $_POST['data_agendamento'];
    $id_vendedor = $_POST['id_vendedor']; // Aqui está o ID do vendedor que você passou do formulário

    // Consulta para verificar se o id_vendedor é válido
    $sql_verificar_vendedor = $conn->prepare("SELECT cod FROM vendedor WHERE cod = ?");
    $sql_verificar_vendedor->bind_param("i", $id_vendedor);
    $sql_verificar_vendedor->execute();

    $result_verificar_vendedor = $sql_verificar_vendedor->get_result();

    if ($result_verificar_vendedor->num_rows > 0) {
        $sql_inserir_agendamento = $conn->prepare("INSERT INTO agendamentos (id_usuario, id_vendedor, id_produto, data_agendamento, horario, status) VALUES (?, ?, ?, ?, ?, 'A')");
        $sql_inserir_agendamento->bind_param("iiiss", $id_usuario, $id_vendedor, $id_produto, $data_agendamento, $horario);

        if ($sql_inserir_agendamento->execute()) {
            // Atualizar o status na tabela horarios_disponiveis
            $sql_atualizar_status = $conn->prepare("UPDATE horarios_disponiveis SET status = 'A' WHERE id_produto = ? AND horario = ?");
            $sql_atualizar_status->bind_param("is", $id_produto, $horario);

            if ($sql_atualizar_status->execute()) {
                $erro = "Agendamento bem-sucedido";
            } else {
                $erro = "Erro ao executar a consulta de atualização: " . $sql_atualizar_status->error;
            }
        } else {
            $erro = "Erro ao executar a consulta de inserção: " . $sql_inserir_agendamento->error;
        }
    } else {
        $erro = "Vendedor inválido";
    }

    // Redirecionar para a página de catálogo com a mensagem de erro, se houver
    header("Location: ../php/catalogo.php?erro=" . urlencode($erro));
    exit;
}
?>