<?php
//inicia session
//recebe valores postados

$Nome = $_POST["nome_cadastro"];
$Email = $_POST["usuario_cadastro"];
$SenhaAdm = $_POST["senha_cadastro"];
$Id = $_SESSION['IdAdm'];


include "conect.php";
try
{
	if ($_POST["senha_cadastro"] == $_POST["senha_confirma"]) 
	{
		$AtualizarNovo = $conexao->prepare("UPDATE ADIMINISTRADOR SET NOME_ADM=?, EMAIL_ADM=?, SENHA_ADM=? WHERE ID_ADM=?");

		//caso não preenchido os campos
		if ($_POST["nome_cadastro"]=="") $Nome = $_SESSION['nomeAdm']; 
		if ($_POST["usuario_cadastro"]=="") $Email = $_SESSION['emailAdm']; 
		if ($_POST["senha_cadastro"]=="") $SenhaAdm = $_SESSION['senhaAdm']; 

		//prepara para atualização
		$AtualizarNovo->bindParam(1, $Nome);
		$AtualizarNovo->bindParam(2, $Email);
		$AtualizarNovo->bindParam(3, $SenhaAdm);
		$AtualizarNovo->bindParam(4, $Id);

		if ($AtualizarNovo->execute()) 
		{
			if ($AtualizarNovo->rowCount()>0) 
			{
				$SelecaoNova = $conexao->prepare("SELECT ID_ADM, NOME_ADM, EMAIL_ADM, SENHA_ADM FROM ADIMINISTRADOR WHERE EMAIL_ADM=? AND SENHA_ADM=?");
				$SelecaoNova->bindParam(1,$Email);
				$SelecaoNova->bindParam(2,$SenhaAdm);

				if ($SelecaoNova ->execute()) 
				{
					if ($SelecaoNova->rowCount()>0)
					{
						while ($Linha=$SelecaoNova->fetch(PDO::FETCH_OBJ)) 
						{
							$id=$Linha->ID_ADM;
							$_SESSION['IdAdm'] = $id;

							$nome = $Linha->NOME_ADM;
							$_SESSION['nomeAdm']= $nome;

							$email = $Linha->EMAIL_ADM;
							$_SESSION['emailAdm']=$email;

							$senha = $Linha->SENHA_ADM;
							$_SESSION['senhaAdm']= $senha;

							//echo "<script>location.href='alteraradm.php';</script>";
							$_SESSION['controleAdm'] = "alterado";
							//header('location:alteraradm.php');

						}
					}
				}
							
			}
		}
		echo "<script> alert('Usuário administrador alterado com sucesso!')</script>";
		echo "<script>location.href='alteraradm.php';</script>";
				

	}
	else
	{
		echo "<script> alert('Senha não confere.')</script>";
		echo "<script> window.location.href='alteraradm.php';</script>";
	}

}
catch(PDOException $erro)
{
	echo "Erro". $erro->getMessage();
}
?>