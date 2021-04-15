<?php
//session_start();
//Páginas para localizar os contatos


include "conect.php";
$IdAluno = $_SESSION['IdAluno'];
try
{
	$SelecaoContato=$conexao->prepare("SELECT * FROM TB_ALUNO WHERE ID_ALUNO=?");
	$SelecaoContato->bindParam(1,$IdAluno);

	if ($SelecaoContato->execute()) 
	{
		if ($SelecaoContato->rowCount()>0) 
		{
			while ($Linha = $SelecaoContato->fetch(PDO::FETCH_OBJ)) 
			{
							$id=$Linha->ID_ALUNO;
							$_SESSION['IdAluno'] = $id;

							$nome = $Linha->NOME_ALUNO;
							$_SESSION['nomeAluno']= $nome;

							$email = $Linha->EMAIL_ALUNO;
							$_SESSION['emailAluno']=$email;

							$senha =$Linha->SENHA_ALUNO;
							$_SESSION["senhaAluno"]=$senha;


							$assistencia =$Linha->ASSISTENCIA_ALUNO;
							$_SESSION["assistenciaAluno"]=$assistencia;

							echo "<script>location.href='relatorioaluno.php';</script>";
							$_SESSION['controleAluno'] = "localizado";
							//header('location:relatorioaluno.php');
							
			}
		}
		else
		{
			echo "<script>alert('Registro não existe!')</script>";
			echo "<script>location.href='relatorioaluno.php';</script>";
		}
	}

}
catch(PDOException $erro)
{
	echo "Erro".$erro->getMessage();
}

?>