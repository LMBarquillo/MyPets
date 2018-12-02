<?php 
    include("engine/dbPets.php");    
    $db = new PetsDB($host, $database, $user, $password);
    $list = $db->getPetList();
?>

			<div role="main" class="main shop">
				<div class="container">
					<hr class="tall">
					<div class="row">
						<div class="col-md-6">
							<h1 class="shorter"><strong>Listado</strong></h1>
							<p>Mostrando 1-12 de 25 resultados.</p>
						</div>
					</div>

					<div id="toolbar" class="row">
						<div class="col-md-12">
							<a href="index.php?route=addpet"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Añadir nueva mascota</button></a>
						</div>
					</div>

					<div id="pet-info" class="row">
						<ul class="products product-thumb-info-list" data-plugin-masonry>
							<?php 
							foreach($list as $pet) { 
							?>
							<li class="col-md-3 col-sm-6 col-xs-12 product">
								<!--<a href="shop-product-sidebar.html">
									<span class="onsale">Sale!</span>
								</a>-->
								<span class="product-thumb-info">
									<a href="index.php?route=viewpet&id=<?php echo $pet->getId(); ?>">
										<span class="product-thumb-info-image">
											<span class="product-thumb-info-act">
												<span class="product-thumb-info-act-left"><em>Ver</em></span>
												<span class="product-thumb-info-act-right"><em><i class="fa fa-plus"></i> Detalles</em></span>
											</span>
											<img alt="" class="img-responsive" src="<?php echo $pet->getPicture(); ?>">
										</span>
									</a>
									<span class="product-thumb-info-content">
										<a href="shop-product-sidebar.html">
											<h4><?php echo $pet->getName(); ?></h4>
											<span class="price">
												<ins><span class="amount"><?php echo $pet->getSpecies(); ?></span> <?php echo $pet->getBreed(); ?></ins>
											</span>
										</a>
									</span>
								</span>
							</li>
							<?php }	?>
						</ul>
					</div>

					<div class="row">
						<div class="col-md-12">
							<ul class="pagination pull-right">
								<li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
								<li class="active"><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			