<?php
//inicia session
//recebe valores postados

$Nome = $_POST["nome_cadastro_professor"];
$Email = $_POST["usuario_cadastro_professor"];
$SenhaProf = $_POST["senha_cadastro_professor"];
$Id = $_SESSION['IdProf'];


include "conect.php";
try
{
	if ($_POST["senha_cadastro_professor"] == $_POST["senha_confirma_professor"]) 
	{
		$AtualizarNovo = $conexao->prepare("UPDATE TB_PROFESSOR SET NOME_PROF=?, EMAIL_PROF=?, SENHA_PROF=? WHERE ID_PROF=?");

		//caso não preenchido os campos
		if ($_POST["nome_cadastro_professor"]=="") $Nome = $_SESSION['nomeProf']; 
		if ($_POST["usuario_cadastro_professor"]=="") $Email = $_SESSION['emailProf']; 
		if ($_POST["senha_cadastro_professor"]=="") $SenhaAdm = $_SESSION['senhaProf']; 

		//prepara para atualização
		$AtualizarNovo->bindParam(1, $Nome);
		$AtualizarNovo->bindParam(2, $Email);
		$AtualizarNovo->bindParam(3, $SenhaProf);
		$AtualizarNovo->bindParam(4, $Id);

		if ($AtualizarNovo->execute()) 
		{
			if ($AtualizarNovo->rowCount()>0) 
			{
				$SelecaoNova = $conexao->prepare("SELECT ID_PROF, NOME_PROF, EMAIL_PROF, SENHA_PROF, ASSISTENCIA_PROF FROM TB_PROFESSOR WHERE EMAIL_PROF=? AND SENHA_PROF=?");
				$SelecaoNova->bindParam(1,$Email);
				$SelecaoNova->bindParam(2,$SenhaProf);

				if ($SelecaoNova ->execute()) 
				{
					if ($SelecaoNova->rowCount()>0)
					{
						while ($Linha=$SelecaoNova->fetch(PDO::FETCH_OBJ)) 
						{
							$id=$Linha->ID_PROF;
							$_SESSION['IdProf'] = $id;

							$nome = $Linha->NOME_PROF;
							$_SESSION['nomeProf']= $nome;

							$email = $Linha->EMAIL_PROF;
							$_SESSION['emailProf']=$email;

							$senha = $Linha->SENHA_PROF;
							$_SESSION['senhaProf']= $senha;

							$assistencia = $linha->ASSISTENCIA_PROF;
							$_SESSION['assistenciaProf'] = $assistencia;

							$_SESSION['controleProf'] = "alterado";
							header('location:alterarprofessor.php');

						}
					}
				}
							
			}
		}




		echo "<script> alert('Usuário professor alterado com sucesso!')</script>";
		echo "<script> window.location.href='alterarprofessor.php';</script>";
				

	}
	else
	{
		echo "<script> alert('Senha não confere.')</script>";
		echo "<script> window.location.href='alterarprofessor.php';</script>";
	}

}
catch(PDOException $erro)
{
	echo "Erro". $erro->getMessage();
}
?>