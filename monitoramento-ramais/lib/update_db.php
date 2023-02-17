<?php
include 'ramais.php';
// Conecta ao banco de dados
$conn = mysqli_connect("localhost", "root", "", "db_ramal");

// Verifica se a conexão foi estabelecida com sucesso
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Loop através dos dados do array e atualiza-os no banco de dados
$response = array();
foreach ($info_ramais as $ramal) {
    $nome = mysqli_real_escape_string($conn, $ramal['nome']);
    $numero = mysqli_real_escape_string($conn, $ramal['ramal']);
    $status = mysqli_real_escape_string($conn, $ramal['status']);

    // Instrução SQL UPDATE
    $sql = "UPDATE `ramais` SET `status`='$status'
            WHERE `nome`='$nome' AND `ramal`='$numero'";

    // Executa a instrução SQL
    if (mysqli_query($conn, $sql)) {
        $response[$nome][$numero] = "Dados atualizados com sucesso!";
    } else {
        $response[$nome][$numero] = "Erro ao atualizar dados: " . mysqli_error($conn);
    }
}

// Fecha a conexão com o banco de dados
mysqli_close($conn);

// Converte a resposta em um formato JSON
echo json_encode($response);
