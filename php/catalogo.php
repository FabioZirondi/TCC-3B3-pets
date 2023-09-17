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
        <link href="https://fonts.googleapis.com/css2?family=Dosis&family=Montserrat:wght@100;200&display=swap" rel="stylesheet">
        <title>Catálogo</title>
    </head>
    <script src="../js/HomePage.js"></script>
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
    </br><?php  
    include '../php/conexao.php';

    // terminar a tela de catalogo depois que fizer a tabela de produtos
    echo"<div class='card'>";
    echo "<img src='../img/servicobanho.jpg' alt='Denim Jeans' style='width:100%'>";
    echo "<h1>Tailored Jeans</h1>";
    echo "<p>Some text about the jeans. Super slim and comfy lorem ipsum lorem jeansum. Lorem jeamsun denim lorem jeansum.</p>";
    echo "<p class='price'>R$19.99</p>";
    echo "<p><button>Add to Cart</button></p>";
    echo "</div>"
    ?>
    
      <!--
      
                include 'conexao.php';

                // Consulta SQL para obter os dados dos produtos
                $sql = "SELECT * FROM produto";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<th scope='row'>" . $row['codprod'] . "</th>";
                        echo "<td>" . $row['descricao'] . "</td>";
                        echo "<td>" . $row['categoria'] . "</td>";
                        echo "<td>" . $row['quantidade'] . "</td>";
                        echo "<td>" . $row['preco'] . "</td>";
                        echo "<td>";
                        echo "<a href='telaeditar.php?codprod=" . $row['codprod'] . "' class='btn btn-success'><i class='bi bi-pencil'></i></a>";
                        echo "<a href='apagar.php?codprod=" . $row['codprod'] . "' class='btn btn-danger'><i class='bi bi-trash'></i></a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Nenhum produto cadastrado.</td></tr>";
                }

                $conn->close();
                
                -->
                
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