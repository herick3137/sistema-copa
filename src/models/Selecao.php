<?php

namespace Res0144783\CopaDoMundo\Models;

use PDO;

class Selecao
{
    private $conn;
    private $table = "selecoes";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // total de seleções
    public function totalSelecoes()
    {
        $query = "SELECT COUNT(*) as total FROM selecoes";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // soma dos títulos
    public function totalTitulos()
    {
        $query = "SELECT SUM(titulos) as total FROM selecoes";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // seleções por grupo
    public function selecoesPorGrupo()
    {
        $query = "SELECT grupo, COUNT(*) as total 
                  FROM selecoes 
                  GROUP BY grupo 
                  ORDER BY grupo";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // verificar duplicado
    public function existe($nome)
    {
        $query = "SELECT id FROM selecoes WHERE nome = :nome LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    // Read (listar)
    public function read()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY nome ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create (salvar)
    public function create($dados)
    {
        $query = "INSERT INTO " . $this->table . " 
                  (nome, grupo, titulos, bandeira) 
                  VALUES (:nome, :grupo, :titulos, :bandeira)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nome', $dados['nome']);
        $stmt->bindParam(':grupo', $dados['grupo']);
        $stmt->bindParam(':titulos', $dados['titulos']);
        $stmt->bindParam(':bandeira', $dados['bandeira']);

        return $stmt->execute();
    }

    // Update
    public function update($dados)
    {
        $query = "UPDATE " . $this->table . "
                  SET nome = :nome,
                      grupo = :grupo,
                      titulos = :titulos,
                      bandeira = :bandeira
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nome', $dados['nome']);
        $stmt->bindParam(':grupo', $dados['grupo']);
        $stmt->bindParam(':titulos', $dados['titulos']);
        $stmt->bindParam(':bandeira', $dados['bandeira']);
        $stmt->bindParam(':id', $dados['id']);

        return $stmt->execute();
    }

    // Read one (por ID)
    public function readOne($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ? LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Delete
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);

        return $stmt->execute();
    }

    public function buscarPorId($id)
    {
        $query = "SELECT * 
              FROM " . $this->table . " 
              WHERE id = :id 
              LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function pesquisar($termo)
    {
        $query = "SELECT * FROM " . $this->table . " 
              WHERE nome LIKE :termo 
              ORDER BY nome ASC";

        $stmt = $this->conn->prepare($query);

        $termo = "%{$termo}%";

        $stmt->bindParam(":termo", $termo);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function filtrarPorGrupo($grupo)
    {
        $query = "SELECT * 
              FROM " . $this->table . " 
              WHERE grupo = :grupo
              ORDER BY nome ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":grupo", $grupo);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ordenarPorTitulos($ordem = "DESC")
    {
        $query = "SELECT * 
              FROM " . $this->table . " 
              ORDER BY titulos " . $ordem;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
