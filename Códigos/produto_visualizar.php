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
		<th>Fabricante</th>
		<th>Desconto</th>
		<th>Estoque</th>
		<th>Setor</th>
	</tr>
	<?php
		include_once("conexao.php");

		$filtro = $converter_filtro[$filtroURL];

		$sql = "SELECT * FROM produto ORDER BY ".$filtro;
		$produtos = mysqli_query($conexao, $sql);

		foreach($produtos as $produto){		

			/*
			$sql = "SELECT nome FROM setor WHERE id_setor=".$produto['id_setor'];
			$setor = mysqli_fetch_array( mysqli_query($conexao, $sql) );
			$setor = $setor['nome'];
			*/

			echo "<tr>";
				echo '<td>' . $produto['nome'] . '</td>';
				echo '<td>' . $produto['preco'] . '</td>';
				echo '<td>' . $produto['fabricante'] . '</td>';
				echo '<td>' . $produto['desconto'] . '</td>';
				echo '<td>' . $produto['quantidade'] . '</td>';
				echo '<td>' . $produto['id_setor'] . '</td>';
				if(isset($_SESSION['logado']) && $_SESSION['logado'] && $_SESSION['tipo_usuario'] == 'Funcionario'){
					echo '<td> <a href="produto_editar.php?id='.$produto['id_produto'].'"> Editar Produto </a> </td>';
					echo '<td> <a href="produto_excluir.php?id='.$produto['id_produto'].'"> Excluir Produto </a> </td>';
				}
				if(isset($_SESSION['logado']) && $_SESSION['logado'] && $_SESSION['tipo_usuario'] == 'Cliente'){
					echo '<td> <a href="produto_comprar.php?id='.$produto['id_produto'].'"> Comprar </a> </td>';
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