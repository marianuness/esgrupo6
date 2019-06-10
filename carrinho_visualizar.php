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
			<a href="produto_cadastro.php"> Cadastrar Produto </a> </br>

			<?php
		}

		if(isset($_GET['filtro'])){
			$filtroURL = $_GET['filtro'];
		}
		else{
			$filtroURL = 'Ordem Alfabética';
		}

		$converter_filtro = array("Ordem Alfabética"=>"nome", 
								  "Preço"=>"preco",
								  "Quantidade"=>"quantidade",  
								  "Setor"=>"id_setor"); 
		
	?>
	<br>
	<form action="" method="GET" target="_self">
		<div class="form-row">
			<div class="form-group col-md-3">
				<select id="inputState" name="filtro" class="form-control">
					<?php 
						$filtros = array('Ordem Alfabética', 'Preço', 'Quantidade', 'Setor');

						foreach ($filtros as &$filtro_atual){
							if(isset($filtroURL) && $filtroURL == $filtro_atual){
								echo '<option selected>' . $filtro_atual . '</option>';
							}
							else{
								echo '<option>' . $filtro_atual . '</option>';
							}
						}
					?>
				</select>
			</div>
			<div class="form-group col-md-3">
				<input name="submit" type="submit" value="Filtrar"/>
			</div>
		</div>
	</form>

<br>
<table>
	<tr>
		<th>Nome</th>
		<th>Preço</th> 
		<th>Quantidade</th>
	</tr>
	<?php
		include_once("conexao.php");

		$filtro = $converter_filtro[$filtroURL];
		
		$idu = intval($_SESSION['id']);
		$sql = "SELECT id_venda FROM venda WHERE id_cliente = $idu AND ativa = 1 ORDER BY id_venda DESC LIMIT 1";
		$resultado = mysqli_fetch_array(mysqli_query($conexao, $sql));
		$venda_ativa = $resultado ['id_venda'];

		$sql = "SELECT id_produto, quantidade FROM item_venda WHERE id_venda = $venda_ativa";
		$produtos = mysqli_query($conexao, $sql);
		
		if($produtos){
			foreach($produtos as $produto){		
				$sql = "SELECT nome,preco FROM produto WHERE id_produto = $produto[id_produto] ORDER BY ".$filtro;
				$prd = mysqli_fetch_array(mysqli_query($conexao, $sql));
				echo "<tr>";
					echo '<td>' . $prd['nome'] . '</td>';
					echo '<td>' . $prd['preco'] . '</td>';
					echo '<td>' . $produto['quantidade'] . '</td>';
					echo '<td> <a href="carrinho_remover.php?id='.$produto['id_produto'].'&venda='.$venda_ativa.'"> Remover </a> </td>';
				echo "</tr>";
			}
		}
	?>
</table>
<br>
</body>

<?php
	echo '<td> <a href="vendas_finalizar.php?id='.$venda_ativa.'"> Finalizar Compra </a> </td>';
	include "footer.php";
?>

</html>