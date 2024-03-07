<?php
include_once __DIR__ . '/../credenciais.php';

// Verificar conexão
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

$email = $_POST["email"];

$comando = "SELECT ASSISTENCIA FROM ALUNO WHERE EMAIL=?";

$stmt = $conexao->prepare($comando);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

while ($r = $resultado->fetch_assoc()){
	$dados = $r["ASSISTENCIA"];
}

$stmt->close();
$conexao->close();

echo json_encode($dados);
?>