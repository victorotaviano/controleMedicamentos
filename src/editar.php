<?php
include "conexao.php";

if (isset($_POST['id'], $_POST['nome'], $_POST['horario'])) {

    $id = (int) $_POST['id'];
    $nome = $_POST['nome'];
    $horario = $_POST['horario'];
    $data = !empty($_POST['data']) ? $_POST['data'] : null;

    $sql = "UPDATE medicamentos 
            SET nome = :nome, 
                horario = :horario, 
                data = :data 
            WHERE id = :id";

    $stmt = $conexao->prepare($sql);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':horario', $horario);
    $stmt->bindParam(':data', $data);
    $stmt->bindParam(':id', $id);

    $stmt->execute();
}

header('Location: ../index.php');
exit;
?>