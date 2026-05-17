<?php
$db_url = getenv('DATABASE_URL');

if ($db_url) {
    if (preg_match('/postgres:\/\/(.*?):(.*?)\@(.*?)(?::(\d+))?\/(.*)/', $db_url, $matches)) {
        $user = $matches[1];
        $pass = $matches[2];
        $host = $matches[3];
        $port = (!empty($matches[4])) ? $matches[4] : "5432";
        $db   = explode('?', $matches[5])[0];
        
        $dsn = "pgsql:host=$host;port=$port;dbname=$db";
    } else {
        exit("Erro: Formato de DATABASE_URL inválido.");
    }
} else {

    $dsn = "pgsql:host=localhost;port=5432;dbname=controleMedicamentos";
    $user = "postgres";
    $pass = "senha"; 
}

try {
    $conexao = new PDO($dsn, $user, $pass);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
   
    exit("Erro na conexão: " . $e->getMessage());
}