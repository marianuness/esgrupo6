<?php
include "header.php";
include_once("conexao.php");

if (isset($_GET['id'])){
	$id = $_GET['id'];
	$idu = intval($_SESSION['id']);
	echo "<h2>" . $idu . "</h2>";
	$sql = "SELECT id_venda FROM venda WHERE id_cliente = $idu AND ativa = 1 ORDER BY id_venda DESC LIMIT 1";
	$resultado = mysqli_fetch_array(mysqli_query($conexao, $sql));
	if($resultado){
		$venda_ativa = $resultado ['id_venda'];
	}
	else {
			$sql = "INSERT INTO venda (id_venda, id_cliente) VALUES (NULL, $idu)";
			$resultado = mysqli_query($conexao, $sql);
			$sql = "SELECT id_venda FROM venda WHERE id_cliente = $idu ORDER BY id_venda DESC LIMIT 1";
			$resultado = mysqli_fetch_array(mysqli_query($conexao, $sql));
			$venda_ativa = $resultado['id_venda'];
		}
		$sql = "INSERT INTO item_venda (id_venda, id_produto, quantidade) VALUES ('$venda_ativa','$id','1')";
		$resultado = mysqli_query($conexao, $sql);
		$sql = "SELECT total FROM venda WHERE id_venda = $venda_ativa";
		$resultado = mysqli_fetch_array(mysqli_query($conexao, $sql));
		$total = $resultado ['total'];
		$sql = "SELECT preco FROM produto WHERE id_produto = $id";
		$resultado = mysqli_fetch_array(mysqli_query($conexao, $sql));
		$preco = $resultado ['preco'];
		$total = $total + $preco;
		$sql = "UPDATE venda SET total = $total WHERE id_venda = $venda_ativa";
		$resultado = mysqli_query($conexao, $sql);

		#header("Location: produto_visualizar.php"); // redireciona de volta para a página de vizualização
	}

?>