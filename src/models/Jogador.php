<?php

namespace Res0144783\CopaDoMundo\Models;

use PDO;

class Jogador
{

    private $conn;
    private $table = "jogadores";

    public $id;
    public $nome;
    public $posicao;
    public $numero;
    public $selecao_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // listar jogadores por seleção
    public function readBySelecao()
    {

        $query = "SELECT * FROM " . $this->table . " 
                  WHERE selecao_id = :selecao_id
                  ORDER BY numero ASC";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":selecao_id", $this->selecao_id);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // cadastrar jogador
    public function create()
    {

        $query = "INSERT INTO " . $this->table . "
                  (nome, posicao, numero, selecao_id)
                  VALUES (:nome, :posicao, :numero, :selecao_id)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":posicao", $this->posicao);
        $stmt->bindParam(":numero", $this->numero);
        $stmt->bindParam(":selecao_id", $this->selecao_id);

        return $stmt->execute();
    }

    // excluir jogador
    public function delete()
    {

        $query = "DELETE FROM " . $this->table . "
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    public function update()
    {
        $query = "UPDATE " . $this->table . "
              SET nome = :nome,
                  posicao = :posicao,
                  numero = :numero
              WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":posicao", $this->posicao);
        $stmt->bindParam(":numero", $this->numero);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }
}
