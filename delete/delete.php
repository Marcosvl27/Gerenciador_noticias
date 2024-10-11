<?php
// Define o cabeçalho como JSON para resposta ao usuario
header('Content-Type: application/json');

// Verifica se o método de requisição é GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Verifica se o ID foi enviado via GET
    if (isset($_GET['id'])) {
        // Obtém o ID da notícia a ser excluída da URL
        $id = $_GET['id'];

        // Arquivo de configuração para conexão com o banco de dados
        include "../confing/conexao.php";

        // Verifica se houve erro na conexão com o banco de dados
        if ($conn->connect_error) {
            // Retorna um JSON indicando erro de conexão
            echo json_encode(['success' => false, 'message' => 'Erro de conexão: ' . $conn->connect_error]);
            exit(); // Interrompe a execução do script
        }

        // Prepara a instrução SQL para excluir a notícia com o ID fornecido
        $stmt = $conn->prepare("DELETE FROM noticias WHERE id = ?");
        $stmt->bind_param("i", $id); // Vincula o parâmetro ID como um inteiro

        // Executa a instrução preparada e verifica se foi bem-sucedida
        if ($stmt->execute()) {
            // Retorna um JSON indicando sucesso na exclusão
            // Redireciona para a página de leitura
            header('Location: ../read/index.php');
            echo json_encode(['success' => true, 'message' => 'Notícia excluída com sucesso!']);
        } else {
            // Retorna um JSON indicando erro ao tentar excluir a notícia
            echo json_encode(['success' => false, 'message' => 'Erro ao excluir a notícia.']);
        }

        // Fecha a instrução e a conexão com o banco de dados
        $stmt->close();
        $conn->close();
    } else {
        // Retorna um JSON indicando que o ID não foi fornecido
        echo json_encode(['success' => false, 'message' => 'ID da notícia não foi fornecido.']);
    }
} else {
    // Retorna um JSON indicando que o método não é permitido
    echo json_encode(['success' => false, 'message' => 'Método não permitido. Método usado: ' . $_SERVER['REQUEST_METHOD']]);
}

?>
