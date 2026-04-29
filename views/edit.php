<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Gerenciar Seleção</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f1f5f9;
            display: flex;
            justify-content: center;
            padding: 220px;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background-image: url('assets/copa-do-mundo-de-2026-182141.avif');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: blur(5px);
            transform: scale(1.05);
            /* evita bordas sem blur */
            z-index: -1;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            color: #1e293b;
            margin-top: 0;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            background: #3b82f6;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            margin-top: 20px;
            cursor: pointer;
            font-weight: 600;
        }

        button:hover {
            background: #2563eb;
        }

        .btn-voltar {
            color: #64748b;
            text-decoration: none;
            font-size: 0.8rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="index.php" class="btn-voltar">⬅ Voltar para a lista</a>
        <h2><?= isset($selecao) ? 'Editar Seleção' : 'Nova Seleção' ?></h2>

        <form method="POST" action="index.php?action=<?= isset($selecao) ? 'atualizar' : 'salvar' ?>">
            <?php if (isset($selecao)): ?>
                <input type="hidden" name="id" value="<?= $selecao['id'] ?>">
            <?php endif; ?>

            <label>Nome:</label>
            <input type="text" name="nome" value="<?= $selecao['nome'] ?? '' ?>" required>

            <label>Grupo:</label>
            <input type="text" name="grupo" value="<?= $selecao['grupo'] ?? '' ?>" required>

            <label>Títulos:</label>
            <input type="number" name="titulos" value="<?= $selecao['titulos'] ?? 0 ?>" required>

            <label>Bandeira</label>
            <input type="text" name="bandeira" value="<?= $selecao['bandeira'] ?? '' ?>" required>

            <button type="submit">Salvar Dados</button>
        </form>
    </div>
</body>

</html>