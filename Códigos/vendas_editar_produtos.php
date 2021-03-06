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
	include_once("conexao.php");	/* Estabelece a conexão */
	include "header.php";

	$venda_ativa = $_GET['id'];
?>

<body>
	<?php
		if(isset($_GET['filtro'])){
			$filtroURL = $_GET['filtro'];
		}
		else{
			$filtroURL = 'Nome';
		}

		$converter_filtro = array("Nome"=>"nome", 
								  "Preço"=>"preco",
								  "Quantidade"=>"item_venda.quantidade"); 
		
	?>
	<br>
	

<br>
<table>
	<tr>
		<th>Nome</th>
		<th>Preço</th> 
		<th>Quantidade</th>
	</tr>
	<?php
		echo "<a href='vendas_editar_produtos.php?id=$venda_ativa&filtro=Nome'> Filtrar por Ordem Alfabetica </a><br>";
		echo "<a href='vendas_editar_produtos.php?id=$venda_ativa&filtro=Preço'> Filtrar por Preço </a><br>";
		echo "<a href='vendas_editar_produtos.php?id=$venda_ativa&filtro=Quantidade'> Filtrar por Quantidade </a>";
		$filtro = $converter_filtro[$filtroURL];

		$sql = "SELECT *
		FROM  produto JOIN item_venda ON item_venda.id_produto = produto.id_produto
		WHERE id_venda = $venda_ativa ORDER BY ".$filtro;
		$produtos = mysqli_query($conexao, $sql);
		
		if($produtos){
			foreach($produtos as $produto){		
				$sql = "SELECT nome,preco FROM produto WHERE id_produto = $produto[id_produto]";
				$prd = mysqli_fetch_array(mysqli_query($conexao, $sql));
				echo "<tr>";
					echo '<td>' . $prd['nome'] . '</td>';
					echo '<td>' . $prd['preco'] . '</td>';
					echo '<td>' . $produto['quantidade'] . '</td>';
					echo '<td> <a href="vendas_remover.php?id='.$produto['id_produto'].'&venda='.$venda_ativa.'"> Remover </a> </td>';
				echo "</tr>";
			}
		}
	?>
</table>
<br>

	<form action="" method="POST" target="_self">
	<fieldset>
		
	<div class="form-group col-md-3">
	<label for="inputPrice4">Produto</label>
	<select id="produto" name="produto" class="form-control">
		<?php 
			$sql = "SELECT * FROM produto";
			$produtos = mysqli_query($conexao, $sql);

			foreach ($produtos as $produto){
				echo '<option>' . $produto['nome'] . '</option>';
				}
			?>
	</select>
	</div>
	<div class="form-group col-md-3">
	<label for="inputPrice4">Quantidade</label>
	<input type="text" name="quantidade" placeholder="0" class="form-control" maxlength="11">
	</div>
	<button type="submit" class="btn btn-primary" value="Submit" name="submit">Adicionar</button>
	</form>
	
		<?php

	/* Ligação com Banco de Dados */
	if(isset($_POST["submit"])) {
			$produto = $_POST['produto'];
			$sql = "SELECT id_produto FROM produto WHERE nome='".$produto."'";
			$produto = mysqli_fetch_array( mysqli_query($conexao, $sql) );
			$id_produto = $produto['id_produto'];

			$quantidade = $_POST['quantidade'];

			$sql = "INSERT INTO item_venda (id_venda, id_produto, quantidade) VALUES ('$venda_ativa', '$id_produto', '$quantidade')";
			$resultado = mysqli_query($conexao, $sql);
			
			header("Location: vendas_editar_produtos.php?id=".$venda_ativa);
			mysqli_close($conexao);
		}
	?>
</body>

<?php
	include "footer.php";

?>

</html>