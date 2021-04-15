<?php
//$conexao = mysqli_connect("localhost","root", "", "tcc");
$conexao = mysqli_connect("localhost","id15054857_adms", "Tcc_1234_banco", "id15054857_acessai");

$loginx = $_POST["login"];
$senhax = $_POST["senha"];
$nomex = $_POST["nome"];
$assistencia = $_POST["assistencia"];

$nome = ucwords($nomex);
$login = strtolower(str_replace(" ", "", $loginx));
$senha = str_replace(" ", "", $senhax);

$comando = "insert into TB_ALUNO(EMAIL_ALUNO, SENHA_ALUNO, NOME_ALUNO, ASSISTENCIA_ALUNO)values('$login', '$senha', '$nome','$assistencia')";

$resultado = mysqli_query($conexao, $comando);

if($resultado != 0) {
	$dados = array("status"=>"ok");
} 
else {
	$dados = array("status"=>"erro");
}

$close = mysqli_close($conexao);
echo json_encode($dados);
?>