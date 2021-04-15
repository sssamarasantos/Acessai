<?php
//$conexao = mysqli_connect("localhost","root", "", "tcc");
$conexao = mysqli_connect("localhost","id15054857_adms", "Tcc_1234_banco", "id15054857_acessai");

$hora_crono = $_POST["hora_crono"];
$dta_crono = $_POST["dta_crono"];
$id_aluno = $_POST["id_aluno"];
$nome_videoaula = $_POST["nome_videoaula"];

$date = str_replace('/', '-', $dta_crono);
$data_crono = date('Y-m-d', strtotime($date));

$com = "select ID_VIDEOAULA from TB_VIDEOAULA where NOME_VIDEOAULA = '$nome_videoaula'";

$result = mysqli_query($conexao, $com);

while ($r = mysqli_fetch_object($result)) {
	$id_videoaula = $r->ID_VIDEOAULA;
}

$comando = "insert into TB_CRONOGRAMA(HORA_CRONO, DTA_CRONO, ID_ALUNO, ID_VIDEOAULA)VALUES('$hora_crono','$data_crono','$id_aluno','$id_videoaula')";

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