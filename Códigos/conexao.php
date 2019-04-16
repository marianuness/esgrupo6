<?php

$hostname = "localhost";;
$user = "root";
$password = "";
$database = "db_lojao_ze";
$conexao = mysqli_connect($hostname, $user, $password, $database);/* Estabelece a conexão */

if(!$conexao)
{
	echo "Falha na conexão com o BD!";/* Exibe uma mensagem de erro caso a conexão falhe */
}


?>