<?php
include('credenciais.php');
$conexao = $conexao;

$id_videoaula = $_POST["id_videoaula"];

$comando = "select TB_DUVIDA.ID_DUVIDA, TB_ALUNO.NOME_ALUNO, TB_DUVIDA.MSG_DUVIDA, date_format(TB_DUVIDA.DTAHR_MSG_DUVIDA, '%d/%c/%Y %H:%i') as 'DTAHR_MSG_DUVIDA', ifnull(TB_PROFESSOR.NOME_PROF,'') as NOME_PROF, ifnull(TB_DUVIDA.RESP_DUVIDA,'') as RESP_DUVIDA, ifnull(date_format(TB_DUVIDA.DTAHR_RESP_DUVIDA, '%d/%c/%Y %H:%i'),'') as DTAHR_RESP_DUVIDA from TB_DUVIDA inner join TB_ALUNO on TB_DUVIDA.ID_ALUNO = TB_ALUNO.ID_ALUNO left join TB_PROFESSOR on TB_DUVIDA.ID_PROF = TB_PROFESSOR.ID_PROF left join TB_VIDEOAULA on TB_VIDEOAULA.ID_VIDEOAULA = TB_DUVIDA.ID_VIDEOAULA where TB_VIDEOAULA.ID_VIDEOAULA = '$id_videoaula' order by TB_DUVIDA.DTAHR_MSG_DUVIDA desc";

$resultado = mysqli_query($conexao, $comando);

$dados = array();

while ($r = mysqli_fetch_array($resultado)){
	$dados[] = array("ID_DUVIDA"=>$r[0],"NOME_ALUNO"=>$r[1],"MSG_DUVIDA"=>$r[2],"DTAHR_MSG_DUVIDA"=>$r[3], "NOME_PROF"=>$r[4], "RESP_DUVIDA"=>$r[5], "DTAHR_RESP_DUVIDA"=>$r[6]);
}

$close = mysqli_close($conexao);
echo json_encode($dados);
?>