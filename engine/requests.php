<?php
/**
 * requests.php
 * Recibe peticiones AJAX, ejecuta la orden y devuelve resultado en asíncrono.
 * 
 * @author Luis M. Barquillo Romero 
 */

include_once("../config.php");
include_once("constants.php");
include_once("session.php");
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
        case 'login':
            login($dbPets, $_POST);
            break;
        case 'logout':
            logout();
            break;
        case 'acceptCookies':
            acceptCookies();
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

function setUnauthorized($msg) {
    header("HTTP/1.1 401 Unauthorized");
    header('Content-Type: application/json; charset=UTF-8');
    die($msg);
}

function setOKPost($msg) {
    echo $msg;
}

function editPet(PetsDB $dbPets, $post) {
    $pet = new Pet();
    $pet->setName($post[NAME]);
    $pet->setSpecies($post[SPECIES]);
    $pet->setBreed($post[BREED]);
    $pet->setGenre($post[GENRE]);
    $pet->setDescription($post[DESCRIPTION]);
    $pet->setPicture($post[PICTURE]);
    // Convertimos la fecha de dd/mm/yyyy a yyyy-mm-dd    
    $spDate = DateTime::createFromFormat('d-m-Y', $post[BIRTHDATE]);
    $mysqlDate = $spDate->format('Y-m-d');
    
    $pet->setBirthDate($mysqlDate);
    
    $result = $dbPets->updatePet($post[ID], $pet);
    
    if($result != null) {
        setOKPost(SUCCESS_EDITPET);
    } else {
        setErrorPost(ERROR_EDITPET);
    }
}

function login(PetsDB $dbPets, $post) {
    if(isset($post[USER]) && isset($post[PASS])) {
        $user = $dbPets->login($post[USER], $post[PASS]);
        
        if(session::initSession($user)) {
            setOKPost(SUCCESS_LOGIN);
        } else {
            setUnauthorized(ERROR_LOGIN);
        }        
    } else {
        setErrorPost(ERROR_BADLOGIN);
    }
}

function logout() {
    Session::destroy();
    setOKPost(SUCCESS_LOGOUT);
}

function acceptCookies() {
    $cookie_name = ALLOW_COOKIES;
    $cookie_value = "Y";
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
}

function insertPet($post) {
    echo "NO IMPLEMENTADO POR ESTE MÉTODO";
}

function deletePet($post) {
    echo "NO IMPLEMENTADO POR ESTE MÉTODO";
}
?>