<!--// TELA INSERIR AULA 01 -->

<!DOCTYPE html>
<html>
<head>
  <title> Inserir Aula | Acessaí </title>
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
	
	.tab01
	{
		font-family: 'Alegreya Sans SC';
		margin-left: 200px;
		font-size: 20px;
		border-color: #C0C0C0;
	}

	.formulario
	{
		float: right;
		font-family: 'Alegreya Sans SC';
		margin-right: 250px;
		margin-top: -100px;
		font-size: 16px;
	}

	.btnPesquisar
	{
		background-image: url("imag/pesquisa2.png");
		background-color: Transparent;
        background-repeat: no-repeat;
        background-size: 50px 50px;
        cursor: pointer;
        width: 50px;
        height: 50px;
        border: none;
		margin-left: 180px;
	}
	.btnPesquisar:hover
	{
		background-image: url("imag/pesquisa1.png");
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
		margin-left: 180px;
	}
	.btnLogin:hover{
		background-image: url("imag/avançar1.png");
	}

	.btnVoltar{
		width: 50px;
		height: 50px;
		background-repeat: no-repeat;
    	background-size: 50px 50px;
    	margin-left: 30px;
    	float: left;
	}
	.btnVoltar:hover{
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
include "conect.php";
error_reporting(0);
ini_set("display_errors", 0);
$Nome = $_SESSION["nomeProf"];
$Assistencia = $_SESSION["assistenciaProf"];


	if ($_SESSION['controle']=='localizado') 
	{
		echo "Disciplina:<BR> ".$_SESSION['nomeDisc'].'<br>'.'<br>';
		//echo "Disciplinas cadastradas: ".'<br>'.'<br>';
	}

		$ID = $_SESSION["IdProf"];

	//carrega a tabela
	$Matriz=$conexao->prepare("select * FROM TB_DISCIPLINA WHERE ID_PROF= $ID");

	echo "<br><br><br><br><br>
	<b style='font-family:Megrim; font-size:40px; margin-left:100px'> Disciplinas que ministra </b><br><br>";
	$Matriz->execute();

	echo "<table border=1 class='tab01'>";
	echo "<tr>";
	echo "<td><b>&nbsp ID (Identificação) &nbsp</td>";
	echo "<td><b>&nbsp Disciplina &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</b></td>";
	echo "</tr>";

	while ($Linha = $Matriz->fetch(PDO::FETCH_OBJ)) 
	{
		$id = $Linha->ID_DISC;
		$nome = $Linha->NOME_DISC;
		$prof = $Linha->ID_PROF;
	
		echo "<tr>";
		echo "<td>&nbsp &nbsp ".$id."</td>";
		echo "<td>&nbsp &nbsp ".$nome."</td>";
		echo "</tr>";
	}

	echo "</table>";
	

	if (isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado')) 
	{
		if ($_POST["iddisc"]!="") $_SESSION['IdDisc'] = $_POST['iddisc']; 
	
		$botao=$_POST["botao"];

		if ($botao == "Localizar") 
		{
			include"localizardisc.php";
		}

	$Topico = $_POST["nometopico"];
	$data = date("Y-m-d H:i:s"); 
	$disciplina = $_POST["iddisc"];
	$nomedisciplina = $_SESSION["nomeDisc"];

	echo "Nome do professor: ".$Nome.'<br>'; // exibe nome do professor que entrou
	echo "Assistência: ". $Assistencia.'<br>'; // exibe a assistencia que ele da
	echo "Disciplina: ". $nomedisciplina.'<br>'.'<br>'.'<br>';
	echo "Dados Assunto da Aula:".'<br>'.'<br>';

	if ($botao == "Continuar") 
		{
			
	try// inserir na tb_aula
	{	

		//PESQUISA AS AULAS QUE JA TEM OU AICIONA UM NOME NOVO
		$Comando = $conexao->prepare("INSERT INTO TB_AULA(NOME_AULA, DTA_MODI_AULA, ID_DISC) VALUES (?, ?, ?)");

			$Comando->bindParam(1, $Topico);
			$Comando->bindParam(2, $data);
			$Comando->bindParam(3, $disciplina);
			
		if ($Comando->execute()) 
		{	
			if ($Comando->rowCount() >0) 
			{
				$Topico= null;
				$data = null;
				$disciplina = null;
				echo "<script> alert('Assunto inserido. Continue.')</script>";
				echo "<script>location.href='aula.php';</script>";
			}

			else
			{
				echo "Erro ao tentar efetivar o envio.";
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

	<div class="formulario">
	<form class="was-validated" action="professor.php?valor=enviado" method="POST">
		<div class="form-group">
			<label for="Id"> ID da Disciplina </label><p>
			<input class="input" class="form-control" type="text" placeholder="Preencha o ID" name="iddisc"><br><br>
			
			<button name="botao" value='Localizar' input type='submit' class='btnPesquisar' id="Codigo" required></button>
		</div>

		<br><br>

    <div id="divtopico">
	<div class="form-group">
      <label for="nometopico">Nome do tópico:</label>
      <input type="text" class="form-control" id="nometopico" name="nometopico" required><br><br>

	  <button name="botao" value='Continuar' input type='submit' class='btnLogin'></button>
	</div>
	</div>
   
  	</div>


  

 
  <br><br><br><br><br><br><br><br><br><br><br><br><br>
  <a href="menuprofessor.php" role="Voltar"> <img src="imag/voltar2.png" class="btnVoltar"> </a>
 
</form>
</div>
<?php
}
?>
</body>
<script>
	$(document).ready(function(){
			$("#divtopico").hide();

	});
		$(document).ready(function(){
			$("#Codigo").click(function(){
			$("#divtopico").show();	
			});
			

	});

</script>
</html>