<?php
// Inclui a classe Noticias, que contém os métodos para manipulação de notícias
include '../tabela/noticia.php';

// Verifica se o método de requisição é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Criação de uma nova instância da classe Noticias
    $noticia = new Noticias();

    // Define os atributos da notícia com os dados recebidos do formulário
    $noticia->setTitulo($_POST['titulo']);
    $noticia->setCorpo($_POST['corpo']);
    $noticia->setData_publicacao($_POST['data_publicacao']);
    $noticia->setAutor($_POST['autor']);
    $noticia->setCategoria($_POST['categoria']);
    $noticia->setStatus($_POST['status']);

    // Verifica se um arquivo de imagem foi enviado sem erros
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $upload_dir = '../uploads/'; // Diretório onde a imagem será salva
        $imagem_nome = basename($_FILES['imagem']['name']); // Nome da imagem
        $upload_path = $upload_dir . $imagem_nome; // Caminho completo para o upload

        // Move o arquivo temporário para o diretório de upload
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $upload_path)) {
            // Define o caminho da imagem na notícia
            $noticia->setImagem($upload_path);
        } else {
            // Exibe uma mensagem de erro caso o upload falhe
            echo "Erro ao fazer upload da imagem.";
            exit; // Interrompe a execução do script
        }
    } else {
        // Se nenhuma imagem for enviada, define como nula
        $noticia->setImagem(null);
    }

    // Tenta gravar a notícia no banco de dados
    $resultado = $noticia->gravar();

    // Verifica se a gravação foi bem-sucedida
    if ($resultado == "Gravado com sucesso!") {
        // Redireciona para a página de leitura
        header('Location: ../read/index.php');
    } else {
        // Exibe uma mensagem de erro se a gravação falhar
        echo "<p>Erro ao cadastrar a notícia: " . $resultado . "</p>";
    }
} else {
    // Exibe uma mensagem se o método de requisição não for válido
    echo "Método de requisição inválido.";
}
?>
