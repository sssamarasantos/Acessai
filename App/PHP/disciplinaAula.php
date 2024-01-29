<?php
include('credenciais.php');
$conexao = $conexao;

$nome_disc = $_POST["nome_disc"];
$assistencia_videoaula = $_POST["assistencia_videoaula"];

$comando = "select TB_DISCIPLINA.NOME_DISC, TB_AULA.ID_AULA, TB_AULA.NOME_AULA from TB_DISCIPLINA inner join TB_AULA on TB_DISCIPLINA.ID_DISC = TB_AULA.ID_DISC inner join TB_VIDEOAULA on TB_VIDEOAULA.ID_AULA = TB_AULA.ID_AULA where TB_DISCIPLINA.NOME_DISC='$nome_disc' and TB_VIDEOAULA.ASSISTENCIA_VIDEOAULA = '$assistencia_videoaula' group by TB_AULA.NOME_AULA";

$resultado = mysqli_query($conexao, $comando);

$dados = array();

while ($r = mysqli_fetch_array($resultado)) {
	$dados[] = array("NOME_DISC"=>$r[0],"ID_AULA"=>$r[1],"NOME_AULA"=>$r[2]);
}
	
$close = mysqli_close($conexao);
echo json_encode($dados);
?>