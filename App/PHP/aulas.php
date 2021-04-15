<?php
//$conexao = mysqli_connect("localhost","root", "", "tcc");
$conexao = mysqli_connect("localhost","id15054857_adms", "Tcc_1234_banco", "id15054857_acessai");

$id_aula = $_POST["id_aula"];
$assistencia = $_POST["assistencia_aluno"];

$comando = "select TB_VIDEOAULA.ID_VIDEOAULA, TB_VIDEOAULA.NOME_VIDEOAULA from TB_VIDEOAULA inner join TB_AULA on TB_AULA.ID_AULA = TB_VIDEOAULA.ID_AULA where TB_VIDEOAULA.ASSISTENCIA_VIDEOAULA = '$assistencia' and TB_VIDEOAULA.ID_AULA = '$id_aula'";

$resultado = mysqli_query($conexao, $comando);
$dados = array();

while ($r = mysqli_fetch_array($resultado)) {
	$dados[] = array("ID_VIDEOAULA"=>$r[0],"NOME_VIDEOAULA"=>$r[1]);
}

$close = mysqli_close($conexao);
echo json_encode($dados);
?>