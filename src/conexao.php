<?php
$db_url = getenv('DATABASE_URL');

if ($db_url) {
    // O Render Blueprint envia como postgres://, o PHP precisa de pgsql:
    $dsn = str_replace('postgres://', 'pgsql:', $db_url);
    $user = null;
    $pass = null;
} else {
    $dsn = "pgsql:host=localhost;port=5432;dbname=controle_medicamentos_sja8";
    $user = "postgres";
    $pass = "senha";
}

try {
    $conexao = new PDO($dsn, $user, $pass);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<h1>Erro de Diagnóstico</h1>";
    echo "<b>Mensagem:</b> " . $e->getMessage() . "<br>";
    echo "<b>Drivers instalados no PHP do Render:</b> " . implode(", ", PDO::getAvailableDrivers()) . "<br>";
    echo "<hr>Se 'pgsql' não estiver na lista acima, o Dockerfile não foi lido.";
    exit;
}