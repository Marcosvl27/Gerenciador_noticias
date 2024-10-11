    function editarNoticia(id) {
        window.location.href = "http://localhost/GERENCIADOR_NOTICIAS/update/index.php?id=" + id;
    }

    // Variáveis globais para armazenar a notícia e o ID
    var noticiaParaExcluir;
    var idNoticiaParaExcluir;

    // Função chamada ao clicar no botão de excluir
    function confirmarExclusao(titulo, id) {
        noticiaParaExcluir = titulo; // Armazena o título da notícia
        idNoticiaParaExcluir = id;   // Armazena o ID da notícia
    
        // Log para depuração
        console.log("Título da notícia:", noticiaParaExcluir);
        console.log("ID da notícia:", idNoticiaParaExcluir);
    
        // Atualiza o modal com o título e o ID
        
        document.getElementById('noticiaTitulo').innerText = `Notícia: ${titulo}`;
        
        document.getElementById('id').innerText = `ID: ${idNoticiaParaExcluir}`;
    
        // Exibe o modal de confirmação
        const excluirModal = new bootstrap.Modal(document.getElementById('confirmarExclusaoModal'));
        excluirModal.show();
    }
    

    // Evento para o botão de confirmação de exclusão
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('btnExcluirConfirmado').addEventListener('click', function () {
            if (idNoticiaParaExcluir) { 
                // Realiza a requisição assíncrona para o backend com o ID da notícia
                window.location.href = "http://localhost/GERENCIADOR_NOTICIAS/delete/delete.php?id=" + idNoticiaParaExcluir;
            }
        });
    });
    
