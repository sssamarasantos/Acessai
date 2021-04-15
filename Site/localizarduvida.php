<?php
//Páginas para localizar os contatos
$idDuvida = $_SESSION['idDuvida'];
$idProf = $_SESSION['IdProf'];

include "conect.php";
try
{
	$SelecaoDuvida=$conexao->prepare("select TB_DUVIDA.ID_DUVIDA, TB_ALUNO.NOME_ALUNO, TB_DUVIDA.MSG_DUVIDA, date_format(TB_DUVIDA.DTAHR_MSG_DUVIDA, '%d/%m/%Y %k:%s') as DTAHR_MSG_DUVIDA, TB_VIDEOAULA.NOME_VIDEOAULA, TB_DUVIDA.RESP_DUVIDA, date_format(TB_DUVIDA.DTAHR_RESP_DUVIDA, '%d/%m/%Y %k:%s') as DTAHR_RESP_DUVIDA from TB_DUVIDA inner join TB_ALUNO on TB_DUVIDA.ID_ALUNO = TB_ALUNO.ID_ALUNO left join TB_PROFESSOR on TB_DUVIDA.ID_PROF = TB_PROFESSOR.ID_PROF left join TB_VIDEOAULA on TB_VIDEOAULA.ID_VIDEOAULA = TB_DUVIDA.ID_VIDEOAULA where TB_DUVIDA.ID_DUVIDA=? and TB_PROFESSOR.ID_PROF=?");
	$SelecaoDuvida->bindParam(1, $idDuvida);
	$SelecaoDuvida->bindParam(2, $idProf);

	if ($SelecaoDuvida->execute()) 
	{
		if ($SelecaoDuvida->rowCount()>0) 
		{
			while ($Linha = $SelecaoDuvida->fetch(PDO::FETCH_OBJ)) 
			{
				$id = $Linha->ID_DUVIDA;
				$_SESSION['idDuvida'] = $id;

				$nomeAluno = $Linha->NOME_ALUNO;
				$_SESSION['nomeAluno'] = $nomeAluno;

				$msgDuvida = $Linha->MSG_DUVIDA;
				$_SESSION['msgDuvida'] = $msgDuvida;

				$dtahrMsgDuvida = $Linha->DTAHR_MSG_DUVIDA;
				$_SESSION['dtahrMsgDuvida'] = $dtahrMsgDuvida;

				$nomeVideoaula = $Linha->NOME_VIDEOAULA;
				$_SESSION ['nomeVideoaula'] = $nomeVideoaula;

				$respDuvida = $Linha->RESP_DUVIDA;
				$_SESSION['respDuvida'] = $respDuvida;

				$dtahrRespDuvida = $Linha->DTAHR_RESP_DUVIDA;
				$_SESSION['dtahrRespDuvida'] = $dtahrRespDuvida;

				$_SESSION['controleProf'] = "localizado";
				echo "<script>location.href='respostaduvida.php';</script>";
				//header('location:respostaduvida.php');					
			}
		}
		else
		{
			echo "<script>alert('Registro não existe!')</script>";

			echo "<script>location.href='respostaduvida.php';</script>";
		}
	}
}
catch(PDOException $erro)
{
	echo "Erro".$erro->getMessage();
}
?>