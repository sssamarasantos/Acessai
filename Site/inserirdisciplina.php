<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>

<?php
session_start();
include"conect.php";
if ($_SESSION['controleProf']=='localizado') 
	{
		echo "Dados do Usuário Professor:<br><br>";
		echo "Nome:<BR> ".$_SESSION['nomeProf'].'<br>'.'<br>';
		echo "E-mail:<BR> ".$_SESSION['emailProf'].'<br>'.'<br>';
		echo "Assistência:<BR> ".$_SESSION['assistenciaProf'].'<br>'.'<br>';
		//echo "Disciplina:<BR> ".$_SESSION['nomeDisc'].'<br>'.'<br>';
		echo "Cadastro localizado com sucesso: ".'<br>'.'<br>';
	}



	//carrega a tabela
	$Matriz=$conexao->prepare("select* FROM TB_PROFESSOR");

	echo "Professores cadastrados no site:<br><br>";
	$Matriz->execute();

	echo "<table border=1>";
	echo "<tr>";
	echo "<td> Identificação</td>";
	echo "<td> Nome</td>";
	echo "<td> E-mail</td>";
	echo "<td> Assistência</td>";
	//echo "<td> Disciplina</td>";
	echo "</tr>";

	while ($Linha = $Matriz->fetch(PDO::FETCH_OBJ)) 
	{
		$idProf = $Linha->ID_PROF;
		$nomeProf = $Linha->NOME_PROF;
		$emailProf = $Linha->EMAIL_PROF;
		$assistenciaProf = $Linha->ASSISTENCIA_PROF;
		//$nomeDisciplina = $Linha->NOME_DISC;
		


	echo "<tr>";
	echo "<td>".$idProf."</td>";
	echo "<td>".$nomeProf."</td>";
	echo "<td>".$emailProf."</td>";
	echo "<td>".$assistenciaProf."</td>";
	//echo "<td>".$nomeDisciplina."</td>";
	echo "</tr>";
	}

	echo "</table>";
	

	if (isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado')) 
	{
		if ($_POST["idprof"]!="") $_SESSION['IdProf'] = $_POST['idprof']; 
		

		

		$botao=$_POST["botao"];
		$nomedisciplina = $_POST["nomedisciplina"];



		if ($botao == "Localizar") 
		{
			include"localizarprofessor2.php";
		}
		
	



		if ($botao == "Confirmar") 
		{
			try
			{
			
					$Comando = $conexao->prepare("INSERT INTO TB_DISCIPLINA(NOME_DISC, ID_PROF) VALUES (?,?)");

					$Comando->bindParam(1, $nomedisciplina);
					$Comando->bindParam(2, $idProf);
					
					if ($Comando->execute()) 
					{
						if ($Comando->rowCount() >0 ) 
						{
							echo "<script> alert('Disciplina criada com sucesso!')</script>";

							$nomedisciplina= null;
							$idProf = null;
							
							//$_SESSION["controleDisc"] == "inserido";


								

							echo "<A href =\"resposta.php\">Voltar</A>";

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
			
		
			
			catch(PDOException $erro)
			{
				echo "Erro". $erro->getMessage();
			}

	

	}

		}

	else
	{//se usuario não tiver clicado no botao, aparece o form ainda
	?> 

	<form name="form1" action="inserirdisciplina.php?valor=enviado" method="POST">
		Nome da disciplina:<br>
			<INPUT type="text" placeholder="Ex: História, Geografia..." name="nomedisciplina"><br><p>

		Id:<br>
		<input class="input" type="text" id="Codigo" placeholder="Preencha seu id." name="idprof">
		<input type="submit" name="botao" value="Localizar"><br><p>

	<input type="submit" name="botao" value="Confirmar"><br><p>	
	</form>
<?php

}
?>
</body>
</html>