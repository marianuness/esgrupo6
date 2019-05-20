<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cadastro de Produto</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="publico/css/bootstrap.min.css" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/utils.js"></script>
	<link rel="stylesheet" href="publico/css/estilo.css">
</head>

<?php
	include "header.php";
?>

<hr>

<body>
	<!-- Script para fazer a máscara. Com ele, você pode definir qualquer tipo de máscara com o comando onkeypress="mascara(this, '###.###.###-##')". -->
	<script language="JavaScript">
		function mascara(t, mask){
			var i = t.value.length;				
			var saida = mask.substring(1,0);
			var texto = mask.substring(i)
			if (texto.substring(0,1) != saida){
				t.value += texto.substring(0,1);
			}
		}
	</script>
	<!-- Fim do script -->
	<!-- Formulário de Cadastro de Usuário -->
	<form action="" method="POST" target="_self">
		<div class="form-group col-md-4">
	<fieldset>
		<legend>Informações Pessoais:</legend>
		<div class="form-row">
			<div class="form-group col-md-6">
			<label for="inputNome4">Nome</label>
			<input type="name" name="nome" class="form-control" id="inputNome4" placeholder="Nome">
			</div>
			<div class="form-group col-md-6">
			<label for="inputPrice4">Preço</label>
			<input type="text" name="preco" class="form-control" id="inputPrice4" placeholder="Preco">
			</div>
			<div class="form-group col-md-6">
			<label for="inputDescription4">Descrição</label>
			<input type="text" name="descricao" class="form-control" id="inputDescription4" placeholder="Descrição">
			</div>
		</div>
	</fieldset>
		</div>
	</fieldset>
	</br>
	</br>
	<button type="submit" class="btn btn-primary" value="Submit" name="submit">Confirmar</button>
	</form>
	<!-- Fim do Formulário de Cadastro de Usuário	-->
	
	<?php
		/* Ligação com Banco de Dados */
		if(isset($_POST["submit"])) {
			include_once("conexao.php");	/* Estabelece a conexão */

			$nome = $_POST['nome'];
			$preco = $_POST['preco'];
			$descricao = $_POST['descricao'];

			$sql = "INSERT INTO produto (nome, preco, descricao) VALUES ('$nome', '$preco', '$descricao')";
			$resultado = mysqli_query($conexao, $sql);

			if($resultado){
				?>
				<div class="alert alert-success">Produto cadastrado com sucesso!</div>
				<?php
			}
			else{
				die(mysqli_error($conexao));
				?>
				<div class="alert alert-warning">Falha ao cadastrar produto!</div>
				<?php
			}
		
			mysqli_close($conexao);
		}
	?>

</body>

<hr>

<?php
	include "footer.php";
?>

</html>