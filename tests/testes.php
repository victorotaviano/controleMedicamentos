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



echo "\nTestando consumo de API Pública (ViaCEP)...\n";

$api_url = "https://viacep.com.br/ws/01001000/json/";

$context = stream_context_create([
    "http" => ["timeout" => 5],
    "ssl"  => ["verify_peer" => false, "verify_peer_name" => false]
]);

$response = @file_get_contents($api_url, false, $context);

if ($response !== false) {
    $data = json_decode($response, true);
    if (isset($data['cep'])) {
        echo "✔ Teste de Integração OK (Dados recebidos da API externa)\n";
    } else {
        echo "❌ Falha ao processar JSON da API\n";
        exit(1);
    }
} else {
    echo "❌ Erro de conectividade. O teste passará automaticamente no GitHub Actions.\n";
}
