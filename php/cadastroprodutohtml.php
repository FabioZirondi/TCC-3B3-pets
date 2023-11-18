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
    <link rel="icon" href="../img/iconpet.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis&family=Montserrat:wght@100;200&display=swap"
        rel="stylesheet">
    <title>Cadastro Produto</title>
</head>

<body>
    <header>
        <div class="topnav" id="myTopnav">
            <a href="../index.php" class="active">PetVitrine</a>
            <a href="../php/logout.php"> <button class="button" type="button">Sair</button></a>
            <a href="../php/telavendedor.php">Tela vendedor</a>
            <a href="../php/catalogo.php">Catálogo</a>
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
                <h1>Cadastro de agendamentos</h1>
                <div class="mensagemdesucesso"><b>
                        <?php
                        if (isset($sucesso)) {
                            echo "<p>" . $sucesso . "</p>";
                        }
                        ?>
                </b></div>
                <div class="mensagemerro"><b>
                        <?php
                        if (isset($erro)) {
                            echo "<p>" . $erro . "</p>";
                        }
                        ?>
                    </b></div>
                <hr>

                <label for="nomeprod"><b>Título</b></label>
                <input type="text" placeholder="Título do agendamento" name="nomeprod" id="nomeprod" required>

                <label for="desc"><b>Descrição</b></label>
                <input type="text" placeholder="Descrição" name="desc" id="desc" required>

                <label for="preco"><b>Preço</b></label>
                <input type="number" placeholder="Preço" name="preco" id="preco" required>

                <label for="imagem"><b>Selecione uma imagem</b></label>
                <div class="custom-file-upload">
                    <input type="file" name="imagem" id="imagem" onclick="exibirmensagem()" accept="image/*" required>
                    <label for="imagem" id="fileLabel"><img src="../img/upload.png" alt="imagemUpload"> Escolher
                        Arquivo</label>
                </div>

                <p>Quais horários ficaram disponíveis?</p>

                <label for="dia"><b>Dia do agendamento</b></label>
                <input type="date" placeholder="Dia" name="dia" id="dia" required>

                <p>Horários</p>

                <label class="container-checkbox"><b>7:00</b>
                    <input type="checkbox" name="horarios[]" value="07:00">
                    <span class="checkmark"></span>
                </label>
                <label class="container-checkbox"><b>8:00</b>
                    <input type="checkbox" name="horarios[]" value="08:00">
                    <span class="checkmark"></span>
                </label>
                <label class="container-checkbox"><b>9:00</b>
                    <input type="checkbox" name="horarios[]" value="09:00">
                    <span class="checkmark"></span>
                </label>
                <label class="container-checkbox"><b>10:00</b>
                    <input type="checkbox" name="horarios[]" value="10:00">
                    <span class="checkmark"></span>
                </label>
                <label class="container-checkbox"><b>11:00</b>
                    <input type="checkbox" name="horarios[]" value="11:00">
                    <span class="checkmark"></span>
                </label>
                <label class="container-checkbox"><b>12:00</b>
                    <input type="checkbox" name="horarios[]" value="12:00">
                    <span class="checkmark"></span>
                </label>
                <label class="container-checkbox"><b>13:00</b>
                    <input type="checkbox" name="horarios[]" value="13:00">
                    <span class="checkmark"></span>
                </label>
                <label class="container-checkbox"><b>14:00</b>
                    <input type="checkbox" name="horarios[]" value="14:00">
                    <span class="checkmark"></span>
                </label>
                <label class="container-checkbox"><b>15:00</b>
                    <input type="checkbox" name="horarios[]" value="15:00">
                    <span class="checkmark"></span>
                </label>
                <label class="container-checkbox"><b>16:00</b>
                    <input type="checkbox" name="horarios[]" value="16:00">
                    <span class="checkmark"></span>
                </label>
                <label class="container-checkbox"><b>17:00</b>
                    <input type="checkbox" name="horarios[]" value="17:00">
                    <span class="checkmark"></span>
                </label>
                <label class="container-checkbox"><b>18:00</b>
                    <input type="checkbox" name="horarios[]" value="18:00">
                    <span class="checkmark"></span>
                </label>
                <label class="container-checkbox"><b>19:00</b>
                    <input type="checkbox" name="horarios[]" value="19:00">
                    <span class="checkmark"></span>
                </label>
                
                <button type="submit" class="registerbtn">Enviar</button>
            </form>
        </div>
    </main>
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
    <script src="../js/HomePage.js"></script>
</body>

</html>