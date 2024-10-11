<?php
include '../confing/conexao.php';  

// Verifica se o ID foi passado via GET e é numérico
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Escapa o valor do ID para evitar SQL Injection
    $id = $conn->real_escape_string($id);

    // Consulta para obter os detalhes da notícia
    $query = "SELECT * FROM noticias WHERE id = $id";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $noticia = $result->fetch_assoc();
    } else {
        echo "Notícia não encontrada.";
        exit;
    }
} else {
    echo "ID de notícia inválido ou não fornecido.";
    exit;
}

// Função para retornar a cor baseada no status
function getStatusBadgeColor($status) {
    switch ($status) {
        case 'publicada':
            return '#28a745';  // Verde para publicada
        case 'arquivada':
            return '#343a40';  // Azul escuro para arquivada
        case 'rascunho':
            return '#dc3545';  // Vermelho para rascunho
        default:
            return '#6c757d';  // Cor padrão para status desconhecido
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../uploads/jornall.png" type="image/x-icon">
    <title><?php echo $noticia['titulo']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .noticia-titulo {
            font-size: 2.8rem;
            font-weight: bold;
            color: #343a40;
            margin-bottom: 20px;
            text-align: center;
        }
        .noticia-autor, .noticia-data {
            color: #6c757d;
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 5px;
        }
        .noticia-conteudo {
            margin-top: 30px;
            font-size: 1.1rem;
            line-height: 1.7;
            color: #495057;
            text-align: justify;
        }
        .categoria-badge {
            background-color: #007bff;
        }
        .status-badge {
            padding: 8px 25px;
            color: white;
            border-radius: 20px;
            font-size: 0.95rem;
            font-weight: 600;
            background-color: <?php echo getStatusBadgeColor($noticia['status']); ?>;
        }
        .noticia-imagem {
            width: 100%;
            height: auto;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .noticia-imagem img {
            width: 100%;
            border-radius: 10px;
        }
        .noticia-atualizacao {
            margin-top: 20px;
            font-size: 0.9rem;
            color: #868e96;
            text-align: center;
        }
        .voltar-btn {
            display: block;
            margin-top: 30px;
            text-align: center;
        }
        .voltar-btn a {
            text-decoration: none;
            color: #fff;
            background-color: #343a40;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .voltar-btn a:hover {
            background-color: #495057;
        }

        /* Flex container para categoria e status */
        .categoria-status-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }
        .categoria-badge {
            padding: 8px 25px;
            color: white;
            border-radius: 20px;
            font-size: 0.95rem;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="noticia-titulo"><?php echo $noticia['titulo']; ?></div>
        <div class="noticia-autor">Por <?php echo $noticia['autor']; ?></div>
        <div class="noticia-data">Publicado em <?php echo date('d/m/Y', strtotime($noticia['data_publicacao'])); ?></div>
        
        <!-- Flex container para categoria e status -->
        <div class="categoria-status-container">
            <div class="categoria-badge"><?php echo $noticia['categoria']; ?></div>
            <div class="status-badge"><?php echo ucfirst($noticia['status']); ?></div>
        </div>

        <div class="noticia-imagem">
            <?php if (!empty($noticia['imagem'])): ?>
                <img src="../uploads/<?php echo $noticia['imagem']; ?>" alt="Imagem da notícia">
            <?php else: ?>
                <p>Sem imagem disponível</p>
            <?php endif; ?>
        </div>
        
        <div class="noticia-conteudo">
            <?php echo nl2br($noticia['corpo']); ?>
        </div>

        <div class="noticia-atualizacao">Última atualização: <?php echo date('d/m/Y H:i', strtotime($noticia['data_atualizacao'])); ?></div>
        <div class="voltar-btn">
            <a href="index.php">Voltar</a>
        </div>
    </div>

</body>
</html>
