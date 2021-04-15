<?php

$Id = $_SESSION['IdVideoaula'];
include "conect.php";
try {
	$AtualizarContato=$conexao->prepare("DELETE FROM TB_CRONOGRAMA where ID_VIDEOAULA=?");//guarda no bd
	$AtualizarContato->bindParam(1,$Id);

			if ($AtualizarContato->execute()) {
				$AtualizarContato=$conexao->prepare("DELETE FROM TB_DUVIDA WHERE ID_VIDEOAULA=?");//guarda no bd
				$AtualizarContato->bindParam(1,$Id);

			if ($AtualizarContato->execute()) {
				$AtualizarContato=$conexao->prepare("DELETE FROM TB_ITEM_AULA WHERE ID_VIDEOAULA=?");//guarda no bd
				$AtualizarContato->bindParam(1,$Id);

			if ($AtualizarContato->execute()) {
				$AtualizarContato=$conexao->prepare("DELETE FROM TB_VIDEOAULA WHERE ID_VIDEOAULA=?");//guarda no bd
				$AtualizarContato->bindParam(1,$Id);

				if ($AtualizarContato->execute()) {
					if ($AtualizarContato->rowCount() > 0) {
						//header('location:relatorioaluno.php');//direciona para a pag 
						echo "<script>location.href='relatorioaulasenviadas.php';</script>";
					}
				}
			}
		}
	}
}
catch(PDOException $erro)
{
	echo "Erro".$erro->getMessage();
}

?>