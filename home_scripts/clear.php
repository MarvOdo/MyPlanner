<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
	// Not logged in, can't clear
    header('Location: ../auth.html');
	exit();
}

$servername = "SERVERNAME"; //servername for database
$username = "USERNAME"; //username for database
$password = "PASSWORD"; //password for database
$dbname = "DATABASENAME"; //database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection with Database failed: " . $conn->connect_error);
}

$clear_sql = "DELETE FROM " . $_SESSION['calendar'];
$conn->query($clear_sql);

$conn->close();

header("Location: ../");
exit();
?>