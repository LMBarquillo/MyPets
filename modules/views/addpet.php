<?php
    include_once("engine/constants.php");

    $addPet = true;
    $errorMsg = "";
    
    if(isset($_GET['error'])) {
        switch($_GET['error']) {
            case ADDPET_ERROR_INCOMPLETE:
                $errorMsg = ERROR_EMPTY_FIELDS;
                break;
            case ADDPET_ERROR_INSERTING:
                $errorMsg = ERROR_INSERTING;
                break;
        }
    }
        
?>
			<div role="main" class="main shop">
				<div class="container">
					<hr class="tall">
			
					<div id="pet-add" class="row">
						<div class="col-md-12">
							<h2 class="short">Insertar registro</h2>
							<form id="add-pet-form" action="engine/newpet.php" method="post">
								<div class="row">
									<div class="form-group">
										<div class="col-md-3">
											<div class="thumbnail">
        										<img id="img-thumbnail" alt="" class="img-responsive img-rounded" src="img/no-picture.jpg">
        									</div>
											<div id="edit-img-btn" class="btn btn-primary edit-img">
												<i class="fa fa-pencil"></i>
											</div>
										</div>
										<div class="col-md-9">
											<div class="row">
												<div class="col-md-6">
													<label>Nombre:</label><em>*</em>
													<input type="text" value="" maxlength="100" class="form-control" name="name" id="name">							
													<label>Especie:</label><em>*</em>
													<input type="text" value="" maxlength="100" class="form-control" name="species" id="species">
													<label>Raza:</label><em>*</em>
													<input type="text" value="" maxlength="100" class="form-control" name="breed" id="breed">
													<label>Género:</label><br/>
													<input type="radio" name="genre" value="M" checked /> Macho
													<input type="radio" name="genre" value="H" /> Hembra
												</div>
												<div class="col-md-6">
													<label>Fecha de nacimiento:</label><br/>
													<input id="datepicker" type="text" name="birthdate" class="form-control" />
													<label>Descripción:</label><br/>
													<textarea id="description" name="description" class="form-control"></textarea>
													<input id="filechooser" type="file" name="file" accept="image/*"/>
													<input id="selected-img" type="hidden" name="img" value="img/no-picture.jpg" />
												</div>
												<div class="col-md-12">
													<p id="result-msg" class="msg-error pull-right"><?php echo $errorMsg; ?></p>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<button id="save-pet" type="button" class="btn btn-success right"><i class="fa fa-check"></i> Guardar</button>
										<a href="index.php"><button id="cancel-pet" type="button" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</button></a>
									</div>
								</div>
							</form>
						</div>
					</div>		
					
				</div>
			</div>