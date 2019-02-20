<!DOCTYPE html>
<html>
	<head>
		<!-- 
			Este proyecto ha sido desarrollado usando la plantilla HTML Porto 3.7, by OklerThemes
			Página oficial de la plantilla: https://preview.oklerthemes.com/porto/7.0.0/index.html
		-->
		<meta charset="utf-8">
		<title>MyPets - Adopta una mascota</title>		
		<meta name="keywords" content="MyPets - Proyecto DAW 2" />
		<meta name="description" content="Proyecto CRUD para la asignatura de Desarrollo Web en Entorno Servidor.">
		<meta name="author" content="Luis Miguel Barquillo Romero">
		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">
		<!-- Vendor CSS -->
		<link rel="stylesheet" href="js/bootstrap/bootstrap.css">
		<link rel="stylesheet" href="css/fontawesome/css/font-awesome.css">
		<link rel="stylesheet" href="css/jquery-ui.min.css">
		<!-- Theme CSS -->
		<link rel="stylesheet" href="css/theme.css">
		<link rel="stylesheet" href="css/theme-elements.css">
		<link rel="stylesheet" href="css/theme-blog.css">
		<link rel="stylesheet" href="css/theme-shop.css">
		<link rel="stylesheet" href="css/theme-animate.css">
		<!-- Skin CSS -->
		<link rel="stylesheet" href="css/skins/default.css">
		<link rel="stylesheet" href="css/custom.css">
	</head>
	<body>
		<div class="body">
			<header id="header">
				<div class="container">
					<div class="logo">
						<a href="index.php">
							<img alt="Logo" width="238" height="90" src="img/logo.png">
						</a>
					</div>
					
					<div class="user-info">
						<div class="input-group">
							<span class="input-group-btn">
							<?php
								if(isset($_SESSION['user']) && isset($_SESSION['pass'])) {
							?>
								<button class="btn btn-danger" type="button"><i class="fa fa-close"></i>&nbsp;Desconectarse</button>
								<span>Bienvenido, <?php echo $_SESSION['user']; ?></span>
							<?php 
								} else { 
							?>
								<a href="index.php?route=login" class="btn btn-primary" type="button"><i class="fa fa-user"></i>&nbsp;Login</a>
							<?php 
								} 
							?>
							</span>
						</div>
					</div>

					<button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse">
						<i class="fa fa-bars"></i>
					</button>
				</div>
				<div class="navbar-collapse nav-main-collapse collapse">
					<div class="container">
						<nav class="nav-main mega-menu">
							<ul class="nav nav-pills nav-main" id="mainMenu">
								<li class="dropdown">
									<a class="dropdown-toggle" href="index.php">
										Inicio
									</a>
								</li>
								<li class="dropdown">
									<a class="dropdown-toggle" href="#">
										Contacto
									</a>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			</header>