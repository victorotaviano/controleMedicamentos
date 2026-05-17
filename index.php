<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

include "src/conexao.php";


$sql = "SELECT * FROM medicamentos ORDER BY horario";
$consulta = $conexao->query($sql);


$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    $sqlU = "SELECT * FROM medicamentos WHERE id = :id";
    $stmt = $conexao->prepare($sqlU);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $medicamento = $stmt->fetch(PDO::FETCH_OBJ);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Controle de Medicamentos</title>

<style>
:root {
    --verde-principal: #6bbf8f;
    --verde-hover: #4fa978;
    --verde-claro: #e8f5ee;
    --texto-principal: #1f2937;
    --texto-secundario: #4b5563;
    --borda: #d1d5db;
}


body {
    font-family: 'Segoe UI', sans-serif;
    background-color: var(--verde-claro);
    margin: 0;
    padding: 40px;
    color: var(--texto-principal);
}

.container {
    max-width: 900px;
    margin: auto;
}


.topo {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

h2 {
    font-weight: 600;
}


form {
    background: white;
    padding: 25px;
    border-radius: 12px;
    margin-bottom: 25px;
    border: 1px solid var(--borda);
}

label {
    font-size: 13px;
    color: var(--texto-secundario);
}

input {
    width: 100%;
    padding: 10px;
    margin: 6px 0 15px 0;
    border-radius: 8px;
    border: 1px solid var(--borda);
    outline: none;
}


input:focus {
    border-color: var(--verde-principal);
    box-shadow: 0 0 0 2px rgba(107,191,143,0.3);
}


button {
    background: var(--verde-principal);
    color: white;
    padding: 10px 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 500;
}

button:hover {
    background: var(--verde-hover);
}


table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid var(--borda);
}

th {
    text-align: left;
    padding: 12px;
    background-color: #f9fafb;
    color: var(--texto-secundario);
    font-weight: 600;
}

td {
    padding: 12px;
    border-top: 1px solid #f1f5f9;
}

tr:hover {
    background-color: #f3fdf7;
}


.acoes {
    display: flex;
    gap: 10px;
}

.btn-editar {
    color: var(--verde-principal);
    text-decoration: none;
    font-size: 14px;
}

.btn-excluir {
    background: #dc2626;
    font-size: 12px;
    padding: 6px 10px;
}

.btn-excluir:hover {
    background: #b91c1c;
}

.btn-sair {
    background: #374151;
    color: white;
    padding: 6px 12px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 13px;
}

.btn-sair:hover {
    background: #111827;
}
</style>
</head>

<body>

<div class="container">

<div class="topo">
    <h2><?php echo isset($id) ? "Editar Medicamento" : "Adicionar Medicamento"; ?></h2>
    <a href="logout.php" class="btn-sair">Sair</a>
</div>

<form method="POST" action="<?php echo isset($id) ? 'src/editar.php' : 'src/inserir.php'; ?>">

    <?php if ($id): ?>
        <input type="hidden" name="id" value="<?php echo $medicamento->id; ?>">
    <?php endif; ?>

    <label>Nome do medicamento</label>
    <input type="text" name="nome" required
        value="<?php echo isset($medicamento) ? $medicamento->nome : '' ?>">

    <label>Horário</label>
    <input type="time" name="horario" required
        value="<?php echo isset($medicamento) ? $medicamento->horario : '' ?>">

    <button type="submit">Salvar</button>
</form>

<table>
<tr>
    <th>Medicamento</th>
    <th>Horário</th>
    <th>Data</th>
    <th>Ações</th>
</tr>

<?php while ($linha = $consulta->fetch(PDO::FETCH_OBJ)) { ?>
<tr>
    <td><?php echo $linha->nome ?></td>
    <td><?php echo $linha->horario ?></td>
    <td><?php echo date('d/m/Y', strtotime($linha->data)) ?></td>

    <td class="acoes">

        <a class="btn-editar" href="index.php?id=<?php echo $linha->id; ?>">
            Editar
        </a>

        <form action="src/excluir.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $linha->id; ?>">
            <button class="btn-excluir" type="submit"
                onclick="return confirm('Tem certeza que deseja excluir?')">
                Excluir
            </button>
        </form>

    </td>
</tr>
<?php } ?>

</table>

</div>

<script>
document.getElementsByName('nome')[0].addEventListener('blur', function() {
    console.log("Validando conectividade com API externa...");
    
    fetch(`https://viacep.com.br/ws/01001000/json/`)
        .then(res => res.json())
        .then(data => {
            if(data.cep) {
                console.log("Integração ativa: Dados recebidos com sucesso.");
                alert("Conexão com API externa validada com sucesso!");
            }
        })
        .catch(err => console.error("Erro na API:", err));
});
</script>

</body>
</html>