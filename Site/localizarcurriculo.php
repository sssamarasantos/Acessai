<?php

//Páginas para localizar os contatos
$IdTrabalhe = $_SESSION['IdTrabalhe'];

include "conect.php";
try
{
	$SelecaoContato=$conexao->prepare("SELECT * FROM TRABALHE_CONOSCO WHERE ID_TRABALHE=?");
	$SelecaoContato->bindParam(1,$IdTrabalhe);

	if ($SelecaoContato->execute()) 
	{
		if ($SelecaoContato->rowCount()>0) 
		{
			while ($Linha = $SelecaoContato->fetch(PDO::FETCH_OBJ)) 
			{
							$id=$Linha->ID_TRABALHE;
							$_SESSION['IdTrabalhe'] = $id;

							$nome = $Linha->NOME_TRABALHE;
							$_SESSION['nomeTrabalhe']= $nome;

							$email = $Linha->EMAIL_TRABALHE;
							$_SESSION['emailTrabalhe']=$email;

							$apresentacao = $Linha->APRESENTACAO_TRABALHE;
							$_SESSION['apresentacaoTrabalhe']=$apresentacao;

							$curriculo = $Linha->CURRICULO_TRABALHE;
							$_SESSION['curriculoTrabalhe']=$curriculo;

							$resp = $Linha->RESP_TRABALHE;
							$_SESSION['respTrabalhe']=$resp;
							
							echo "<script>location.href='respostacurriculo.php';</script>";
							$_SESSION['controle'] = "localizado";
							//header('location:respostacurriculo.php');
							
			}
		}
		else
		{
			echo "<script>alert('Registro não existe!')</script>";
			echo "<script>location.href='respostacurriculo.php';</script>";
		}
	}
}
catch(PDOException $erro)
{
	echo "Erro".$erro->getMessage();
}

?>