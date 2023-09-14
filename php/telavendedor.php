<?php
include_once("../php/sessionvendedor.php");
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
    <title>Tela vendedor</title>
</head>

<body>
<header>
        <div class="topnav" id="myTopnav">
            <a href="../php/HomePage.php" class="active">I-Pet</a>
            <a href="../php/login.php"> <button class="button" type="button">Login</button></a>
            <a href="../php/cadastroprodutos.php">Produtos</a>
            <a href="#sobre">Sobre</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </header>
    <script src="../js/HomePage.js"></script>
</body>

</html>