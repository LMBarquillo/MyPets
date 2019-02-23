<?php
class Session {
	public $data = array();
			
  	public function __construct() {		
		if (!session_id()) {
			ini_set('session.use_cookies', 'On');
			ini_set('session.use_trans_sid', 'Off');
			
			session_set_cookie_params(0, '/');
			session_start();
		}
		$this->data =& $_SESSION;
	}
	
	function getId() {
		return session_id();
	}
	
	/**
	 * Inicia una sesión para un usuario especificado
	 * @param User $user -> Usuario de la sesión
	 * @return boolean -> true si la inició o false si no llegaron datos del usuario
	 */
	public static function initSession(User $user) {
	    if(!empty($user->getUser())) {
	        // Iniciamos sesión
	        session_start();
	        $_SESSION[USER] = $user->getUser();
	        $_SESSION[TOKEN] = $user->getPass();
	        $_SESSION[ROLE] = $user->getRole();
	        
	        return true;
	    } else {
	        return false;
	    }	    
	}

	/**
	 * Destruye la sesión
	 */
	public static function destroy() {
	    session_start();
		// Destruir todas las variables de sesión.
		$_SESSION = array();

		// Si se desea destruir la sesión completamente, borraremos también la cookie de sesión.
		// Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}

		// Finalmente, destruir la sesión.
		session_destroy();
	}
}
?>
