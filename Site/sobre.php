<!--//TELA 2 - SOBRE NÓS -->
<!DOCTYPE html>
<html>
<head>
  <title> Sobre Nós | Acessaí </title>
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
  .Info
  { 

  }  

  .Titulo
  {
    text-align: left;
    margin-left: 160px; 
    margin-top: -20px;
    font-family: 'Megrim'; 
    font-size: 80px;
    font-style: bold;
  }

  .Texto
  {
    text-align: left;
    margin-left: 210px;
    font-size: 18px;
  }

  .ImgEquip
  {
    float: right;
    margin-right: 40px;
  }

  .Rodape
  {
    text-align: center;
    margin-top: 70px;
    margin-bottom: 20px;
  }
  </style>


</head>
<body>

<ul class="nav nav-tabs" style="font-family: 'Alegreya Sans SC'">
  <li class="nav-item">
    <a class="nav-link" href="contato.php">Contato</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="trabalhe.php">Trabalhe Conosco</a>
  </li>

  <div>
    <a href="index.php"> <img src="imag/homezin.png" width=110px height=110px;> </a>
  </div>

  <li class="nav-item">
    <a class="nav-link" href="faq.php"> FAQ </a> 
  </li>

  <li class="nav-item">
    <a style="background-color: #ffda75; border-style: none; font-style: bold; margin-right: 180px" href="menulogin.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">
      &nbsp Login &nbsp</a>
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

  <!-- Caixa de texto Sobre Nós-->
  <div class="ImgEquip">
    <img src="imag/nós.png" width=520px height=520px;>
  </div>

  <div class="Info">

  <h5 class="Titulo"> A Equipe </h5>
  
  <div class="Texto">
    <p class="card-text"> Nós somos um grupo de 3 garotas que se juntaram <br>
                            para dar vida à ideia desse aplicativo que começou com <br>
                            uma ideia solta e hoje se tornou este projeto. </p>
    <p class="card-text"> Temos a Emanuela com a programação web, <br> 
                            Samara com a proramação de app e <br>
                            Nicoly com interface e design, tudo pensado e feito com carinho :D </p>

    <p class="card-text"> Emanuela tem 19 anos, é estudante do curso de Desenvolvimento <br> 
                            de Sistemas, e nesse projeto trabalhou na programação <br>
                            do site. Além de dedicar-se aos estudos, seus hobbies <br>
                            envolvem ver filmes e séries! </p>

    <p class="card-text"> Samara tem 19 anos e é estudante do curso de Desenvolvimento <br> 
                            de Sistemas. Gosta de jogar, ouvir música, ver os amigos <br>
                            e estuda bastante (mesmo não gostando tanto assim). Nesse projeto <br>
                            ela trabalhou na programação do aplicativo (uma função que gosta bastante), <br>
                            pois desde o início pareceu ser uma linguagem divertida e desafiadora. </p>

    <p class="card-text"> Nicoly tem 17 anos, é uma ilustradora e programadora *estressada* <br> 
                            que gosta de criar (na maior parte do tempo) coisas coloridas <br>
                            e alegres, ela não é boa em se definir com palavras. </p>

    <p class="card-text"> Por isso, buscamos fazer o melhor o nosso para que a ideia funcionasse da melhor forma possível! </p>
  </div>

<div class="Rodape" style="font-family: 'Alegreya Sans SC'">
  <img src="imag/nos.jpg" width=135px height=77px;>
  <p class="card-text"> Acessaí © 2020
</div>


</div>
</body>
</html>