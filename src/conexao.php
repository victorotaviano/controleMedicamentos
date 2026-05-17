<?php
$db_url = getenv('DATABASE_URL');

if ($db_url) {

    $dbopts = parse_url($db_url);
    
    $host = $dbopts["host"];

    $port = isset($dbopts["port"]) ? $dbopts["port"] : "5432";
    $user = $dbopts["user"];
    $pass = $dbopts["pass"];
    $db   = ltrim($dbopts["path"], '/');
    
    
    $dsn = "pgsql:host=$host;port=$port;dbname=$db";
} else {

    $dsn = "pgsql:host=localhost;port=5432;dbname=controleMedicamentos";
    $user = "postgres";
    $pass = "sua_senha_local";
}

try {
    $conexao = new PDO($dsn, $user, $pass);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit("Erro na conexão: " . $e->getMessage());
}