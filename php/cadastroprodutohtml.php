<?php

include_once("../php/sessionvendedor.php");


$erro = isset($_GET['erro']) ? urldecode($_GET['erro']) : '';

$sucesso = isset($_GET['sucesso']) ? urldecode($_GET['sucesso']) : '';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/HomePage.css">
    <link rel="stylesheet" href="../css/cadastroprodutos.css">
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
            <a href="../php/HomePage.php" class="active">I-Pet</a>
            <a href="../php/logout.php"> <button class="button" type="button">Sair</button></a>
            <a href="../php/telavendedor.php">Produtos</a>
            <a href="#sobre">Sobre</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </header>
    <main>
        <br />
        <br />
        <div class="form">
            <form class="container-form" action="../php/cadastroproduto.php" method="POST"
                enctype="multipart/form-data">
                <h1>Cadastro de produtos</h1>
                <hr>

                <label for="nomeprod"><b>Título</b></label>
                <input type="text" placeholder="Título do produto" name="nomeprod" id="nomeprod" required>

                <label for="desc"><b>Descrição</b></label>
                <input type="text" placeholder="Descrição" name="desc" id="desc" required>

                <label for="preco"><b>Preço</b></label>
                <input type="number" placeholder="Preço" name="preco" id="preco" required>

                <div class="custom-file-upload">
                    <button type="button"><img src="../img/upload.png" alt="imagemUpload"> </img>Escolher
                        Arquivo</button>
                    <input type="file" name="imagem" id="imagem" accept="image/*" required>
                </div>
                <label for="imagem"><b>Selecione uma imagem</b></label>
                <p><b>A imagem não pode esceder os 750x480 pixels</b></p>
                    <div class="mensagemerro">
                    <?php
                    if (isset($erro)) {
                        echo "<p>" . $erro . "</p>";
                    }
                    ?>
                    </div>
                    <div class="mensagemdesucesso">
                    <?php
                    if (isset($sucesso)) {
                        echo "<p>" . $sucesso . "</p>";
                    }
                    ?>

                <button type="submit" class="registerbtn">Enviar</button>
            </form>



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