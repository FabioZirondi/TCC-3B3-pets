<?php
include_once("../php/verificaSessionPagInicial.php");

include_once("../php/conexao.php");

// Consulta para obter os 3 últimos agendamentos
$sql_agendamentos = $conn->prepare("SELECT a.id, u.nome, p.nome_produto, h.data_agendamento, h.horario, a.status, p.imagem_nome_uniq
                                    FROM agendamentos a 
                                    INNER JOIN produtos p ON a.id_produto = p.id
                                    INNER JOIN horarios_disponiveis h ON a.id_produto = h.id_produto AND a.horario = h.horario
                                    INNER JOIN usuario u ON a.id_usuario = u.cod
                                    ORDER BY a.id DESC
                                    LIMIT 3");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis&family=Montserrat:wght@100;200&display=swap"
        rel="stylesheet">
    <title>Página Inicial</title>
</head>

<body>
    <header>
        <div class="topnav" id="myTopnav">
            <a href="../php/HomePage.php" class="active">PetVitrine</a>
            <a href="../php/login.php"> <button class="button" type="button">Login</button></a>
            <a href="#sobre">Sobre</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </header>
    <main>

        <!-- Bem vindo/ Cadastre-se -->

        <div class="container_img">
            <div class="container">
                <h1 class="text_main">Bem-Vindo!</h1>
                <p class="text_main">Nosso site foi desenvolvido para facilitar agendamentos de serviços para seu Pet.
                </p>
                <a href="../php/cadastrohtml.php"><button class="button_main text_main"
                        type="submit">Inscreva-se</button></a>
            </div>
        </div>

        <!-- Cads de anuncio -->

        <div class="background_card">
            <h1 style="text-align: center;margin-top: 50px;">Nossos serviços</h1>
            <div class="container_cards">
                <?php
                if ($result_agendamentos->num_rows > 0) {
                    while ($row = $result_agendamentos->fetch_assoc()) {
                        $dia_string = str_pad($row['data_agendamento'], 8, '0', STR_PAD_LEFT);
                        $data_formatada = DateTime::createFromFormat('dmY', $dia_string)->format('d/m/y');
                        echo '<div class="card">';
                        echo '<img src="../imagemprodutos/' . $row['imagem_nome_uniq'] . '" alt="Avatar" style="width:100%">';
                        echo '<div class="container_card">';
                        echo '<h4><b>' . $row['nome_produto'] . '</b></h4>';
                        echo '<hr>';
                        echo '<p>' . $data_formatada . ' | ' . $row['horario'] . '</p>';
                        echo '<button class="button_card" src="#">Agendar agora!</button>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                   
                    echo '<p>Não há produtos disponíveis para agendamento no momento.</p>';
                }
                ?>
            </div>
        </div>

        <!-- Sobre nós -->

        <div class="container_about">
            <div class="container_img_about">
                <div class="sobrenos_img">
                    <h1>Sobre nós</h1>
                </div>
            </div>
            <div class="container_obj">
                <p>Nossos objetivos</p>
                <h3>Desde 2000, o(a) Colabs tem fornecido suprimentos para animais de estimação, materiais educativos,
                    acesso aos criadores e outros produtos e serviços de primeira linha na região de São Paulo . A
                    alegria e satisfação de ver donos de animais de estimação com seus bichinhos é verdadeiramente
                    gratificante.</h3>
            </div>
        </div>
    </main>
    <footer>
        <h1>I-Pet</h1>
        <p>I-pet@gmail.com</p>
        <div class="social-icons">
            <a href="https://pt-br.facebook.com/"><img src="../img/icon-facebook.png" alt="Facebook"></a>
            <a href="https://twitter.com/"><img src="../img/icon-twitter.png" alt="Twitter"></a>
            <a href="https://br.linkedin.com/"><img src="../img/icon-linkedin.png" alt="LinkedIn"></a>
            <a href="https://web.telegram.org/a/"><img src="../img/icon-telegram.png" alt="Telegram"></a>
        </div>
        <p>&copy; 2023. Todos os direitos reservados.</p>
    </footer>
    <script src="../js/HomePage.js"></script>
</body>

</html>