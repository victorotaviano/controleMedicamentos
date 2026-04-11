<?php
include 'conexao.php';

if (!isset($_POST['nome'], $_POST['horario']) || empty($_POST['nome']) || empty($_POST['horario'])) {
    header('Location: ../index.php');
    exit;
}

$nome = $_POST['nome'];
$horario = $_POST['horario'];
$data = !empty($_POST['data']) ? $_POST['data'] : null;

$sql = "INSERT INTO medicamentos (nome, horario, data) 
        VALUES (:nome, :horario, :data)";

$stmt = $conexao->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':horario', $horario);
$stmt->bindParam(':data', $data);

$stmt->execute();

header('Location: ../index.php');
exit;
?>