<?php

include_once("../php/sessionvendedor.php");

include_once("../php/conexao.php");


// Verifica se o vendedor está autenticado
if (!isset($_SESSION['email_vendedor'])) {
    header("Location: ../php/login.php");
    exit;
}

$emailVendedor = $_SESSION['email_vendedor'];

// Consulta SQL para obter os produtos do vendedor logado
$sql = "SELECT * FROM produtos WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $emailVendedor);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    echo "Erro na consulta: " . $stmt->error;
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/HomePage.css">
    <link rel="stylesheet" href="../css/telavendedor.css">
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
            <a href="../php/logout.php"> <button class="button" type="button">Sair</button></a>
            <a href="../php/cadastroprodutohtml.php">Cadastrar Produto</a>
            <a href="#sobre">Sobre</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </header>
    <main>
        <p></p>
        </br>
        <h1>Seus produtos:</h1>

        <table class="tabela">
            <?php
            if ($result->num_rows > 0) {
                // Exibe os produtos em uma tabela
                echo "<table>";
                echo "<tr><th>Nome do Produto</th><th>Descrição</th><th>Preço</th><th>Ações</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['nome_produto'] . "</td>";
                    echo "<td>" . $row['descricao'] . "</td>";
                    echo "<td>R$ " . $row['preco'] . "</td>";
                    echo "<td>";
                    echo "<form method='POST' action='apagarproduto.php' style='display: inline;'>";
                    echo "<input type='hidden' name='produto_id' value='" . $row['id'] . "'>";
                    echo "<button type='submit'>Apagar</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "Nenhum produto cadastrado.";
            }

            $stmt->close();
            $conn->close();
            ?>

        </table>
    </main>
    <footer>
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
    </footer>
    <script src="../js/HomePage.js"></script>
</body>

</html>