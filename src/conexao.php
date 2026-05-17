<?php
$db_url = getenv('DATABASE_URL');

if ($db_url) {
    $dbopts = parse_url($db_url);
    $host = $dbopts["host"];
    $port = $dbopts["port"];
    $user = $dbopts["user"];
    $pass = $dbopts["pass"];
    $db   = ltrim($dbopts["path"], '/');
} else {
    $host = "localhost";
    $port = "5432";
    $db   = "controleMedicamentos";
    $user = "postgres";
    $pass = "senha"; 
}

try {
    $conexao = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit("Erro na conexão: " . $e->getMessage());
}