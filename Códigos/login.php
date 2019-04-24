<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
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


<?php
	include_once("conexao.php");

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$email = mysqli_real_escape_string($conexao,$_POST['email']);
		$senha = mysqli_real_escape_string($conexao,$_POST['senha']); 

		$sql = "SELECT tipo_usuario FROM usuario WHERE email='$email' and senha='$senha'";
		$resultado = mysqli_query($conexao, $sql);
		$usuario = mysqli_fetch_array($resultado);

		$numero_usuarios = mysqli_num_rows($resultado);

		if($numero_usuarios == 1) {
			$_SESSION['logado'] = true;
			$_SESSION['nome'] = $usuario;
			$_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];

			header("location: index.php");
		}
		else {
			$error = "Usuário ou Senha Inválido!";
		}
	}
?>

<body>
	  <div align = "center">
		 <div style="border: solid 1px #333333; width:300px;" align="left">
			<div style="padding:5px; background-color:#B22D30; color:#FFFFFF;"><b>Login</b></div>
			<div style="margin:30px 0 30px 30px;">
			   <form action = "" method = "post">
				  <label>E-Mail:</label> <input type="text"     name="email" class="box"/>  <br/><br/>
				  <label>Senha:</label>  <input type="password" name="senha" class="box" /> <br/><br/>
				  <input type = "submit" value = " Submit "/><br />
			   </form>
			</div>
				
			<?php 
				if(isset($error)){
					echo "<div class='alert alert-warning'>".$error."</div>";
				}
			?>
		 </div>
			
	  </div>

</body>

</html>