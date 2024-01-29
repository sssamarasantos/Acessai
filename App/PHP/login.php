<?php
include('credenciais.php');
$conexao = $conexao;

$loginx = $_POST["usuario"];
$senhax = $_POST["senha"];

$login = strtolower(str_replace(" ", "", $loginx));
$senha = str_replace(" ", "", $senhax);

$comando = "select * from TB_ALUNO where EMAIL_ALUNO='$login' and SENHA_ALUNO='$senha'";

$resultado = mysqli_query($conexao, $comando);

$dados = array("status"=>"-");

while($r = mysqli_fetch_array($resultado)){
    $dados = array("status"=>"ok");
}

$close = mysqli_close($conexao);
echo json_encode($dados);
?>