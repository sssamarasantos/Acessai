<!--// TELA MENU ADMINISTRADOR -->

<!DOCTYPE html>
<html>
<head>
  <title> Menu Administrador | Acessaí </title>
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
  .imag01
  {
    margin-top: 35px;
    text-align: center;
  }

  .imag02
  {
    margin-top: 20px;
    text-align: center;
  }

  .txt
  {
    font-family: 'Megrim'; 
    font-size: 28px; 
    margin-left: 140px;
  }

  .Contatos
  {

  }
  .Curriculos
  {
    margin-left:200px;
  }
  .RelatorioSuporte
  {
    margin-left:200px;
  }
  .RelatorioAulas 
  {

  }
  .RelatorioAluno
  {
    
  }
  .RelatorioProfessor
  {
    margin-left:200px;
  }
  .RelatorioAulas
  {
    margin-left:200px;
  }

  .btnVoltar{
		width: 50px;
		height: 50px;
		background-repeat: no-repeat;
    background-size: 50px 50px;
    margin-top: -50px;
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

<div class="imag01">
    <a class="Contatos" href="respostacontato.php" role="Contatos">
      <img src="imag/contatos.png" width=220px height=220px;> </a>

    <a class="Curriculos" href="respostacurriculo.php" role="Curriculos">
      <img src="imag/curriculos.png" width=220px height=220px;></a>
      
    <a class="RelatorioSuporte" href="relatoriosuporte.php" role="RelatorioSuporte">
      <img src="imag/solicitacoessuporte.png" width=220px height=220px;></a><br><br>
  </div>
  <div class="txt">
    <b style="margin-left:55px"> Contatos </b>
    <b style="margin-left:275px"> Currículos </b>
    <b style="margin-left:190px"> Solicitações de Suporte </b>
  </div>

  <div class="imag02">
    <a class="RelatorioAluno" href="relatorioaluno.php" role="RelatorioAluno">
      <img src="imag/relatorioaluno.png" width=220px height=220px;></a>

    <a class="RelatorioProfessor" href="relatorioprofessor.php" role="RelatorioProfessor">
      <img src="imag/relatorioprof.png" width=220px height=220px;></a>
      
    <a class="RelatorioAulas" href="relatorioaulas.php" role="RelatorioAulas">
      <img src="imag/relatorioaulaa.png" width=220px height=220px;></a><br><br>
  </div>
  <div class="txt">
    <b> Relatório Alunos </b>
    <b style="margin-left:155px"> Relatório Professores </b>
    <b style="margin-left:160px"> Relatório Aulas </b>
  </div>

  <a href="alteraradm.php" role="Voltar"> <img src="imag/voltar2.png" class="btnVoltar"> </a>

</body>
</html>