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