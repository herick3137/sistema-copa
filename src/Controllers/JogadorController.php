<?php

namespace Res0144783\CopaDoMundo\Controllers;

use Res0144783\CopaDoMundo\Models\Jogador;
use Res0144783\CopaDoMundo\Config\Database;
use PDO;

class JogadorController
{

    private $db;
    private $jogador;

    public function __construct()
    {

        $database = new Database();
        $this->db = $database->getConnection();

        $this->jogador = new Jogador($this->db);
    }

    // listar elenco
    public function elenco($selecao_id)
    {

        $this->jogador->selecao_id = $selecao_id;

        $jogadores = $this->jogador->readBySelecao();

        require './views/elenco.php';
    }

    // salvar jogador
    public function salvar()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $this->jogador->nome = $_POST['nome'];
            $this->jogador->posicao = $_POST['posicao'];
            $this->jogador->numero = $_POST['numero'];
            $this->jogador->selecao_id = $_POST['selecao_id'];

            if ($this->jogador->create()) {
                header("Location: index.php?action=elenco&id=" . $_POST['selecao_id']);
                exit;
            }
        }
    }

    // excluir jogador
    public function excluir($id, $selecao_id)
    {

        $this->jogador->id = $id;

        if ($this->jogador->delete()) {
            header("Location: index.php?action=elenco&id=" . $selecao_id);
            exit;
        }
    }

    public function editar($id)
    {
        $query = "SELECT * FROM jogadores WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $jogador = $stmt->fetch(PDO::FETCH_ASSOC);

        require __DIR__ . '/../../views/editar_jogador.php';
    }

    public function atualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $this->jogador->id = $_POST['id'];
            $this->jogador->nome = $_POST['nome'];
            $this->jogador->posicao = $_POST['posicao'];
            $this->jogador->numero = $_POST['numero'];

            $selecao_id = $_POST['selecao_id'];

            if ($this->jogador->update()) {
                header("Location: index.php?action=elenco&id=" . $selecao_id);
            }
        }
    }
}
