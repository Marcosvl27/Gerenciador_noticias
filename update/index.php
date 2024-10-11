<?php
include "../confing/conexao.php";

$id_Noticia = $_GET['id'];
// Recupera a notícia com o ID fornecido
$sql = "SELECT * FROM `noticias` WHERE id = $id_Noticia";
$resultados = $conn->query($sql);
$row = $resultados->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Notícia</title>
    <link rel="shortcut icon" href="../uploads/jornall.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 700px;
            background-color: #fff;
            padding: 30px;
            margin-top: 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            margin-bottom: 20px;
            font-size: 28px;
            font-weight: bold;
            color: #343a40;
            text-align: center;
        }
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ced4da;
        }
        .mb-3 label {
            font-weight: bold;
            color: #343a40;
        }
        .form-section {
            background-color: #e9ecef;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }
        .form-section h4 {
            font-size: 20px;
            margin-bottom: 15px;
            color: #495057;
        }
        button[type="submit"] {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            border-radius: 50px;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        .form-section img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-top: 10px;
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


    </style>
</head>
<body>

<div class="container">
<div class="voltar-btn">
            <a href="../read/index.php">Voltar</a>
        </div>
    <h2>Atualizar Notícia</h2>
    <form action="atualizar.php" method="POST" enctype="multipart/form-data">
        <!-- ID oculto para enviar junto no POST -->
        <input type="hidden" name="id" value="<?= $id_Noticia ?>">

        <!-- Seção 1: Informações principais -->
        <div class="form-section">
   
            <h4>Informações Principais</h4>

            <!--Título -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" value="<?= $row['titulo'] ?>" class="form-control" id="titulo" name="titulo" required>
            </div>

            <!--Corpo -->
            <div class="mb-3">
                <label for="corpo" class="form-label">Corpo da Notícia</label>
                <textarea class="form-control" id="corpo" name="corpo" rows="5" required><?= $row['corpo'] ?></textarea>
            </div>
        </div>

        <!-- Seção 2: Detalhes adicionais -->
        <div class="form-section">
            <h4>Detalhes Adicionais</h4>

            <!--Data de Publicação -->
            <div class="mb-3">
                <label for="data_publicacao" class="form-label">Data de Publicação</label>
                <input type="date" class="form-control" id="data_publicacao" name="data_publicacao" value="<?= $row['data_publicacao'] ?>" required>
            </div>

            <!--Autor -->
            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" class="form-control" id="autor" name="autor" value="<?= $row['autor'] ?>" required>
            </div>

            <!--Categoria -->
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-select" id="categoria" name="categoria" required>
                    <option value="">Escolha uma categoria</option>
                    <option value="Esportes" <?= ($row['categoria'] == 'Esportes') ? 'selected' : '' ?>>Esportes</option>
                    <option value="Política" <?= ($row['categoria'] == 'Política') ? 'selected' : '' ?>>Política</option>
                    <option value="Tecnologia" <?= ($row['categoria'] == 'Tecnologia') ? 'selected' : '' ?>>Tecnologia</option>
                    <option value="Entretenimento" <?= ($row['categoria'] == 'Entretenimento') ? 'selected' : '' ?>>Entretenimento</option>
                    <option value="Geral" <?= ($row['categoria'] == 'Geral') ? 'selected' : '' ?>>Geral</option>
                </select>
            </div>

            <!--Status -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="rascunho" <?= ($row['status'] == 'rascunho') ? 'selected' : '' ?>>Rascunho</option>
                    <option value="publicada" <?= ($row['status'] == 'publicada') ? 'selected' : '' ?>>Publicada</option>
                    <option value="arquivada" <?= ($row['status'] == 'arquivada') ? 'selected' : '' ?>>Arquivada</option>
                </select>
            </div>
        </div>

        <!-- Seção 3: Imagem destacada -->
        <div class="form-section">
            <h4>Imagem Destacada</h4>

            <!--Imagem -->
            <div class="mb-3">
                <label for="imagem" class="form-label">Substituir Imagem (opcional)</label>
                <input class="form-control" type="file" id="imagem" name="imagem" accept="image/*">
            </div>
            
            <!-- Mostrar imagem atual -->
            <?php if (!empty($row['imagem'])): ?>
                <img src="../uploads/<?= $row['imagem'] ?>" alt="Imagem Destacada Atual">
            <?php endif; ?>
        </div>

        <!-- Botão de envio-->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Atualizar Notícia</button>
        </div>
    </form>
</div>

</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
