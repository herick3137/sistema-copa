<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Elenco</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f1f5f9;
            padding: 20px;
            display: flex;
            justify-content: center;
            background-image: url('assets/camisas_adidas.jpg.webp');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .container {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 700px;
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 10px;

        }

        .form-add {
            background: #f8fafc;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            display: grid;
            grid-template-columns: 1fr 1fr 80px 100px;
            gap: 10px;
            background: rgba(255, 255, 255, 0.0000001);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        input {
            padding: 8px;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
        }

        button {
            background: #10b981;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: rgba(255, 255, 255, 0.0000001);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        th {
            text-align: left;
            padding: 10px;
            background: #f1f5f9;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #f1f5f9;
        }

        .btn-excluir {
            color: #ef4444;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.8rem;
        }

        .btn-editar {
            color: #efba1d;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.8rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Elenco da Seleção</h2>
            <a href="index.php" style="text-decoration:none;">⬅ Voltar</a>
        </div>

        <form class="form-add" method="POST" action="index.php?action=salvar_jogador">
            <input type="hidden" name="selecao_id" value="<?= $_GET['id'] ?>">
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="text" name="posicao" placeholder="Posição" required>
            <input type="number" name="numero" placeholder="Nº" required>
            <button type="submit">Adicionar</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Posição</th>
                    <th>Número</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jogadores as $jogador): ?>
                    <tr>
                        <td><?= $jogador['nome'] ?></td>
                        <td><?= $jogador['posicao'] ?></td>
                        <td><strong><?= $jogador['numero'] ?></strong></td>
                        <td>
                            <a  class="btn-editar"
                                href="index.php?action=editar_jogador&id=<?= $jogador['id'] ?>&selecao_id=<?= $_GET['id'] ?>">
                                Editar
                            </a>

                            <br>
                            
                            <a class="btn-excluir"
                                href="index.php?action=excluir_jogador&id=<?= $jogador['id'] ?>&selecao_id=<?= $_GET['id'] ?>">
                                Excluir
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>