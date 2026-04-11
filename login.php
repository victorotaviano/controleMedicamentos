<?php
session_start();
include "src/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario AND senha = :senha";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['usuario'] = $usuario;
        header("Location: index.php");
        exit;
    } else {
        $erro = "Usuário ou senha inválidos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Login</title>

<style>
:root {
    --verde-principal: #6bbf8f;
    --verde-hover: #4fa978;
    --verde-claro: #e8f5ee;
    --texto: #1f2937;
}

body {
    background-color: var(--verde-claro);
    font-family: 'Segoe UI', sans-serif;
    display: flex;
    height: 100vh;
    align-items: center;
    justify-content: center;
}

.login-box {
    background: white;
    padding: 30px;
    border-radius: 12px;
    width: 320px;
    border: 1px solid #d1d5db;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: var(--texto);
}

input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 8px;
    border: 1px solid #d1d5db;
}

input:focus {
    border-color: var(--verde-principal);
    box-shadow: 0 0 0 2px rgba(107,191,143,0.3);
}

button {
    width: 100%;
    padding: 10px;
    background: var(--verde-principal);
    color: white;
    border: none;
    border-radius: 8px;
}

button:hover {
    background: var(--verde-hover);
}

.erro {
    color: #dc2626;
    text-align: center;
}
</style>
</head>

<body>

<div class="login-box">
    <h2>Login</h2>

    <?php if (isset($erro)) echo "<p class='erro'>$erro</p>"; ?>

    <form method="POST">
        <input type="text" name="usuario" placeholder="Usuário" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>
</div>

</body>
</html>