<?php
	session_start();
	session_unset();
	session_destroy();
	header("Location: login.php?msg=You are sucessfully logged out");

?>