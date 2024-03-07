<?php
date_default_timezone_set('America/Sao_Paulo');

include_once __DIR__ . '/../credenciais.php';

// Verificar conexão
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

$dataHoraAtual = date("Y-m-d H:i:s");

$email = $_POST["email"];
$senha = $_POST["senha"];
$nome = $_POST["nome"];
$assistencia = $_POST["assistencia"];

$nome = ucwords($nome);
$email = strtolower(trim($email));
$senha_hash = password_hash(trim($senha), PASSWORD_DEFAULT);

$comando = "INSERT INTO ALUNO (EMAIL, SENHA, NOME, ASSISTENCIA, DATA_HORA_CRIACAO) VALUES (?, ?, ?, ?, ?)";

$stmt = $conexao->prepare($comando);
$stmt->bind_param("sssss", $email, $senha_hash, $nome, $assistencia, $dataHoraAtual);
$resultado = $stmt->execute();

if ($resultado) {
    $dados = true;
} else {
    $dados = false;
}

$stmt->close();
$conexao->close();

echo json_encode($dados);
?>
