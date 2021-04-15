<!--// TELA ESQUECEU SENHA - PROFESSOR -->
<!DOCTYPE html>
<html>
<head>
  <title> Esqueceu Senha | Acessaí </title>
  <link rel="sortcut icon" href="imag/icon.ico" type="image/x-icon"/>

	<meta charset="utf-8">
	<link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
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

  .imgpc
	{
		text-align: center;
		margin-top: 45px;
	}

  .formulario
  {
    margin-left: 480px;
    margin-right: 480px;
  }

  .btnRecuperar{
		background-image: url("imag/avançar2.png");
		background-color: transparent;
		cursor: pointer;
		width: 55px;
		height: 55px;
		background-repeat: no-repeat;
		background-size: 55px 55px;
	}
	.btnRecuperar:hover{
		background-image: url("imag/avançar1.png");
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
  
include "conect.php";
//session_start();  

  
  if(isset($_REQUEST['valor']) and ($_REQUEST['valor']== 'enviado')) 
  {
    $botao = $_POST["botao"];
    $login =  $_POST["usuario_login"]; 

    if ($botao == "Recuperar") 
    {
      session_start();  
          
      try
      {
        $Comando = $conexao->prepare("SELECT ID_PROF, NOME_PROF, EMAIL_PROF, SENHA_PROF, ASSISTENCIA_PROF FROM TB_PROFESSOR WHERE EMAIL_PROF=?");
  
        $Comando->bindParam(1,$login);

        if ($Comando->execute()) 
        {
          if ($Comando->rowCount()>0) 
          {
            while ($linha = $Comando-> fetch(PDO::FETCH_OBJ)) 
            {
              $id = $linha->ID_PROF;
              $_SESSION['IdProf'] = $id;

              $nome = $linha->NOME_PROF;
              $_SESSION['nomeProf'] = $nome;

              $email = $linha->EMAIL_PROF;
              $_SESSION['emailProf'] = $email;

              $senha = $linha->SENHA_PROF;
              $_SESSION['senhaProf'] = $senha;

              $assistencia = $linha->ASSISTENCIA_PROF;
              $_SESSION['assistenciaProf'] = $assistencia;

              $_SESSION["controle"] = "esquecido";
              header('location:recuperar.php');
            }
          }

          else 
          {
            unset($_SESSION['controle']);

            echo "<script> alert('Usuário não encontrado.')</script>";
          }
        }
      }

      catch(PDOException $erro)
        {
          echo "Erro". $erro->getMessage();
        }
    }
    
    $senha=$_SESSION["senhaProf"];
    $login=$_SESSION["emailProf"];
    
  }
  else
  {
    ?>

  <br>
  <div class="imgpc">
		<img src="imag/imgpc.png" width=250px height=250px;>
	</div>

    <div class="formulario">
    <form action="esqueceusenha.php?valor=enviado" method="POST">
    <br>

      <div class="form-group">
        <label for="Email"> E-mail </label>
        <input type="text" class="form-control" placeholder="Preencha seu e-mail" name="usuario_login">
      </div>

      <div class="form-group">
        <button name="botao" style="border-style:none;margin-left:150px" input type="submit" value="Recuperar" class="btnRecuperar"></button>
      <div>

    </form>
    </div>
    <?php

  }

  ?>

</body>
</html>