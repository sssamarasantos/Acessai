<?php
//$conexao = mysqli_connect("localhost","root", "", "tcc");
$conexao = mysqli_connect("localhost","id15054857_adms", "Tcc_1234_banco", "id15054857_acessai");

$status_item_aula = $_POST["status_item_aula"];
$id_videoaula = $_POST["id_videoaula"];
$id_aluno = $_POST["id_aluno"];

$comando = "update TB_ITEM_AULA set STATUS_ITEM_AULA='$status_item_aula' where ID_ALUNO='$id_aluno' and ID_VIDEOAULA='$id_videoaula'";

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