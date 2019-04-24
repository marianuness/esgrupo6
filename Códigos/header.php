<!--Menu-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	<!--Links do Menu-->

	<?php
		function esta_ativa($pagina){
			$array_url =  explode('/', $_SERVER['REQUEST_URI']) ;
			$pagina_atual = end($array_url);

			if($pagina_atual == $pagina){
				echo 'active';
			} 
		}
	?>

	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item <?php esta_ativa('index.php');?>">
			<a class="nav-link" href="index.php">Home</a> <!--  <span class="sr-only">(current)</span> -->
			</li>

			<li class="nav-item <?php esta_ativa('produto.php');?>">
			<a class="nav-link" href="produto.php"> Produtos </a>
			</li>

			<li class="nav-item <?php esta_ativa('usuario_visualizar.php');?>">
			<a class="nav-link" href="usuario_visualizar.php"> Usuários </a>
			</li>

			<li class="nav-item">
			<?php
				session_start();
				echo "<li class='nav-item' style='float: right;'>";
				if (isset($_SESSION['logado']) && $_SESSION['logado']){
					echo "<a class='nav-link' href='logout.php'> Logout </a>";
				}
				else{
					echo "<a class='nav-link' href='login.php'> Login </a>";
				}
			?>
			</li>
		</ul>
	</div>
	<!--Links do Menu-->
</nav>
<!--Menu-->