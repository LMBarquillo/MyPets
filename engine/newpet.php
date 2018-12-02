<?php
include_once("../config.php");
include_once("constants.php");
include_once("dbPets.php");

if (!empty($_POST['name']) && !empty($_POST['species']) && !empty($_POST['breed']) && !empty($_POST['genre']) && !empty($_POST['birthdate']) && !empty($_POST['description']) && !empty($_POST['img'])) {
    $dbPets = new PetsDB($host, $database, $user, $password);
    
    $pet = new Pet();
    $pet->setName($_POST['name']);
    $pet->setSpecies($_POST['species']);
    $pet->setBreed($_POST['breed']);
    $pet->setGenre($_POST['genre']);
    $pet->setDescription($_POST['description']);
    $pet->setPicture($_POST['img']);
    
    $spDate = DateTime::createFromFormat('d-m-Y', $_POST['birthdate']);
    $mysqlDate = $spDate->format('Y-m-d');    
    $pet->setBirthDate($mysqlDate);
    
    $result = $dbPets->insertPet($pet);
   
    if($result != null) {
        header("Location: ../index.php");
        die();
    } else {
        header("Location: ../index.php?route=addpet&error=".ADDPET_ERROR_INSERTING);
        die();
    }    
    
} else {
    // Si tenemos algún campo vacío, regresamos mostrando un error, aunque se supone que este caso ya lo habrá filtrado el Javascript.
    header("Location: ../index.php?route=addpet&error=".ADDPET_ERROR_INCOMPLETE);
    die();
}
?>