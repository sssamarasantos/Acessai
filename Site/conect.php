<?php

$db = 'id15054857_acessai';
//$Usuario = 'root';
//$Senha = '';
$Usuario = 'id15054857_adms';
$Senha = 'Tcc_1234_banco';

try
{
	$conexao = new PDO("mysql:host=localhost; dbname=$db", "$Usuario", "$Senha");
	$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conexao->exec("set names utf8");
}

catch(PDOException $erro)
{
	echo "Erro na conexão".$erro->getMessage();
}



?>