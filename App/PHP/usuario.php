<?php
//$conexao = mysqli_connect("localhost","root", "", "tcc");
$conexao = mysqli_connect("localhost","id15054857_adms", "Tcc_1234_banco", "id15054857_acessai");

$loginx = $_POST["usuario"];

$login = strtolower(str_replace(" ", "", $loginx));

$comando = "select * from TB_ALUNO where EMAIL_ALUNO='$login'";
$resultado = mysqli_query($conexao, $comando);
$dados = array();

while ($r = mysqli_fetch_array($resultado)){
	$dados[] = array("ID_ALUNO"=>$r[0],"NOME_ALUNO"=>$r[1],"EMAIL_ALUNO"=>$r[2],"SENHA_ALUNO"=>$r[3], "ASSISTENCIA_ALUNO"=>$r[4]);
}

$close = mysqli_close($conexao);
echo json_encode($dados);
?>
