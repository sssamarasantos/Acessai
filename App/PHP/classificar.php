<?php
include('credenciais.php');
$conexao = $conexao;

$classificar_item_aula = $_POST["classificar_item_aula"];
$id_videoaula = $_POST["id_videoaula"];
$id_aluno = $_POST["id_aluno"];

$comando = "update TB_ITEM_AULA set CLASSIFICAR_ITEM_AULA='$classificar_item_aula' where ID_ALUNO='$id_aluno' and ID_VIDEOAULA='$id_videoaula'";

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