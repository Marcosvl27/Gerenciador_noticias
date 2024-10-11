<?php
// Configurações de conexão com o banco de dados
$host = "localhost";   // Endereço do servidor MySQL
$usuario = "root";     // Nome de usuário do MySQL
$senha = "";           // Senha do MySQL (no caso, sem senha)
$banco = "jornal";     // Nome do banco de dados a ser utilizado

// Criação da conexão com o MySQL utilizando o mysqli
$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica se houve erro na conexão
if (!$conn) {
    // Exibe uma mensagem de erro com o número e descrição do erro
    echo "Não foi possível conectar ao MySQL. Erro #" . mysqli_connect_errno() . " : " . mysqli_connect_error();
} else {
    // Caso a conexão seja bem-sucedida, pode-se adicionar código aqui
 
}

// Define o charset da conexão como UTF-8 para evitar problemas de codificação de caracteres
$charset = $conn->set_charset('utf8');
?>
