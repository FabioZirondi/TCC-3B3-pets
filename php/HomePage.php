<?php

include_once("../php/verificaSessionPagInicial.php");

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
            <a href="../php/HomePage.php" class="active">I-Pet</a>
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
                <a href="../php/cadastrohtml.php"><button class="button_main text_main" type="submit">Inscreva-se</button></a>
            </div>
        </div>

        <!-- Cads de anuncio -->

        <div class="background_card">
            <h1 style="text-align: center;margin-top: 50px;">Nossos serviços</h1>
            <div class="container_cards">
                <div class="card">
                    <img src="https://static.wixstatic.com/media/11062b_73641fdcc7974ff387adf65f2bcc8bf9~mv2.jpg/v1/fill/w_364,h_364,fp_0.50_0.50,q_80,usm_0.66_1.00_0.01,enc_auto/11062b_73641fdcc7974ff387adf65f2bcc8bf9~mv2.jpg"
                        alt="Avatar" style="width:100%">
                    <div class="container_card">
                        <h4><b>Banho</b></h4>
                        <hr>
                        <p>1h</p>
                        <button class="button_card" src="#">Agendar agora!</button>
                    </div>
                </div>
                <div class="card">
                    <img src="https://static.wixstatic.com/media/11062b_d683e351d75a49c3bcf30051902027b8~mv2.jpg/v1/fill/w_563,h_563,fp_0.50_0.50,q_80,usm_0.66_1.00_0.01,enc_auto/11062b_d683e351d75a49c3bcf30051902027b8~mv2.jpg"
                        alt="Avatar" style="width:100%">
                    <div class="container_card">
                        <h4><b>Tosa Higiênica</b></h4>
                        <hr>
                        <p>1h</p>
                        <button class="button_card" src="#">Agendar agora!</button>
                    </div>
                </div>
                <div class="card">
                    <img src="https://static.wixstatic.com/media/9c6757_4f0a4ce526df417894139de4368cc05c~mv2.jpeg/v1/fill/w_563,h_563,fp_0.50_0.50,q_80,usm_0.66_1.00_0.01,enc_auto/9c6757_4f0a4ce526df417894139de4368cc05c~mv2.jpeg"
                        alt="Avatar" style="width:100%">
                    <div class="container_card">
                        <h4><b>Hospedagem Pet</b></h4>
                        <hr>
                        <p>1h</p>
                        <button class="button_card" src="#">Agendar agora!</button>
                    </div>
                </div>
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