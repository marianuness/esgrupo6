<?php

include_once("conexao.php");

if (isset($_GET['id'])){
	$id = $_GET['id'];
	$tipo = $_GET['tipo'];

	if($tipo == 'Cliente'){
		$sql = "DELETE FROM cliente WHERE id_cliente=" . $id;
	}
	else if($tipo == 'Funcionario'){
		$sql = "DELETE FROM funcionario WHERE id_funcionario=" . $id;
	}
	$resultado = mysqli_query($conexao, $sql);


	$sql = "DELETE FROM usuario WHERE id_cadastro=" . $id;
	$resultado = mysqli_query($conexao, $sql);

	if($tipo == 'Cliente'){
		header("Location: usuario_visualizar_completo.php?visualizar=Cliente"); // redireciona de volta para a página de vizualização
	}
	else if($tipo == 'Funcionario'){
		header("Location: usuario_visualizar_completo.php?visualizar=Funcionario"); // redireciona de volta para a página de vizualização
	}
}

?>