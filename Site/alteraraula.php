<?php
//session_start();
error_reporting(0);
ini_set("display_errors", 0);
$nomevideoaula=$_POST["nome_videoaula"];
$textovideoaula=$_POST["texto_videoaula"];
$datapost=$_POST["datapostagem"];
$IdAula= $_SESSION['IdVideoaula'];
include "conect.php";
try
{
	$AtualizarNovo=$conexao->prepare("UPDATE TB_VIDEOAULA SET NOME_VIDEOAULA=?, TEXTO_VIDEOAULA=?, DTA_POST_VIDEOAULA=? WHERE ID_VIDEOAULA=?");//guarda no bd

	//caso não preenchido 
		if ($_POST["nome_videoaula"]=="") $nomevideoaula = $_SESSION['nomeVideoaula']; 
		if ($_POST["texto_videoaula"]=="") $textovideoaula= $_SESSION['textoVideoaula']; 
		if ($_POST["datapostagem"]=="") $datapost = $_SESSION['dataPost']; 



	$AtualizarNovo->bindParam(1,$nomevideoaula);
	$AtualizarNovo->bindParam(2,$textovideoaula);
	$AtualizarNovo->bindParam(3,$datapost);
	$AtualizarNovo->bindParam(4,$IdAula);

if($AtualizarNovo->execute())
{	
	if ($AtualizarNovo->rowCount()>0) 
			{
				$SelecaoNova = $conexao->prepare("SELECT ID_VIDEOAULA, NOME_VIDEOAULA ,VIDEO_VIDEOAULA, DTA_POST_VIDEOAULA, ASSISTENCIA_VIDEOAULA, ARQUIVO_VIDEOAULA, TEXTO_VIDEOAULA, ID_AULA FROM TB_VIDEOAULA WHERE NOME_VIDEOAULA=? AND DTA_POST_VIDEOAULA=? AND TEXTO_VIDEOAULA=?");

				$SelecaoNova->bindParam(1,$nomevideoaula);
				$SelecaoNova->bindParam(2,$datapost);
				$SelecaoNova->bindParam(3,$textovideoaula);
				

				if ($SelecaoNova ->execute()) 
				{
					if ($SelecaoNova->rowCount()>0)
					{
						while ($Linha=$SelecaoNova->fetch(PDO::FETCH_OBJ)) 
						{
							$id=$Linha->ID_VIDEOAULA;
							$_SESSION['IdVideoaula'] = $id;

							$nome = $Linha->NOME_VIDEOAULA;
							$_SESSION['nomeVideoaula']= $nome;

							$datapostagem = $Linha->DTA_POST_VIDEOAULA;
							$_SESSION['dataPost']= $datapostagem;

							$assistencia = $Linha->ASSISTENCIA_VIDEOAULA;
							$_SESSION['assistenciaVideoaula']=$assistencia;

							$arquivo = $Linha->ARQUIVO_VIDEOAULA;
							$_SESSION['arquivoVideoaula']= $arquivo;

							$texto = $Linha->TEXTO_VIDEOAULA;
							$_SESSION['textoVideoaula']= $texto;

							$idaula = $Linha->ID_AULA;
							$_SESSION['idaulaVideoaula']= $idaula;


							$_SESSION['controleVDAula'] = "alterado";
							header('location:relatorioaulasenviadas.php');



						

						}
					}
				}
}
}
//header("Refresh:0; url=alteraraula.php");
echo "<script> alert('Aula alterada com sucesso!')</script>";
echo "<script>location.href='relatorioaulasenviadas.php';</script>";
}
catch(PDOException $erro)
{
	echo "Erro".$erro->getMessage();
}

?>
