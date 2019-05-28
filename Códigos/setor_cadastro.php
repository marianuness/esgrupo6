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
	<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js">
		$('.dinheiro').mask('#.##0,00', {reverse: true});</script>
	<link rel="stylesheet" href="publico/css/estilo.css">
</head>

<?php
	include "header.php";
	include_once("conexao.php");	/* Estabelece a conexão */
?>

<hr>

<body>
	<a href="setor_visualizar.php"> Ver dados completos </a>
	<p> </p>
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
			<label for="inputPrice4">Administrador Responsável</label>
			<select id="nome_responsavel" name="nome_responsavel" class="form-control">
				<?php
					$sql = "SELECT id_funcionario FROM funcionario WHERE cargo='Administrador'";
					$funcionarios = mysqli_query($conexao, $sql);

					foreach($funcionarios as $funcionario){
						$sql = "SELECT nome FROM usuario WHERE id_cadastro=".$funcionario['id_funcionario'];
						$usuario = mysqli_fetch_array( mysqli_query($conexao, $sql) );
						echo '<option>' . $usuario['nome'] . '</option>';
					}
				?>
			</select>
			</div>
			<div class="form-group col-md-3">
			<label>Número de Identificação</label>
			<input type="name" name="codigo_identificacao" class="form-control" placeholder="11.111-11" onkeypress="mascara(this, '##.###-##')" maxlength="9">
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
			$nome_responsavel = $_POST['nome_responsavel'];
			$codigo_identificacao = $_POST['codigo_identificacao'];

			$sql = "SELECT id_cadastro FROM usuario WHERE nome='".$nome_responsavel."'";
			$usuarios = mysqli_query($conexao, $sql);

			foreach ($usuarios as $usuario){
				$sql = "SELECT id_funcionario FROM funcionario WHERE id_funcionario=".$usuario['id_cadastro'];
				$funcionarios = mysqli_query($conexao, $sql);
				$row = mysqli_fetch_row($funcionarios);
				if(implode(null,$row) != null){
					foreach ($funcionarios as $funcionario){
						$id_responsavel = $funcionario['id_funcionario'];
					}
				}
			}

			$sql = "INSERT INTO setor (nome, id_responsavel, codigo_identificacao) VALUES ('$nome', '$id_responsavel', '$codigo_identificacao')";
			$resultado = mysqli_query($conexao, $sql);

			if($resultado){
				?>
				<div class="alert alert-success">Setor cadastrado com sucesso!</div>
				<?php
			}
			else{
				die(mysqli_error($conexao));
				?>
				<div class="alert alert-warning">Falha ao cadastrar setor!</div>
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