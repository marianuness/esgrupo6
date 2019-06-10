<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Produtos</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="publico/css/bootstrap.min.css" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="publico/css/estilo.css">
	<style>
	table, th, td {
	border: 1px solid black;
	border-collapse: collapse;
	}
	th, td {
	padding: 15px;
	}
	</style>
</head>

<?php
	include "header.php";
?>

<body>
	<?php
		if(isset($_SESSION['logado']) && $_SESSION['logado'] && $_SESSION['tipo_usuario'] == 'Funcionario'){
			?>

			<p> </p>
			<a href="vendas_cadastro.php"> Cadastrar Nova Venda </a> </br>

			<?php
		}

		if(isset($_GET['filtro'])){
			$filtroURL = $_GET['filtro'];
		}
		else{
			$filtroURL = 'Ordem Alfabética';
		}

		$converter_filtro = array("Ordem Alfabética"=>"nome", 
								  "Data"=>"data",
								  "Quantidade"=>"quantidade",  
								  "Setor"=>"id_setor"); 
		
	?>
	<br>

<br>
<table>
	<tr>
		<th>Cliente</th>
		<th>Funcionario</th> 
		<th>Preço</th>
		<th>Data</th>
	</tr>
	<?php
		include_once("conexao.php");

		$filtro = $converter_filtro[$filtroURL];

		$sql = "SELECT * FROM venda WHERE ativa = 0 ORDER BY data";
		$vendas = mysqli_query($conexao, $sql);

		foreach($vendas as $venda){		
			$id_cliente = $venda['id_cliente'];
			$sql = "SELECT * FROM item_venda WHERE id_venda = '".$venda['id_venda']."'";
			$produtos = mysqli_query($conexao, $sql);
			$total = 0;
			if ($produtos){
				foreach($produtos as $p){
					$produto = $p['id_produto'];
					$sql = "SELECT preco FROM produto WHERE id_produto = $produto";
					$preco = mysqli_fetch_array(mysqli_query($conexao, $sql));
					$sql = "SELECT quantidade FROM item_venda WHERE id_venda = '".$venda['id_venda']."' AND id_produto = $produto";
					$qtd = mysqli_fetch_array(mysqli_query($conexao, $sql));
					$total = $total + ($preco['preco']*$qtd['quantidade']);
				}
			}
			$sql = "SELECT nome FROM usuario WHERE id_cadastro = $id_cliente";
			$nome_cliente = mysqli_fetch_array(mysqli_query($conexao, $sql));
			$nome_cliente = $nome_cliente['nome'];
			$id_func = $venda['id_responsavel'];
			$sql = "SELECT nome FROM usuario WHERE id_cadastro = $id_func";
			$nome_func = mysqli_fetch_array(mysqli_query($conexao, $sql));
			$nome_func = $nome_func['nome'];
			echo "<tr>";
				echo '<td>' . $nome_cliente . '</td>';
				echo '<td>' . $nome_func . '</td>';
				echo '<td>' . $total . '</td>';
				echo '<td>' . $venda['data'] . '</td>';
				if(isset($_SESSION['logado']) && $_SESSION['logado'] && $_SESSION['tipo_usuario'] == 'Funcionario'){
					echo '<td> <a href="vendas_editar_usuarios.php?id='.$venda['id_venda'].'"> Editar Usuarios </a> </td>';
					echo '<td> <a href="vendas_editar_produtos.php?id='.$venda['id_venda'].'"> Editar Produtos </a> </td>';
					echo '<td> <a href="vendas_excluir.php?id='.$venda['id_venda'].'"> Excluir Venda </a> </td>';
				}
			echo "</tr>";
		}
	?>
</table>
<br>
</body>

<?php
	include "footer.php";
?>

</html>