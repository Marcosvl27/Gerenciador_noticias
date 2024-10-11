<?php
// Conexão com o banco de dados
include '../confing/conexao.php';

// Capturar filtros
$pesquisa = isset($_GET['pesquisa']) ? mysqli_real_escape_string($conn, $_GET['pesquisa']) : '';
$categoria = isset($_GET['categoria']) ? mysqli_real_escape_string($conn, $_GET['categoria']) : '';
$status = isset($_GET['status']) ? mysqli_real_escape_string($conn, $_GET['status']) : '';
$data_publicacao = isset($_GET['data_publicacao']) ? mysqli_real_escape_string($conn, $_GET['data_publicacao']) : '';
// Consulta SQL com filtros
$sql = "SELECT id, titulo, autor, categoria, data_publicacao, status FROM noticias WHERE 1=1";

if (!empty($pesquisa)) {
    $sql .= " AND titulo LIKE '%$pesquisa%'";
}

if (!empty($categoria)) {
    $sql .= " AND categoria = '$categoria'";
}

if (!empty($status)) {
    $sql .= " AND status = '$status'";
}

if (!empty($data_publicacao)) {
    $sql .= " AND DATE(data_publicacao) = '$data_publicacao'";
}


$resultado = mysqli_query($conn, $sql);

// Verifica se encontrou resultados
if (mysqli_num_rows($resultado) > 0) {
    // Exibe cada linha de resultado como uma linha na tabela
    while ($noticia = mysqli_fetch_assoc($resultado)) {
        // Escapa as saídas para evitar injeção de HTML
        $id = htmlspecialchars($noticia['id']);
        $titulo = htmlspecialchars($noticia['titulo']);
        $autor = htmlspecialchars($noticia['autor']);
        $categoria = htmlspecialchars($noticia['categoria']);
        $data_publicacao = htmlspecialchars($noticia['data_publicacao']);
        $status = htmlspecialchars($noticia['status']);

        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$titulo</td>";
        echo "<td>$autor</td>";
        echo "<td>$categoria</td>";
        echo "<td>$data_publicacao</td>";
        echo "<td>$status</td>";
        echo "<td>
                <button class='btn btn-primary btn-sm' onclick=\"editarNoticia('$id')\"><i class='fas fa-edit'></i> Editar</button>
                <button class='btn btn-danger btn-sm' data-id='". $row['id'] ."' onclick=\"confirmarExclusao('$titulo', '$id')\"><i class='fas fa-trash'></i> Excluir</button>
               <a href='visualizar.php?id=". $id ."' class='btn btn-info btn-sm'>Visualizar</a>
                </td>";
        echo "</tr>";
    }
} else {
    // Se não houver notícias, exibe uma mensagem
    echo "<tr><td colspan='6'>Nenhuma notícia encontrada.</td></tr>";
}

// Fechar a conexão
mysqli_close($conn);
?>
