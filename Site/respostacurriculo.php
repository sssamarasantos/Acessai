<!--// TELA CÚRRICULOS -->

<!DOCTYPE html>
<html>
<head>
  <title> Cúrriculos | Acessaí </title>
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
		margin-top: -630px;
		margin-left: 100px;
		width: 300px;
	}

	.jumbotron
	{
		font-family: 'Alegreya Sans SC';
		height: 300px;
		width: 300px;
		float: right;
		margin-right: 100px;
		margin-top: 10px;
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

	.btnAlterar
	{
		float: right;
		background-image: url("imag/salvar2.png");
		background-color: transparent;
		cursor: pointer;
		width: 50px;
		height: 50px;
		background-repeat: no-repeat;
		background-size: 50px 50px;
		margin-top: 10px;
	}
	.btnAlterar:hover
	{
		background-image: url("imag/salvar1.png");
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
		margin-left: 350px;
		margin-top: -150px;
	}
	.btnLogin:hover{
		background-image: url("imag/avançar1.png");
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
	if ($_SESSION['controle']=='localizado') 
	{
		echo "<br>
		<section class='jumbotron'>
		  <div class='infos' style='margin-top:-45px'>
		<b>░&nbsp&nbsp Dados do Contato de Cúrriculo: </b><br><br>";
		echo "Nome:<BR> &nbsp&nbsp&nbsp"
			.$_SESSION['nomeTrabalhe'].'<br>'.'<br>';
		echo "E-mail:<BR> &nbsp&nbsp&nbsp"
			.$_SESSION['emailTrabalhe'].'<br>'.'<br>';
		echo "Carta :<BR> &nbsp&nbsp&nbsp"
			.$_SESSION['apresentacaoTrabalhe'].'<br>'.'<br></div></section>';
	}

	else if ($_SESSION['controleResp']=='respondido') 
	{
		echo "Resposta gravada com sucesso!<br><br>";
	}
	else if ($_SESSION['controleResp']== 'enviado') 
	{
		echo "Resposta enviada com sucesso!<br><br>";
	}

	//carrega a tabela
	$Matriz=$conexao->prepare("select* FROM TRABALHE_CONOSCO");

	echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<b style='font-family:Megrim; font-size:40px; margin-left:50px'> Cúrriculos enviados no site: </b><br><br>";
	$Matriz->execute();

	echo "<table border=1 class='tab01'>";
	echo "<tr>";
	echo "<td><b>&nbsp ID (Identificação) &nbsp&nbsp&nbsp </b></td>";
	echo "<td><b>&nbsp Nome &nbsp </b></td>";
	echo "<td><b>&nbsp E-mail &nbsp </b></td>";
	echo "<td><b>&nbsp Carta de Apresentação &nbsp </b></td>";
	echo "<td><b>&nbsp Currículo &nbsp </b></td>";
	echo "<td><b>&nbsp Resposta &nbsp </b></td>";
	echo "</tr>";

	while ($Linha = $Matriz->fetch(PDO::FETCH_OBJ)) 
	{
		$idTrabalhe = $Linha->ID_TRABALHE;
		$nomeTrabalhe = $Linha->NOME_TRABALHE;
		$emailTrabalhe = $Linha->EMAIL_TRABALHE;
		$apresentacaoTrabalhe = $Linha->APRESENTACAO_TRABALHE;
		$curriculo = $Linha->CURRICULO_TRABALHE;
		$respTrabalhe = $Linha->RESP_TRABALHE;



	echo "<tr>";
	echo "<td>&nbsp".$idTrabalhe."&nbsp</td>";
	echo "<td>&nbsp".$nomeTrabalhe."&nbsp</td>";
	echo "<td>&nbsp".$emailTrabalhe."&nbsp</td>";
	echo "<td>&nbsp".$apresentacaoTrabalhe."&nbsp</td>";
	echo "<td>&nbsp".$curriculo."&nbsp</td>";
	echo "<td>&nbsp".$respTrabalhe."&nbsp</td>";
	echo "</tr>";
	}

	echo "</table>";

if(isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado')) 
	{
		if ($_POST["id_trabalhe"]!="") $_SESSION['IdTrabalhe'] = $_POST['id_trabalhe']; 
		if ($_POST["resp_trabalhe"]!="") $_SESSION['respTrabalhe'] = $_POST['resp_trabalhe']; 

		$Botao=$_POST["Botao"];

		try{


		if ($Botao == "Enviar") 
		{
			include"respondercurriculo.php";
		}

			if ($Botao == "Alterar") 
		{
			
			include"alterarcurriculo.php";
			
		}


		if ($Botao == "Localizar") 
		{
			
			include"localizarcurriculo.php";
		}
		
	}

		catch(PDOException $erro)
				{
					echo "Erro ao enviar resposta. Atualize a página.". $erro->getMessage();
				}
}
	else
	{
		?>

		<br>
		<div class="formulario">
			<form name="form1" action="respostacurriculo.php?valor=enviado" method="POST">
			<div class="form-group">
				<label for="id"> ID do Contato </label><p>
				<input class="input" class="form-control" type="text"  placeholder="Preencha ID do contato" name="id_trabalhe">
					<br>
				<button name="Botao" value="Localizar" input type='submit' class='btnPesquisar'></button>
			</div>

			<div class="form-group">
      				<label for="mensagemrespota"> Mensagem de Resposta </label>
					<textarea class="form-control" placeholder="Preencha a resposta..." name="resp_trabalhe" rows="8" cols="40"></textarea>

					<button name="Botao" style="border-style:none" input type="submit" value="Alterar" class="btnAlterar"></button>
						<br><br>
	  				<button name="Botao" value='Enviar' input type='submit' class='btnLogin'></button>
				</div>		
			</form>
			</div>
			<br><br><br><br><br><br><br><br>
		<a href="resposta.php"> <img src="imag/voltar2.png" class="btnVoltar"> </a>
		</form>
		</body>
		<?php
	}

?>

</html>