<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Editar Jogador</title>

<style>

body{
    font-family:'Segoe UI', sans-serif;
    background-image:url('assets/camisas_adidas.jpg.webp');
    background-size:cover;
    background-repeat:no-repeat;
    background-attachment:fixed;

    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.container{
    width:400px;
    padding:30px;
    border-radius:12px;

    background:rgba(255,255,255,0.25);
    backdrop-filter:blur(12px);
    -webkit-backdrop-filter:blur(12px);

    box-shadow:0 10px 25px rgba(0,0,0,0.3);
    border:1px solid rgba(255,255,255,0.2);
}

h2{
    margin-top:0;
    margin-bottom:20px;
    color:#1e293b;
}

label{
    font-size:14px;
    font-weight:600;
    color:#1e293b;
}

input{
    width:100%;
    padding:10px;
    margin-top:5px;
    margin-bottom:15px;
    border-radius:6px;
    border:1px solid rgba(0,0,0,0.1);

    background:rgba(255,255,255,0.6);
}

input:focus{
    outline:none;
    border-color:#3b82f6;
    box-shadow:0 0 0 2px rgba(59,130,246,0.2);
}

button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:6px;
    background:#3b82f6;
    color:white;
    font-weight:600;
    cursor:pointer;
    transition:0.2s;
}

button:hover{
    background:#2563eb;
}

.btn-voltar{
    display:block;
    text-align:center;
    margin-top:10px;
    text-decoration:none;
    color:#1e293b;
    font-size:14px;
}

</style>
</head>

<body>

<div class="container">

<h2>Editar Jogador</h2>

<form method="POST" action="index.php?action=atualizar_jogador">

<input type="hidden" name="id" value="<?= $jogador['id'] ?>">
<input type="hidden" name="selecao_id" value="<?= $_GET['selecao_id'] ?>">

<label>Nome</label>
<input type="text" name="nome" value="<?= $jogador['nome'] ?>" required>

<label>Posição</label>
<input type="text" name="posicao" value="<?= $jogador['posicao'] ?>" required>

<label>Número</label>
<input type="number" name="numero" value="<?= $jogador['numero'] ?>" required>

<button type="submit">Salvar Alterações</button>

</form>

<a class="btn-voltar" href="javascript:history.back()">⬅ Voltar</a>

</div>

</body>
</html>