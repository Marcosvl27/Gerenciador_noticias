<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Notícias</title> 
    <link rel="shortcut icon" href="../uploads/jornall.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Botão para voltar à página anterior -->
    <div class="voltar-btn">
        <a href="../read/index.php">Voltar</a>
    </div>

    <div class="container mt-5">
        <h2>Cadastro de Notícias</h2>
        <form action="processa_noticia.php" method="POST" enctype="multipart/form-data">
            <!-- Título -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>

            <!-- Corpo da notícia -->
            <div class="mb-3">
                <label for="corpo" class="form-label">Corpo da Notícia</label>
                <textarea class="form-control" id="corpo" name="corpo" rows="5" required></textarea>
            </div>

            <!-- Data de publicação -->
            <div class="mb-3">
                <label for="data_publicacao" class="form-label">Data de Publicação</label>
                <input type="date" class="form-control" id="data_publicacao" name="data_publicacao" required>
            </div>

            <!-- Autor -->
            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" class="form-control" id="autor" name="autor" required>
            </div>

            <!-- Categoria -->
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-select" id="categoria" name="categoria" required>
                    <option value="">Escolha uma categoria</option>
                    <option value="Esportes">Esportes</option>
                    <option value="Política">Política</option>
                    <option value="Tecnologia">Tecnologia</option>
                    <option value="Entretenimento">Entretenimento</option>
                    <option value="Geral">Geral</option>
                </select>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="rascunho">Rascunho</option>
                    <option value="publicada">Publicada</option>
                    <option value="arquivada">Arquivada</option>
                </select>
            </div>

            <!-- Imagem destacada -->
            <div class="mb-3">
                <label for="imagem" class="form-label">Imagem Destacada</label>
                <input class="form-control" type="file" id="imagem" name="imagem" accept="image/*">
            </div>

            <!-- Botão de envio -->
            <button type="submit" class="btn btn-primary">Cadastrar Notícia</button>
        </form>
    </div>

    <!-- Scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Estilo personalizado -->
    <style>
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
    </style>
</body>
</html>
