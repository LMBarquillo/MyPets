<?php
/**
 * Clase Page. Usada para pasar la información de paginación al listado.
 * @author Luismi
 * 
 */
class Page {
    private $content;
    private $pageNumber;
    private $totalPages;
    private $totalElements;
    private $first;
    private $last;
    
    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getPageNumber()
    {
        return $this->pageNumber;
    }

    /**
     * @return mixed
     */
    public function getTotalPages()
    {
        return $this->totalPages;
    }

    /**
     * @return mixed
     */
    public function getTotalElements()
    {
        return $this->totalElements;
    }

    /**
     * @return mixed
     */
    public function getFirst()
    {
        return $this->first;
    }

    /**
     * @return mixed
     */
    public function getLast()
    {
        return $this->last;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @param mixed $pageNumber
     */
    public function setPageNumber($pageNumber)
    {
        $this->pageNumber = $pageNumber;
    }

    /**
     * @param mixed $totalPages
     */
    public function setTotalPages($totalPages)
    {
        $this->totalPages = $totalPages;
    }

    /**
     * @param mixed $totalElements
     */
    public function setTotalElements($totalElements)
    {
        $this->totalElements = $totalElements;
    }

    /**
     * @param mixed $first
     */
    public function setFirst($first)
    {
        $this->first = $first;
    }

    /**
     * @param mixed $last
     */
    public function setLast($last)
    {
        $this->last = $last;
    }

    
    function __construct() {
        
    }      
    
}

?>