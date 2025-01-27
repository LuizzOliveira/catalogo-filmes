<?php

// classe Model que representa a tabela filme no db
class Filme
{
    private $table = "filme";

    private $conn;

    // colunas da tabela
    public $id;
    public $genero;
    public $titulo;
    public $ano;
    public $descricao;
    public $link_img;
    public $link_trailer;

    // parâmetro de connexão opcional
    public function __construct($conn = null)
    {
        $this->conn = $conn;
    }

    // método responsável por buscar todos os filmes
    public function findAll()
    {
        $query = "SELECT * FROM $this->table";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, __CLASS__);

        return $stmt->fetchAll();
    }

    // método responsável por buscar 1 o filme
    public function findById($id)
    {
        $query = "SELECT * FROM $this->table
            WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        // Configurando o PDO para comparar inteiros
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        // configura o PDO para retornar uma instância da classe
        // como resultado da consulta.
        $stmt->setFetchMode(PDO::FETCH_CLASS, __CLASS__);

        return $stmt->fetch();
    }

    // método para excluir filme por id
    public function delete($id)
    {
        $query = "DELETE FROM $this->table 
            WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    // método para inserir um filme
    public function insert($genero,$titulo, $ano, $descricao,$link_img, $link_trailer)
    {
        $query = "INSERT INTO $this->table (genero,titulo, ano, descricao,link_img,link_trailer)
            values (:genero,:titulo, :ano, :descricao,:link_img,:link_trailer)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":genero", $genero);
        $stmt->bindParam(":titulo", $titulo);
        $stmt->bindParam(":ano", $ano);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":link_img", $link_img);
        $stmt->bindParam(":link_trailer", $link_trailer);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function update($id,$genero,$titulo, $ano, $descricao,$link_img, $link_trailer) {
        $query = "UPDATE $this->table SET
            genero = :genero,
            titulo = :titulo,
            ano = :ano,
            descricao = :descricao,
            link_img = :link_img,
            link_trailer = :link_trailer
            WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":genero", $genero);
        $stmt->bindParam(":titulo", $titulo);
        $stmt->bindParam(":ano", $ano);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":link_img", $link_img);
        $stmt->bindParam(":link_trailer", $link_trailer);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

}