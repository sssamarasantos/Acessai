<!-- TELA INICIAL - DOWNLOAD APP -->
<!DOCTYPE html>
<html>
<head>
	<title>Acessaí - Tela Inicial | Download do Aplicativo </title>
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
	
<!-- EXTENSÃO P APP
<html>
  <head>
    <title>YouTube</title>
    <meta name="author" content="Google, Inc.">
    <meta name="apple-itunes-app" content="app-id=544007664">
    <meta name="google-play-app" content="app-id=com.google.android.youtube">

    <link rel="stylesheet" href="jquery.smartbanner.css" type="text/css" media="screen">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
  </head>
  <body>
    ...
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
    <script src="jquery.smartbanner.js"></script>
    <script type="text/javascript">
      $().smartbanner();
    </script>
  </body>
</html>-->

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

.Info
{ 

}  

.Titulo
{
  text-align: left;
  margin-left: 195px; 
  font-family: 'Megrim'; 
  font-size: 95px;
}

.Texto
{
  text-align: left;
  margin-left: 250px;
  font-size: 18px;

}

.ImgApp
{
  float: right;
  margin-right: 130px;
  margin-top: 60px;
}

.linkzin
{
  color: white;
}
.linkzin:hover
{
  color: #008CBA;
  text-decoration: none;
}

.btnDownload 
  {
    font-size: 20px;
    font-style: bold;
    background-color: #008CBA; 
    border-color: #008cba;
    color: white; 
    padding: 12px 30px;
    border-radius: 8px;

    margin-left: 420px;
  }

.btnDownload:hover 
  {
    font-size: 20px;
    font-style: bold;
    background-color: white;
    border-color: #008cba;
    color: #008CBA;
    padding: 12px 30px;
    border-radius: 8px;
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
    <a style="background-color: #ffda75; border-style: none; font-style: bold" href="menulogin.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">
      &nbsp Login &nbsp</a>
  </li>
</ul>

<br><br><br>

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


  <!-- Imagem do app e link para baixar-->
  <div class="Info">

    <div class="ImgApp">
      <img src="imag/acessai.png" width=380px height=380px;>
    </div>

    <h5 class="Titulo"> Acessaí </h5>
      
    <div class="Texto">
      <p class="card-text"> O Acessaí é um aplicativo educacional acessível pensado <br>
                              exclusivamente para pessoas que apresentam alguma deficiência <br>
                              (seja ela visual, auditiva ou cognitiva). </p>
      <p class="card-text"> Ele apresenta acessibilidade auditiva, cognitiva e visual, para que <br> 
                              sua única preocupação em entender seja em relação as matérias <br>
                              (o que também queremos deixar o mais fácil possível para você!). </p>
    </div>

  </div>
          

  <br><br><br><br>
  <button class="btnDownload" onclick="return confirm('Deseja fazer download do aplicativo?')"><a class="linkzin" href="http://acessai.000webhostapp.com/apk/app-debug.zip" download> Baixe Já!</a></button>




 <?php
 //COMANDO PARA BAIXAR O APK - AJUSTAR
 
   /*header('Content-Description: File Transfer');
   header('Content-Type: application/vnd.android.package-archive');
   header('Content-Disposition: attachment; filename=' . $androidPackage);
   header('Content-Transfer-Encoding: binary');
   header('Expires: 0');
   header('Cache-Control: must-revalidate');
   header('Pragma: public');
   header('Content-Length: ' . filesize($package));
   ob_clean();
   flush();
   readfile($package);
   exit;*/
?>

</body>
</html>