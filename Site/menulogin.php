<!--// TELA 5 - CONTATO-->

<!DOCTYPE html>
<html>
<head>

  <title> Perfil Login | Acessaí </title>
  <link rel="sortcut icon" href="imag/icon.ico" type="image/x-icon"/>

  <meta charset="utf-8">
  <link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Megrim' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Martel Sans' rel='stylesheet'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<style type="text/css">
	ul
  	{
       display: flex;
       align-items: center;
       text-align: center;
       background-color: none;
       float: right;
       margin-right: 70px;
       border-radius: 8px;
  	}

	a.nav-link
  {
    color: #333;
    font-style: bold;
    font-size: 20px;
    margin-right: 10px;
    background-color: none;
  }

  .botaozin{
    justify-content: center; 
    align-items: center; 
    text-align: center;
  }

	.btnAdm 
	{
    background-color: Transparent;
    background-repeat: no-repeat;
    background-size: 350px 350px;
	}
  .btnAdm:hover{
    background-image: url("imag/pcfundo.png");
  }

	.btnProf 
	{
		background-color: Transparent;
    background-repeat: no-repeat;
    background-size: 350px 350px;
    margin-left: 30px;
	}
  .btnProf:hover{
    background-image: url("imag/lousafundo.png");
  }

</style>

</head>
<body>
<br>

<ul class="nav nav-tabs" style="font-family: 'Alegreya Sans SC'; border-style: none">
  <li class="nav-item">
    <a class="nav-link" href="sobre.php">Sobre Nós</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="trabalhe.php">Trabalhe Conosco</a>
  </li>

   <li class="nav-item">
    <a class="nav-link" href="faq.php" class="btn btn-lg btn-danger" data-toggle="popover" title="Perguntas Frequentes" data-content="Perguntas Frequentes">FAQ</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="contato.php">Contato</a>
  </li>

  <li class="nav-item">
    <a style="background-color: #68b0ee; border-style: none; font-style: bold" href="index.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">
      &nbsp Home &nbsp</a>
  </li>
</ul>

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

<br><br><br><br>

  <div class="botaozin">
    <a href="entraradm.php" role="Contato"> <img src="imag/pcimg.png" class="btnAdm" width=350px height=350px;> </a>

    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

	  <a href="entrarprofessor.php" role="Contato"> <img src="imag/lousaimage.png" class="btnProf" width=350px; height=350p;> </a>
  </div>

  <div style="margin-left: -30px; justify-content: center; align-items: center; text-align: center; font-family: 'Megrim'; font-size: 50px">
    administradores 

      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

    professores
  </div>

</body>
</html>