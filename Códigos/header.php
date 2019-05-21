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

		session_start();
	?>

	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item <?php esta_ativa('index.php');?>">
			<a class="nav-link" href="index.php">Home</a>
			</li>

			<?php
				if(isset($_SESSION['logado']) && $_SESSION['logado'] && 
					($_SESSION['tipo_usuario'] == 'Cliente' || $_SESSION['tipo_usuario'] == 'Funcionario')){
					?>

					<li class="nav-item <?php esta_ativa('produto_visualizar.php');?>">
					<a class="nav-link" href="produto_visualizar.php">Lista de Produtos</a>
					</li>

					<?php

					if($_SESSION['tipo_usuario'] == 'Funcionario' && $_SESSION['cargo'] == 'Administrador'){
						?>

						<li class="nav-item <?php esta_ativa('usuario_visualizar.php');?>">
						<a class="nav-link" href="usuario_visualizar.php">Usuários</a>
						</li>

						<li class="nav-item <?php esta_ativa('#');?>">
						<a class="nav-link" href="#">Setores</a>
						</li>

						<li class="nav-item <?php esta_ativa('#');?>">
						<a class="nav-link" href="#">Vendas</a>
						</li>

						<?php
					}
				}
			?>

			<li class="nav-item">
			<?php
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