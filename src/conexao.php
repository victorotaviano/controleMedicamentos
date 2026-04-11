<?php

$host = "localhost";
$port = "5432";
$db   = "controleMedicamentos";
$user = "postgres";
$pass = "senha";

try {
    $conexao = new PDO(
        "pgsql:host=$host;port=$port;dbname=$db",
        $user,
        $pass
    );

    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
    exit;
}