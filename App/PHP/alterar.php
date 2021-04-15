<?php
//$conexao = mysqli_connect("localhost","root", "", "tcc");
$conexao = mysqli_connect("localhost","id15054857_adms", "Tcc_1234_banco", "id15054857_acessai");

$id = $_POST["id"];
$loginx = $_POST["login"];
$senhax = $_POST["senha"];
$nomex = $_POST["nome"];
$assistencia = $_POST["assistencia"];

$nome = ucwords($nomex);
$login = strtolower(str_replace(" ", "", $loginx));
$senha = str_replace(" ", "", $senhax);

$comando = "update TB_ALUNO set EMAIL_ALUNO='$login', SENHA_ALUNO='$senha', NOME_ALUNO= '$nome', ASSISTENCIA_ALUNO='$assistencia' where ID_ALUNO='$id'";

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