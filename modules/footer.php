			<footer id="footer">
				<div class="container">
					<div class="row">
						<div class="footer-ribbon">
							<span>Sigue con nosotros!</span>
						</div>
						<div class="col-md-3">
							<div class="newsletter">
								<h4>Newsletter</h4>
								<p>¿Buscas una mascota especial? Recibe nuestra newsletter con las últimas incorporaciones.</p>
								<form id="newsletterForm" action="#" method="POST">
									<div class="input-group">
										<input class="form-control" placeholder="Email" name="newsletterEmail" id="newsletterEmail" type="text">
										<span class="input-group-btn">
											<button class="btn btn-default" type="submit">Enviar</button>
										</span>
									</div>
								</form>
							</div>
						</div>
						<div class="col-md-3"><!-- Vacía --></div>
						<div class="col-md-4">
							<div class="contact-details">
								<h4>Contacto</h4>
								<ul class="contact">
									<li><p><i class="fa fa-map-marker"></i> <strong>Dirección:</strong> Av. Real Fábrica de Sedas, s/n, 45600 Talavera de la Reina, Toledo</p></li>
									<li><p><i class="fa fa-phone"></i> <strong>Teléfono:</strong> 925 722 233</p></li>
									<li><p><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:45005471.ies@edu.jccm.es">45005471.ies@edu.jccm.es</a></p></li>
								</ul>
							</div>
						</div>
						<div class="col-md-2">
							<h4>Síguenos</h4>
							<div class="social-icons">
								<ul class="social-icons">
									<li class="facebook"><a href="#" target="_blank" data-placement="bottom" data-tooltip title="Facebook">Facebook</a></li>
									<li class="twitter"><a href="#" target="_blank" data-placement="bottom" data-tooltip title="Twitter">Twitter</a></li>
									<li class="linkedin"><a href="#" target="_blank" data-placement="bottom" data-tooltip title="Linkedin">Linkedin</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="footer-copyright">
					<div class="container">
						<div class="row">
							<div class="col-md-2">
								<a href="index.php" class="logo">
									<img alt="Logo" class="img-responsive" src="img/logo-footer.png">
								</a>
							</div>
							<div class="col-md-10">
								<p>© Copyleft <?php echo date("Y"); ?>, Luis M. Barquillo Romero - DAW2. Puedes hacer lo que quieras con el código.</p>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>

		<!-- Vendor -->
		<script src="js/jquery.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/bootstrap/bootstrap.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="js/theme.js"></script>		
		
		<!-- Theme Initialization Files -->
		<script src="js/theme.init.js"></script>
				
		<!-- Javascript general del web -->
		<script src="js/script.js"></script>	
		
		<!-- Javascript propios de cada sección -->
		<?php
		if(isset($mainPage)) {
		    echo "<script src='js/mainpage.js'></script>";
		}
		if(isset($viewPet)) {
		    echo "<script src='js/viewpet.js'></script>";
		}
		if(isset($addPet)) {
		    echo "<script src='js/addpet.js'></script>";
		}
		if(isset($loginPage)) {
			echo "<script src='js/login.js'></script>";
		}
		?>
	</body>
</html>
