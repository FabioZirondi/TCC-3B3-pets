<?php
include_once("conexao.php");
session_start();


if(isset($_POST['id_produto'])){
    $id_produto = $_POST['id_produto'];
}

$status = 'D';

$produto = null;
$horarios_disponiveis = [];

if ($id_produto) {
    $sql_horarios = $conn->prepare("SELECT * FROM horarios_disponiveis WHERE id_produto = ? AND `status` = ?");
    $sql_horarios->bind_param("is", $id_produto, $status);
    $sql_horarios->execute();

    $result_horarios = $sql_horarios->get_result();

    if ($result_horarios->num_rows > 0) {
        while ($row_horario = $result_horarios->fetch_assoc()) {
            $dia = $row_horario['data_agendamento'];
            $horario = $row_horario['horario'];
            $horarios_disponiveis[$dia][] = $horario;
        }

        $sql_produto = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
        $sql_produto->bind_param("i", $id_produto);
        $sql_produto->execute();

        $result_produto = $sql_produto->get_result();

        if ($result_produto->num_rows > 0) {
            $produto = $result_produto->fetch_assoc();
        }
    }

    $sql_horarios->close();
    $sql_produto->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Agendamento -
        <?php echo $produto ? $produto['nome_produto'] : 'Produto não encontrado'; ?>
    </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/HomePage.css">
    <link rel="stylesheet" href="../css/agenda.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis&family=Montserrat:wght@100;200&display=swap"
        rel="stylesheet">
</head>

<body>
    <header>
        <div class="topnav" id="myTopnav">
            <a href="../php/HomePage.php" class="active">I-Pet</a>
            <a href="../php/logout.php"> <button class="button" type="button">Sair</button></a>
            <a href="#sobre">Sobre</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </header>
    <main>
        <div class="div_main">
        </br>
        </br>
            <h2>Qual horário deseja agendar?</h2>
            <p><b>
                    Serviço:
                    <?php echo $produto ? $produto['nome_produto'] : 'Produto não encontrado'; ?>
            </b></p>
            <div class="container_principal">
                <?php
                if ($produto && $horarios_disponiveis) {
                    foreach ($horarios_disponiveis as $dia => $horarios) {
                        echo "<h3>{$dia}</h3>";
                        echo "<form action='processar_agendamento.php' method='post'>";
                        echo "<label for='horario'><b>Escolha um horário:</b></label>";
                        echo "<select name='horario' id='horario'>";
                        foreach ($horarios as $horario) {
                            echo "<option value='{$horario}'>{$horario}</option>";
                        }
                        echo "</select>";
                        echo "<input type='hidden' name='id_produto' value='{$id_produto}'>";
                        echo "<button type='submit' class='button_agenda'>Agendar</button>";
                        echo "</form>";
                    }
                } else {
                    echo "<p>Produto não encontrado ou não há horários disponíveis para agendamento.</p>";
                }
                ?>
            </div>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>
