<!--// TELA RELATÓRIO DE AULAS-->

<!DOCTYPE html>
<html>
<head>
  <title> Relatório de Aulas | Acessaí </title>
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
	.jumbotron
	{
		font-family: 'Alegreya Sans SC';
		height: 250px;
		width: 500px;
		float:right;
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
	}
	.btnPesquisar:hover
	{
		background-image: url("imag/pesquisa1.png");
	}

	.btnEditar
	{
		background-image: url("imag/editar2.png");
		background-color: Transparent;
        background-repeat: no-repeat;
        background-size: 45px 45px;
        cursor: pointer;
        width: 45px;
        height: 45px;
        border: none;
	}
	.btnEditar:hover
	{
		background-image: url("imag/editar1.png");
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
		margin-bottom: 50px;
    	float: left;
	}
	.btnVoltar:hover
	{
		background-image: url("imag/voltar1.png");
	}
</style>
</head>
<body>
	<div class="container">
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
	include "conect.php";
	error_reporting(0);
	ini_set("display_errors", 0);

	if ($_SESSION['controleVDAula']=='localizado') 
	{
		echo "<br><br>
			  <section class='jumbotron'>
			  <div id='MostraPesq' style='margin-top:-45px'>
			  <b>░&nbsp&nbsp Dados da última Videoaula pesquisada: </b><p><p>
				Nome:<BR> &nbsp&nbsp&nbsp&nbsp&nbsp".
					$_SESSION['nomeVideoaula'].'<p>';
		echo "Nome da Aula:<BR> &nbsp&nbsp&nbsp&nbsp&nbsp".
					$_SESSION['nomeVideoaula'].'<p>';
		echo "Data de postagem:<BR> &nbsp&nbsp&nbsp&nbsp&nbsp".	
					$_SESSION['dataPost'].'<br>'.'<br>
			  </div>
    		  </section>';
	}
	if (isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado')) 
	{
		if ($_POST["id_videoaula"]!="") $_SESSION['IdVideoaula'] = $_POST['id_videoaula']; 
		

		$Botao=$_POST["Botao"];
		
		if ($Botao == "Excluir") 
		{
			include"excluiraula.php";
		}

		if ($Botao == "Editar") 
		{
			header('location:editaraula.php');
		}

		if ($Botao == "Pesquisar") 
		{
			include"localizarvideoaula.php";
		}
	}
	else{
	?>
	
	<article style='font-family:Alegreya Sans SC; float:left; margin-left:20px'>
	    <br>
		<form name='form'  method='post' action='relatorioaulas.php?valor=enviado'>
		<fieldset>
			<div class='input-prepend'>
				<span class='add-on'><i class='icon-search'></i></span>
				<input type='text' name='id_videoaula' id='id_videoaula' value='' tabindex='1' placeholder='Pesquisar ID videoaula...' />
				
				<div style='margin-top:10px'>
				  <button name='Botao' value='Pesquisar' input type='submit' class='btnPesquisar'></button>
					&nbsp&nbsp
				  <button name='Botao' value='Editar' input type='submit' class='btnEditar'></button>
				  	&nbsp&nbsp
				  <button name='Botao'  value='Excluir' input type='submit' class='btnExcluir' onclick="return confirm('Tem certeza que deseja deletar este registro?')"></button>
				</div>
			</div>
		</fieldset>
		</form>
	
		<div id='contentLoading'>
			<div id='loading'></div>
		</div>
		
		
	</article>


	<br><br><br><br><br><br><br><br><br><br>
	<b style="font-family: 'Megrim'; font-size:50px">VIDEOAULAS</b>
	<span id="conteudo" style="font-familiy:'Alegreya Sans SC'"></span>

	<br><br>
	<a href="resposta.php" role="Voltar" > <img src="imag/voltar2.png" class="btnVoltar"> </a>

<?php
}
?>
	<script>
		$(document).ready(function () {
			$.post('listar_aula.php', function(retorna){
				//Subtitui o valor no seletor id="conteudo"
				$("#conteudo").html(retorna);
			});
		});
	</script>		
 </body>
</html>