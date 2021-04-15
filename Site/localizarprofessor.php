<?php

//Páginas para localizar os contatos
$IdProf = $_SESSION['IdProf'];

include "conect.php";
try
{
	$SelecaoContato=$conexao->prepare("SELECT * FROM TB_PROFESSOR WHERE ID_PROF=?");
	$SelecaoContato->bindParam(1,$IdProf);

	if ($SelecaoContato->execute()) 
	{
		if ($SelecaoContato->rowCount()>0) 
		{
			while ($Linha = $SelecaoContato->fetch(PDO::FETCH_OBJ)) 
			{
							$id=$Linha->ID_PROF;
							$_SESSION['IdProf'] = $id;

							$nome = $Linha->NOME_PROF;
							$_SESSION['nomeProf']= $nome;

							$email = $Linha->EMAIL_PROF;
							$_SESSION['emailProf']=$email;

							$senha =$Linha->SENHA_PROF;
							$_SESSION["senhaProf"]=$senha;


							$assistencia =$Linha->ASSISTENCIA_PROF;
							$_SESSION["assistenciaProf"]=$assistencia;

							echo "<script>location.href='relatorioprofessor.php';</script>";
							$_SESSION['controleProf'] = "localizado";
							//header('location:relatorioprofessor.php');
							
			}
		}
		else
		{
			echo "<script>alert('Registro não existe!')</script>";
			echo "<script>location.href='relatorioprofessor.php';</script>";
		}
	}
}
catch(PDOException $erro)
{
	echo "Erro".$erro->getMessage();
}

?>