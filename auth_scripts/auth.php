<?php
session_start();

if (!isset($_POST['username'], $_POST['password'])) {
	// No username or password
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

$select_sql = "SELECT id, hash, calendar FROM Users WHERE username = '" . mysqli_real_escape_string($conn, $_POST['username']) . "';";
$result = $conn->query($select_sql);

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
    $conn->close();
	if (password_verify($_POST['password'], $row['hash'])) {
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $_POST['username'];
		$_SESSION['id'] = $row['id'];
        $_SESSION['calendar'] = $row['calendar'];
        header('Location: ../');
        exit();
	} else {
		header('Location: ../auth.html');
        exit();
	}
} else {
	header('Location: ../auth.html');
    exit();
}