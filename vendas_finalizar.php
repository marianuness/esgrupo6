<?php

include_once("conexao.php");
include "header.php";

if (isset($_GET['id'])){
	$venda_ativa = $_GET['id'];

	$sql = "UPDATE venda SET ativa = 0 WHERE id_venda = $venda_ativa";
	$resultado = mysqli_query($conexao, $sql);

	header("Location: carrinho_visualizar.php"); // redireciona de volta para a página de vizualização
}

?>