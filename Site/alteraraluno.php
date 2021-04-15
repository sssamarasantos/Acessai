<?php

$IdAluno = $_SESSION['IdAluno'];
include "conect.php";
try {
	$AtualizarContato=$conexao->prepare("DELETE FROM TB_CRONOGRAMA where ID_ALUNO=?");//guarda no bd
	$AtualizarContato->bindParam(1,$IdAluno);

	if ($AtualizarContato->execute()) {
		$AtualizarContato=$conexao->prepare("DELETE FROM TB_ITEM_AULA WHERE ID_ALUNO=?");//guarda no bd
		$AtualizarContato->bindParam(1,$IdAluno);

		if ($AtualizarContato->execute()) {
			$AtualizarContato=$conexao->prepare("DELETE FROM  TB_DUVIDA  WHERE ID_ALUNO=?");//guarda no bd
			$AtualizarContato->bindParam(1,$IdAluno);

			if ($AtualizarContato->execute()) {
				$AtualizarContato=$conexao->prepare("DELETE FROM TB_ALUNO WHERE ID_ALUNO=?");//guarda no bd
				$AtualizarContato->bindParam(1,$IdAluno);

				if ($AtualizarContato->execute()) {
					if ($AtualizarContato->rowCount() > 0) {
						echo"<script>location.href='relatorioaluno.php';</script>";
						//header('location:relatorioaluno.php');//direciona para a pag 
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
