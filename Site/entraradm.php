<!--// TELA - ENTRAR ADM-->

<!DOCTYPE html>
<html>
<head>
	<title> Login Administrador | Acessaí </title>
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
	.Titulo{
		font-family: 'Megrim'; 
		font-size: 30px;
		margin-top: 10px;
	}

	.formulario
	{
		align-items: center;
		display: center;
		justify-content: center;
		margin-right: 500px;
		margin-left: 500px;
	}

	.btnVoltar{
		width: 50px;
		height: 50px;
		background-repeat: no-repeat;
		background-size: 50px 50px;
	}
	.btnVoltar:hover{
		background-image: url("imag/voltar1.png");
		
	}

	.btnLogin{
		background-image: url("imag/avançar2.png");
		background-color: transparent;
		cursor: pointer;
		width: 55px;
		height: 55px;
		background-repeat: no-repeat;
		background-size: 55px 55px;
	}
	.btnLogin:hover{
		background-image: url("imag/avançar1.png");
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

	
	if (isset($_REQUEST['valor']) and ($_REQUEST['valor']== 'enviado')) 

	{
		$botao = $_POST["botao"];
		$login = $_POST['usuario_login'];
		$senha = $_POST['senha_login'];
		include"conect.php";


		if ($botao == "Login") 

		{
			session_start();
			$_SESSION["controleAdm"] = "logado";
			try
			{
				$Comando = $conexao->prepare("SELECT ID_ADM, NOME_ADM, EMAIL_ADM, SENHA_ADM FROM ADIMINISTRADOR WHERE EMAIL_ADM=? AND SENHA_ADM=?");
	
	$Comando->bindParam(1,$login);
	$Comando->bindParam(2,$senha);

	if ($Comando->execute()) 
	{
		if ($Comando->rowCount()>0) 
		{
			while ($linha = $Comando-> fetch(PDO::FETCH_OBJ)) 
			{
				$id = $linha->ID_ADM;
				$_SESSION['IdAdm'] = $id;

				$nome = $linha->NOME_ADM;
				$_SESSION['nomeAdm'] = $nome;

				$email = $linha->EMAIL_ADM;
				$_SESSION['emailAdm'] = $email;

				$senha = $linha->SENHA_ADM;
				$_SESSION['senhaAdm'] = $senha;

				header('location:alteraradm.php');


			}
		}
		else 
		{
			unset($_SESSION['controle']);

			echo ("<script> 

                        alert('Usuário e/ou senha não confere');
                        window.location.href='entraradm.php';

                            </script>");
		}
	}
			}

			catch(PDOException $erro)
				{
					echo "Erro". $erro->getMessage();
				}


		}

		if ($botao == "Cadastrar") 
		{
			session_start();
			$_SESSION["controleAdm"] = "novo";
			//será marcado como novo para sabermos que o usuario não tem cadastro
			echo "<script>location.href='cadastroadm.php';</script>";

		}
	}
	else
	{
		?>.

<br><br>
	<div style="text-align: center;">
		<img src="imag/pcfundo.png" width="225px" height="225px">
		<p class="Titulo"> Administrador </p>
	</div>

	<div class="formulario">
		<form action="entraradm.php?valor=enviado" method="POST">
		<div class="form-group">
			<label for="Usuário"> Usuário </label>
			<input type="text" class="form-control" placeholder="Preencha seu e-mail" name="usuario_login" required>
		</div>

		<div class="form-group">
			<label for="Senha"> Senha </Label>
			<input type="password" class="form-control" placeholder="Preencha sua senha" name="senha_login" required>
		</div>

		<br>

		<div style="text-align:center">
		<div class="form-group" style="float:left; margin-left:25px">
			<!--<input type="submit" name="botao" value="Cadastrar">-->
			<a href="menulogin.php"> <img src="imag/voltar2.png" class="btnVoltar"> </a>
		</div>

		<div class="form-group" style="float:right; margin-right:25px">
			<button name="botao" style="border-style:none" input type="submit" value="Login" class="btnLogin"></button>
		</div>
		</div>
		</form>
	</div>

		<?php

	}
?>
