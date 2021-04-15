<?php
$servidor = "localhost";
$usuario = 'id15054857_adms';
$senha = 'Tcc_1234_banco';
$dbname = "id15054857_acessai";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

if (!mysqli_set_charset($conn, 'utf8')) {
    printf('Error ao usar utf8: %s', mysqli_error($conn));
    exit;
}