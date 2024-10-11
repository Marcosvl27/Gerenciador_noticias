<?php
// Conectar ao banco de dados
include '../confing/conexao.php';

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capturar e escapar os dados do formulário para evitar injeção de SQL
    $id = isset($_POST['id']) ? mysqli_real_escape_string($conn, $_POST['id']) : '';
    $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($conn, $_POST['titulo']) : '';
    $corpo = isset($_POST['corpo']) ? mysqli_real_escape_string($conn, $_POST['corpo']) : '';
    $autor = isset($_POST['autor']) ? mysqli_real_escape_string($conn, $_POST['autor']) : '';
    $categoria = isset($_POST['categoria']) ? mysqli_real_escape_string($conn, $_POST['categoria']) : '';
    $data_publicacao = isset($_POST['data_publicacao']) ? mysqli_real_escape_string($conn, $_POST['data_publicacao']) : '';
    $status = isset($_POST['status']) ? mysqli_real_escape_string($conn, $_POST['status']) : '';

    // Verificar se uma nova imagem foi enviada
    if (!empty($_FILES['imagem']['name'])) {
        // Diretório de destino da imagem
        $target_dir = "../uploads/";
        // Caminho completo do arquivo com o nome da imagem
        $target_file = $target_dir . basename($_FILES["imagem"]["name"]);
        // Verificar o tipo do arquivo
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["imagem"]["tmp_name"]);
        
        if ($check !== false) {
            // Tentar mover a imagem para o diretório
            if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
                // Definir a nova imagem
                $imagem = $_FILES["imagem"]["name"];
            } else {
                echo "Erro ao fazer upload da imagem.";
                exit;
            }
        } else {
            echo "O arquivo enviado não é uma imagem válida.";
            exit;
        }
    } else {
        // Se nenhuma nova imagem for enviada, manter a imagem atual
        $sql = "SELECT imagem FROM noticias WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $imagem = $row['imagem'];
        }
    }

    // Incluir o arquivo de classe que contém a tabela Noticias
    include "../tabela/noticia.php";

    // Criar uma nova instância da classe Noticias
    $Noticias = new Noticias();

    // Definir os valores capturados no objeto Noticias
    $Noticias->setTitulo($titulo);
    $Noticias->setCorpo($corpo);
    $Noticias->setAutor($autor);
    $Noticias->setCategoria($categoria);
    $Noticias->setStatus($status);
    $Noticias->setImagem($imagem);  
    $Noticias->setData_publicacao($data_publicacao);

    // Chamar o método de atualização da classe Noticias, passando o ID da notícia
    $atualizado = $Noticias->atualizar($id);

    // Verificar se a atualização foi bem-sucedida
    if ($atualizado) {
    header('Location: ../read/index.php');
    } else {
        echo "Erro ao atualizar a notícia.";
    }
}

// Fechar a conexão com o banco de dados
mysqli_close($conn);
?>
