<?php

$IdTrabalhe = $_SESSION['IdTrabalhe'];
$RespTrabalhe = $_SESSION['respTrabalhe'];
include "conect.php";
try
{
	$AtualizarContato=$conexao->prepare("UPDATE TRABALHE_CONOSCO SET RESP_TRABALHE=? WHERE ID_TRABALHE=?");//guarda no bd
	$AtualizarContato->bindParam(1, $RespTrabalhe);
	$AtualizarContato->bindParam(2,$IdTrabalhe);

	if ($AtualizarContato->execute()) 
	{
		if ($AtualizarContato->rowCount() >0) 
		{	echo "<script>location.href='respostacurriculo.php';</script>";
			$_SESSION['controleResp'] = "respondido";//software entende que fez a ação responder
			//header('location:respostacurriculo.php');//direciona para a pag fale conosco
		}
	}
}
catch(PDOException $erro)
{
	echo "Erro".$erro->getMessage();
}

?>