<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>

<?php
session_start();

	if (isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado')) 
	{
		$botao = $_POST["botao"];
		$Nome = $_POST["nome_cadastro"];
		$Email = $_POST["usuario_cadastro"];
		$SenhaAdm = $_POST["senha_cadastro"];

		include "conect.php";

		if ($botao == "Inserir") 
		{
			try
			{
				if ($_POST["senha_cadastro"] == $_POST["senha_confirma"]) 
				{
					$Comando = $conexao->prepare("INSERT INTO ADIMINISTRADOR(NOME_ADM, EMAIL_ADM, SENHA_ADM) VALUES (?, ?, ?)");

					$Comando->bindParam(1, $Nome);
					$Comando->bindParam(2, $Email);
					$Comando->bindParam(3, $SenhaAdm);

					if ($Comando->execute()) 
					{
						if ($Comando->rowCount() >0 ) 
						{
							echo "<script> alert('Cadastro realizado com sucesso!')</script>";

							$Nome = null;
							$Email = null;
							$SenhaAdm = null;
							$_SESSION["controleAdm"] == "cadastrado";

							echo "<script>location.href='entraradm.php';</script>";


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
					echo "<A href=\cadastroadm..php\">Cadastro</A>";
				}
			}
			catch(PDOException $erro)
			{
				echo "Erro". $erro->getMessage();
			}

		}
	}
	else
	{//se usuario não tiver clicado no botao, aparece o form ainda
	?> 
	<form name="form1" action="cadastroadm.php?valor=enviado" method="POST">
		Nome:<br>
		<input class="input" type="text" id="nome_cadastro" placeholder="Preencha seu nome." name="nome_cadastro"><br><p>
		Usuário(e-mail): <br>
		<input class="input" type="text"  placeholder="Preencha seu e-mail." name="usuario_cadastro"><br><p>
		Senha:<br>
		<input class="input" type="text" placeholder="Preencha sua senha." name="senha_cadastro" maxlength="8" required><br><p>
		Confirma senha:<br>
		<input class="input" type="text" placeholder="Confirme sua senha." name="senha_confirma" maxlength="8" required><br><p>

		<input type="submit" name="botao" value="Inserir"><br><p>

		<label id="aviso">Preencha os campos obrigatórios.</label><br>

	</p>

		
	</form>
	<?php

	}
?>


</body>
</html>