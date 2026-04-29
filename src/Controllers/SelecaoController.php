<?php

namespace Res0144783\CopaDoMundo\Controllers;

use Res0144783\CopaDoMundo\Models\Selecao;
use Res0144783\CopaDoMundo\Config\Database;

class SelecaoController
{

    private $db;
    private $selecao;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();

        $this->selecao = new Selecao($this->db);
    }

    public function index()
    {

        if (isset($_GET['ordem'])) {

            $selecoes = $this->selecao->ordenarPorTitulos($_GET['ordem']);
        } elseif (isset($_GET['grupo'])) {

            $selecoes = $this->selecao->filtrarPorGrupo($_GET['grupo']);
        } elseif (isset($_GET['pesquisa']) && !empty($_GET['pesquisa'])) {

            $selecoes = $this->selecao->pesquisar($_GET['pesquisa']);
        } else {

            $selecoes = $this->selecao->read();
        }

        $totalSelecoes = $this->selecao->totalSelecoes();
        $totalTitulos = $this->selecao->totalTitulos();
        $porGrupo = $this->selecao->selecoesPorGrupo();

        require './views/lista.php';
    }

    // Salvar
    public function salvar()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $dados = [
                'nome' => htmlspecialchars(trim($_POST['nome']), ENT_QUOTES, 'UTF-8'),
                'grupo' => htmlspecialchars(trim($_POST['grupo']), ENT_QUOTES, 'UTF-8'),
                'titulos' => htmlspecialchars(trim($_POST['titulos']), ENT_QUOTES, 'UTF-8'),
                'bandeira' => htmlspecialchars(trim($_POST['bandeira']), ENT_QUOTES, 'UTF-8')
            ];

            if (empty($dados['nome']) || empty($dados['grupo'])) {
                header("Location: index.php?status=erro&msg=Preencha todos os campos");
                exit;
            }

            if ($this->selecao->existe($dados['nome'])) {
                header("Location: index.php?status=erro&msg=Seleção já cadastrada");
                exit;
            }

            if ($this->selecao->create($dados)) {
                header("Location: index.php?status=sucesso");
                exit;
            } else {
                header("Location: index.php?status=erro&msg=Erro ao salvar");
                exit;
            }
        }
    }

    // Form cadastro
    public function criar()
    {
        require './views/cadastro.php';
    }

    // Editar
    public function editar($id)
    {

        $selecao = $this->selecao->readOne($id);

        if ($selecao) {
            require './views/edit.php';
        } else {
            header("Location: index.php?status=erro&msg=Seleção não encontrada");
        }
    }

    // Atualizar
    public function atualizarDados()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $dados = [
                'id' => (int) $_POST['id'],
                'nome' => htmlspecialchars(trim($_POST['nome']), ENT_QUOTES, 'UTF-8'),
                'grupo' => htmlspecialchars(trim($_POST['grupo']), ENT_QUOTES, 'UTF-8'),
                'titulos' => htmlspecialchars(trim($_POST['titulos']), ENT_QUOTES, 'UTF-8'),
                'bandeira' => htmlspecialchars(trim($_POST['bandeira']), ENT_QUOTES, 'UTF-8')
            ];

            if ($this->selecao->update($dados)) {
                header("Location: index.php?status=sucesso&msg=Atualizado!");
            } else {
                header("Location: index.php?status=erro&msg=Erro ao atualizar");
            }
        }
    }

    // Deletar
    public function deletar($id)
    {

        if ($this->selecao->delete($id)) {
            header("Location: index.php?status=sucesso&msg=Excluído!");
        } else {
            header("Location: index.php?status=erro&msg=Erro ao excluir");
        }
    }
}
