<?php
//$conexao = mysqli_connect("localhost","root", "", "tcc");
$conexao = mysqli_connect("localhost","id15054857_adms", "Tcc_1234_banco", "id15054857_acessai");

$id = $_POST["id"];

$comando = "delete from TB_CRONOGRAMA where ID_CRONO = '$id'";

$resultado = mysqli_query($conexao, $comando);

if($resultado != 0) {
	$dados = array("status"=>"ok");
} 
else {
	$dados = array("status"=>"erro");
}

$close = mysqli_close($conexao);
echo json_encode($dados);
?>