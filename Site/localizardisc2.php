<?php

//Páginas para localizar os contatos
include "conect.php";
$Id = $_SESSION["IdDisc"];

//$Email = $_SESSION['emailProf'];
//$SenhaProf = $_SESSION["senhaProf"];
try
	{
	$SelecaoContato=$conexao->prepare("SELECT * FROM TB_DISCIPLINA WHERE ID_DISC=?");
	$SelecaoContato->bindParam(1,$Id);
	//$SelecaoContato->bindParam(1,$Email);
	//$SelecaoContato->bindParam(2,$SenhaProf);

	if ($SelecaoContato->execute()) 
	{
		if ($SelecaoContato->rowCount()>0) 
		{
			while ($Linha = $SelecaoContato->fetch(PDO::FETCH_OBJ)) 
			{
							$id=$Linha->ID_DISC;
							$_SESSION['IdDisc'] = $id;

							$nome = $Linha->NOME_DISC;
							$_SESSION['nomeDisc']= $nome;

							$idprof = $Linha->ID_PROF;
							$_SESSION['IdProfDisc']=$idprof;


							

							$_SESSION['controled'] = "localizado";
							header('location:relatorioaulasenviadas1.php');
							
			}
		}
		else
		{
			echo "<script>alert('Registro não existe!')</script>";
			echo "<script>location.href='relatorioaulasenviadas1.php';</script>";
		}
	}
}
catch(PDOException $erro)
{
	echo "Erro".$erro->getMessage();
}


?>