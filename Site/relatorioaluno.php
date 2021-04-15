<!--// TELA RELATÓRIO ALUNO -->

<!DOCTYPE html>
<html>
<head>
  <title> Relatório de Alunos | Acessaí </title>
  <link rel="sortcut icon" href="imag/icon.ico" type="image/x-icon"/>

	<meta charset="utf-8">
	<link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Megrim' rel='stylesheet'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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
		margin-top: -450px;
		margin-left: 1000px;
		width: 300px;
	}

	.jumbotron
	{
		font-family: 'Alegreya Sans SC';
		height: 280px;
		width: 300px;
		float: right;
		margin-right: 70px;
		margin-left: 40px;
		margin-top: -400px;
	}

	.tab01
	{
		font-family: 'Alegreya Sans SC';
		margin-left: 100px;
		font-size: 18px;
		border-color: #C0C0C0;
	}

	.btnPesquisar
	{
		background-image: url("imag/pesquisa2.png");
		background-color: Transparent;
        background-repeat: no-repeat;
        background-size: 45px 45px;
        cursor: pointer;
        width: 45px;
        height: 45px;
        border: none;
		margin-left: 85px;
	}
	.btnPesquisar:hover
	{
		background-image: url("imag/pesquisa1.png");
	}

	.btnExcluir
	{
		background-image: url("imag/excluir2.png");
		background-color: Transparent;
        background-repeat: no-repeat;
        background-size: 45px 45px;
        cursor: pointer;
        width: 45px;
        height: 45px;
        border: none;
	}
	.btnExcluir:hover
	{
		background-image: url("imag/excluir1.png");
	}

	.btnVoltar
	{
		width: 50px;
		height: 50px;
		background-repeat: no-repeat;
    	background-size: 50px 50px;
    	margin-left: 30px;
    	float: left;
	}
	.btnVoltar:hover
	{
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
session_start();
include"conect.php";

error_reporting(0);
ini_set("display_errors", 0);


	$Matriz=$conexao->prepare("select* FROM TB_ALUNO");
	$Matriz->execute();
	echo "<br><br>
	<b style='font-family:Megrim; font-size:40px; margin-left:50px'> Alunos cadastrados no Aplicativo </b><br><br>";
	

	echo "<table border=1 class='tab01'>";
	echo "<tr>";
	echo "<td><b>&nbsp ID (Identificação) &nbsp&nbsp&nbsp</td>";
	echo "<td><b>&nbsp Nome &nbsp</td>";
	echo "<td><b>&nbsp E-mail &nbsp</td>";
	echo "<td><b>&nbsp Assistência &nbsp</b></td>";
	echo "</tr>";

	while ($Linha = $Matriz->fetch(PDO::FETCH_OBJ)) 
	{
		$idAluno = $Linha->ID_ALUNO;
		$nomeAluno = $Linha->NOME_ALUNO;
		$emailAluno = $Linha->EMAIL_ALUNO;
		$assistenciaAluno = $Linha->ASSISTENCIA_ALUNO;
		


	echo "<tr>";
	echo "<td>&nbsp".$idAluno."&nbsp</td>";
	echo "<td>&nbsp".$nomeAluno."&nbsp</td>";
	echo "<td>&nbsp".$emailAluno."&nbsp</td>";
	echo "<td>&nbsp".$assistenciaAluno."&nbsp</td>";
	echo "</tr>";
	}

	echo "</table>";

if (isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado'))
{
		if ($_POST["id_aluno"]!="") $_SESSION['IdAluno'] = $_POST['id_aluno']; 
		

		$Botao=$_POST["Botao"];

		
		if ($Botao == "Excluir") 
		{
			
			include"alteraraluno.php";
		}

		if ($Botao == "Pesquisar") 
		{
			include"localizaraluno.php";
			//header('location:localizaraluno.php');
		}
		
	}

	//carrega a tabela

	
	else
	{
		?>

		<br>
		<div class="formulario">
		<form name="form1" action="relatorioaluno.php?valor=enviado" method="POST">
			<div class="form-group">
				<label for="id"> ID do Aluno </label><p>
				<input class="input" class="form-control" type="text"  placeholder="Preencha ID do Aluno" name="id_aluno">
			</div>
			<div class="form-group">
				<button name="Botao" value="Pesquisar" input type='submit' class='btnPesquisar'></button>
					&nbsp&nbsp
				<button name="Botao"  value='Excluir' input type='submit' class='btnExcluir' onclick="return confirm('Tem certeza que deseja deletar este registro?')"></button>
			</div>
		</form>
		</div>
		<br><br><br>
		<a href="resposta.php"> <img src="imag/voltar2.png" class="btnVoltar"> </a>
		</body>
		<?php

	if ($_SESSION['controleAluno']=='localizado') 
	{

	echo "<br><br>
		  <section class='jumbotron'>
		  <div id='MostraPesq' style='margin-top:-45px'>
		  <b>░&nbsp&nbsp Dados do Usuário Aluno: </b><br><br>";
	echo "Nome:<BR> &nbsp&nbsp"
		.$_SESSION['nomeAluno'].'<br>'.'<br>';
	echo "E-mail:<BR> &nbsp&nbsp"
		.$_SESSION['emailAluno'].'<br>'.'<br>';
	echo "Assistência:<BR> &nbsp&nbsp"
		.$_SESSION['assistenciaAluno'].'<br>'.'<br></div></section>';
	}
}

?>

</html>