<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>

<?php

	//contato com o banco

	$Nome 	= $_POST['Nome'];
	$Email 	= $_POST['Email'];
	$Mensagem  = $_POST['Mensagem'];
	$Assunto = $_POST['Assunto'];
	$Resposta = null;

	echo ("Nome: ".$Nome."<br>");
	echo ("E-mail: ".$Email."<br>");
	echo ("Assunto: ".$Assunto."<br>");
	echo ("Fone: ".$Fone."<br>");
	echo ("Mensagem: ".$Mensagem."<br>");

	$Resposta = null;
	include "conect.php";
	try
	{	
		$Comando = $conexao->prepare("INSERT INTO CONTATO(NOME_CONTATO, EMAIL_CONTATO, ASSUNTO_CONTATO, MSG_CONTATO, RESP_CONTATO) VALUES (?, ?, ?, ?, ?)");

			$Comando->bindParam(1, $Nome);
			$Comando->bindParam(2, $Email);
			$Comando->bindParam(3, $Assunto);
			$Comando->bindParam(4, $Mensagem);
			$Comando->bindParam(5, $Resposta);

		if ($Comando->execute()) 
		{	
			if ($Comando->rowCount() >0) 
			{
				echo "<script> alert('Contato realizado com sucesso!')</script>";
				echo ('<meta http equiv="refresh" content=0; "ccontataradm.php">');

				$Nome 	= null;
				$Email 	= null;
				$Msg 	 = null;
				$Assunto = null;
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
		echo "Carregue um arquivo compatível.".$erro->getMessage();
	}

?>	

</body>
</html>