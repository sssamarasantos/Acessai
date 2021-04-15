<?php

$IdProf = $_SESSION['IdProf'];
include "conect.php";
try {
	$AtualizarContato=$conexao->prepare("DELETE FROM TB_DISCIPLINA where ID_PROF=?");//guarda no bd
	$AtualizarContato->bindParam(1,$IdProf);


			if ($AtualizarContato->execute()) {
				$AtualizarContato=$conexao->prepare("DELETE FROM TB_PROFESSOR WHERE ID_PROF=?");//guarda no bd
				$AtualizarContato->bindParam(1,$IdProf);

				if ($AtualizarContato->execute()) {
					if ($AtualizarContato->rowCount() > 0) {
						//header('location:relatorioaluno.php');//direciona para a pag 
						echo "<script>location.href='relatorioprofessorphp';</script>";
					}
				}
			}
}
catch(PDOException $erro)
{
	echo "Erro".$erro->getMessage();
}

?>