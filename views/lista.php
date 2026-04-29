<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Seleções</title>
    <link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1e293b;
            --secondary: #2366d2;
            --accent: #0b8a60;
            --danger: #d62c2c;
            --bg: #f8fafc;
            --text: #334155;
            --white: #ffffff;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg);
            color: var(--text);
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-image: url('assets/trofeu-da-copa-do-mundo-1600x900.webp');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* --- Dashboard --- */
        .dashboard {
            background: rgba(30, 41, 59, 0.35);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);

            color: var(--white);
            border-radius: 12px;
            width: 100%;
            max-width: 900px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .dashboard h2 {
            margin-top: 0;
            font-size: 1.5rem;
            border-bottom: 2px solid var(--secondary);
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .bloco {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .card-stats {
            background: rgba(255, 255, 255, 0.1);
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }

        .card-stats h3 {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            color: #94a3b8;
        }

        .card-stats p {
            font-size: 2rem;
            font-weight: bold;
            margin: 0;
            color: var(--secondary);
        }

        .grupo-list {
            font-size: 0.85rem;
            text-align: left;
            max-height: 100px;
            overflow-y: auto;
        }

        /* --- Tabela e Conteúdo --- */
        .selecoes {
            width: 100%;
            max-width: 900px;

            background: rgba(255, 255, 255, 0.30);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);

            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .selecoes h1 {
            margin-top: 0;
            color: var(--primary);
        }

        .btn-cadastrar {
            display: inline-block;
            background-color: var(--accent);
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 20px;
            transition: opacity 0.2s;
        }

        .btn-cadastrar:hover {
            opacity: 0.9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background-color: #f1f5f9;
            text-align: left;
            padding: 12px;
            color: var(--primary);
            font-weight: 600;
            border-bottom: 2px solid #e2e8f0;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
        }

        tr:hover {
            background-color: #f8fafc;
        }

        /* --- Ações --- */
        .acoes-links a {
            text-decoration: none;
            font-size: 0.85rem;
            margin-right: 10px;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: 600;
        }

        .btn-elenco {
            color: var(--secondary);
            border: 1px solid var(--secondary);
        }

        .btn-editar {
            color: orange;
            border: 1px solid orange;
        }

        .btn-deletar {
            color: var(--danger);
            border: 1px solid var(--danger);
        }

        .acoes-links a:hover {
            background-color: currentColor;
            color: white;
        }

        .selecoes td{
            color: #0a0f21;
        }
    </style>
</head>

<body>

    <form method="GET" action="index.php" style="margin-bottom:15px;">
        <input
            type="text"
            name="pesquisa"
            placeholder="Pesquisar seleção..."
            value="<?= $_GET['pesquisa'] ?? '' ?>"
            style="
            padding:8px;
            width:250px;
            border-radius:6px;
            border:1px solid #ccc;
        ">

        <button type="submit" class="btn-cadastrar">
            Pesquisar
        </button>
    </form>

    <div style="margin-bottom:15px;">
        <a href="index.php" class="btn-cadastrar">Todos</a>

        <?php foreach (range('A', 'H') as $g): ?>
            <a href="index.php?grupo=<?= $g ?>" class="btn-cadastrar">
                Grupo <?= $g ?>
            </a>
        <?php endforeach; ?>
    </div>

    <div style="margin-bottom:15px;">
        <a href="index.php?ordem=desc" class="btn-cadastrar">
            🏆 Mais títulos
        </a>

        <a href="index.php?ordem=asc" class="btn-cadastrar">
            🏆 Menos títulos
        </a>
    </div>

    <div class="dashboard">
        <h2>Dashboard de Controle</h2>
        <div class="bloco">
            <div class="card-stats">
                <h3>Total de Seleções</h3>
                <p><?= $totalSelecoes['total'] ?></p>
            </div>

            <div class="card-stats">
                <h3>Total de Títulos</h3>
                <p><?= $totalTitulos['total'] ?? 0 ?></p>
            </div>

            <div class="card-stats">
                <h3>Por Grupo</h3>
                <div class="grupo-list">
                    <?php foreach ($porGrupo as $grupo): ?>
                        <div><strong><?= $grupo['grupo'] ?>:</strong> <?= $grupo['total'] ?> times</div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="selecoes">
        <h1>Seleções da Copa</h1>
        <a href="index.php?action=criar" class="btn-cadastrar">+ Cadastrar Nova Seleção</a>

        <table>
            <thead>
                <tr>
                    <th>Bandeira</th>
                    <th>Nome</th>
                    <th>Grupo</th>
                    <th>Títulos</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($selecoes as $selecao): ?>
                    <tr>
                        <td>
                            <img src="<?= $selecao['bandeira'] ?>" width="50">
                        </td>
                        <td><strong><?= $selecao['nome'] ?></strong></td>
                        <td>Grupo <?= $selecao['grupo'] ?></td>
                        <td>🏆 <?= $selecao['titulos'] ?></td>
                        <td class="acoes-links">
                            <a href="index.php?action=elenco&id=<?= $selecao['id'] ?>" class="btn-elenco">Elenco</a>
                            <a href="index.php?action=editar&id=<?= $selecao['id'] ?>" class="btn-editar">Editar</a>
                            <a href="index.php?action=deletar&id=<?= $selecao['id'] ?>" class="btn-deletar" onclick="return confirm('Tem certeza?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>

</html>