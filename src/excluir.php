<?php
include 'conexao.php';

if (!isset($_POST['id']) || empty($_POST['id'])) {
    header('Location: ../index.php');
    exit;
}

$id = (int) $_POST['id'];

$sql = "DELETE FROM medicamentos WHERE id = :id";

$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

header('Location: ../index.php');
exit;
?>