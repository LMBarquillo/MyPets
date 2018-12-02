<?php
/**
 * requests.php
 * Recibe peticiones AJAX, ejecuta la orden y devuelve resultado en asíncrono.
 * 
 * @author Luis M. Barquillo Romero 
 */

include_once("../config.php");
include_once("constants.php");
include_once("dbPets.php");

if(isset($_POST['action'])) {
    $dbPets = new PetsDB($host, $database, $user, $password);
    
    switch($_POST['action']) {
        case 'insertPet':
            insertPet($_POST);
            break;            
        case 'editPet':
            editPet($dbPets, $_POST);
            break;
        case 'deletePet':
            deletePet($_POST);
            break;
        default:
            setErrorPost(ERROR_BADACTION);
    }
} else {
    setErrorPost(ERROR_NOPOST);
}

function setErrorPost($msg) {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json; charset=UTF-8');
    die($msg);
}

function setOKPost($msg) {
    echo $msg;
}

function editPet(PetsDB $dbPets, $post) {
    $pet = new Pet();
    $pet->setName($post['name']);
    $pet->setSpecies($post['species']);
    $pet->setBreed($post['breed']);
    $pet->setGenre($post['genre']);
    $pet->setDescription($post['description']);
    $pet->setPicture($post['picture']);
    // Convertimos la fecha de dd/mm/yyyy a yyyy-mm-dd    
    $spDate = DateTime::createFromFormat('d-m-Y', $post['birthdate']);
    $mysqlDate = $spDate->format('Y-m-d');
    
    $pet->setBirthDate($mysqlDate);
    
    $result = $dbPets->updatePet($post['id'], $pet);
    
    if($result != null) {
        setOKPost(SUCCESS_EDITPET);
    } else {
        setErrorPost(ERROR_EDITPET);
    }
}

function insertPet($post) {
    echo "NO IMPLEMENTADO POR ESTE MÉTODO";
}

function deletePet($post) {
    echo "NO IMPLEMENTADO POR ESTE MÉTODO";
}
?>