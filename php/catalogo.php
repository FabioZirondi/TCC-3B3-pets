<?php

include_once("../php/verificaSession.php");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/HomePage.css">
    <link rel="stylesheet" href="../css/catalogo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis&family=Montserrat:wght@100;200&display=swap"
        rel="stylesheet">
    <title>Catálogo</title>
</head>
<script src="../js/HomePage.js"></script>

<body>
    <header>
        <div class="topnav" id="myTopnav">
            <a href="../php/HomePage.php" class="active">I-Pet</a>
            <a href="../php/logout.php"> <button class="button" type="button">Sair</button></a>
            <?php

            if ($_SESSION['usuario'] == 'v') {
                echo "<a href='../php/telavendedor.php'>Seus produtos</a>";
            }
            ?>
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

        </br>

        <?php
        echo "<div class='bemvindo, '>";
        echo "<h1>Bem-vindo, ";
        if (isset($_SESSION['nome'])) {
            echo "{$_SESSION['nome']}!"; 
        }
        echo "</h1>";
        echo "<div class='card-container'>";
        include '../php/conexao.php';

        $sql = "SELECT * FROM produtos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='card'>";
                echo "<img src='../imagemprodutos/{$row['imagem_nome_uniq']}' alt='{$row['descricao']}' style='width:100%'>";
                echo "<h1>{$row['nome_produto']}</h1>";
                echo "<h3>{$row['descricao']}</h3>";
                echo "<p class='preco'>R$ {$row['preco']}</p>";
                echo "<p><button class='button_catalogo'>Agendar</button></p>";
                echo "</div>";
            }
        } else {
            echo "<p>Nenhum produto cadastrado.</p>";
        }

        $conn->close();
        ?>
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
</body>

</html>