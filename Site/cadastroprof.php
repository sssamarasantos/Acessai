<!--// TELA CADASTRO PROFESSOR -->
<!DOCTYPE html>
<html>
<head>
	<title> Cadastro Professor | Acessaí </title>
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
		margin-left: 500px;
		width: 300px;
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

	if (isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado')) 
	{
		$botao = $_POST["botao"];
		$Nome = $_POST["nome_cadastro_professor"];
		$Email = $_POST["usuario_cadastro_professor"];
		$SenhaProf = $_POST["senha_cadastro_professor"];
		$Assistencia = $_POST["assistencia"];

		include "conect.php";

		if($Assistencia == 1)
		{
			$Assistencia = "Auditiva";
		}
		if($Assistencia == 2)
		{
			$Assistencia = "Cognitiva";
		}
		if($Assistencia == 3)
		{
			$Assistencia = "Visual";
		}
		if($Assistencia == 4)
		{
			$Assistencia = "Nenhuma";
		}


		if ($botao == "Inserir") 
		{
			try
			{
				if ($_POST["senha_cadastro_professor"] == $_POST["senha_confirma_professor"]) 
				{
					$Comando = $conexao->prepare("INSERT INTO TB_PROFESSOR(NOME_PROF, EMAIL_PROF, SENHA_PROF, ASSISTENCIA_PROF) VALUES (?, ?, ?,?)");

					$Comando->bindParam(1, $Nome);
					$Comando->bindParam(2, $Email);
					$Comando->bindParam(3, $SenhaProf);
					$Comando->bindParam(4, $Assistencia);

					if ($Comando->execute()) 
					{
						if ($Comando->rowCount() >0 ) 
						{
							echo "<script> alert('Cadastro do usuário Professor realizado com sucesso!')</script>";

							$Nome = null;
							$Email = null;
							$SenhaProf = null;
							$Assistencia = null;
							$_SESSION["controleProf"] == "cadastrado";

							echo "<script>location.href='cadastroprof.php';</script>";


						}
						else
						{
							echo "Erro ao tentar efetivar o contato.";
						}
					}
					else
					{
						throw new PDOException("Erro: não foi possível executar a declaração sql.");
						
					}

				}
				else
				{
					echo ('Senha não confere').'br';
					echo "<A href=\cadastroprof.php\">Cadastro</A>";
				}
			}
			catch(PDOException $erro)
			{
				echo "Erro". $erro->getMessage();
			}

		}
	}
	else
	{	
		//se usuario não tiver clicado no botao, aparece o form ainda
	?> 

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

  <br><br>

	<div style="text-align: center;">
		<img src="imag/lousafundo.png" width="225px" height="225px">
	</div>

	<br><br>

	<div class="formulario">
	<form name="form1" action="cadastroprof.php?valor=enviado" method="POST">
		<div class="form-group">
			<label for="Nome"> Nome </label>
			<input type="text" size="45" class="form-control" id="nome_cadastro" placeholder="Preencha seu nome" name="nome_cadastro_professor">
		</div>

		<div class="form-group">
			<label for="Email"> Usuário [E-mail] </label>
			<input type="text" class="form-control" id="nome_cadastro" placeholder="Preencha seu e-mail" name="usuario_cadastro_professor">
		</div>

		<div class="form-group">
			<label for="Senha"> Senha </label>
			<input type="password" class="form-control" placeholder="Preencha uma senha" name="senha_cadastro_professor" maxlength="8" required>
		</div>

		<div class="form-group">
			<label for="SenhaConf"> Confirmar Senha </label>
			<input type="password" class="form-control" placeholder="Confirme sua senha" name="senha_confirma_professor" maxlength="8" required>
		</div>

		<p>
		<div class="form-group">
			<label for="Assistencia"> Assistência </label><p>
				<input type="radio" name="assistencia" value= "1"> Auditiva <p>
				<input type="radio" name="assistencia" value= "2"> Cognitiva <p>
				<input type="radio" name="assistencia" value= "3"> Visual <p>
				<input type="radio" name="assistencia" value= "4"> Nenhuma<br>
		</div>

		<label id="aviso">Preencha os campos obrigatórios.</label><br><br><br><br><br>

		<button name="botao" value='Inserir' input type='submit' class='btnLogin'></button>

		<a href="resposta.php"> <img src="imag/voltar2.png" class="btnVoltar"> </a>
		
	</form>
	</div>
	<?php

	}
?>


</body>
</html>