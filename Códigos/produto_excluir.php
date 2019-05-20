<?php

include_once("conexao.php");

if (isset($_GET['id'])){
	$id = $_GET['id'];

	$sql = "DELETE FROM produto WHERE id=" . $id;
	$resultado = mysqli_query($conexao, $sql);

	header("Location: produto.php"); // redireciona de volta para a página de vizualização
}

?>