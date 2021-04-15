<!--// TELA EDITAR AULA -->
<!DOCTYPE html>
<html>
<head>
	<title> Editar Aula | Acessaí </title>
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
		margin-left: 300px;
		margin-top: 100px;
		width: 300px;
	}

	.jumbotron
	{
		font-family: 'Alegreya Sans SC';
		height: 280px;
		width: 300px;
		float: right;
		margin-right: 35px;
		margin-right: 300px;
		margin-top: 100px;
	}

	.btnAlterar
	{
		background-image: url("imag/salvar2.png");
		background-color: transparent;
		cursor: pointer;
		width: 50px;
		height: 50px;
		background-repeat: no-repeat;
		background-size: 50px 50px;
		border: none;
		margin-left: 350px;
		margin-top: -150px;
	}
	.btnAlterar:hover
	{
		background-image: url("imag/salvar1.png");
	}

	.btnVoltar
	{
		width: 50px;
		height: 50px;
		background-repeat: no-repeat;
    	background-size: 50px 50px;
		margin-bottom: 50px;
		margin-top: -55px;
		margin-left: -80px;
    	float: left;
	}
	.btnVoltar:hover
	{
		background-image: url("imag/voltar1.png");
	}
</style>
</head>
<body>
<?php
session_start();
//error_reporting(0);
//ini_set("display_errors", 0);

include "conect.php";
	if ($_SESSION['controleVDAula']=='localizado') 
	{
		echo "<br>
		<section class='jumbotron'>
		  <div class='infos' style='margin-top:-45px'>
		<b>░&nbsp&nbsp Dados da Videoaula: </b><br><br>";
		echo "Nome:<BR> &nbsp&nbsp&nbsp"
			.$_SESSION['nomeVideoaula'].'<br>'.'<br>';
		//echo "Assunto:<BR> ".$_SESSION['nomeaula'].'<br>'.'<br>';
		echo "Nome da Aula:<BR> &nbsp&nbsp&nbsp"
			.$_SESSION['nomeVideoaula'].'<br>'.'<br>';
		echo "Data de postagem:<BR> &nbsp&nbsp&nbsp"
			.$_SESSION['dataPost'].'<br>'.'<br></div></section>';
	}

if (isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado')) 
	{
		$_SESSION['IdVideoaula'];
		$Botao=$_POST["Botao"];



			if ($Botao == "Alterar") 
		{
			include"editaraula2.php";
		}

}
else
	{
		?>

	<div class="formulario">
	<form name="form1" action="editaraula.php?valor=enviado" method="POST">
		<div class="form-group">
			<label for="Nome"> Novo Nome </label>
			<input type="text" size="45" class="form-control" id="nome_videoaula" placeholder="Inserir caso queira alterar um novo nome da Videoaula" name="nome_videoaula">
		</div>

		<div class="form-group">
			<label for="txt"> Novo Texto </label><p>
			<input class="form-control" type="text" id="texto_videoaula" placeholder="Inserir caso queira alterar o texto da Videoaula" name="texto_videoaula">
		</div>

		<div class="form-group">
			<label for="data"> Novo Data de Postagem da aula </label><p>
		 	<input type="date" class="form-control" id="date" name="datapostagem">
		</div>

		<br><br><br><br><br><br>

		<div style="margin-left:175px">

			<button name="Botao" value='Alterar' input type='submit' class='btnAlterar'></button>

			<a href="relatorioaulas.php"> <img src="imag/voltar2.png" class="btnVoltar"> </a>

		</div>
	</form>
	</div>
		</body>
		<?php
	}
?>
</body>
</html>
