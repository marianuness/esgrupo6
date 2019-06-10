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
	<form action="" method="GET" target="_self">
		<div class="form-row">
			<div class="form-group col-md-3">
				<select id="inputState" name="filtro" class="form-control">
					<?php 
						$filtros = array('Ordem Alfabética', 'Data', 'Quantidade', 'Setor');

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
		<th>Cliente</th>
		<th>Funcionario</th> 
		<th>Preço</th>
		<th>Data</th>
	</tr>
	<?php
		include_once("conexao.php");

		$filtro = $converter_filtro[$filtroURL];

		$sql = "SELECT * FROM venda WHERE ativa = 0";
		$vendas = mysqli_query($conexao, $sql);

		foreach($vendas as $venda){		
			$id_cliente = $venda['id_cliente'];
			$sql = "SELECT * FROM usuario JOIN venda ON usuario.id_cadastro = venda.id_cliente OR usuario.id_cadastro = venda.id_responsavel";
			$table = mysqli_fetch_array(mysqli_query($conexao, $sql));
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
				echo '<td>' . $venda['total'] . '</td>';
				echo '<td>' . $venda['data'] . '</td>';
				if(isset($_SESSION['logado']) && $_SESSION['logado'] && $_SESSION['tipo_usuario'] == 'Funcionario'){
					echo '<td> <a href="vendas_editar.php?id='.$venda['id_venda'].'"> Editar Venda </a> </td>';
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