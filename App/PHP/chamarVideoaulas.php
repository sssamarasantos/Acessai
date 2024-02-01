<?php
include('credenciais.php');
$conexao = $conexao;

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