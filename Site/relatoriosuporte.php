<!--// TELA RELATÓRIO DE SUPORTE -->

<!DOCTYPE html>
<html>
<head>
  <title> Relatório de Suporte | Acessaí </title>
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
		margin-top: -380px;
		margin-left: 1000px;
		width: 300px;
	}

	.jumbotron
	{
		font-family: 'Alegreya Sans SC';
		height: 500px;
		width: 300px;
		float: right;
		margin-right: 70px;
		margin-left: 40px;
		margin-top: -480px;
	}

	.tab01
	{
		font-family: 'Alegreya Sans SC';
		margin-left: 30px;
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
		margin-left: 200px;
		margin-top: -50px;
	}
	.btnPesquisar:hover
	{
		background-image: url("imag/pesquisa1.png");
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
	

	//carrega a tabela
	$Matriz=$conexao->prepare("select* FROM CONTATO WHERE ASSUNTO_CONTATO LIKE '%Suporte%'");

	echo "<br><br>
	<b style='font-family:Megrim; font-size:40px; margin-left:50px'> Solicitações de suporte </b><br><br>";
	$Matriz->execute();

	echo "<table border=1 class='tab01'>";
	echo "<tr>";
	echo "<td><b>&nbsp ID (Identificação) &nbsp&nbsp&nbsp</td>";
	echo "<td><b>&nbsp Nome do Contato &nbsp</td>";
	echo "<td><b>&nbsp E-mail do Contato &nbsp</td>";
	echo "<td><b>&nbsp Assunto do Contato &nbsp</td>";
	echo "<td><b>&nbsp Msg do Contato &nbsp</b></td>";
	echo "</tr>";

	while ($Linha = $Matriz->fetch(PDO::FETCH_OBJ)) 
	{
		$idContato = $Linha->ID_CONTATO;
		$nomeContato = $Linha->NOME_CONTATO;
		$emailContato = $Linha->EMAIL_CONTATO;
		$assuntoContato = $Linha->ASSUNTO_CONTATO;
		$msgContato = $Linha->MSG_CONTATO;
		$respContato = $Linha->RESP_CONTATO;


	echo "<tr>";
	echo "<td>&nbsp".$idContato."&nbsp</td>";
	echo "<td>&nbsp".$nomeContato."&nbsp</td>";
	echo "<td>&nbsp".$emailContato."&nbsp</td>";
	echo "<td>&nbsp".$assuntoContato."&nbsp</td>";
	echo "<td>&nbsp".$msgContato."&nbsp</td>";
	echo "</tr>";
	}

	echo "</table> <br><br><br>";

	$Matriz=$conexao->prepare("select* FROM CONTATO WHERE ASSUNTO_CONTATO LIKE '%Senha%'");

	echo "<br><br>
	<b style='font-family:Megrim; font-size:40px; margin-left:50px'> Solicitações de senha </b><br><br>";
	$Matriz->execute();

	echo "<table border=1 class='tab01'>";
	echo "<tr>";
	echo "<td><b>&nbsp ID (Identificação) &nbsp&nbsp&nbsp</td>";
	echo "<td><b>&nbsp Nome do Contato &nbsp</td>";
	echo "<td><b>&nbsp E-mail do Contato &nbsp</td>";
	echo "<td><b>&nbsp Assunto do Contato &nbsp</td>";
	echo "<td><b>&nbsp Msg do Contato &nbsp </b></td>";
	echo "</tr>";

	while ($Linha = $Matriz->fetch(PDO::FETCH_OBJ)) 
	{
		$idContato = $Linha->ID_CONTATO;
		$nomeContato = $Linha->NOME_CONTATO;
		$emailContato = $Linha->EMAIL_CONTATO;
		$assuntoContato = $Linha->ASSUNTO_CONTATO;
		$msgContato = $Linha->MSG_CONTATO;
		$respContato = $Linha->RESP_CONTATO;


	echo "<tr>";
	echo "<td>&nbsp".$idContato."&nbsp</td>";
	echo "<td>&nbsp".$nomeContato."&nbsp</td>";
	echo "<td>&nbsp".$emailContato."&nbsp</td>";
	echo "<td>&nbsp".$assuntoContato."&nbsp</td>";
	echo "<td>&nbsp".$msgContato."&nbsp</td>";
	echo "</tr>";
	}

	echo "</table>";
	

	if (isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado')) 
	{
		if ($_POST["id_contato"]!="") $_SESSION['IdContato'] = $_POST['id_contato']; 
		if ($_POST["resp_contato"]!="") $_SESSION['respContato'] = $_POST['resp_contato']; 

		$Botao=$_POST["Botao"];


		if ($Botao == "Localizar") 
		{
			include"localizarcontato2.php";
		}
		
	}

	else
	{
		?>

		<br>
		<div class="formulario">
		<form name="form1" action="relatoriosuporte.php?valor=enviado" method="POST">
			<div class="form-group">
				<label for="id"> ID do Contato </label><p>
				<input class="input" class="form-control" type="text"  placeholder="Preencha ID do contato" name="id_contato">
					<br>
				<button name="Botao" value="Localizar" input type='submit' class='btnPesquisar'></button>
			</div>
		</form>
		</div>

		<br><br><br><br><br><br><br><br>
		<a href="resposta.php"> <img src="imag/voltar2.png" class="btnVoltar"> </a>
		</body>
		<?php
		
		if ($_SESSION['controleResp']=='localizado') 
	{
		echo "<br>
		<section class='jumbotron'>
		  <div class='infos' style='margin-top:-45px'>
		<b>░&nbsp&nbsp Dados: </b><br><br>";
		echo "Nome:<BR> &nbsp&nbsp&nbsp"
			.$_SESSION['nomeContato'].'<br>'.'<br>';
		echo "E-mail:<BR> &nbsp&nbsp&nbsp"
			.$_SESSION['emailContato'].'<br>'.'<br>';
		echo "Assunto:<BR> &nbsp&nbsp&nbsp"
			.$_SESSION['assuntoContato'].'<br>'.'<br>';
		echo "Mensagem:<BR> &nbsp&nbsp&nbsp"
			.$_SESSION['msgContato'].'<br>'.'<br>';
		echo "Resposta:<BR> &nbsp&nbsp&nbsp"
			.$_SESSION['respContato'].'<br>'.'<br></div></section>';
		
	}

	else if ($_SESSION['controleResp']=='respondido') 
	{
		echo "Resposta gravada com sucesso!<br><br>";
	}
	else if ($_SESSION['controleResp']== 'enviado') 
	{
		echo "Resposta enviada com sucesso!<br><br>";
	}
	}

?>

</html>