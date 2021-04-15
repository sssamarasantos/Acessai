<?php
date_default_timezone_set('America/Sao_Paulo');

$idDuvida = $_SESSION['idDuvida'];
$respDuvida = $_SESSION['respDuvida'];
$dtahrRespDuvida = date('Y/m/d H:i:s');

include "conect.php";

try
{
	$AtualizarDuvida=$conexao->prepare("update TB_DUVIDA set RESP_DUVIDA=?, DTAHR_RESP_DUVIDA=? where ID_DUVIDA=?");//guarda no bd
	$AtualizarDuvida->bindParam(1, $respDuvida);
	$AtualizarDuvida->bindParam(2, $dtahrRespDuvida);
	$AtualizarDuvida->bindParam(3, $idDuvida);

	if ($AtualizarDuvida->execute()) 
	{
		if ($AtualizarDuvida->rowCount() >0) 
		{
			$_SESSION['controleProf'] = "respondido";//software entende que fez a ação responder
			//header('location:respostaduvida.php');//direciona para a pag fale conosco
			echo "<script>location.href='respostaduvida.php';</script>";
		}
	}
}
catch(PDOException $erro)
{
	echo "Erro".$erro->getMessage();
}

?>