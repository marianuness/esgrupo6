<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Setores</title>
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
		if(isset($_SESSION['logado']) && $_SESSION['logado'] && $_SESSION['tipo_usuario'] == 'Funcionario' && $_SESSION['cargo'] == 'Administrador'){
			?>

			<p> </p>
			<a href="setor_cadastro.php"> Cadastrar Setor </a> </br>
			<p> </p>

			<?php
		}

		if(isset($_GET['filtro'])){
			$filtroURL = $_GET['filtro'];
		}
		else{
			$filtroURL = 'Ordem Alfabética';
		}

		$converter_filtro = array("Ordem Alfabética"=>"nome", 
								  "Administrador Responsável"=>"id_responsavel",  
								  "Número Identificação"=>"codigo_identificacao"); 
	?>
	<form action="" method="GET" target="_self">
		<div class="form-row">
			<div class="form-group col-md-3">
				<select id="inputState" name="filtro" class="form-control">
					<?php 
						$filtros = array('Ordem Alfabética', 'Administrador Responsável', 'Número Identificação');

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
			<th>Nome</th>
			<th>(ID) Administrador Responsável</th> 
			<th>Número Identificação</th>
		</tr>
		<?php
			include_once("conexao.php");

			$filtro = $converter_filtro[$filtroURL];

			$sql = "SELECT * FROM setor ORDER BY ".$filtro;
			$setores = mysqli_query($conexao, $sql);
			
			foreach($setores as $setor){

				/*
				$sql = "SELECT nome FROM usuario WHERE id_cadastro=".$setor['id_responsavel'];
				$usuario = mysqli_fetch_array( mysqli_query($conexao, $sql) );
				$nome_responsavel = $usuario['nome'];
				*/

				echo "<tr>";
					echo '<td>' . $setor['nome'] . '</td>';
					echo '<td>' . $setor['id_responsavel'] . '</td>';
					echo '<td>' . $setor['codigo_identificacao'] . '</td>';

					if(isset($_SESSION['logado']) && $_SESSION['logado'] && $_SESSION['tipo_usuario'] == 'Funcionario' && $_SESSION['cargo'] == 'Administrador'){
						echo '<td> <a href="setor_editar.php?id='.$setor['id_setor'].'"> Editar Setor </a> </td>';
						echo '<td> <a href="setor_excluir.php?id='.$setor['id_setor'].'"> Excluir Setor </a> </td>';
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