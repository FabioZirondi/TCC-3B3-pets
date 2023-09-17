<?php
include_once("../php/conexao.php");

//informações do produto
$nomeproduto = $_POST['nomeprod'];
$descricao = $_POST['desc'];
$preco = $_POST['preco'];

//imagem
$nome_imagem = $_FILES['imagem']['name'];
$tipo_imagem = $_FILES['imagem']['type'];
$tamanho_imagem = $_FILES['imagem']['size'];

$nomeproduto = mysqli_real_escape_string($conn, $nomeproduto);
$descricao = mysqli_real_escape_string($conn, $descricao);
$preco = mysqli_real_escape_string($conn, $preco);
$nome_imagem = mysqli_real_escape_string($conn, $nome_imagem);
$tipo_imagem = mysqli_real_escape_string($conn, $tipo_imagem);
$tamanho_imagem = mysqli_real_escape_string($conn, $tamanho_imagem);

if (empty($nomeproduto) || empty($descricao) || empty($preco) || empty($nome_imagem) || empty($tipo_imagem) || empty($tamanho_imagem)) {
    echo "Erro: Todos os campos obrigatórios devem estar preenchidos.";
    exit;
}

// Verificações de arquivo
$tipo_permitido = ['image/jpeg', 'image/png', 'image/gif']; // Tipos de arquivo permitidos
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
    // Verifica as dimensões da imagem
    list($largura, $altura) = getimagesize($_FILES['imagem']['tmp_name']);
    if ($largura > 750 || $altura > 480) {
        $erro = "Erro: A imagem excede as dimensões permitidas (750x480 pixels).";
        if (isset($erro)) {
            header("Location: ../php/cadastroprodutohtml.php?erro=" . urlencode($erro));
            exit;
        }
        
    } else {
        // Caminho onde a imagem será armazenada
        $caminho_imagem = "C:/imagemprodutos/" . basename($_FILES['imagem']['name']);

        // Salvar a imagem na pasta "imagemprodutos"
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_imagem)) {
            // Inserir informações da imagem no banco de dados
            $sql = "INSERT INTO produtos (nome_produto, descricao, preco, imagem_nome_uniq) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $nomeproduto, $descricao, $preco, $nome_imagem);

            if ($stmt->execute()) {
                $sucesso = "Imagem enviada com sucesso.";
                if (isset($sucesso)) {
                    header("Location: ../php/cadastroprodutohtml.php?erro=" . urlencode($sucesso));
                    exit;
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
            echo "Erro ao fazer o upload da imagem.";
        }
    }
}

$conn->close();
?>
