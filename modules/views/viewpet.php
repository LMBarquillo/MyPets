			<div role="main" class="main shop">
				<div class="container">
					<hr class="tall">
<?php 
    include("engine/dbPets.php");

	if(isset($_GET['id'])) {
	    $viewPet = true;
		$db = new PetsDB($host, $database, $user, $password);
		$pet = $db->getPetByID($_GET['id']);
		$date = date_create($pet->getBirthDate());
?>		
			
<?php
		if($pet->getId() >= 0) {
?>
					<div id="pet-view" class="row" <?php if(isset($_GET['edit']) && $_GET['edit'] == 'true') echo 'style="display: none;"'?>>
						<div class="col-md-6">
							<div class="owl-carousel">
								<div>
									<div class="thumbnail">
										<img id="viewpet-image" alt="" class="img-responsive img-rounded" src="<?php echo $pet->getPicture();?>">
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="summary entry-summary">
								<h1 id="viewpet-name" class="shorter"><?php echo $pet->getName(); ?></h1>

								<p id="viewpet-species-breed" class="species">
									<?php echo $pet->getSpecies();?> <?php echo $pet->getBreed();?>
								</p>
								<p id="viewpet-birth" class="birth">
									<?php echo $pet->getGenre() == 'M' ? "Macho nacido el " : "Hembra nacida el ";?><?php echo $pet->getFormattedDate();?>
								</p>

								<p id="viewpet-description" class="description"><?php echo $pet->getDescription();?></p>
								
								<button id="edit-pet" type="button" class="btn btn-info">Modificar mascota </button>
								<a href="index.php"><button id="go-back" type="button" class="btn btn-danger right"><i class="fa fa-chevron-left"></i> Volver al listado</button></a>
							</div>
						</div>
					</div>
					
					<div id="pet-edit" class="row"  <?php if(isset($_GET['edit']) && $_GET['edit'] == 'true') echo 'style="display: block;"'?>>
						<div class="col-md-12">
							<h2 class="short">Editar registro</h2>
							<form id="edit-pet-form" action="index.php?route=viewpet&id=<?php echo $_GET['id']; ?>" method="post">
								<div class="row">
									<div class="form-group">
										<div class="col-md-3">
											<div class="thumbnail">
        										<img id="img-thumbnail" alt="" class="img-responsive img-rounded" src="<?php echo $pet->getPicture();?>">
        									</div>
											<div id="edit-img-btn" class="btn btn-primary edit-img">
												<i class="fa fa-pencil"></i>
											</div>
										</div>
										<div class="col-md-9">
											<div class="row">
												<div class="col-md-6">
													<label>Nombre:</label><em>*</em>
													<input type="text" value="<?php echo $pet->getName();?>" maxlength="100" class="form-control" name="name" id="name">							
													<label>Especie:</label><em>*</em>
													<input type="text" value="<?php echo $pet->getSpecies();?>" maxlength="100" class="form-control" name="species" id="species">
													<label>Raza:</label><em>*</em>
													<input type="text" value="<?php echo $pet->getBreed();?>" maxlength="100" class="form-control" name="breed" id="breed">
													<label>Género:</label><br/>
													<input type="radio" name="genre" value="M" checked /> Macho
													<input type="radio" name="genre" value="H" /> Hembra
												</div>
												<div class="col-md-6">
													<label>Fecha de nacimiento:</label><br/>
													<input id="datepicker" type="text" name="birthdate" class="form-control" />
													<script>
														// Definimos variables js con datos llegados de php
														var petId = <?php echo $pet->getId(); ?>;
														var birthDate = new Date("<?php echo $pet->getBirthDate(); ?>");
														var petImage = "<?php echo $pet->getPicture(); ?>";
													</script>
													<label>Descripción:</label><br/>
													<textarea id="description" name="description" class="form-control"><?php echo $pet->getDescription();?></textarea>
													<input id="filechooser" type="file" name="file" accept="image/*"/>
												</div>
												<div class="col-md-12">
													<p id="result-msg"></p>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<button id="save-edit" type="button" class="btn btn-success right"><i class="fa fa-check"></i> Guardar</button>
										<?php if(isset($_GET['edit']) && $_GET['edit'] == 'true') { ?>
										<a href="index.php"><button id="go-back" type="button" class="btn btn-danger"><i class="fa fa-chevron-left"></i> Volver al listado</button></a>
										<?php } else { ?>
										<button id="cancel-edit" type="button" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</button>
										<?php } ?>
									</div>
								</div>
							</form>
						</div>
					</div>
<?php
		} else {
?>
					<div class="row">
						<div class="col-md-12">
							<h4>No se encontró la mascota que estás buscando</h4>
						</div>
					</div>
<?php	
		}
	} else {
?>
					<div class="row">
						<div class="col-md-12">
							<h4>Error. Parámetros incorrectos.</h4>
						</div>
					</div>
<?php
	}
?>
				</div>
			</div>