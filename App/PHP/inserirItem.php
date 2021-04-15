<?php
//$conexao = mysqli_connect("localhost","root", "", "tcc");
$conexao = mysqli_connect("localhost","id15054857_adms", "Tcc_1234_banco", "id15054857_acessai");

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