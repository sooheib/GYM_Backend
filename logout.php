<?php
	session_start();
	$session = array();
	$_SESSION = array();
	session_destroy();
	header("Location: index.php");
?>