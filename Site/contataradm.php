<!--// TELA CONTATAR ADMINISTRADOR -->

<!DOCTYPE html>
<html>
<head>
  <title> Contato Administrador | Acessaí </title>
  <link rel="sortcut icon" href="imag/icon.ico" type="image/x-icon"/>

	<meta charset="utf-8">
	<link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Megrim' rel='stylesheet'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />

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
		margin-left: 150px;
		margin-right: 450px;
	}

	.btnVoltar{
		width: 50px;
		height: 50px;
		background-repeat: no-repeat;
    	background-size: 50px 50px;
    	margin-left: 10px;
    	float: left;
	}
	.btnVoltar:hover{
		background-image: url("imag/voltar1.png");
		
	}

	.btnLimpar
	{
		background-image: url("imag/limpar.png");
		float: right;
		margin-right:-200px;
		margin-top: -430px;
		border-bottom-color: transparent;
		background-color: Transparent;
        background-repeat: no-repeat;
        background-size: 115px 115px;
		cursor: pointer;
        width: 115px;
        height: 115px;
        border: none;
    }

	.btnLimpar:hover
	{
        background-image: url("imag/limpar2.png");
    }

	.btnEnviar
	{
		background-image: url("imag/enviar.png");
		background-color: Transparent;
        background-repeat: no-repeat;
        background-size: 115px 115px;
        cursor: pointer;
        width: 115px;
        height: 115px;
        border: none;

		float: right;
		margin-right:-200px;
		margin-top: -210px;
		border-bottom-color: transparent;
    }

	.btnEnviar:hover
	{
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
	$Nome 	= $_POST["nome_contato"];
	$Email 	= $_POST["email_contato"];
	$Mensagem  = $_POST["mensagem_contato"];
	$Assunto = $_POST["assunto_contato"];
	$Resposta = null;
	include "conect.php";

	if ($botao == "Enviar") 
		{
			
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
				echo "<script>location.href='contataradm.php';</script>";
				

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
		echo "Erro".$erro->getMessage();
	}
}
}
else{

?>	


<br>

 <!-- Conteúdo -->

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

	<!-- Div para formulario-->
	<div class="formulario">
	<b style="font-family:Megrim; font-size:45px; margin-left:-50px">Contatar administradores</b>

	<form action="contataradm.php?valor=enviado" method="post">				
		<div class="form-group">
			<label for="Nome"> Nome </label>
			<input type="text" class="form-control" id="nome_contato" placeholder="Insira seu nome" name="nome_contato" required>
		</div>

		<div class="form-group">
			<label for="Email"> Endereço de e-mail </label>
			<input type="email" class="form-control" id="email_contato" placeholder="nome@exemplo.com" name="email_contato" required>
		</div>
			  
		<div class="form-group">
			<label for="Assunto"> Selecione o assunto </label>
			<select class="form-control" id="assunto_contato" name="assunto_contato">
				<option default value="Selecione"> Selecione um assunto </option>
				<option value="Suporte"> Solicitações de suporte </option>
				<option value="Senha"> Alterar Senha </option>
			</select>
		</div>

		<div class="form-group">
			<label for="Mensagem"> Mensagem </label>
			<textarea class="form-control" id="mensagem_contato" name="mensagem_contato" rows="7" cols="40" required></textarea>
		</div>

		<div class="form-group">
			<button input type="submit" name="botao" style="border-style:none" value="Enviar" class="btnEnviar"></button> 
		</div>

		<div class="form-group">
			<button input type="reset" name="botao" style="border-style:none" value="Limpar" class="btnLimpar"></button> 
		</div>

		<a href="menuprofessor.php" role="Voltar"> <img src="imag/voltar2.png" class="btnVoltar"> </a>

	</form>

		
	</div>
<br><br>


<?php
}
?>

</body>
</html>
