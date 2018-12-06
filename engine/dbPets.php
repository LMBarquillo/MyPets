<?php 
require_once('helpers.php');
require_once('constants.php');
require_once('connection.php');
require_once('models/pet.model.php');
require_once('models/page.model.php');

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
    
    /**
     * Obtiene un objeto de página con sus correspndientes resultados
     * @param number: El número de página deseado, siendo 0 la primera.
     * @return Page: El objeto con los resultados e información de la página 
     */
    function getPetList($page = 1) {
        $count = 0;
        $paramPage = ($page-1) * RESULTS_PER_PAGE;
        $list = Array();
        
        // Para crear una página de resultados necesito el número de registros
        $queryCount = "SELECT COUNT(*) AS num FROM ".DB_TABLE_NAME;
        // Y los resultados, evidentemente
        $query = "SELECT * FROM ".DB_TABLE_NAME." LIMIT ?,".RESULTS_PER_PAGE;
        
        $this->mysqli->begin_transaction();

        // Lanzo las 2 consultas dentro de una transacción, de ese modo, nos aseguramos que 
        // el número de registros se corresponde con los que obtendré en la consulta posterior
        if($stmt = $this->mysqli->prepare($queryCount)) {
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($count);
            $data = $stmt->fetch();
            $stmt->close();
        } else {
            $count = -1;
        }
        
        if($stmt = $this->mysqli->prepare($query)) {
            $stmt->bind_param("s", $paramPage);
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
        
        // Calculo el total de páginas
        $totalPages = ceil($count / RESULTS_PER_PAGE);

        // El objeto Page contiene, tanto los resultados, como la información de la paginación
        $elements = new Page();
        $elements->setContent($list);
        $elements->setTotalElements($count);
        $elements->setPageNumber($page);
        $elements->setTotalPages($totalPages);
        $elements->setFirst($page == 1 ? true : false);
        $elements->setLast($page == $totalPages ? true : false);
        
        // Y disparamos el commit
        $this->mysqli->commit();
        
        return $elements;   // Devolvemos toda la información junta.
    }
    
    /**
     * Obtiene un registro específico a partir de su id
     * @param El id del registro a obtener
     * @return Pet : objeto con el resultado
     */
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
    
    /**
     * Inserta un registro a partir de un objeto
     * @param Pet Objeto a insertar
     * @return null o el número de filas afectadas
     */
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
        return null;
    }
    
    /**
     * Actualiza un registro a partir de su objeto y su id
     * @param int id a actualizar
     * @param Pet Ojbeto a actualizar
     * @return null o el número de filas afectadas
     */
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
    
    /**
     * Elimina un registro a partir de su id
     * @param int id a eliminar
     * @return null o el número de filas afectadas
     */
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