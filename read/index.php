<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../uploads/jornall.png" type="image/x-icon">
    <title>Visualizar Notícias</title>
    <script src="script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .container {
            margin-top: 50px;
        }

        .table-container {
            margin-top: 30px;
        }

        table tr:hover {
            background-color: #f5f5f5;
        }

        .modal-body {
            text-align: center;
        }

        .modal-footer {
            justify-content: center;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Notícias Cadastradas</h2>

        <!-- Filtros e Campo de Pesquisa -->
        <form method="GET" action="busca.php">
            <div class="row mb-4">
                <div class="col-md-4">
                    <input type="text" name="pesquisa" class="form-control" placeholder="Pesquisar por título">
                </div>
                <div class="col-md-3">
                    <select name="categoria" class="form-control">
                        <option value="">Filtrar por Categoria</option>
                        <option value="Tecnologia">Tecnologia</option>
                        <option value="Esportes">Esportes</option>
                        <option value="Entretenimento">Entretenimento</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-control">
                        <option value="">Filtrar por Status</option>
                        <option value="Rascunho">Rascunho</option>
                        <option value="Publicado">Publicado</option>
                        <option value="arquivada">Arquivado</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-4">
                    <input type="date" name="data_publicacao" class="form-control" placeholder="Data de Publicação">
                </div>
                <div class="col-md-2">
                    <a href="../create/index.php" class="btn btn-success w-100">Cadastrar Notícia</a>
                </div>
            </div>
        </form>

        <div class="table-container">
            <table class="table table-hover table-striped" id="tabelaNoticias">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Categoria</th>
                        <th>Data de Publicação</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="noticiasBody">
                    <!-- O conteúdo será carregado via AJAX -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal de Confirmação -->
    <div class="modal fade" id="confirmarExclusaoModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza de que deseja excluir esta notícia?</p>
                    <p id="noticiaTitulo"></p>
                    <p id="id"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btnExcluirConfirmado">Excluir</button>
                </div>
            </div>
        </div>
    </div>



    
    
    <script>
    $(document).ready(function () {
        // Função para carregar as notícias
        function carregaNoticias() {
            $('#noticiasBody').html('<tr><td colspan="6" class="text-center">Carregando...</td></tr>');
            $.ajax({
                url: 'busca.php',
                type: 'GET',
                data: $('form').serialize(),
                success: function (data) {
                    $('#noticiasBody').html(data);
                }
            });
        }

        // Carrega notícias ao abrir a página
        carregaNoticias();

        // Pesquisa instantânea
        $('input[name="pesquisa"], select[name="categoria"], select[name="status"], input[name="data_publicacao"]').on('change keyup', function () {
            carregaNoticias();
        });

        // Ação para o botão de excluir
        $(document).on('click', '.btnExcluir', function () {
            var id = $(this).data('id');  // Captura o ID da notícia
            var titulo = $(this).data('titulo');  // Captura o título da notícia

            $('#noticiaTitulo').text(titulo);  // Exibe o título na modal
            $('#btnExcluirConfirmado').data('id', id);  // Salva o ID no botão de confirmação

            $('#confirmarExclusaoModal').modal('show');  // Abre a modal
        });

        // Evento para o botão de confirmação de exclusão
        $('#btnExcluirConfirmado').click(function () {
            var idNoticiaParaExcluir = $(this).data('id'); // Captura o ID da notícia a partir do botão

            if (idNoticiaParaExcluir) {
                // Cria um objeto FormData para enviar os dados
                const formData = new FormData();
                formData.append('idNoticiaParaExcluir', idNoticiaParaExcluir);

                // Envia a requisição POST para o delete.php
                fetch('http://localhost/GERENCIADOR_NOTICIAS/delete/delete.php', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Recarrega a página para atualizar a lista
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Erro ao excluir a notícia:', error);
                    alert('Ocorreu um erro ao excluir a notícia.');
                });
            }
        });
    });
    </script>


</body>
</html>