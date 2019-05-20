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
    <th>Descrição</th>
	<?php
	if(isset($_SESSION['logado']) && $_SESSION['logado'] && $_SESSION['tipo_usuario'] == 'Funcionario'){
	echo '<th>Editar</th>';
	echo '<th>Excluir</th>';
	}
	?>
  </tr>
 <?php
	include_once("conexao.php");
 	$sql = "SELECT * FROM produto";
	$produtos = mysqli_query($conexao, $sql);
	
	foreach($produtos as $produto){
		$sql = "SELECT * FROM produto WHERE id='".$produto['id']."'";
		$selecionado = mysqli_fetch_array( mysqli_query($conexao, $sql) );
		
		echo "<tr>";
		echo '<td>' . $selecionado['nome'] . '</td>';
		echo '<td>' . $selecionado['preco'] . '</td>';
		echo '<td>' . $selecionado['descricao'] . '</td>';
		if(isset($_SESSION['logado']) && $_SESSION['logado'] && $_SESSION['tipo_usuario'] == 'Funcionario'){
			echo '<td> <a href="produto_editar.php?id='.$selecionado['id'].'"> Editar Produto </a> </td>';
			echo '<td> <a href="produto_excluir.php?id='.$selecionado['id'].'"> Excluir Produto </a> </td>';
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