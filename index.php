<?php

require_once __DIR__ . '/vendor/autoload.php';

use Res0144783\CopaDoMundo\Controllers\SelecaoController;
use Res0144783\CopaDoMundo\Controllers\JogadorController;

$app = new SelecaoController();
$jogador = new JogadorController();

$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($action === 'atualizar') {
        $app->atualizarDados();
    } 
    elseif ($action === 'salvar_jogador') {
        $jogador->salvar();
    }
    elseif ($action === 'atualizar_jogador') {
        $jogador->atualizar();
    }
    else {
        $app->salvar();
    }

} else {

    switch ($action) {

        case 'criar':
            require './views/create.php';
        break;

        case 'editar':
            $app->editar($id);
        break;

        case 'deletar':
            $app->deletar($id);
        break;

        case 'elenco':
            $jogador->elenco($id);
        break;

        case 'excluir_jogador':
            $selecao_id = $_GET['selecao_id'];
            $jogador->excluir($id, $selecao_id);
        break;

        case 'editar_jogador':
            $jogador->editar($id);
        break;

        default:
            $app->index();
        break;
    }
}