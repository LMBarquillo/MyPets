<?php 
    include("config.php");

	if(isset($_GET['route'])) {
		if(file_exists('modules/views/'.$_GET['route'].'.php')) {
			include('modules/views/'.$_GET['route'].'.php');
		} else {
			include('modules/views/404.php');
		}
	} else {
		include('modules/views/mainpage.php');
	}
?>