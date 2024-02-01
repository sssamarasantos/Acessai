<?php
include('credenciais.php');
$conexao = $conexao;

$resp_duvida = $_POST["resp_duvida"];
$id_duvida = $_POST["id_duvida"];
$id_prof = $_POST["id_prof"];

date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('Y/m/d H:i:s');

$comando = "update TB_DUVIDA set RESP_DUVIDA = '$resp_duvida', DTAHR_RESP_DUVIDA = '$dataHora', ID_PROF = '$id_prof' where ID_DUVIDA = '$id_duvida'";

$resultado = mysqli_query($conexao, $comando);

if($resultado != 0){
	$dados = array("status"=>"ok");
}
else{
	$dados = array("status"=>"erro");
}

$close = mysqli_close($conexao);
echo json_encode($dados);
?>