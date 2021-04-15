<!--// TELA 3 - TRABALHE CONOSCO -->
<!DOCTYPE html>
<html>
<head>
  <title> Trabalhe Conosco | Acessaí </title>
  <link rel="sortcut icon" href="imag/icon.ico" type="image/x-icon"/>

	<meta charset="utf-8">
	<link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" href="style.css" />

	<style type="text/css">

	.imgpc
	{
		float: left;
		margin-left: 180px;
		margin-top: 45px;
	}

	.formulario
	{
		float: right;
		margin-right: 60px;
		margin-top: -20px;
	}

	.botaoform
	{
		float: right;
		margin-top: 35px;
		margin-right: 110px;
	}

	div.upload {
    	width: 90px;
    	height: 90px;
    	background: url("imag/upload.png");
		background-size: 160px 160px;
		width: 160px;
        height: 160px;
    	overflow: hidden;
	}
	div.upload:hover{
        background-image: url("imag/upload2.png");
    }

	div.upload input 
	{
		cursor: pointer;
    	display: block !important;
    	width: 127px !important;
    	height: 127px !important;
    	opacity: 0 !important;
    	overflow: hidden !important;
	}

	.botaozin{
        background-image: url("imag/enviar.png");
		background-color: Transparent;
        background-repeat: no-repeat;
        background-size: 115px 115px;
        cursor: pointer;
        width: 115px;
        height: 115px;
        border: none;
    }

	.botaozin:hover{
        background-image: url("imag/enviar2.png");
    }
	</style>
</head>
<body>

<?php
session_start();

	if (isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado')) 
	{

	$botao = $_POST["botao"];	
	$Nome 	= $_POST["nome_trabalhe"];
	$Email 	= $_POST["email_trabalhe"];
	$Mensagem  = $_POST["apresentacao_trabalhe"];
	$Curriculo = $_POST["curriculo_trabalhe"];
	$Resposta = null;

		include "conect.php";

		if ($botao == "Enviar") 
		{
			
		

		try
		{	
		$Comando = $conexao->prepare("INSERT INTO TRABALHE_CONOSCO(NOME_TRABALHE, EMAIL_TRABALHE, APRESENTACAO_TRABALHE, CURRICULO_TRABALHE, RESP_TRABALHE) VALUES (?, ?, ?, ?,?)");

			$Comando->bindParam(1, $Nome);
			$Comando->bindParam(2, $Email);
			$Comando->bindParam(3, $Mensagem);
			$Comando->bindParam(4, $Curriculo);
			$Comando->bindParam(5, $Resposta);

		if ($Comando->execute()) 
		{	
			if ($Comando->rowCount() >0) 
			{
				echo "<script> alert('Contato registrado com sucesso!')</script>";
				echo "<script>location.href='trabalhe.php';</script>";

				$Nome 	= null;
				$Email 	= null;
				$Mensagem = null;
				$Curriculo = null;
				$Resposta = null;

			}

			else
			{
				echo "Erro ao tentar efetivar o contato.";
			}
		}

		else
		{
			throw new PDOException("Não foi possível executar a declaração sql.");
			
		}
	}

	catch(PDOException $erro)
	{
		echo "Erro".$erro->getMessage();
	}
}
}

else {
	?>

<ul class="nav nav-tabs" style="font-family: 'Alegreya Sans SC'">
  <li class="nav-item">
    <a class="nav-link" href="contato.php">Contato</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="faq.php"> FAQ </a> 
  </li>

  <div>
  	<a href="index.php"> <img src="imag/homezin.png" width=110px height=110px;> </a>
  </div>

  <li class="nav-item">
    <a class="nav-link" href="sobre.php">Sobre Nós</a>
  </li>

  <li class="nav-item">
    <a style="background-color: #ffda75; border-style: none; font-style: bold;" href="menulogin.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">
      &nbsp Login &nbsp</a>
  </li>
</ul>

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

	<div class="imgpc">
		<img src="imag/imgpc.png" width=350px height=350px;>
	</div>

	<br>

	<!-- Formulario -->
	<div class="formulario">
		<form action="trabalhe.php?valor=enviado" method="POST">

	</div>

	<div class="botaoform">
		<div class="form-group">
			<div class="upload">
				<input type="file" class="form-control-file" id="curriculo_trabalhe" name="curriculo_trabalhe" required>
			</div>
		</div>

		<br><br>

		<div class="enviar">
			<button name="botao" style="margin-right:-450px" value="Enviar" class="botaozin"></button> 
		</div>
		<br><p>
	</div>
	<div class="formulario">

		<div class="form-group">
			<label for="Nome">Nome:</label>
			<input type="text" class="form-control" id="nome_trabalhe" name="nome_trabalhe" size="43" placeholder="Insira seu nome" required>
		</div>

		<div class="form-group">
			<label for="Email">Endereço de e-mail:</label>
			<input type="email" class="form-control" id="email_trabalhe" name="email_trabalhe" placeholder="nome@exemplo.com" required>
		</div>
			
		<div class="form-group">
			<label for="Apresentacao">Carta de apresentação:</label>
			<textarea class="form-control" id="apresentacao_trabalhe" name="apresentacao_trabalhe" rows="8" required></textarea>
		</div>
	</div>

	
	</form>

<br><br><br>
      
    <?php

}
?>
</body>
</html>