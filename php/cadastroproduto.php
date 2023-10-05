<?php
session_start();

include_once("../php/conexao.php");

$sessionEmail = isset($_SESSION['email_vendedor']) ? $_SESSION['email_vendedor'] : '';

//busca o cod do vendedor para referenciar com os produtos
$codigoVendedor = $_SESSION['codigo_vendedor'];
$sessionEmail = $_SESSION['email_vendedor'];

// Informações do produto
$nomeproduto = $_POST['nomeprod'];
$descricao = $_POST['desc'];
$preco = $_POST['preco'];

// Imagem
$nome_imagem_original = $_FILES['imagem']['name'];
$tipo_imagem = $_FILES['imagem']['type'];
$tamanho_imagem = $_FILES['imagem']['size'];

//Horários 

$horarios = $_POST['horarios'];
$dia = $_POST['dia'];


$nomeproduto = mysqli_real_escape_string($conn, $nomeproduto);
$descricao = mysqli_real_escape_string($conn, $descricao);
$preco = mysqli_real_escape_string($conn, $preco);
$nome_imagem_original = mysqli_real_escape_string($conn, $nome_imagem_original);
$tipo_imagem = mysqli_real_escape_string($conn, $tipo_imagem);
$tamanho_imagem = mysqli_real_escape_string($conn, $tamanho_imagem);
$dia = mysqli_real_escape_string($conn, $dia);

if (empty($nomeproduto) || empty($descricao) || empty($preco) || empty($nome_imagem_original) || empty($tipo_imagem) || empty($tamanho_imagem)) {
    $erro = "Todos os campos obrigatórios devem estar preenchidos." . $stmt->error;
    header("Location: ../php/cadastroprodutohtml.php?erro=" . urlencode($erro));
    exit;
}

// Verificações de arquivo
$tipo_permitido = ['image/jpeg', 'image/png']; // Tipos de arquivo permitidos
$tamanho_maximo = 5 * 1024 * 1024; // Tamanho máximo de 5 MB (em bytes)

$tipo_imagem = $_FILES['imagem']['type'];
$tamanho_imagem = $_FILES['imagem']['size'];

// Verifica o tipo de arquivo
if (!in_array($tipo_imagem, $tipo_permitido)) {
    $erro = "Erro: Tipo de arquivo não permitido.";
    if (isset($erro)) {
        header("Location: ../php/cadastroprodutohtml.php?erro=" . urlencode($erro));
        exit;
    }
} elseif ($tamanho_imagem > $tamanho_maximo) {
    $erro = "Erro: O tamanho do arquivo excede o limite permitido.";
    if (isset($erro)) {
        header("Location: ../php/cadastroprodutohtml.php?erro=" . urlencode($erro));
        exit;
    }
} else {
    // Gere um nome único para a imagem
    $nome_imagem = uniqid() . '_' . $nome_imagem_original;

    // Verifique se o nome de imagem já existe no banco de dados
    $sql_verificar_imagem = "SELECT id FROM produtos WHERE imagem_nome_uniq = ?";
    $stmt_verificar_imagem = $conn->prepare($sql_verificar_imagem);
    $stmt_verificar_imagem->bind_param("s", $nome_imagem);
    $stmt_verificar_imagem->execute();
    $result_verificar_imagem = $stmt_verificar_imagem->get_result();

    if ($result_verificar_imagem->num_rows > 0) {
        $erro = "Erro: O nome da imagem já existe.";
        if (isset($erro)) {
            header("Location: ../php/cadastroprodutohtml.php?erro=" . urlencode($erro));
            exit;
        }
    }

    // Caminho onde a imagem será armazenada
    $caminho_imagem = "../imagemprodutos/" . $nome_imagem;

    // Salvar a imagem na pasta "imagemprodutos"
    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_imagem)) {
        // Inserir informações da imagem no banco de dados
        $sql = "INSERT INTO produtos (nome_produto, descricao, preco, imagem_nome_uniq, cod_vendedor, email) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssis", $nomeproduto, $descricao, $preco, $nome_imagem, $codigoVendedor, $sessionEmail);

        if ($stmt->execute()) {
            // Obtém o último ID inserido
            $ultimoID = mysqli_insert_id($conn);

            //CADASTRO DE HORÁRIOS
            $_SESSION['id_produto'] = $ultimoID;

            $sql_inserir_horario = "INSERT INTO horarios_disponiveis (id_produto, data_agendamento, horario, status) VALUES (?, ?, ?, 'D')";
            $stmt_inserir_horario = $conn->prepare($sql_inserir_horario);

            foreach ($_POST['horarios'] as $horario) {
                $stmt_inserir_horario->bind_param("iss", $ultimoID, $dia, $horario);
                $stmt_inserir_horario->execute();
            }

            $stmt_inserir_horario->close();
            $sucesso = "Informações enviadas com sucesso.";
            if (isset($sucesso)) {

                header("Location: ../php/cadastroprodutohtml.php?erro=" . urlencode($sucesso));
            }
        } else {
            $erro = "Erro ao enviar a imagem: " . $stmt->error;
            if (isset($erro)) {
                header("Location: ../php/cadastroprodutohtml.php?erro=" . urlencode($erro));
                exit;
            }
        }

        $stmt->close();
    } else {
        $erro = "Erro ao enviar a imagem: " . $stmt->error;
        if (isset($erro)) {
            header("Location: ../php/cadastroprodutohtml.php?erro=" . urlencode($erro));
            exit;
        }
    }
}


$conn->close();
?>