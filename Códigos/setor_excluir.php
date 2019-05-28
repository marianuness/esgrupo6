<?php

include_once("conexao.php");

if (isset($_GET['id'])){
	$id = $_GET['id'];

	$sql = "DELETE FROM setor WHERE id_setor=" . $id;
	$resultado = mysqli_query($conexao, $sql);

	header("Location: setor_visualizar.php"); // redireciona de volta para a página de vizualização
}

?>