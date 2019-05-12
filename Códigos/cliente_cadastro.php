<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cadastro de Cliente</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="publico/css/bootstrap.min.css" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
	<fieldset>
		<legend>Informações Pessoais:</legend>
		<div class="form-row">
			<div class="form-group col-md-6">
			<label for="inputEmail4">Email</label>
			<input type="name" name="email" class="form-control" id="inputEmail4" placeholder="Email">
			</div>
			<div class="form-group col-md-6">
			<label for="inputPassword4">Senha</label>
			<input type="password" name="senha" class="form-control" id="inputPassword4" placeholder="Senha">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
			<label for="inputEmail4">Nome</label>
			<input type="name" name="nome" class="form-control" id="inputNome4" placeholder="Nome">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-4">
			<label for="inputPassword4">Telefone</label>
			<input type="text" name="telefone" class="form-control" id="inputTelefone4" placeholder="(11)1111-1111" onkeypress="mascara(this, '## ####-####')"	maxlength="12">
			</div>
			<div class="form-group col-md-4">
			<label for="inputPassword4">CPF</label>
			<input type="text" name="cpf" class="form-control" id="inputCPF4" placeholder="111.111.111-11" onkeypress="mascara(this, '###.###.###-##')"	maxlength="14">
			</div>
			<div class="form-group col-md-4">
			<label for="inputPassword4">CNPJ</label>
			<input type="text" name="cnpj" class="form-control" id="inputCNPJ4" placeholder="11.111.111/1111-11" onkeypress="mascara(this, '##.###.###/####-##')"	maxlength="18">
			</div>
		</div>
	</fieldset>
	</br>
	<fieldset>
		<legend>Informações Residenciais:</legend>
		<div class="form-group">
			<label for="inputAddress">Rua</label>
			<input type="text" name="rua" class="form-control" id="inputAddress" placeholder="Av. Rio Branco">
		</div>
		<div class="form-row">
			<div class="form-group col-md-2">
				<label for="inputNumber">Número</label>
				<input type="number" name="numero" class="form-control" id="inputNumber" placeholder="220">
			</div>
			<div class="form-group col-md-10">
				<label for="inputAddress2">Complemento</label>
				<input type="text" name="complemento" class="form-control" id="inputAddress2" placeholder="Apartmento, estudio, or andar">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="inputCity">Cidade</label>
				<input type="text" name="cidade" class="form-control" id="inputCity" placeholder="Cidade">
			</div>
			<div class="form-group col-md-4">
				<label for="inputState">Estado</label>
				<select id="inputState" name="estado" class="form-control">
					<option selected>Escolha...</option>
					<?php 
						$estados = array('AC', 'AL', 'AP', 'AM',
										 'BA', 'CE', 'DF', 'ES',
										 'GO', 'MA', 'MT', 'MS',
										 'MG', 'PA', 'PB', 'PR',
										 'PE', 'PI', 'RJ', 'RN',
										 'RS', 'RO', 'RR', 'SC',
										 'SP', 'SE', 'TO');

						foreach ($estados as &$estado){
							echo '<option>' . $estado . '</option>';
						}
					?>
				</select>
			</div>
			<div class="form-group col-md-2">
				<label for="inputZip">CEP</label>
				<input type="text" name="cep" class="form-control" id="cep" onkeypress="mascara(this, '##.###-###')" placeholder="11.111-111" maxlength="10">
			</div>
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

			$tipo_usuario = 'Cliente';

			$email = $_POST['email'];
			$senha = $_POST['senha'];

			$nome = $_POST['nome'];
			$telefone = $_POST['telefone'];
			$cpf = $_POST['cpf'];
			$cnpj = $_POST['cnpj'];

			$rua = $_POST['rua'];
			$numero = $_POST['numero'];
			$complemento = $_POST['complemento'];
			$cidade = $_POST['cidade'];
			$estado = $_POST['estado'];
			$cep = $_POST['cep'];

			$sql = "INSERT INTO usuario (nome, cpf, telefone, email, senha, rua, numero, cep, cidade, estado, complemento, tipo_usuario) VALUES ('$nome', '$cpf', '$telefone', '$email', '$senha', '$rua', '$numero', '$cep', '$cidade', '$estado', '$complemento', '$tipo_usuario')";
			$resultado = mysqli_query($conexao, $sql);

			$id_usuario = mysqli_insert_id($conexao); // Último ID inserido

			$sql = "INSERT INTO cliente (id_cliente, cnpj) VALUES ('$id_usuario', '$cnpj')";
			$resultado = mysqli_query($conexao, $sql);

			if($resultado){
				?>
				<div class="alert alert-success">Usuário cadastrado com sucesso!</div>
				<?php
			}
			else{
				die(mysqli_error($conexao));
				?>
				<div class="alert alert-warning">Falha ao cadastrar usuário!</div>
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