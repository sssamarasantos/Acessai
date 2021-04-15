<!--// TELA INSERIR AULA 02 -->

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

	.jumbotron
	{
		font-family: 'Alegreya Sans SC';
		height: 180px;
		width: 350px;
		float: right;
		margin-right: 20px;
	}

	.formulario
	{
		font-family: 'Alegreya Sans SC';
		margin-left: 100px;
		margin-right: 250px;
	}

	.btnLogin{
		background-image: url("imag/avançar2.png");
		background-color: transparent;
		cursor: pointer;
		width: 75px;
		height: 75px;
		background-repeat: no-repeat;
		background-size: 75px 75px;
		border: none;
		float: right;
		margin-right: 200px;
		margin-bottom: 50px;
	}
	.btnLogin:hover{
		background-image: url("imag/avançar1.png");
	}

	.btnVoltar{
		width: 65px;
		height: 65px;
		background-repeat: no-repeat;
    	background-size: 65px 65px;
    	margin-left: 80px;
		margin-bottom: 35px;
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



	//include_once 'localizardisc.php';
	$Nome = $_SESSION["nomeProf"];
	$Assistencia = $_SESSION["assistenciaProf"];
	$nomedisciplina = $_SESSION["nomeDisc"];	
	$disciplina = $_SESSION["IdProf"];






echo "<br>
	<section class='jumbotron'>
	  <div class='infos' style='margin-top:-35px'>
	<b>░&nbsp&nbsp Informações </b><br><br>
 	Nome do professor: ".$Nome.'<br>'; // exibe nome do professor que entrou
echo "Assistência: ". $Assistencia.'<br>'; // exibe a assistencia que ele da
echo "Disciplina: ". $nomedisciplina.'<br>'.'<br>'.'<br></div></section>';
echo "<br><br><br><br>
	<b style='font-family:Megrim; font-size:40px; margin-left:40px'> Insira os dados da Aula </b>".'<br>'.'<br>';


//lista com os tópicos já cadastrados
	$Matriz=$conexao->prepare("select * FROM TB_AULA");
	$Matriz->execute();
	while ($Linha = $Matriz-> fetch(PDO::FETCH_OBJ)) 
	{
		$idaula=$Linha->ID_AULA;
		$nomeaula=$Linha->NOME_AULA;
		$datamodi=$Linha->DTA_MODI_AULA;
		$iddisci=$Linha->ID_DISC;
	}

	$_SESSION["nomeaula"]=$nomeaula;

	if (isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado')) 
	{
		
	$botao = $_POST["botao"];
	$Aula	= $_POST["nomeaula"];
	$Texto = $_POST["texto"];
	$videoaula = $_POST["videoaula"];
	$arquivo = $_POST["arquivo"];
	$datapost = $_POST["datapostagem"];
	$idAula = $idaula;
	$Assistencia = $_SESSION["assistenciaProf"];
	
	





	
	if ($botao == "Enviar") 
		{
			//MOSTRA TABELA COM AS AULAS TODAS PRA ELE ESCOLHER QUAL USAR E PEGA ID MESMA LOGICA QUE A DISC
	try// inserir na tb_videoaula
	{
		$Comando = $conexao->prepare("INSERT INTO TB_VIDEOAULA(NOME_VIDEOAULA,VIDEO_VIDEOAULA, DTA_POST_VIDEOAULA, ASSISTENCIA_VIDEOAULA, ARQUIVO_VIDEOAULA, TEXTO_VIDEOAULA,ID_AULA) VALUES (?, ?, ?, ?, ?,?,?)");

			$Comando->bindParam(1, $Aula);
			$Comando->bindParam(2, $videoaula);
			$Comando->bindParam(3, $datapost);
			$Comando->bindParam(4, $Assistencia);
			$Comando->bindParam(5, $arquivo);
			$Comando->bindParam(6, $Texto);
			$Comando->bindParam(7, $idAula);

		if ($Comando->execute()) 
		{	
			if ($Comando->rowCount() >0) 
			{
				echo "<script> alert('Aula enviada com sucesso!')</script>";
				echo "<script>location.href='aula.php';</script>";
				

				$Aula = null;
				$videoaula = null;
				$datapost	= null;
				$Assistencia = null;
				$arquivo = null;
				$Texto = null;
				$idAula= null;

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

<br>

<div class="formulario">
<form class="was-validated" action="aula.php?valor=enviado" method="POST">
	<div class="form-group">
		<label for="Assunto"> Selecione um tópico </label>
		<select class="form-control" id="idaula" name="idaula"> 
			<option value=$idaula><?php echo $nomeaula;?></option>	
    	</select><br>
	</div>


    <div class="col-md-6 mb-3" style="margin-left:-15px">
      <label for="nomeaula"> Nome da aula </label>
      <input type="text" class="form-control" id="nomeaula" name="nomeaula" required>
      <div class="valid-feedback">
        Nome da Videoaula inserido.
      </div>
    </div><br>



  <div class="mb-3">
    <label for="validationTextarea">Texto:</label>
    <textarea class="form-control is-invalid" id="texto" name="texto" placeholder="Escreva aqui..." required></textarea>
    <div class="invalid-feedback">
      Preencha o campo
    </div>
  </div><br>


  <div class="custom-file mb-3">
    	<input type="file" class="custom-file-input" id="videoaula" name="videoaula" required>
    	<label class="custom-file-label" for="videoaula">Escolha um arquivo</label>
    	<label>Insira seu vídeo</label>
     <div class="valid-feedback">
        Vídeo inserido
      </div>
  </div><br><br>



    <div class="custom-file mb-3">
    <input type="file" class="custom-file-input" id="arquivo" name="arquivo">
    <label class="custom-file-label" for="arquivo">Escolha um arquivo.</label>
    <label>Insira sua imagem ou documento</label>
     <div class="valid-feedback">
        Arquivo inserido
      </div>
  </div><br><br>

  <input type="date" id="date" name="datapostagem" required>

  </div><br><br><br><br><br>

  <button name="botao" value='Enviar' input type='submit' class='btnLogin'></button>

  <a href="menuprofessor.php" role="Voltar"> <img src="imag/voltar2.png" class="btnVoltar"> </a>

</form>
</div>

<?php
}
?>
<script>
	
function data($datapost){
    return date("d/m/Y", strtotime($datapost));
}
</script>
</body>
</html>
