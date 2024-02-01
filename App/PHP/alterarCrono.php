<?php
include('credenciais.php');
$conexao = $conexao;

$id_crono = $_POST["id_crono"];
$hora_crono = $_POST["hora_crono"];
$dta_crono = $_POST["dta_crono"];
$nome_videoaula = $_POST["nome_videoaula"];

$date = str_replace('/', '-', $dta_crono);
$data_crono = date('Y-m-d', strtotime($date));

$com = "select ID_VIDEOAULA from TB_VIDEOAULA where NOME_VIDEOAULA = '$nome_videoaula'";

$result = mysqli_query($conexao, $com);

while ($r = mysqli_fetch_object($result)) {
	$id_videoaula = $r->ID_VIDEOAULA;
}

$comando = "update TB_CRONOGRAMA set DTA_CRONO = '$data_crono', HORA_CRONO = '$hora_crono', ID_VIDEOAULA = '$id_videoaula' where ID_CRONO = '$id_crono'";

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