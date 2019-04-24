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
	<a href="usuario_cadastro.php"> Cadastrar Usuário </a> </br>
	<a href="usuario_visualizar_completo.php"> Ver dados completos </a>
	<p> </p>

	<?php
		include_once("conexao.php");	/* Estabelece a conexão */

		$sql = "SELECT * FROM usuario ORDER BY nome";
		$usuarios = mysqli_query($conexao, $sql);

		echo "<table border='1' cellpadding='10'>";

		echo "	<tr> 
					<th>Nome</th> 
					<th>E-Mail</th>
					<th>Tipo Usuário</th> 
				</tr>";

		while($usuario = mysqli_fetch_array( $usuarios )) {

			$sql = "SELECT * FROM endereco WHERE id=" . $usuario['id'];

			$endereco = mysqli_fetch_array( mysqli_query($conexao, $sql) );

			echo "<tr>";
				echo '<td>' . $usuario['nome'] . '</td>';
				echo '<td>' . $usuario['email'] . '</td>';
				echo '<td>' . $usuario['tipo_usuario'] . '</td>';
			echo "</tr>";
		}

		echo "</table>";
	?>
	
</body>

</html>