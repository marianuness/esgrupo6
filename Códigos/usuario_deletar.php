<?php

include_once("conexao.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])){
	$id = $_GET['id'];

	$sql = "DELETE FROM usuario WHERE id=" . $id;
	$resultado = mysqli_query($conexao, $sql);

	header("Location: usuario_visualizar.php"); // redireciona de volta para a página de vizualização
}

?>