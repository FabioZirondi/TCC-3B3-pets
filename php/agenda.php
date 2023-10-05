<?php
include_once("conexao.php");

$id_produtos = isset($_POST['id_produto']) ? $_POST['id_produto'] : null;
$status = 'D';

$produtos = null;
$horarios_disponiveis = [];

if ($id_produtos) {
    $sql_horarios = $conn->prepare("SELECT * FROM horarios_disponiveis WHERE id_produto = ? AND `status` = ?");
    $sql_horarios->bind_param("is", $id_produtos, $status);
    $sql_horarios->execute();

    $result_horarios = $sql_horarios->get_result();

    if ($result_horarios->num_rows > 0) {
        while ($row_horario = $result_horarios->fetch_assoc()) {
            $horarios_disponiveis[] = $row_horario['data_agendamento'];
        }

        $sql_produtos = "SELECT * FROM produtos WHERE id = $id_produtos";
        $result_produtos = $conn->query($sql_produtos);

        if ($result_produtos->num_rows > 0) {
            $produtos = $result_produtos->fetch_assoc();
        }
    }

    $sql_horarios->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Agendamento -
        <?php echo $produtos ? $produtos['nome_produto'] : 'Produto não encontrado'; ?>
    </title>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/HomePage.css">
        <link rel="stylesheet" href="../css/agenda.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dosis&family=Montserrat:wght@100;200&display=swap"
            rel="stylesheet">
    </head>
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
        </br>
        </br>
        </br>
        <div class="div_main">
            <h2>Qual horário deseja agendar?</h2>
            <p><b>
                    serviço:
                    <?php echo $produtos ? $produtos['nome_produto'] : 'Produto não encontrado'; ?>
            </b></p>
            <div class="container_principal">
                <?php
                if ($produtos && $horarios_disponiveis) {
                    echo "<p><b>{$produtos['descricao']}</b></p>
         <p class='preco'><b>R$ {$produtos['preco']}</b></p>
         <form action='processar_agendamento.php' method='post'>
         <label for='horario'><b>Escolha um horário:</b></label>
         <select name='horario' id='horario'>";
                    foreach ($horarios_disponiveis as $horario) {
                        echo "<option value='$horario'>$horario</option>";
                    }
                    echo "</select>
         <input type='hidden' name='id_produto' value='$id_produtos'>
         <button type='submit' class='button_agenda'>Agendar</button>
         </form>";
                } else {
                    echo "<p>Produto não encontrado ou não há horários disponíveis para agendamento.</p>";
                }
                ?>
            </div>
        </div>
    </main>
    <footer>

    </footer>
    </div>
</body>

</html>