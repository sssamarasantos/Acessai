<?php
include('credenciais.php');
$conexao = $conexao;

$nome_disc = $_POST["nome_disc"];
$assistencia_videoaula = $_POST["assistencia_videoaula"];

$comando = "select TB_DISCIPLINA.NOME_DISC, TB_VIDEOAULA.ASSISTENCIA_VIDEOAULA from TB_DISCIPLINA inner join TB_AULA on TB_DISCIPLINA.ID_DISC = TB_AULA.ID_DISC inner join TB_VIDEOAULA on TB_VIDEOAULA.ID_AULA = TB_AULA.ID_AULA where TB_DISCIPLINA.NOME_DISC='$nome_disc' and TB_VIDEOAULA.ASSISTENCIA_VIDEOAULA = '$assistencia_videoaula'";
$resultado = mysqli_query($conexao, $comando);

$dados = array("status"=>"-");

while ($r = mysqli_fetch_array($resultado)){
	$dados = array("status"=>"ok");
}

$close = mysqli_close($conexao);
echo json_encode($dados);
?>