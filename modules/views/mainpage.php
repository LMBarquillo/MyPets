<?php 
    include("engine/dbPets.php");
    
    $mainPage = true;
    $db = new PetsDB($host, $database, $user, $password);
    
    if(isset($_POST['action']) && isset($_POST['id'])) {
        if($_POST['action'] == ACTION_DELETE) {
            echo $db->deletePet($_POST['id']);
        }        
    }
    
    if(isset($_GET['page']) && is_numeric($_GET['page'])) {
        $elements = $db->getPetList($_GET['page']);
    } else {
        $elements = $db->getPetList(1);
    }    
?>
			<div role="main" class="main shop">
				<div class="container">
					<hr class="tall">
					<div class="row">
						<div class="col-md-6">
							<h1 class="shorter"><strong>Listado</strong></h1>
							<p>Mostrando <?php echo $elements->getFirstElement(); ?> al <?php echo $elements->getLastElement(); ?> de <?php echo $elements->getTotalElements(); ?> resultados.</p>
						</div>
					</div>

					<div id="toolbar" class="row">
						<div class="col-md-12">
							<?php
							if(isset($_SESSION[ROLE]) && $_SESSION[ROLE] == ADMIN_ROLE) {
							?>
							<a href="index.php?route=addpet">
								<button class="btn btn-primary pull-right">
									<i class="fa fa-plus"></i> Añadir nueva mascota
								</button>
							</a>
							<?php
							}
							?>
						</div>
					</div>

					<div id="pet-info" class="row">
						<ul class="products product-thumb-info-list" data-plugin-masonry>
							<?php 
							// Obtenemos el contenido del objeto recibido, que es la lista de resultados.
							foreach($elements->getContent() as $pet) { 
							?>
							<li class="col-md-3 col-sm-6 col-xs-12 product">
								<div class="product-thumb-info">
									<a href="index.php?route=viewpet&id=<?php echo $pet->getId(); ?>">
										<div class="product-thumb-info-image">
											<div class="product-thumb-info-act">
												<span class="product-thumb-info-act-left"><em>Ver</em></span>
												<span class="product-thumb-info-act-right"><em><i class="fa fa-plus"></i> Detalles</em></span>
											</div>
											<img alt="" class="img-responsive" src="<?php echo $pet->getPicture(); ?>">
										</div>
									</a>
									<div class="product-thumb-info-content">
										<a href="index.php?route=viewpet&id=<?php echo $pet->getId(); ?>">
											<h4><?php echo $pet->getName(); ?></h4>
											<span class="price">
												<ins><span class="amount"><?php echo $pet->getSpecies(); ?></span> <?php echo $pet->getBreed(); ?></ins>
											</span>
										</a>
										<div class="actions">
										<?php
							                 if(isset($_SESSION[ROLE]) && $_SESSION[ROLE] == ADMIN_ROLE) {
							             ?>
											<button class="btn btn-danger right" data-toggle="modal" data-target="#confirmDelete" data-delete="<?php echo $pet->getId(); ?>"><i class="fa fa-times"></i></button>
											<button class="btn btn-primary right" onclick="window.location.replace('index.php?route=viewpet&id=<?php echo $pet->getId(); ?>&edit=true');"><i class="fa fa-pencil"></i></button>
										<?php 
							                 }
							            ?>
											<button class="btn btn-success right" onclick="window.location.replace('index.php?route=viewpet&id=<?php echo $pet->getId(); ?>');"><i class="fa fa-eye"></i></button>
										</div>
									</div>
								</div>
							</li>
							<?php }	?>
						</ul>
					</div>
					
					<div class="row">
						<div class="col-md-4">
							<a href="index.php?page=<?php echo $elements->getPageNumber()-1; ?>">
    							<button type="button" class="btn btn-primary right" <?php if($elements->getFirst()) echo "disabled"; ?>>
    								<i class="fa fa-angle-left"></i>
    							</button>
    						</a>
							<a href="index.php?page=1">
								<button type="button" class="btn btn-primary right" <?php if($elements->getFirst()) echo "disabled"; ?>>
									<i class="fa fa-angle-double-left"></i>
								</button>
							</a>
						</div>
						<div class="col-md-4 ">
							<p class="page-info">Página <?php echo $elements->getPageNumber()." de ".$elements->getTotalPages(); ?></p>
						</div>
						<div class="col-md-4">
							<a href="index.php?page=<?php echo $elements->getPageNumber()+1; ?>">
    							<button type="button" class="btn btn-primary" <?php if($elements->getLast()) echo "disabled"; ?>>
    								<i class="fa fa-angle-right"></i>
    							</button>
							</a>
							<a href="index.php?page=<?php echo $elements->getTotalPages(); ?>">
    							<button type="button" class="btn btn-primary" <?php if($elements->getLast()) echo "disabled"; ?>>
    								<i class="fa fa-angle-double-right"></i>
    							</button>
							</a>
						</div>
					</div>
					
					
					<!-- Modal -->
                    <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Atención!</h5>
                          </div>
                          <div class="modal-body">
                            ¿Está seguro de querer borrar el registro?
                          </div>
                          <div class="modal-footer">
                          	<form action="index.php" method="post">
                          		<input name="action" type="hidden" value="<?php echo ACTION_DELETE; ?>" />
                          		<input id="id-to-delete" name="id" type="hidden" value="" />
                          		<button type="button" class="btn btn-secondary" data-dismiss="modal">Mmmm... no</button>
                            	<button type="submit" class="btn btn-primary">Sí, destruyelo!</button>
                          	</form>                            
                          </div>
                        </div>
                      </div>
                    </div>
				</div>
			</div>			