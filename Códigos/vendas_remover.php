<?php

include_once("conexao.php");

if (isset($_GET['id'])){
	$id = $_GET['id'];
	$venda_ativa = $_GET['venda'];

	$sql = "DELETE FROM item_venda WHERE id_produto= $id AND id_venda = $venda_ativa";
	$resultado = mysqli_query($conexao, $sql);

	header("Location: vendas_editar.php?id=$venda_ativa"); // redireciona de volta para a página de vizualização
}

?>