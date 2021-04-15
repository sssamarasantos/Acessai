<?php
//$conexao = mysqli_connect("localhost","root", "", "tcc");
$conexao = mysqli_connect("localhost","id15054857_adms", "Tcc_1234_banco", "id15054857_acessai");

$assistencia = $_POST["assistencia"];

$comando = "select NOME_VIDEOAULA from TB_VIDEOAULA where ASSISTENCIA_VIDEOAULA = '$assistencia' order by NOME_VIDEOAULA";

$resultado = mysqli_query($conexao, $comando);

$dados = array();

while ($r = mysqli_fetch_array($resultado)) {
	$dados[] = array("NOME_VIDEOAULA"=>$r[0]);
}

$close = mysqli_close($conexao);
echo json_encode($dados);
?>