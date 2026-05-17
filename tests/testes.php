<?php

echo "Rodando testes...\n\n";


$valor1 = 10;
$valor2 = 20;
$resultado = $valor1 + $valor2;

if ($resultado === 30) {
    echo "✔ Teste soma OK\n";
} else {
    echo "❌ Teste soma FALHOU\n";
}


$horario = "08:30";

if (preg_match("/^\d{2}:\d{2}$/", $horario)) {
    echo "✔ Horário válido OK\n";
} else {
    echo "❌ Horário válido FALHOU\n";
}


$horario = "abc";

if (!preg_match("/^\d{2}:\d{2}$/", $horario)) {
    echo "✔ Horário inválido OK\n";
} else {
    echo "❌ Horário inválido FALHOU\n";
}

$horario = "23:59";

if (preg_match("/^\d{2}:\d{2}$/", $horario)) {
    echo "✔ Caso limite OK\n";
} else {
    echo "❌ Caso limite FALHOU\n";
}

echo "\nTestes finalizados.";


echo "\nTestando conexão com API de Medicamentos...\n";
$teste_api = file_get_contents("https://bula.pbelem.com.br/api/pesquisar?nome=Dipirona");

if ($teste_api !== false && is_array(json_decode($teste_api, true))) {
    echo "✔ Teste de Integração OK\n";
} else {
    echo "❌ Teste de Integração FALHOU\n";
    exit(1);
}