<?php
//$conexao = mysqli_connect("localhost","root", "", "tcc");
$conexao = mysqli_connect("localhost","id15054857_adms", "Tcc_1234_banco", "id15054857_acessai");

$id_aluno = $_POST["id_aluno"];

$comando = "select TB_CRONOGRAMA.ID_CRONO, TB_DISCIPLINA.NOME_DISC, date_format(TB_CRONOGRAMA.DTA_CRONO, '%d/%m/%Y') as 'DTA_CRONO', date_format(TB_CRONOGRAMA.HORA_CRONO, '%H:%i') as 'HORA_CRONO', TB_VIDEOAULA.ID_VIDEOAULA, TB_VIDEOAULA.NOME_VIDEOAULA from TB_CRONOGRAMA inner join TB_VIDEOAULA on TB_CRONOGRAMA.ID_VIDEOAULA = TB_VIDEOAULA.ID_VIDEOAULA inner join TB_AULA on TB_VIDEOAULA.ID_AULA = TB_AULA.ID_AULA inner join TB_DISCIPLINA on TB_AULA.ID_DISC = TB_DISCIPLINA.ID_DISC where TB_CRONOGRAMA.ID_ALUNO = '$id_aluno' order by TB_CRONOGRAMA.DTA_CRONO and TB_DISCIPLINA.NOME_DISC";

$resultado = mysqli_query($conexao, $comando);

$dados = array();

while ($r = mysqli_fetch_array($resultado)) {
	$dados[] = array("ID_CRONO"=>$r[0], "NOME_DISC"=>$r[1], "DTA_CRONO"=>$r[2], "HORA_CRONO"=>$r[3], "ID_VIDEOAULA"=>$r[4], "NOME_VIDEOAULA"=>$r[5]);
}

$close = mysqli_close($conexao);
echo json_encode($dados);
?>