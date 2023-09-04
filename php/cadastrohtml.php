<?php

include_once("../php/verificaSessionPagInicial.php");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis&family=Montserrat:wght@100;200&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../css/cadastro.css">
    <link rel="stylesheet" href="../css/HomePage.css">
    <title>Página Inicia</title>
</head>

<body>
    <header>
        <!-- NavBar -->
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

        <!-- parte principal -->

        <div class="container-geral">

            <!-- Imagem -->

            <div class="img-form">
                <div class="cadastrese">
                    <h1>cadastre-se</h1>
                    <p>oi, teste</p>
                </div>
            </div>

            <!-- Formulário -->

            <div class="form">
                <form class="container-form" method="POST" action="../php/cadastro.php">
                    <h1>Cadastro</h1>
                    <p>Faça seu cadastro para acessar mais informações</p>
                    <hr>

                    <label for="nome"><b>Nome</b></label>
                    <input type="text" placeholder="Nome" name="nome" id="nome" required>

                    <label for="email"><b>Email</b></label>
                    <input type="email" placeholder="Email" name="email" id="email" required>

                    <label for="senha"><b>Senha</b></label>
                    <input type="password" placeholder="Senha" name="senha" id="senha" minlength="8" required>

                    <input class="checkbox" type="checkbox" id="vendedor" name="vendedor" value="v">
                    <label for="">Cadastro para vendedores</label>
                    <p></p>

                    <div id="camposVendedor" style="display: none;">

                        <label for="telefone"><b>Telefone</b></label>
                        <input type="text" id="telefone" name="numero" placeholder="(xx) xxxxx-xxxx" >

                        <label for="nomeemp"><b>Nome da sua empresa</b></label>
                        <input type="text" placeholder="Empresa" name="nomeemp" id="nomeemp" >

                        <label for="cnpj"><b>CNPJ</b></label>
                        <input type="text" placeholder="CNPJ" placeholder="XX.XXX.XXX/0001-XX." name="cnpj" id="cnpj">
                    </div>
                    <hr>
                    <button type="submit" class="registerbtn">Register</button>
                    <p>já possuí conta? <a href="../php/login.php">Login</a>.</p>
                </form>
                <script>
                    document.getElementById('vendedor').addEventListener('change', function () {
                        var camposVendedor = document.getElementById('camposVendedor');
                        camposVendedor.style.display = this.checked ? 'block' : 'none';
                    });
                </script>

            </div>
        </div>
        </div>
    </main>

    <!-- Rodapé -->

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