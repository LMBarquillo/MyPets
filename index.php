<?php
	header('Content-Type: text/html; charset=utf-8');
	require_once('config.php');
	require_once('engine/session.php');
	$session = new Session();

	require_once('modules/header.php');
	require_once('modules/content.php');
	require_once('modules/footer.php');
?>