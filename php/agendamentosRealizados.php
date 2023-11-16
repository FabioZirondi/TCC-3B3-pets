<?php
include_once("../php/conexao.php");

include("../php/verificaSession.php");

// Obtém o id do usuário da sessão
$id_usuario = $_SESSION['codigo_usuario_vendedor'];

// Consulta para obter os agendamentos relacionados ao usuário
$sql_agendamentos = $conn->prepare("SELECT a.id, p.nome_produto, h.data_agendamento, h.horario, a.status FROM agendamentos a 
                                    INNER JOIN produtos p ON a.id_produto = p.id
                                    INNER JOIN horarios_disponiveis h ON a.id_produto = h.id_produto AND a.horario = h.horario
                                    WHERE a.id_usuario = ?");
$sql_agendamentos->bind_param("i", $id_usuario);
$sql_agendamentos->execute();

$result_agendamentos = $sql_agendamentos->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/HomePage.css">
    <link rel="stylesheet" href="../css/agendamentorealizado.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="../img/iconpet.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis&family=Montserrat:wght@100;200&display=swap"
        rel="stylesheet">
    <title>Seus agendamentos</title>
</head>

<body>
    <header>
        <div class="topnav" id="myTopnav">
            <a href="../index.php" class="active">PetVitrine</a>
            <a href="../php/logout.php"> <button class="button" type="button">Sair</button></a>
            <a href="../php/catalogo.php">Catalogo</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </header>
    <main>
        </br>
        </br>
        <h2>Seus Agendamentos</h2>
        <table class="striped-table">
            <tr>
                <th>Produto</th>
                <th>Data do Agendamento</th>
                <th>Horário(h/m/s)</th>
                <th>Status</th>
            </tr>

            <?php
            
            while ($row = $result_agendamentos->fetch_assoc()) {
                echo "<tr>";
                echo "<b>";
                echo "<td>" . $row['nome_produto'] . "</td>";
                echo "<td>" . $row['data_agendamento'];;
                echo "<td>" . $row['horario'] . "</td>";
                echo "<td>" . ($row['status'] === 'A' ? 'Agendado' : $row['status']) . "</td>";
                echo "</b>";
                echo "</tr>";
            }
            ?>
        </table>
    </main>
    <script src="../js/homepage.js"></script>
    <footer>
    <h1>PetVitrine</h1>
        <p>petvitrine@gmail.com</p>
        <div class="social-icons">
            <a href="https://pt-br.facebook.com/"><img src="../img/icon-facebook.png" alt="Facebook"></a>
            <a href="https://twitter.com/"><img src="../img/icon-twitter.png" alt="Twitter"></a>
            <a href="https://br.linkedin.com/"><img src="../img/icon-linkedin.png" alt="LinkedIn"></a>
            <a href="https://web.telegram.org/a/"><img src="../img/icon-telegram.png" alt="Telegram"></a>
        </div>
        <p>&copy; 2023. Todos os direitos reservados.</p>
    </footer>
</body>

</html>

<?php
// Lembre-se de fechar a consulta e a conexão após usá-las
$sql_agendamentos->close();
$conn->close();
?>