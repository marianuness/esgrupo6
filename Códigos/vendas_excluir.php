<?php

include_once("conexao.php");

if (isset($_GET['id'])){
	$id = $_GET['id'];
	
	$sql = "DELETE FROM item_venda WHERE id_venda=" . $id;
	$resultado = mysqli_query($conexao, $sql);

	$sql = "DELETE FROM venda WHERE id_venda=" . $id;
	$resultado = mysqli_query($conexao, $sql);

	header("Location: vendas_visualizar.php"); // redireciona de volta para a página de vizualização
}

?>