<!--// TELA PROFESSOR - ALTERAR DADOS -->
<!DOCTYPE html>
<html>
<head>
	<title> Professor Info | Acessaí </title>
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

  	.imagem
  	{
	  	float: left;
		margin-top: 100px;
		margin-left: 250px;
	}

	.Infos
	{
		float: left;
		margin-top: 360px;
		margin-left: -230px;
		font-family: 'Alegreya Sans SC';
	}

	.formulario
	{
		float: right;
		font-family: 'Alegreya Sans SC';
		margin-right: 230px;
	}

  	.btnSair
  	{
		float: left;
		margin-left: -300px;
		margin-top: 500px;
		background-image: url("imag/sair2.png");
		background-color: transparent;
		cursor: pointer;
		width: 55px;
		height: 55px;
		background-repeat: no-repeat;
		background-size: 55px 55px;
	}
	.btnSair:hover{
		background-image: url("imag/sair1.png");
	}

	.btnAvancar
	{
		float: left;
		margin-left: -220px;
		margin-top: -10px;
		background-image: url("imag/avançar2.png");
		background-color: transparent;
		cursor: pointer;
		width: 55px;
		height: 55px;
		background-repeat: no-repeat;
		background-size: 55px 55px;
	}
	.btnAvancar:hover
	{
		background-image: url("imag/avançar1.png");
	}

	.btnAlterar
	{
		float: right;
		margin-left: -280px;
		margin-top: 20px;
		background-image: url("imag/salvar2.png");
		background-color: transparent;
		cursor: pointer;
		width: 60px;
		height: 60px;
		background-repeat: no-repeat;
		background-size: 60px 60px;
	}
	.btnAlterar:hover
	{
		background-image: url("imag/salvar1.png");
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
//error_reporting(0);
//ini_set("display_errors", 0);

	echo "<div class='imagem'>
			<img src='imag/lousafundo.png' width=230px; height=230p;>
		  </div>
		  
		  <div class='Infos'> 
		░&nbsp&nbsp  Dados do Professor <br><br>
		&nbsp&nbsp	Nome: ".$_SESSION['nomeProf']."<br>
		&nbsp&nbsp	Usuário: ".$_SESSION['emailProf']."<br><br>
		  </div>";
		  echo "<a href='doLogout.php?token=".md5(session_id())."'><div class='btnSair'></div></a>
			  ";


	if ($_SESSION['controleProf'] == 'alterado') 
	{
		//echo ("<script> window.location.href='alterarprofessor.php';</script>"); 
		echo "Cadastro atualizado com sucesso!".'<br>'.'<br>';
		$_SESSION['controleProf'] == '';
	}
	else
	{
		echo "<div style='float:right; margin-top:-90px; margin-right: 260px; font-family: Alegreya Sans SC'> 
				<br><br><br><br><br><br><Br>
				Preencha o campo que deseja alterar :D <p>
				Caso não queira alterar nada, confirme sua senha novamente! <br><br> </div>";
		
	}

	if (isset($_REQUEST['valor']) and ($_REQUEST['valor']== 'enviado')) 
	{
		$botao = $_POST["botao"];

		if ($botao == "Alterar") 
		{
			include "alteradoprofessor.php";
		}

		if ($botao == "Gerenciar") 
		{
			$_SESSION['controleProf'] = "gerenciar";
			header('location:menuprofessor.php');

		}

	}

	else
	{
		?> 

	<div class="formulario">
	<form name="form1" action="alterarprofessor.php?valor=enviado" method="POST">
		<div class="form-group">
			<label for="Nome"> Alterar Nome </label>
			<input type="text" size="45" class="form-control" id="nome_cadastro_professor" placeholder="Preencha seu nome" name="nome_cadastro_professor">
		</div>
		<div class="form-group">
			<label for="Email"> Alterar Usuário [E-mail] </label>
			<input type="text" class="form-control" placeholder="Preencha seu e-mail" name="usuario_cadastro_professor">
		</div>
		<div class="form-group">
			<label for="Senha"> Senha </label>
			<input type="password" class="form-control" placeholder="Preencha sua senha" name="senha_cadastro_professor" maxlength="8" required>
		</div>
		<div class="form-group">
			<label for="SenhaConf"> Confirmar Senha </label>
			<input type="password" class="form-control" placeholder="Confirme sua senha" name="senha_confirma_professor" maxlength="8" required>
		</div>

		<div class="form-group">
			<button name="botao" style="border-style:none" input type="submit" value="Alterar" class="btnAlterar"></button>
		</div>

		<div class="form-group">
			<button name="botao" style="border-style:none" input type="submit" value="Gerenciar" class="btnAvancar"></button>
		</div>

	</form>
	</div>

		
	</body>
	<?php
}

?>