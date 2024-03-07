<?php
include_once __DIR__ . '/../credenciais.php';

$email = $_POST["email"];

$email = strtolower(trim($email));

$comando = "SELECT * FROM ALUNO WHERE EMAIL=?";

$stmt = $conexao->prepare($comando);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

$dados = array();

while ($r = $resultado->fetch_assoc()){
	$dados = array("id"=>$r["ID"],"nome"=>$r["NOME"],"email"=>$r["EMAIL"],"senha"=>$r["SENHA"], "assistencia"=>$r["ASSISTENCIA"], "dataHoraCriacao"=>$r["DATA_HORA_CRIACAO"]);
}


$stmt->close();
$conexao->close();

echo json_encode($dados);
?>
