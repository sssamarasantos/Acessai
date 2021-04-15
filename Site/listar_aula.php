<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
<?php
session_start();
include_once "conexao.php";

//consultar no banco de dados
$result_usuario = "SELECT * FROM TB_VIDEOAULA ORDER BY ID_VIDEOAULA DESC";
$resultado_usuario = mysqli_query($conn, $result_usuario);


//Verificar se encontrou resultado na tabela "usuarios"
if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
	?>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nome</th>

				<th>Video</th>
				<th>Data de Publicação</th>
				<th>Assistencia</th>
				<th>Arquivos</th>
				<th>Texto</th>
				<th>Identificação da Aula</th>
			</tr>
		</thead>
		<tbody>
<?php


			while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
				?>
				<tr>
					<th><?php echo $row_usuario['ID_VIDEOAULA']; ?></th>
					<td><?php echo $row_usuario['NOME_VIDEOAULA']; ?></td>
					<td><?php echo $row_usuario['VIDEO_VIDEOAULA']; ?></td>
					<td><?php echo $row_usuario['DTA_POST_VIDEOAULA']; ?></td>
					<td><?php echo $row_usuario['ASSISTENCIA_VIDEOAULA']; ?></td>
					<td><?php echo $row_usuario['ARQUIVO_VIDEOAULA']; ?></td>
					<td><?php echo $row_usuario['TEXTO_VIDEOAULA']; ?></td>
					<td><?php echo $row_usuario['ID_AULA']; ?></td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
<?php
}
else
{
	echo "<div class='alert alert-danger' role='alert'>Nenhum usuário encontrado!</div>";
}
?>
</body>
</html>

		
