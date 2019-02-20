<?php

class User {
    private $user;
    private $pass;
    private $role;

    function __construct() {
	    
    }  
    
    function setUser($user) {
        $this->user = $user;
    }

    function getUser() {
        return $this->user;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    function getPass() {
        return $this->pass;
    }

    function setRole($role) {
        $this->role = $role;
    }

    function getRole() {
        return $this->role;
    }

}