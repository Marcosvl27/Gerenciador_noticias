<?php

class Noticias {
    // Atributos da classe
    private $titulo;
    private $corpo;
    private $data_publicacao;
    private $autor;
    private $categoria;
    private $status;
    private $imagem;

    // Métodos Setters e Getters para os atributos
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }
    
    public function getTitulo() {
        return $this->titulo;
    }
    
    public function setCorpo($corpo) {
        $this->corpo = $corpo;
    }
    
    public function getCorpo() {
        return $this->corpo;
    }
    
    public function setData_publicacao($data_publicacao) {
        $this->data_publicacao = $data_publicacao;
    }
    
    public function getData_publicacao() {
        return $this->data_publicacao;
    }
    
    public function setAutor($autor) {
        $this->autor = $autor;
    }
    
    public function getAutor() {
        return $this->autor;
    }
    
    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }
    
    public function getCategoria() {
        return $this->categoria;
    }
    
    public function setStatus($status) {
        $this->status = $status;
    }
    
    public function getStatus() {
        return $this->status;
    }
    
    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }
    
    public function getImagem() {
        return $this->imagem;
    }

    // Método para gravar uma nova notícia
    public function gravar() {
        include "../confing/conexao.php"; // Inclui a conexão com o banco de dados
        
        // Comando SQL para inserir uma nova notícia
        $sql = "INSERT INTO noticias (titulo, corpo, data_publicacao, autor, categoria, status, imagem)
                VALUES ('$this->titulo', '$this->corpo', '$this->data_publicacao', '$this->autor', '$this->categoria', '$this->status', '$this->imagem')";
        
        // Executa a query e retorna mensagem de sucesso ou erro
        if (mysqli_query($conn, $sql)) {
            return "Gravado com sucesso!";
        } else {
            return 'Erro na tabela noticias: ' . mysqli_error($conn);
        }
    }

    // Método para atualizar uma notícia existente
    public function atualizar($id) {
        include "../confing/conexao.php"; // Inclui a conexão com o banco de dados
    
        // Comando SQL para atualizar uma notícia existente
        $sql = "UPDATE noticias 
                SET titulo = '$this->titulo', 
                    corpo = '$this->corpo', 
                    data_publicacao = '$this->data_publicacao', 
                    autor = '$this->autor', 
                    categoria = '$this->categoria', 
                    status = '$this->status', 
                    imagem = '$this->imagem' 
                WHERE id = $id";
        
        // Executa a query e retorna mensagem de sucesso ou erro
        if (mysqli_query($conn, $sql)) {
            return "Atualizado com sucesso!";
        } else {
            return 'Erro ao atualizar a notícia: ' . mysqli_error($conn);
        }
    }
}

?>
