<?php
include_once __DIR__ . '/../credenciais.php';

// Verificar conexão
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

$email = $_POST["email"];
$senha = $_POST["senha"];

$comando = "SELECT SENHA FROM ALUNO WHERE EMAIL=?";

$stmt = $conexao->prepare($comando);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($senha_hash);

if ($stmt->fetch() && password_verify($senha, $senha_hash)) {
    // A senha está correta
    $dados = true;
} else {
    // A senha está incorreta
    $dados = false;
}

$stmt->close();
$conexao->close();

echo json_encode($dados);
?>