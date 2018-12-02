<?php 
require_once('helpers.php');
require_once('constants.php');
require_once('connection.php');
require_once('models/pet.model.php');

/**
 * Clase PetsDB. Métodos de acceso a la BD para objetos Pet.
 * @author Luismi
 *
 */
class PetsDB extends Connection {
    private $mysqli;
    
    function __Construct($host,$database,$user,$pass) {
        $connection = new Connection($host, $database, $user, $pass);
        $this->mysqli = $connection->getConnection();
    }
    
    function getPetList() {
        $list = Array();
        $query = "SELECT * FROM ".DB_TABLE_NAME;    // TODO: CAMBIAR * POR LOS DATOS QUE QUERAMOS 
        
        if($stmt = $this->mysqli->prepare($query)) {
            $stmt->execute();
            $stmt->store_result();
            $data = Helpers::fetcharray($stmt);            
            $stmt->free_result();
            $stmt->close();
            foreach($data as $row) {
                $m = new Pet();
                $m->setId($row[ID]);
                $m->setName($row[NAME]);
                $m->setSpecies($row[SPECIES]);
                $m->setBreed($row[BREED]);
                $m->setGenre($row[GENRE]);
                $m->setDescription($row[DESCRIPTION]);
                $m->setBirthDate($row[BIRTH_DATE]);
                $m->setPicture($row[PICTURE]);
                
                $list[] = $m; 
            }            
        }
        
        return $list;
    }
    
    function getPetById($id) {
        $pet = new Pet();
        
        $query = "SELECT * FROM ".DB_TABLE_NAME." WHERE id=?";
        if($stmt = $this->mysqli->prepare($query)) {
            $stmt->bind_param("d", $id);     
            $stmt->execute();
            $stmt->store_result();
            $data = Helpers::fetcharray($stmt);
            $stmt->free_result();
            $stmt->close();
     
			if(count($data) > 0) {
				$pet->setId($id);
				$pet->setName($data[0][NAME]);
				$pet->setSpecies($data[0][SPECIES]);
				$pet->setBreed($data[0][BREED]);
				$pet->setGenre($data[0][GENRE]);
				$pet->setDescription($data[0][DESCRIPTION]);
				$pet->setBirthDate($data[0][BIRTH_DATE]);
				$pet->setPicture($data[0][PICTURE]);
			} else {
				// Si no encuentra la mascota, devuelve -1 en la id.
				$pet->setId(-1);
			}
        }
        
        return $pet;
    }
    
    function insertPet(Pet $pet) {
        $query = "INSERT INTO ".DB_TABLE_NAME." (".NAME.","
            .SPECIES.","
            .BREED.","
            .GENRE.","
            .DESCRIPTION.","
            .BIRTH_DATE.","
            .PICTURE.") VALUES (?,?,?,?,?,?,?)";
        
        $name = $pet->getName();
        $species = $pet->getSpecies();
        $breed = $pet->getBreed();
        $genre = $pet->getGenre();
        $description = $pet->getDescription();
        $birthDate = $pet->getBirthDate();
        $picture = $pet->getPicture(); 
        
        if($stmt = $this->mysqli->prepare($query)) {
            $stmt->bind_param("sssssss", $name, $species, $breed, $genre, $description, $birthDate, $picture);
            $stmt->execute();
            $affected = $stmt->affected_rows;
            $stmt->close();
            
            return $affected;           
        }
        return $query;
    }
    
    function updatePet($id, Pet $pet) {
        $query = "UPDATE ".DB_TABLE_NAME." SET ".NAME."=?,"
            .SPECIES."=?,"
            .BREED."=?,"
            .GENRE."=?,"
            .DESCRIPTION."=?,"
            .BIRTH_DATE."=?,"
            .PICTURE."=? WHERE ".ID."=?";
        
        $name = $pet->getName();
        $species = $pet->getSpecies();
        $breed = $pet->getBreed();
        $genre = $pet->getGenre();
        $description = $pet->getDescription();
        $birthDate = $pet->getBirthDate();
        $picture = $pet->getPicture();            
            
        if($stmt = $this->mysqli->prepare($query)) {
            $stmt->bind_param("sssssssd", $name, $species, $breed, $genre, $description, $birthDate, $picture, $id);
            $stmt->execute();
            $affected = $stmt->affected_rows;
            $stmt->close();
            
            return $affected;
        }
        
        return null;
    }
    
    function deletePet($id) {
        $query = "DELETE FROM ".DB_TABLE_NAME." WHERE ".ID."=?";
        
        if($stmt = $this->mysqli->prepare($query)) {
            $stmt->bind_param("d",$id);
            $stmt->execute();
            $affected = $stmt->affected_rows;
            $stmt->close();
            
            return $affected;
        }
        
        return null;
    }
}

?>