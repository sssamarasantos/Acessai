<!--// TELA RESPOSTA DÚVIDA	-->

<!DOCTYPE html>
<html>
<head>
  <title> Resposta de Dúvidas | Acessaí </title>
  <link rel="sortcut icon" href="imag/icon.ico" type="image/x-icon"/>

	<meta charset="utf-8">
	<link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Megrim' rel='stylesheet'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<style type="text/css">
	body 
	{
		background: url("imag/backgroundnuv.png") no-repeat center center fixed;
		background-size: cover;
		-webkit-background-size: cover; /* SAFARI / CHROME */
		-moz-background-size: cover; /* FIREFOX */
		-ms-background-size: cover; /* IE */
		-o-background-size: cover; /* OPERA */
	}

	.formulario
	{
		font-family: 'Alegreya Sans SC';
		float: left;
		margin-top: -760px;
		margin-left: 100px;
		width: 300px;
	}

	.jumbotron
	{
		font-family: 'Alegreya Sans SC';
		height: 430px;
		width: 300px;
		float: right;
		margin-right: 100px;
		margin-top: -1020px;
	}

	.tab01
	{
		font-family: 'Alegreya Sans SC';
		margin-left: 50px;
		font-size: 16px;
		border-color: #C0C0C0;
	}

	.btnPesquisar
	{
		background-image: url("imag/pesquisa2.png");
		background-color: Transparent;
        background-repeat: no-repeat;
        background-size: 50px 50px;
        cursor: pointer;
        width: 50px;
        height: 50px;
        border: none;
		margin-left: 130px;
		margin-top: 10px;
	}
	.btnPesquisar:hover
	{
		background-image: url("imag/pesquisa1.png");
	}

	.btnLogin{
		background-image: url("imag/avançar2.png");
		background-color: transparent;
		cursor: pointer;
		width: 50px;
		height: 50px;
		background-repeat: no-repeat;
		background-size: 50px 50px;
		border: none;
		margin-left: 250px;
		margin-top: 10px;
	}
	.btnLogin:hover{
		background-image: url("imag/avançar1.png");
	}

	.btnVoltar{
		width: 50px;
		height: 50px;
		background-repeat: no-repeat;
		background-size: 50px 50px;
		margin-bottom: 20px;
		margin-left: 20px;
	}
	.btnVoltar:hover{
		background-image: url("imag/voltar1.png");
		
	}
</style>
</head>
<body>
	    <!-- Plugin Vlibras-->  
    <div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
      <div class="vw-plugin-top-wrapper"></div>
    </div>
  </div>
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
  </script>
<?php
include"conect.php";

session_start();

$idProf = $_SESSION['IdProf'];

	//carrega a tabela
	$Matriz=$conexao->prepare("select TB_DUVIDA.ID_DUVIDA, TB_VIDEOAULA.NOME_VIDEOAULA, TB_ALUNO.NOME_ALUNO, TB_DUVIDA.MSG_DUVIDA, date_format(TB_DUVIDA.DTAHR_MSG_DUVIDA, '%d/%m/%Y %k:%s') as DTAHR_MSG_DUVIDA, TB_DUVIDA.RESP_DUVIDA, date_format(TB_DUVIDA.DTAHR_RESP_DUVIDA, '%d/%m/%Y %k:%s') as DTAHR_RESP_DUVIDA from TB_DUVIDA inner join TB_ALUNO on TB_DUVIDA.ID_ALUNO = TB_ALUNO.ID_ALUNO left join TB_PROFESSOR on TB_DUVIDA.ID_PROF = TB_PROFESSOR.ID_PROF left join TB_VIDEOAULA on TB_VIDEOAULA.ID_VIDEOAULA = TB_DUVIDA.ID_VIDEOAULA where TB_PROFESSOR.ID_PROF=?");

	$Matriz->bindParam(1, $idProf);

	echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<b style='font-family:Megrim; font-size:35px; margin-left:10px'> Dúvidas enviadas através do aplicativo </b><br><br>";
	$Matriz->execute();

	echo "<table border=1 class='tab01'>";
	echo "<tr style='align-items:center'>";
	echo "<td><b>&nbsp ID (Identificação) &nbsp&nbsp&nbsp</td>";
	echo "<td><b>&nbsp Nome da Videoaula &nbsp</td>";
	echo "<td><b>&nbsp Nome do Aluno &nbsp</td>";
	echo "<td><b>&nbsp Mensagem &nbsp</td>";
	echo "<td><b>&nbsp Data e Hora da Mensagem &nbsp</td>";
	echo "<td><b>&nbsp Resposta da Mensagem &nbsp</td>";
	echo "<td><b>&nbsp Data e Hora da Resposta &nbsp</td>";
	echo "</tr>";

	while ($Linha = $Matriz->fetch(PDO::FETCH_OBJ)) 
	{
		$idDuvida = $Linha->ID_DUVIDA;
		$nomeVideoaula = $Linha->NOME_VIDEOAULA;
		$nomeAluno = $Linha->NOME_ALUNO;
		$msgDuvida = $Linha->MSG_DUVIDA;
		$dtahrMsgDuvida = $Linha->DTAHR_MSG_DUVIDA;
		$respDuvida = $Linha->RESP_DUVIDA;
		$dtahrRespDuvida = $Linha->DTAHR_RESP_DUVIDA;

		echo "<tr>";
		echo "<td>&nbsp &nbsp".$idDuvida."&nbsp</td>";
		echo "<td>&nbsp &nbsp".$nomeVideoaula."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>";
		echo "<td>&nbsp &nbsp".$nomeAluno."&nbsp</td>";
		echo "<td>&nbsp &nbsp".$msgDuvida."&nbsp&nbsp&nbsp&nbsp&nbsp</td>";
		echo "<td>&nbsp &nbsp".$dtahrMsgDuvida."&nbsp</td>";
		echo "<td>&nbsp &nbsp".$respDuvida."&nbsp</td>";
		echo "<td>&nbsp &nbsp".$dtahrRespDuvida."&nbsp</td>";
		echo "</tr>";
	}

	echo "</table>";

	if (isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado')) 
	{
		if ($_POST["id_duvida"]!="") $_SESSION['idDuvida'] = $_POST['id_duvida']; 
		if ($_POST["resp_duvida"]!="") $_SESSION['respDuvida'] = $_POST['resp_duvida']; 

		$botao = $_POST["botao"];

		if ($botao == "Enviar") 
		{
			include "alterarduvida.php";
		}

		if ($botao == "Localizar") 
		{
			include "localizarduvida.php";
		}
	}

	else
	{
		?>

		<div class="formulario">
			<form name="form1" action="respostaduvida.php?valor=enviado" method="POST">
			<div class="form-group">
				<label for="Usuário"> ID da Dúvida </label><p>
				<input class="input" class="form-control" type="text" placeholder="Preencha o ID" name="id_duvida">
					<br>
				<button name="botao" value="Localizar" input type='submit' class='btnPesquisar' required></button>
			</div>

			<div id="divtopico">
			<div class="form-group">
      			<label for="mensagemrespota"> Mensagem de Resposta </label>
				<textarea class="form-control" placeholder="Preencha a resposta" name="resp_duvida" rows="8" cols="40"></textarea>

	  			<button name="botao" value='Enviar' input type='submit' class='btnLogin'></button>
			</div>
			</div>
	
			</form>
		</div>

		<br><br><br><br><br><br><br><br>
		<a href="menuprofessor.php"> <img src="imag/voltar2.png" class="btnVoltar"> </a>
		</body>
		<?php

	if ($_SESSION['controleProf'] =='localizado') 
	{
		echo "<br>
		<section class='jumbotron'>
	  		<div class='infos' style='margin-top:-35px'>
			<b>░&nbsp&nbsp Dados da Mensagem </b><br><br>";
		echo "Nome da Videoaula:<BR> ".$_SESSION['nomeVideoaula'].'<br>'.'<br>';
		echo "Nome do Aluno:<BR> ".$_SESSION['nomeAluno'].'<br>'.'<br>';
		echo "Mensagem:<BR> ".$_SESSION['msgDuvida'].'<br>'.'<br>';
		echo "Resposta:<BR> ".$_SESSION['respDuvida'].'<br>'.'<br> </div></section>';
	}

	else if ($_SESSION['controleProf'] == 'respondido') 
	{
		echo "<br>
		<section class='jumbotron'>
	  	<div class='infos' style='margin-top:-35px'>
			<b>░&nbsp&nbsp Dados da Mensagem: </b><br><br>";
		echo "Nome da Videoaula:<BR> ".$_SESSION['nomeVideoaula'].'<br>'.'<br>';
		echo "Nome do Aluno:<BR> ".$_SESSION['nomeAluno'].'<br>'.'<br>';
		echo "Mensagem:<BR> ".$_SESSION['msgDuvida'].'<br>'.'<br>';
		echo "Resposta:<BR> ".$_SESSION['respDuvida'].'<br>'.'<br>';
		echo "Resposta gravada com sucesso! </div></section><br><br>";
	}
}
?>

</html>