<?php
include('credenciais.php');
$conexao = $conexao;

$id_videoaula = $_POST["id_videoaula"];
$id_aluno = $_POST["id_aluno"];

$comando = "insert into TB_ITEM_AULA(ID_ALUNO, ID_VIDEOAULA)VALUES('$id_aluno','$id_videoaula')";
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