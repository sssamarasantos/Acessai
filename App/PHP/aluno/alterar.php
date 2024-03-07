<?php
include_once __DIR__ . '/../credenciais.php';

$id = $_POST["id"];
$email = $_POST["email"];
$senha = $_POST["senha"];
$nome = $_POST["nome"];
$assistencia = $_POST["assistencia"];

$nome = ucwords($nome);
$email = strtolower(trim($email));
$senha = trim($senha);

$stmt = $conexao->prepare("UPDATE ALUNO SET EMAIL=?, SENHA=?, NOME=?, ASSISTENCIA=? WHERE ID=?");

$stmt->bind_param("ssssi", $email, $senha, $nome, $assistencia, $id);
$resultado = $stmt->execute();

if($resultado) {
	$dados = true;
} 
else {
	$dados = false;
}

$stmt->close();
$conexao->close();
echo json_encode($dados);
?>
