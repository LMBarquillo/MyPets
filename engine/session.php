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

	static function destroy() {
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
