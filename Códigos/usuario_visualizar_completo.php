<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Visualizar Usuários</title>
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
	<?php
		$visualizar = $_GET['visualizar'];

		include_once("conexao.php");	/* Estabelece a conexão */

		$sql = "SELECT * FROM ".$visualizar;
		$selecionados = mysqli_query($conexao, $sql);

		?>

		<table border='1' cellpadding='10'>
			<tr> 
				<th>ID</th> 
				<th>Nome</th> 
				<th>E-Mail</th>
				<th>Telefone</th> 
				<th>CPF</th> 
				<?php
					if($visualizar == 'Cliente'){
						echo "<th>CNPJ</th> ";
					}
					else if($visualizar == 'Funcionario'){
						echo "<th>Número Identificação</th> ";
						echo "<th>Salário</th> ";
						echo "<th>Cargo</th> ";
					}
				?>
				<th>Rua</th> 
				<th>Número</th> 
				<th>Complemento</th> 
				<th>CEP</th> 
				<th>Cidade</th> 
				<th>Estado</th> 
				<th>Tipo Usuário</th> 
			</tr>

			<?php
				while($selecionado = mysqli_fetch_array( $selecionados )) {

					if($visualizar == 'Cliente'){
						$sql = "SELECT * FROM usuario WHERE id_cadastro=" . $selecionado['id_cliente'];
					}
					else if($visualizar == 'Funcionario'){
						$sql = "SELECT * FROM usuario WHERE id_cadastro=" . $selecionado['id_funcionario'];
					}

					$usuario = mysqli_fetch_array(mysqli_query($conexao, $sql));

					echo "<tr>";
						echo '<td>' . $usuario['id_cadastro'] . '</td>';
						echo '<td>' . $usuario['nome'] . '</td>';
						echo '<td>' . $usuario['email'] . '</td>';
						/*echo '<td>' . $usuario['senha'] . '</td>';*/
						echo '<td>' . $usuario['telefone'] . '</td>';
						echo '<td>' . $usuario['cpf'] . '</td>';
						if($visualizar == 'Cliente'){
							echo '<td>' . $selecionado['cnpj'] . '</td>';
						}
						else if($visualizar == 'Funcionario'){
							echo '<td>' . $selecionado['codigo_identificacao'] . '</td>';
							echo '<td>' . $selecionado['salario'] . '</td>';
							echo '<td>' . $selecionado['cargo'] . '</td>';
						}
						echo '<td>' . $usuario['rua'] . '</td>';
						echo '<td>' . $usuario['numero'] . '</td>';
						echo '<td>' . $usuario['complemento'] . '</td>';
						echo '<td>' . $usuario['cep'] . '</td>';
						echo '<td>' . $usuario['cidade'] . '</td>';
						echo '<td>' . $usuario['estado'] . '</td>';
						echo '<td>' . $usuario['tipo_usuario'] . '</td>';

						if($visualizar == 'Cliente'){
							echo '<td><a href="cliente_editar.php?id=' . $usuario['id_cadastro'] . '">Editar</a></td>';
						}
						else if($visualizar == 'Funcionario'){
							echo '<td><a href="funcionario_editar.php?id=' . $usuario['id_cadastro'] . '">Editar</a></td>';
						}
						echo '<td><a href="usuario_deletar.php?id=' . $usuario['id_cadastro'] . '&tipo=' . $visualizar . '">Deletar</a></td>';
					echo "</tr>";
				}
			?>
		</table>
	
</body>

</html>