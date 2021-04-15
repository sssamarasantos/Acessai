<!--// TELA 4 - FAQ-->
<!DOCTYPE html>
<html>
<head>
  <title> FAQ | Acessaí </title>
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
		background: url("imag/background01.png") no-repeat center center fixed;
		background-size: cover;
		-webkit-background-size: cover; /* SAFARI / CHROME */
		-moz-background-size: cover; /* FIREFOX */
		-ms-background-size: cover; /* IE */
		-o-background-size: cover; /* OPERA */
	}

  .Titulo
  {
    text-align: left;
    margin-left: 150px; 
    margin-top: 15px;
    font-family: 'Megrim'; 
    font-size: 70px;
    font-style: bold;
  }

  .nuvem 
  {
    float: right;
    margin-right: 130px;
    margin-top: -130px
  }

  .titulozin 
  {
    font-family:  'Alegreya Sans SC';
    font-style: bold;
    font-size: 15px;
    align-items: left;
    float: left;
    text-align: left;
  }

  .perguntins 
  {
    font-family: 'Alegreya Sans SC';
    font-style: bold;
    align-items: left;
    float: left;
    text-align: left;
    background-color: #ffda75;
    margin-bottom: 10px;
  }

  .respostin 
  {
    align-items: left;
    float: left;
    text-align: left;
    font-family: 'Alegreya Sans SC';
    margin-top: -10px;
    margin-left: 13px;
    margin-bottom: 10px;
    font-size: 18px;
    color: #808080;
    background-color: white;
    width: 452px;
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
    <a class="nav-link" href="sobre.php">Sobre Nós</a>
  </li>

  <li class="nav-item">
    <a style="background-color: #ffda75; border-style: none; font-style: bold; margin-right: 130px" href="menulogin.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">
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
  
  <h5 class="Titulo"> F A Q </h5>
  <br>

  <img src="imag/nuvemfaq.png" class="nuvem" width=290px height=290px;>

  <div style="margin-right: 35px; margin-top: 45px; text-align: right; font-size: 19px; font-family: 'Alegreya Sans SC'; float: right">
		<p> Mais dúvidas?</p>
	  <a class="btn btn-primary" href="contato.php" role="Contato" style="font-size: 19px; background-color:#68b0ee; border-style: none; font-style: bold; margin-top:-5px"> 
        Fale conosco! </a>
	</div>
  
  <br><br>

<!-- FAQ -->

  <!-- FUNÇÕES -->
  <div style="float: left; width: 500px; height: 500px; margin-top:1px; margin-left: 100px; margin-bottom: -5px;">
    <div class="titulozin">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
	  <li class="nav-item" role="presentation">
		  <a class="nav-link" id="Funcao" data-toggle="tab" href="#funcao" role="tab" aria-controls="home" aria-selected="true">
        Funções 
          &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
          &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
          &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
          &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
        +
      </a>
	  </li>
    </ul>
    </div>

    <br>
    <!-- PERGUNTAS --> 
    <div class="tab-content" id="myTabContent">
		<div class="tab-pane fade" id="funcao" role="tabpanel" aria-labelledby="home-tab">

      <br>
      <div class="perguntins">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
		  <li class="nav-item" role="presentation">
		    <a class="nav-link" id="home-tab" data-toggle="tab" href="#fun01" role="tab" aria-controls="home" aria-selected="true">
          Provas/exercícios para resolução 
            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp
        </a>
		  </li>
      </ul>
      </div>
      
        <div class="respostin">
        <div class="tab-content" id="myTabContent">
		    <div class="tab-pane fade" id="fun01" role="tabpanel" aria-labelledby="home-tab">
          - Apresentamos apenas videoaulas, mas pensamos em <p>
          &nbsp adicionar outras ferramentas futuramente! :D
        </div>
        </div>
        </div>


      <div class="perguntins">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
		  <li class="nav-item" role="presentation">
		    <a class="nav-link" id="home-tab" data-toggle="tab" href="#fun02" role="tab" aria-controls="home" aria-selected="true">
          Dúvidas sobre aulas 
              &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp
        </a>
		  </li>
      </ul>
      </div>
              
        <div class="respostin">
        <div class="tab-content" id="myTabContent">
		    <div class="tab-pane fade" id="fun02" role="tabpanel" aria-labelledby="home-tab">
          - Você pode facilmente postar uma dúvida de forma <p> 
          &nbsp que apenas seu nome irá aparecer :D
        </div>
        </div>
        </div>    


      <div class="perguntins">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
		  <li class="nav-item" role="presentation">
		    <a class="nav-link" id="home-tab" data-toggle="tab" href="#fun03" role="tab" aria-controls="home" aria-selected="true">
          Localização de Aulas 
              &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp
        </a>
		  </li>
      </ul>
      </div>
              <br><br>
        <div class="respostin">
        <div class="tab-content" id="myTabContent">
		    <div class="tab-pane fade" id="fun03" role="tabpanel" aria-labelledby="home-tab">
          - Para ajudar na sua navegação de aulas vistas e/ou <p> 
          &nbsp aprendidas, temos 2 botões que vocês podem marcar <br> 
          &nbsp e desmarcar para ajudar :D
        </div>
        </div>
        </div>

        <br><br><br><br>

    </div>
    </div>
    
<br><br><br>
  <!-- CONTA -->
    <div class="titulozin" style="margin-top: 25px">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item" role="presentation">
		  <a class="nav-link" id="Funcao" data-toggle="tab" href="#conta" role="tab" aria-controls="home" aria-selected="true">
        Conta
          &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
          &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
          &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
          &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
        +
      </a>
		</li>
    </ul>
    </div>

    <br>
    <!-- PERGUNTAS -->
      <div class="tab-content" id="myTabContent">
		  <div class="tab-pane fade" id="conta" role="tabpanel" aria-labelledby="home-tab">


      <div class="perguntins">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
		  <li class="nav-item" role="presentation">
		    <a class="nav-link" id="home-tab" data-toggle="tab" href="#con01" role="tab" aria-controls="home" aria-selected="true">
          Editar/Atualizar informações do perfil
              &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
        </a>
		  </li>
      </ul>
      </div>
           
        <div class="respostin">
        <div class="tab-content" id="myTabContent">
		    <div class="tab-pane fade" id="con01" role="tabpanel" aria-labelledby="home-tab">
          - Entre em seu perfil pelo menu no app, lá você <p>
          &nbsp encontrará um botão que ao clicar poderá atualizar <br>
          &nbsp suas informações e salvar! 
        </div>
        </div>
        </div>
        <div class="perguntins">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
		  <li class="nav-item" role="presentation">
		    <a class="nav-link" id="home-tab" data-toggle="tab" href="#con02" role="tab" aria-controls="home" aria-selected="true">
          Problemas com o e-mail na hora de logar
              &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
        </a>
		  </li>
      </ul>
      </div>
              
        <div class="respostin">
        <div class="tab-content" id="myTabContent">
		    <div class="tab-pane fade" id="con02" role="tabpanel" aria-labelledby="home-tab">
          - Confira se está utilizando o mesmo e-mail que usou <p> 
          &nbsp para se cadastrar, se o problema persistir entre <br>
          &nbsp em contato conosco!
        </div>
        </div>
        </div>    


      <div class="perguntins">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
		  <li class="nav-item" role="presentation">
		    <a class="nav-link" id="home-tab" data-toggle="tab" href="#con03" role="tab" aria-controls="home" aria-selected="true">
          Esqueci a senha 
              &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
        </a>
		  </li>
      </ul>
      </div>
    
        <div class="respostin">
        <div class="tab-content" id="myTabContent">
		    <div class="tab-pane fade" id="con03" role="tabpanel" aria-labelledby="home-tab">
          - Caso você esqueça a senha da sua conta, basta clicar <p> 
          &nbsp em um botão na própria tela de login que nós iremos <br> 
          &nbsp enviar sua senha ao email que você tiver cadastrado :D 
        </div>
        </div>
        </div>


      <div class="perguntins">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
		  <li class="nav-item" role="presentation">
		    <a class="nav-link" id="home-tab" data-toggle="tab" href="#con04" role="tab" aria-controls="home" aria-selected="true">
          Troca/Desabilitação da acessibilidade 
              &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp
        </a>
		  </li>
      </ul>
      </div>
             
        <div class="respostin">
        <div class="tab-content" id="myTabContent">
		    <div class="tab-pane fade" id="con04" role="tabpanel" aria-labelledby="home-tab">
          - A qualquer momento você pode ir no seu perfil para <p> 
          &nbsp trocar e/ou desabilitar alguma acessibilidade de <br> 
          &nbsp sua preferência :D
        </div>
        </div>
        </div>

      <br><br><br><br>

    </div>
    </div>

  </div>

  <!-- DÚVIDAS GERAIS -->
  <div style="float: right; width: 500px; height: 500px; margin-top: 10px; margin-right: 75px">
    <div class="titulozin">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item" role="presentation">
		  <a class="nav-link" id="Funcao" data-toggle="tab" href="#duvidas" role="tab" aria-controls="home" aria-selected="true">
        Dúvidas Gerais
          &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
          &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
          &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
          &nbsp &nbsp
        +
      </a>
		</li>
    </ul>
    </div>

    <!-- PERGUNTAS -->
      <div class="tab-content" id="myTabContent">
		  <div class="tab-pane fade" id="duvidas" role="tabpanel" aria-labelledby="home-tab">


      <div class="perguntins">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
		  <li class="nav-item" role="presentation">
		    <a class="nav-link" id="home-tab" data-toggle="tab" href="#duv01" role="tab" aria-controls="home" aria-selected="true">
          O aplicativo é para IOS e android? 
              &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp
        </a>
		  </li>
      </ul>
      </div>
           
        <div class="respostin" style="margin-left: 1px; width: 462px">
        <div class="tab-content" id="myTabContent">
		    <div class="tab-pane fade" id="duv01" role="tabpanel" aria-labelledby="home-tab">
         &nbsp &nbsp &nbsp - Por enquanto, apenas para plataformas android D': <br>
         &nbsp
        </div>
        </div>
        </div>


        
      <div class="perguntins">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
		  <li class="nav-item" role="presentation">
		    <a class="nav-link" style="float:left" id="home-tab" data-toggle="tab" href="#duv02" role="tab" aria-controls="home" aria-selected="true">
        <div style="margin-left: -60px"> 
            O aplicativo é apenas para pessoas que </div> 
            necessitam de acessibilidade para os estudos?
                &nbsp &nbsp &nbsp
        </a>
		  </li>
      </ul>
      </div>
             
        <div class="respostin" style="margin-left: 1px; width: 462px">
        <div class="tab-content" id="myTabContent">
		    <div class="tab-pane fade" id="duv02" role="tabpanel" aria-labelledby="home-tab">
        &nbsp &nbsp &nbsp - Com toda certeza, não! Acima do fato de nós sermos <p>
        &nbsp &nbsp &nbsp &nbsp um aplicativo de acessibilidade, somos um aplicativo <br>
        &nbsp &nbsp &nbsp &nbsp inclusivo!
        </div>
        </div>
        </div>


      </div>
      </div>
  </div>

</body>
</html>