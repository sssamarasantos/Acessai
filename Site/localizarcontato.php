<?php

//Páginas para localizar os contatos
$IdContato = $_SESSION['IdContato'];

include "conect.php";
try
{
	$SelecaoContato=$conexao->prepare("SELECT * FROM CONTATO WHERE ID_CONTATO=?");
	$SelecaoContato->bindParam(1,$IdContato);

	if ($SelecaoContato->execute()) 
	{
		if ($SelecaoContato->rowCount()>0) 
		{
			while ($Linha = $SelecaoContato->fetch(PDO::FETCH_OBJ)) 
			{
							$id=$Linha->ID_CONTATO;
							$_SESSION['IdContato'] = $id;

							$nome = $Linha->NOME_CONTATO;
							$_SESSION['nomeContato']= $nome;

							$email = $Linha->EMAIL_CONTATO;
							$_SESSION['emailContato']=$email;

							$assunto = $Linha->ASSUNTO_CONTATO;
							$_SESSION['assuntoContato']=$assunto;

							$msg = $Linha->MSG_CONTATO;
							$_SESSION['msgContato']=$msg;

							$resp = $Linha->RESP_CONTATO;
							$_SESSION['respContato']=$resp;


							
							echo "<script>location.href='respostacontato.php';</script>";
							$_SESSION['controleResp'] = "localizado";
							//header('location:respostacontato.php');
							
			}
		}
		else
		{
			echo "<script>alert('Registro não existe!')</script>";
			echo "<script>location.href='respostacontato.php';</script>";
		}
	}
}
catch(PDOException $erro)
{
	echo "Erro".$erro->getMessage();
}

?>