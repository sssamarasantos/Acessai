<?php

//Páginas para localizar a aula

include "conect.php";
try
{
	$SelecaoContato=$conexao->prepare("SELECT * FROM TB_AULA");
	

	if ($SelecaoContato->execute()) 
	{
		if ($SelecaoContato->rowCount()>0) 
		{
			while ($Linha = $SelecaoContato->fetch(PDO::FETCH_OBJ)) 
			{
							$id=$Linha->ID_AULA;
							$_SESSION['IdAula'] = $id;

							$nome = $Linha->NOME_AULA;
							$_SESSION['nomeAula']= $nome;

							$data = $Linha->DATA_MODI_AULA;
							$_SESSION['dataModi']=$data;

							$idDisc= $Linha->ID_DISC;
							$_SESSION['IdDisc']=$idDisc;
							


							

							$_SESSION['controleAula'] = "localizado";
							header('location:aula.php');
							
			}
		}
		else
		{
			echo "<script>alert('Registro não existe!')</script>";
			echo "<script>location.href='aula.php';</script>";
		}
	}
}
catch(PDOException $erro)
{
	echo "Erro".$erro->getMessage();
}

?>