<?php
include('credenciais.php');
$conexao = $conexao;

$id = $_POST["id"];

$comando = "delete from TB_CRONOGRAMA where ID_CRONO = '$id'";

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