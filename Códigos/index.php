<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible">
	<title>Lojão do Zé</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="publico/css/bootstrap.min.css" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="publico/css/estilo.css">

</head>
<?php
	include "header.php";
?>

<body>

	<hr>
	<h1>Aqui está o corpo do Site!</h1>
	<hr>
	<!-- Carrossel -->
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="imagem" src="publico/imagens/logo.png" alt="Primeiro slide">
			</div>
			
			<div class="carousel-item">
				<img class="imagem" src="publico/imagens/produto.jpg" alt="Segundo slide">
			</div>

			<div class="carousel-item">
				<img class="imagem" src="publico/imagens/produto2.png" alt="Terceiro slide">
			</div>

			<div class="carousel-item">
				<img class="imagem" src="publico/imagens/produto3.jpg" alt="Quarto slide">
			</div>
			
			<div class="carousel-item">
				<img class="imagem" src="publico/imagens/produto4.jpg" alt="Quinto slide">
			</div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<!-- Fim do Carrossel -->
	<hr>
	<!-- Texto descritivo do Lojão do Zé -->
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nec ligula quis lorem scelerisque cursus ac non
		metus. Sed eleifend elementum justo at pretium. Proin et mauris ut neque tincidunt vestibulum. Nunc scelerisque,
		odio faucibus ullamcorper hendrerit, orci neque ullamcorper leo, ac mattis purus lectus et elit. Integer finibus
		faucibus arcu, eget sodales purus dignissim a. Proin semper rhoncus neque, sed auctor augue sagittis et. Aenean
		risus sem, commodo eu ultricies in, vestibulum sit amet nisi.</p>

	<p>Etiam nunc nulla, molestie vitae velit ac, bibendum eleifend libero. Proin ut rhoncus nisl, elementum auctor
		elit. Quisque sit amet lobortis felis. Donec lobortis massa ipsum, et congue erat congue ut. Proin sollicitudin
		lacus eget nibh maximus, eu dignissim arcu luctus. Phasellus tristique dapibus volutpat. Etiam scelerisque,
		lacus aliquet posuere maximus, eros velit sagittis metus, eget cursus lacus mauris eu odio. Aenean eu volutpat
		mauris, sollicitudin feugiat eros. Sed non lacus ex. Nulla accumsan porttitor turpis, elementum congue odio
		condimentum eu. Donec eget libero et ex dignissim pulvinar ut sed ipsum. Nulla et tincidunt enim. Nunc dictum
		magna non orci sollicitudin elementum.</p>

	<p>Quisque vitae augue mi. Suspendisse semper aliquam gravida. Suspendisse sodales libero lacus. Nam sed augue quam.
		Sed maximus metus vel tempor ultrices. Duis laoreet mi et neque ultricies, at vestibulum quam finibus. Aliquam
		tempor nisl enim, eu vehicula eros placerat eget. Maecenas iaculis, lorem eget malesuada pellentesque, justo
		nisl aliquet mi, ut sollicitudin metus nisl non lectus. Nullam ac eros et mauris commodo egestas vitae eu massa.
		Curabitur lorem nisl, aliquam sit amet tristique nec, lacinia at sapien. Suspendisse libero justo, facilisis at
		dapibus ut, iaculis quis nunc. Aliquam a elit vel eros tincidunt consequat. Etiam vel sapien sem.</p>

	<p>Suspendisse vestibulum, massa ac pretium iaculis, metus dolor vulputate purus, ut condimentum turpis turpis non
		diam. Ut euismod commodo neque, eu sollicitudin libero tincidunt vitae. Aliquam at eleifend elit. Sed molestie
		hendrerit purus at faucibus. Morbi non elementum est. Vestibulum vel aliquet risus. Etiam auctor dolor urna, id
		cursus metus fermentum quis. Nulla nec ex enim. Praesent imperdiet urna arcu, sit amet congue nisi mattis id.
	</p>
	<!-- Fim do Texto descritivo do Lojão do Zé -->
</body>

<hr>


<?php
	include "footer.php";
?>

</html>