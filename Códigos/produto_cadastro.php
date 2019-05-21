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
	include_once("conexao.php");	/* Estabelece a conexão */
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
		function mascaraDinheiro(t) {
			$('.dinheiro').mask('#.00', {reverse: true});
		}
	</script>
	<!-- Fim do script -->
	<!-- Formulário de Cadastro de Usuário -->
	<form action="" method="POST" target="_self">
	<fieldset>
		<legend>Informações:</legend>
		<div class="form-row">
			<div class="form-group col-md-6">
			<label for="inputNome4">Nome</label>
			<input type="name" name="nome" class="form-control" id="inputNome4" placeholder="Nome">
			</div>
			<div class="form-group col-md-3">
			<label for="inputPrice4">Preço</label>
			<input type="text" name="preco" placeholder="100,00" class="dinheiro form-control" onkeypress="mascaraDinheiro(this)" maxlength="11">
			</div>
			<div class="form-group col-md-3">
			<label for="inputPrice4">Desconto</label>
			<input type="text" name="desconto" placeholder="10,00" class="dinheiro form-control" onkeypress="mascaraDinheiro(this)" maxlength="11">
			</div>
			<div class="form-group col-md-6">
			<label for="inputDescription4">Fabricante</label>
			<input type="text" name="fabricante" class="form-control" id="inputDescription4" placeholder="Nome Fabricante">
			</div>
			<div class="form-group col-md-3">
			<label for="inputPrice4">Quantidade</label>
			<input type="text" name="quantidade" placeholder="1000" class="form-control" maxlength="11">
			</div>
			<div class="form-group col-md-3">
			<label for="inputPrice4">Setor</label>
			<select id="setor" name="setor" class="form-control">
				<?php 
					$tipos = array('Administrador', 'Vendedor');
					$sql = "SELECT * FROM setor";
					$setores = mysqli_query($conexao, $sql);

					/*foreach ($setores as &$setor){
						echo '<option>' . $setor['codigo_identificacao'] . '</option>';
					}*/
				?>
			</select>
			</div>
		</div>
	</fieldset>
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
			$fabricante = $_POST['fabricante'];
			$desconto = $_POST['desconto'];
			$quantidade = $_POST['quantidade'];
			$setor = $_POST['setor'];

			$sql = "SELECT id_setor FROM setor WHERE codigo_identificacao=".$setor;
			$setor = mysqli_query($conexao, $sql);
			$id_setor = $setor['id_setor'];

			$sql = "INSERT INTO produto (nome, preco, fabricante, desconto, quantidade, id_setor) VALUES ('$nome', '$preco', '$fabricante', '$desconto', '$quantidade', '$id_setor')";
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