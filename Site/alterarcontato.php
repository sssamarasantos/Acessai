<?php

$IdContato = $_SESSION['IdContato'];
$RespContato = $_SESSION['respContato'];
include "conect.php";
try
{
	$AtualizarContato=$conexao->prepare("UPDATE CONTATO SET RESP_CONTATO=? WHERE ID_CONTATO=?");//guarda no bd
	$AtualizarContato->bindParam(1, $RespContato);
	$AtualizarContato->bindParam(2,$IdContato);

	if ($AtualizarContato->execute()) 
	{
		if ($AtualizarContato->rowCount() >0) 
		{
			echo "<script>location.href='respostacontato.php';</script>";
			$_SESSION['controleRes'] = "respondido";//software entende que fez a ação responder
			//header('location:respostacontato.php');//direciona para a pag fale conosco
		}
	}
}
catch(PDOException $erro)
{
	echo "Erro".$erro->getMessage();
}

?>