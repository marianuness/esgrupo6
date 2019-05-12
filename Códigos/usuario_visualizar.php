<!DOCTYPE html>
<html>


<?php
	if(isset($_GET['visualizar'])){
		$visualizar = $_GET['visualizar'];
	}
	else{
		$visualizar = 'Cliente';
	}

	$aux_visualizar = array("Cliente"=>"cliente", 
							"Funcionario"=>"funcionario"); 
?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Visualizar <?php echo $visualizar; ?></title>
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
		if(isset($_GET['filtro'])){
			$filtroURL = $_GET['filtro'];
		}
		else{
			$filtroURL = 'Ordem Alfabética';
		}
		?>

		<a href="cliente_cadastro.php"> Cadastrar Cliente </a> </br>
		<a href="usuario_visualizar_completo.php?visualizar=Cliente"> Ver dados completos dos Clientes</a>
		<p> </p>

		<a href="funcionario_cadastro.php"> Cadastrar Funcionário </a> </br>
		<a href="usuario_visualizar_completo.php?visualizar=Funcionario"> Ver dados completos dos Funcionários</a>
		<p> </p>

		<?php

		include_once("conexao.php");	/* Estabelece a conexão */

		$converter_filtro = array("Ordem Alfabética"=>"nome", 
								  "Estado"=>"estado",  
                  				  "Cidade"=>"cidade", 
                  				  "Número de Identificação"=>"codigo_identificacao",  
                  				  "Cargo"=>"cargo"); 
		?>

		<form action="" method="GET" target="_self">
			<div class="form-row">
				<div class="form-group col-md-3">
					<select id="inputState" name="filtro" class="form-control">
						<?php 
							$filtrosCliente 	= array('Ordem Alfabética', 'Estado', 'Cidade');
							$filtrosFuncionario = array('Ordem Alfabética', 'Número de Identificação', 'Cargo');

							if($visualizar == 'Cliente'){
								$filtros = $filtrosCliente;
							}
							else if($visualizar == 'Funcionario'){
								$filtros = $filtrosFuncionario;
							}

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
				<div class="form-group col-md-3" style="display: none;">
					<select id="inputState" name="visualizar" class="form-control">
							<option selected><?php echo $visualizar; ?></option>
					</select>
				</div>
				<div class="form-group col-md-3">
					<input name="submit" type="submit" value="Filtrar"/>
				</div>
			</div>
		</form>
		<?php

		if($visualizar == 'Cliente'){
			?>
			<a href="usuario_visualizar.php?visualizar=Funcionario"> Visualizar dados Funcionario </a> </br>
			<?php
		}
		else if($visualizar == 'Funcionario'){
			?>
			<a href="usuario_visualizar.php?visualizar=Cliente"> Visualizar dados Cliente </a> </br>
			<?php
		}
		?>

		<table border='1' cellpadding='10'>
			<tr>
				<?php
					if($visualizar == 'Funcionario'){
						echo "<th>Número Identificação</th> ";
					}
				?>
				<th>Nome</th>
				<?php
					if($visualizar == 'Cliente'){
						echo "<th>CNPJ</th> ";
					}
					else if($visualizar == 'Funcionario'){
						echo "<th>CPF</th> ";
						echo "<th>Cargo</th> ";
					}
				?>
				<th>E-Mail</th>
				<th>Cidade</th> 
				<th>Estado</th> 
			</tr>
			<?php
				$filtro = $converter_filtro[$filtroURL];

				if($filtro == 'codigo_identificacao' || $filtro == 'cargo'){
					$sql = "SELECT * FROM funcionario  ORDER BY ".$filtro."";
					$usuarios = mysqli_query($conexao, $sql);
				}
				else{
					$sql = "SELECT * FROM usuario WHERE tipo_usuario='".$visualizar."' ORDER BY ".$filtro."";
					$usuarios = mysqli_query($conexao, $sql);
				}

				foreach($usuarios as $usuario){
					if($filtro == 'codigo_identificacao' || $filtro == 'cargo'){
						$sql = "SELECT * FROM usuario WHERE id_cadastro='".$usuario['id_funcionario']."'";

						$selecionado = mysqli_fetch_array( mysqli_query($conexao, $sql) );

						echo "<tr>";
							echo '<td>' . $usuario['codigo_identificacao'] . '</td>';
							echo '<td>' . $selecionado['nome'] . '</td>';
							echo '<td>' . $selecionado['cpf'] . '</td>';
							echo '<td>' . $usuario['cargo'] . '</td>';
							echo '<td>' . $selecionado['email'] . '</td>';
							echo '<td>' . $selecionado['cidade'] . '</td>';
							echo '<td>' . $selecionado['estado'] . '</td>';
						echo "</tr>";

					}
					else{
						if($visualizar == 'Cliente'){
							$sql = "SELECT * FROM cliente WHERE id_cliente='".$usuario['id_cadastro']."'";
						}
						else if($visualizar == 'Funcionario'){
							$sql = "SELECT * FROM funcionario WHERE id_funcionario='".$usuario['id_cadastro']."'";
						}

						$selecionado = mysqli_fetch_array( mysqli_query($conexao, $sql) );

						echo "<tr>";
							if($visualizar == 'Funcionario'){
								echo '<td>' . $selecionado['codigo_identificacao'] . '</td>';
							}
							echo '<td>' . $usuario['nome'] . '</td>';
							if($visualizar == 'Cliente'){
								echo '<td>' . $selecionado['cnpj'] . '</td>';
							}
							else if($visualizar == 'Funcionario'){
								echo '<td>' . $usuario['cpf'] . '</td>';
								echo '<td>' . $selecionado['cargo'] . '</td>';
							}
							echo '<td>' . $usuario['email'] . '</td>';
							echo '<td>' . $usuario['cidade'] . '</td>';
							echo '<td>' . $usuario['estado'] . '</td>';
						echo "</tr>";
					}
				}
			?>
		</table>
	
</body>

</html>