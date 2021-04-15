<?php

//Páginas para localizar a aula
$id=$_POST['id_videoaula'];
include "conect.php";
try
{
	$SelecaoContato=$conexao->prepare("SELECT * FROM TB_VIDEOAULA WHERE ID_VIDEOAULA=?");
	$SelecaoContato->bindParam(1,$id);
	

	if ($SelecaoContato->execute()) 
	{
		if ($SelecaoContato->rowCount()>0) 
		{
			while ($Linha = $SelecaoContato->fetch(PDO::FETCH_OBJ)) 
			{
							$id=$Linha->ID_VIDEOAULA;
							$_SESSION['IdVideoaula'] = $id;

							$nome = $Linha->NOME_VIDEOAULA;
							$_SESSION['nomeVideoaula']= $nome;

							$nome = $Linha->VIDEO_VIDEOAULA;
							$_SESSION['videoVideoaula']= $nome;

							$data = $Linha->DTA_POST_VIDEOAULA;
							$_SESSION['dataPost']=$data;

							$nome = $Linha->ASSISTENCIA_VIDEOAULA;
							$_SESSION['assistenciaVideoula']= $nome;

							$nome = $Linha->ARQUIVO_VIDEOAULA;
							$_SESSION['arquivoVideoula']= $nome;

							$nome = $Linha->TEXTO_VIDEOAULA;
							$_SESSION['textoVideoaula']= $nome;

							$nome = $Linha->ID_AULA;
							$_SESSION['nomeaulaVideoaula']= $nome;


							

							$_SESSION['controleVDAula'] = "localizado";
							header('location:relatorioaulas.php');
							
			}
		}
		else
		{
			echo "<script>alert('Registro não existe!')</script>";
			echo "<script>location.href='relatorioaulas.php';</script>";
		}
	}
}
catch(PDOException $erro)
{
	echo "Erro".$erro->getMessage();
}

?>