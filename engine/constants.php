<?php

/**
 * Constantes de uso general.
 */
const RESULTS_PER_PAGE = 4;
const ALLOW_COOKIES = "allowCookies";
const ACTION_DELETE = "delete";

// Tabla mascotas
const DB_TABLE_PETS = "mascotas";
const ID = "id";
const NAME = "nombre";
const SPECIES = "especie";
const BREED = "raza";
const GENRE = "genero";
const DESCRIPTION = "descripcion";
const BIRTH_DATE = "fnacimiento";
const PICTURE = "foto";

// Tabla usuarios
const DB_TABLE_USERS = "usuarios";
const USER = "user";
const PASS = "pass";
const TOKEN = "token";
const ROLE = "role";

const ADMIN_ROLE = "ADMIN";
const USER_ROLE = "USER";

const SUCCESS_EDITPET = "Éxito. Se modificó correctamente el registro.";
const SUCCESS_LOGIN = "Identificación correcta";
const SUCCESS_LOGOUT = "Desconexión correcta";

const ERROR_NOPOST = "Error. No se recibieron los datos correctos.";
const ERROR_BADACTION = "Error. Los datos recibidos son incorrectos.";
const ERROR_EDITPET = "Error. No se pudo modificar los datos del registro.";
const ERROR_EMPTY_FIELDS = "Error. No se rellenaron todos los campos obligatorios.";
const ERROR_INSERTING = "Error. No se pudo insertar el registro. Inténtelo de nuevo.";
const ERROR_BADLOGIN = "Error. Faltan datos necesarios para identificarse.";
const ERROR_LOGIN = "Usuario o contraseña incorrectos";

const INDEX_ERROR_ADD_NOPOST = 100;
const ADDPET_ERROR_INCOMPLETE = 101;
const ADDPET_ERROR_INSERTING = 102;

?>