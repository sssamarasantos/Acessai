<!--// TELA AULAS ENVIADAS 02 -->

<!DOCTYPE html>
<html>
<head>
  <title> Aulas Enviadas | Acessaí </title>
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

		overflow: hidden;
	}

	.formulario
	{
		font-family: 'Alegreya Sans SC';
		float: right;
		margin-top: -340px;
		margin-right: -10px;
		width: 300px;
	}

	.jumbotron
	{
		font-family: 'Alegreya Sans SC';
		height: 250px;
		width: 250px;
		float: right;
		margin-right: -230px;
		margin-left: 30px;
		margin-top: -280px;
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
		background-image: url("imag/salvar2.png");
		background-color: Transparent;
        background-repeat: no-repeat;
        background-size: 45px 45px;
        cursor: pointer;
        width: 45px;
        height: 45px;
        border: none;
	}
	.btnAlterar:hover
	{
		background-image: url("imag/salvar1.png");
	}

	.btnExcluir
	{
		background-image: url("imag/excluir2.png");
		background-color: Transparent;
        background-repeat: no-repeat;
        background-size: 45px 45px;
        cursor: pointer;
        width: 45px;
        height: 45px;
        border: none;
	}
	.btnExcluir:hover
	{
		background-image: url("imag/excluir1.png");
	}

	.btnVoltar
	{
		width: 50px;
		height: 50px;
		background-repeat: no-repeat;
    	background-size: 50px 50px;
    	margin-left: 40px;
		margin-top: 230px;
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
include"conect.php";
error_reporting(0);
ini_set("display_errors", 0);
$iddisc=$_SESSION["IdDisc"];

echo "<p><p><p>
	<b style='font-family:Megrim; font-size:40px; margin-left:50px'> Dados das Videoaulas Enviadas </b><br><br>";
	//echo "Nome:<BR> ".$_SESSION['nomeVideoaula'].'<br>'.'<br>';


	//carrega a tabela
	$Matriz=$conexao->prepare("select TB_VIDEOAULA.ID_VIDEOAULA, TB_VIDEOAULA.NOME_VIDEOAULA, TB_VIDEOAULA.DTA_POST_VIDEOAULA, TB_VIDEOAULA.ID_AULA, TB_AULA.NOME_AULA, TB_AULA.ID_AULA, TB_AULA.ID_DISC FROM TB_VIDEOAULA inner join TB_AULA ON TB_VIDEOAULA.ID_AULA= TB_AULA.ID_AULA where TB_AULA.ID_DISC=?");
	$Matriz->bindParam(1, $iddisc);


	$Matriz->execute();

	echo "<table border=1 class='tab01'>";
	echo "<tr>";
	echo "<td><b>&nbsp ID (Identificação) &nbsp&nbsp&nbsp</td>";
	echo "<td><b>&nbsp Disciplina &nbsp</td>";
	echo "<td><b>&nbsp Assunto &nbsp</td>";
	echo "<td><b>&nbsp Nome da aula &nbsp</td>";
	echo "<td><b>&nbsp Data de postagem &nbsp&nbsp&nbsp</b></td>";
	echo "</tr>";

	while ($Linha = $Matriz->fetch(PDO::FETCH_OBJ)) 
	{
		$id= $Linha->ID_VIDEOAULA;
		$nome = $Linha->NOME_VIDEOAULA;
		$datapost = $Linha->DTA_POST_VIDEOAULA;
		$topico =$Linha->NOME_AULA;
		


		echo "<tr>";
		echo "<td>&nbsp&nbsp".$id."</td>";
		echo "<td>&nbsp&nbsp".$_SESSION["nomeDisc"]."&nbsp&nbsp&nbsp&nbsp</td>";
		echo "<td>&nbsp&nbsp".$topico."&nbsp</td>";
		echo "<td>&nbsp&nbsp".$nome."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>";
		echo "<td>&nbsp&nbsp".$datapost."</td>";
		echo "</tr>";
	}
	

	echo "</table>";
	

	if (isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado')) 
	{
		if ($_POST["id_videoaula"]!="") $_SESSION['IdVideoaula'] = $_POST['id_videoaula']; 

		$Botao=$_POST["Botao"];



			if ($Botao == "Alterar") 
		{
			include"alteraraula.php";
		}

		if ($Botao == "Localizar") 
		{
			include"localizaraula2.php";
		}

		if($Botao == "Excluir")
		{
			include"excluiraula2.php";
		}

		
	}

	else
	{
		?>

	<div class="formulario">
		<form name="form1" action="relatorioaulasenviadas.php?valor=enviado" method="POST">
			<div class="form-group">
				<label for="id"> ID da Videoaula </label><p>
				<input class="input" class="form-control" type="text" placeholder="Preencha ID da videoaula" name="id_videoaula">
					<br>

				<button name="Botao" value="Localizar" input type='submit' class='btnPesquisar'></button>
			</div>


			<br><br><br><br><br><br><br><br><br><br>

			<div class="form-group">
				<label for="novonomeaula"> Novo Nome da aula </label><p>
				<input class="input" class="form-control" type="text" id="nome_videoaula" placeholder="Inserir caso queira alterar um novo nome da Videoaula" name="nome_videoaula">
			</div>

			<div class="form-group">
				<label for="txt"> Novo Texto da aula </label><p>
				<input class="input" class="form-control" type="text" id="texto_videoaula" placeholder="Inserir caso queira alterar o texto da Videoaula" name="texto_videoaula">
			</div>

			<div class="form-group">
				<label for="data"> Novo Data de Postagem da aula </label><p>
		 		<input type="date" id="date" name="datapostagem">
			</div>

		<div style="margin-left:145px">

			<button name="Botao" value='Alterar' input type='submit' class='btnAlterar'></button>
				&nbsp
			<button name="Botao" value='Excluir' input type='submit' class='btnExcluir' onclick="return confirm('Tem certeza que deseja deletar este registro?')"></button>
		
		</div>
		</form>
	</div>

		<a href="menuprofessor.php"> <img src="imag/voltar2.png" class="btnVoltar"> </a>

		</body>
		<?php

if ($_SESSION['controleVDAula']=='localizado') 
{
	
	echo "<br>
	<section class='jumbotron'>
	  <div class='infos' style='margin-top:-45px'>
	<b>░&nbsp&nbsp Informações da Aula </b><br><br>
		  Nome da Aula:<BR> &nbsp&nbsp&nbsp
					  ".$_SESSION['nomeVideoaula'].'<br>';
	echo "Data de postagem:<BR> &nbsp&nbsp&nbsp
					".$_SESSION['dataPost'].'<br>';
	echo "Disciplina:<BR> &nbsp&nbsp&nbsp
					".$_SESSION['nomeDisc'].'<br>'.'<br></div></section>';
}


else if ($_SESSION['controleVDAula']== 'alterado') 
{
	echo "<script> alert('Alterado com sucesso!')</script>";
}
	}

?>

</html>