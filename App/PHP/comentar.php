<?php
//$conexao = mysqli_connect("localhost","root", "", "tcc");
$conexao = mysqli_connect("localhost","id15054857_adms", "Tcc_1234_banco", "id15054857_acessai");

$msg_duvida = $_POST["msg_duvida"];
$id_videoaula = $_POST["id_videoaula"];
$id_aluno = $_POST["id_aluno"];
$id_prof = $_POST["id_prof"];

date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('Y/m/d H:i:s');

$comando = "insert into TB_DUVIDA(MSG_DUVIDA, DTAHR_MSG_DUVIDA,ID_VIDEOAULA, ID_ALUNO, ID_PROF)values('$msg_duvida','$dataHora','$id_videoaula','$id_aluno', '$id_prof')";

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