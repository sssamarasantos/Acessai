<?php
$nome = $_SESSION['nomeContato'];
$email = $_SESSION['emailContato'];
$opcoes = $_SESSION['assuntoContato'];
$mensagem = $_SESSION['msgContato'];
$corpo = $_SESSION['respContato'];

$data_envio = date('d/m/Y');
$hora_envio = date('H:i:s');


date_default_timezone_set('Etc/UTC');

require'phpmailer/class.phpmailer.php';
//Create a new PHPMailer instance
global $error;
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "equipeacessai@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "acessai_123";
//Set who the message is to be sent from
$mail->setFrom('equipeacessai@gmail.com', 'Site');
//Set an alternative reply-to address

//Set who the message is to be sent to
$mail->addAddress($email, 'Usuário');
//Set the subject line
$mail->Subject = 'Resposta ao contato.';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($corpo);
//Replace the plain text body with one created manually
$mail->AltBody = $corpo;
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Messagem enviada!";
}


?>