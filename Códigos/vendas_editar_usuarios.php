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
	$sql = "SELECT * FROM venda WHERE id_venda=" . $venda_ativa;
	$venda = mysqli_fetch_array( mysqli_query($conexao, $sql) );
	$id_cliente = $venda['id_cliente'];
	$id_funcionario = $venda['id_responsavel'];
	$sql = "SELECT nome FROM usuario WHERE id_cadastro=" . $id_cliente;
	$cliente = mysqli_fetch_array( mysqli_query($conexao, $sql) );
	$cliente = $cliente['nome'];
	$sql = "SELECT nome FROM usuario WHERE id_cadastro=" . $id_funcionario;
	$funcionario = mysqli_fetch_array( mysqli_query($conexao, $sql) );
	$funcionario = $funcionario['nome'];
?>

<body>
	<form action="" method="POST" target="_self">
	<fieldset>
		<legend>Informações:</legend>
		<div class="form-row">
			<div class="form-group col-md-6">
			<label for="inputNome4">Nome Cliente</label>
			<input type="name" name="nomeCliente" class="form-control" id="inputNome4" placeholder="Nome" value="<?php  echo $cliente; ?>">
			</div>
			<div class="form-group col-md-6">
			<label for="inputNome4">Nome Responsavel</label>
			<input type="name" name="nomeFunc" class="form-control" id="inputNome4" placeholder="Nome" value="<?php  echo $funcionario; ?>">
			</div>
	</div>
	</fieldset>
	</br>
	<button type="submit" class="btn btn-primary" value="Submit" name="submit">Modificar</button>
	</form>
	
		<?php
		/* Ligação com Banco de Dados */
		if(isset($_POST["submit"])) {
			include_once("conexao.php");	/* Estabelece a conexão */

			$cliente = $_POST['nomeCliente'];
			$funcionario = $_POST['nomeFunc'];
			
			$sql = "SELECT id_cadastro FROM usuario WHERE nome='" . $cliente."'";
			$cliente = mysqli_fetch_array( mysqli_query($conexao, $sql) );
			if(!$cliente){
				?>
				<div class="alert alert-warning">Cliente nao encontrado!</div>
				<?php
			}
			$cliente = $cliente['id_cadastro'];
			$sql = "SELECT id_cadastro FROM usuario WHERE nome='" . $funcionario."'";
			$funcionario = mysqli_fetch_array( mysqli_query($conexao, $sql) );
			if(!$funcionario){
				?>
				<div class="alert alert-warning">Funcionario nao encontrado!</div>
				<?php
			}
			$funcionario = $funcionario['id_cadastro'];

			$sql = "UPDATE venda SET id_cliente = '".$cliente."', id_responsavel = '".$funcionario."' WHERE id_venda = ".$venda_ativa."";
			$resultado = mysqli_query($conexao, $sql);
			header("Location: vendas_visualizar.php?id=".$venda_ativa);

			if($resultado){
				?>
				<div class="alert alert-success">Venda atualizada com sucesso!</div>
				<?php
			}
			else{
				die(mysqli_error($conexao));
				?>
				<div class="alert alert-warning">Falha ao atualizar venda!</div>
				<?php
			}
		}
	?>
</body>

<?php
	include "footer.php";

?>

</html>