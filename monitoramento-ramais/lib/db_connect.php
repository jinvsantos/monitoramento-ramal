<?php
include 'ramais.php';
// Conecta ao banco de dados
$conn = mysqli_connect("localhost", "root", "", "db_ramal");

// Verifica se a conexão foi estabelecida com sucesso
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Loop através dos dados do array e insere-os no banco de dados
foreach ($info_ramais as $ramal) {
    $nome = mysqli_real_escape_string($conn, $ramal['nome']);
    $numero = mysqli_real_escape_string($conn, $ramal['ramal']);
    $online = mysqli_real_escape_string($conn, $ramal['online']);
    $status = mysqli_real_escape_string($conn, $ramal['status']);

    // Instrução SQL INSERT INTO
    $sql = "INSERT INTO `ramais`(`nome`, `ramal`, `online`, `status`)
            VALUES ('$nome', '$numero', '$online', '$status')";

    // Executa a instrução SQL
    if (mysqli_query($conn, $sql)) {
        echo "Dados inseridos com sucesso!";
    } else {
        echo "Erro ao inserir dados: " . mysqli_error($conn);
    }
}

// Fecha a conexão com o banco de dados
mysqli_close($conn);
