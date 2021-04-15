<?php
//$conexao = mysqli_connect("localhost","root", "", "tcc");
//conexao com o banco de dados
$conexao = mysqli_connect("localhost","id15054857_adms", "Tcc_1234_banco", "id15054857_acessai");
//variavel recebe o valor do aplicativo via post
$id_videoaula = $_POST["id_videoaula"];
//comando usado no banco de dados
$comando = "select TB_VIDEOAULA.NOME_VIDEOAULA, TB_VIDEOAULA.VIDEO_VIDEOAULA, date_format(TB_VIDEOAULA.DTA_POST_VIDEOAULA, '%d/%m/%Y') as 'DTA_POST_VIDEOAULA', TB_PROFESSOR.ID_PROF,TB_PROFESSOR.NOME_PROF from TB_VIDEOAULA inner join TB_AULA on TB_VIDEOAULA.ID_AULA = TB_AULA.ID_AULA inner join TB_DISCIPLINA on TB_AULA.ID_DISC = TB_DISCIPLINA.ID_DISC inner join TB_PROFESSOR on TB_DISCIPLINA.ID_PROF = TB_PROFESSOR.ID_PROF where TB_VIDEOAULA.ID_VIDEOAULA='$id_videoaula'";
//resultado obtido através do comando executado no banco
$resultado = mysqli_query($conexao, $comando);
//atribui um array para a varialvel dados
$dados = array();
//atraves do laço de repetição, o resultado é atribuido a variavel r
while ($r = mysqli_fetch_array($resultado)) {
    //os valores recebidos são atribuidos para a variavel dados atraves do array
	$dados[] = array("NOME_VIDEOAULA"=>$r[0], "VIDEO_VIDEOAULA"=>$r[1], "DTA_POST_VIDEOAULA"=>$r[2], "ID_PROF"=>$r[3], "NOME_PROF"=>$r[4]);
}
//fecha a conexao com o banco de dados
$close = mysqli_close($conexao);
//envia os dados via json para o aplicativo
echo json_encode($dados);
?>