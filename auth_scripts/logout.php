<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
	// Not logged in, can't logout
    header('Location: ../auth.html');
	exit();
}

$_SESSION = array();
session_destroy();

header('Location: ../auth.html');
exit();
?>