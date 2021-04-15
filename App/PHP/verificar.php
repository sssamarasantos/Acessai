<?php
//$conexao = mysqli_connect("localhost","root", "", "tcc");
$conexao = mysqli_connect("localhost","id15054857_adms", "Tcc_1234_banco", "id15054857_acessai");

$id_videoaula = $_POST["id_videoaula"];
$id_aluno = $_POST["id_aluno"];

$comando = "select ifnull(TB_ITEM_AULA.STATUS_ITEM_AULA,'-') as STATUS_ITEM_AULA, ifnull(TB_ITEM_AULA.CLASSIFICAR_ITEM_AULA,'-') as CLASSIFICAR_ITEM_AULA from TB_VIDEOAULA inner join TB_AULA on TB_VIDEOAULA.ID_AULA = TB_AULA.ID_AULA inner join TB_ITEM_AULA on TB_ITEM_AULA.ID_VIDEOAULA = TB_VIDEOAULA.ID_VIDEOAULA inner join TB_ALUNO on TB_ALUNO.ID_ALUNO = TB_ITEM_AULA.ID_ALUNO where TB_VIDEOAULA.ID_VIDEOAULA = '$id_videoaula' and TB_ALUNO.ID_ALUNO = '$id_aluno'";

$resultado = mysqli_query($conexao, $comando);

$dados = array();

while ($r = mysqli_fetch_array($resultado)){
    $dados[] = array("STATUS_ITEM_AULA"=>$r[0],"CLASSIFICAR_ITEM_AULA"=>$r[1]);
}

if(empty($dados)){
    $dados[] = array("STATUS_ITEM_AULA"=>"nenhum","CLASSIFICAR_ITEM_AULA"=>"nenhum");
}

$close = mysqli_close($conexao);
echo json_encode($dados);
?>