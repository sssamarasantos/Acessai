<?php
include('credenciais.php');
$conexao = $conexao;

$Emailx = $_POST["email"];
$Email = strtolower(str_replace(" ", "", $Emailx));
$comando = "select NOME_ALUNO, EMAIL_ALUNO, SENHA_ALUNO from TB_ALUNO where EMAIL_ALUNO='$Email'";
$resultado = mysqli_query($conexao, $comando);

while($linha = mysqli_fetch_object($resultado)) {
    $nomex = $linha->NOME_ALUNO;
    $emailx = $linha->EMAIL_ALUNO;
	$senhax = $linha->SENHA_ALUNO;
}

if(!empty($emailx)) {
    if ($linha == 0) {
    	$nome = $nomex;
    	$email = $emailx;
    	$corpo = $senhax;
    
    	$data_envio = date('d/m/Y');
    	$hora_envio = date('H:i:s');
    
    	require_once("phpmailer/class.phpmailer.php");
    
    	include "emailSenha.php";
    
    	$para = $email;
    	$de = 'equipeacessai@gmail.com';
    	$de_nome = 'Equipe Acessai';
    	$assunto = 'Recuperar senha';
    
    	function smtpmailer($para, $de, $de_nome, $assunto, $corpo) {
    		global $error;
    		$mail = new PHPMailer();
    		$mail->IsSMTP();
    		$mail->SMTPDebug = 0;
    		$mail->SMTPAuth = true;
    		$mail->SMTPSecure = 'tls';
    		$mail->Host = 'smtp.gmail.com';
    		$mail->Port = 587;
    		$mail->Username = USER;
    		$mail->Password = PASSWORD;	
    		$mail->SetFrom($de, $de_nome);
    		$mail->Subject = $assunto;
    		$mail->Body =  $corpo;
    		$mail->AddAddress($para);
    
    		if (!$mail->Send()) {
    	    	$error = 'Mail error: '.$mail->ErrorInfo;
    			return false;
    		}
    		else {
    		    //$error = 'Mensagem enviada!';
    		    return true;
    		}
    	}
    
    	$vai = "Nome: $nome\n\nEmail: $email\n\nSenha: $corpo";
    
    	if (smtpmailer($email, 'equipeacessai@gmail.com','Equipe Acessai','Recuperar senha',$vai)) {
    		$dados = array("status"=>"ok");
    	}
    	if (!empty($error)) echo $error;
    } 
    else {   
	    $dados = array("status"=>"erro");
    }
}
else {   
	$dados = array("status"=>"vazio");
}
$close = mysqli_close($conexao);
echo json_encode($dados);
?>