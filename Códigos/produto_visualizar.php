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

			<a href="produto_cadastro.php"> Cadastrar Produto </a> </br>
			<p> </p>

			<?php
		}
		
	?>

<br>
<table>
  <tr>
    <th>Nome</th>
    <th>Preço</th> 
    <th>Fabricante</th>
    <th>Desconto</th>
    <th>Quantidade</th>
    <th>Cód.Setor</th>
  </tr>
 <?php
	include_once("conexao.php");
 	$sql = "SELECT * FROM produto";
	$produtos = mysqli_query($conexao, $sql);
	
	foreach($produtos as $produto){		

		$sql = "SELECT codigo_identificacao FROM setor WHERE id_setor=".$produto['id_setor'];
		$codigo_identificacao = mysqli_query($conexao, $sql);
		$id_setor = $setor['id_setor'];

		echo "<tr>";
			echo '<td>' . $produto['nome'] . '</td>';
			echo '<td>' . $produto['preco'] . '</td>';
			echo '<td>' . $produto['fabricante'] . '</td>';
			echo '<td>' . $produto['desconto'] . '</td>';
			echo '<td>' . $produto['quantidade'] . '</td>';
			echo '<td>' . $codigo_identificacao . '</td>';
			if(isset($_SESSION['logado']) && $_SESSION['logado'] && $_SESSION['tipo_usuario'] == 'Funcionario'){
				echo '<td> <a href="produto_editar.php?id='.$produto['id'].'"> Editar Produto </a> </td>';
				echo '<td> <a href="produto_excluir.php?id='.$produto['id'].'"> Excluir Produto </a> </td>';
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