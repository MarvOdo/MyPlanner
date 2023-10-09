<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
	// Not logged in, can't save
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

$conn->set_charset("utf8_unicode_520_ci");

foreach($_POST as $id => $content) {
    //select row with certain id / day
    $select_sql = "SELECT id FROM" . $_SESSION['calendar'] . "WHERE id=" . $id . ";";
    $result = $conn->query($select_sql);

    //insert if non-existant or rewrite if already exists
    if ($result->num_rows == 0) {
        $insert_sql = "INSERT INTO Boxes (id, content) VALUES (" . $id . ", '" . mysqli_real_escape_string($conn, $content) . "');";
        $conn->query($insert_sql);
    } else
    {
        $update_sql = "UPDATE Boxes SET content='" . mysqli_real_escape_string($conn, $content) . "' WHERE id=" . $id . ";";
        $conn->query($update_sql);
    }
}

$conn->close();

header("Location: ../");
exit();
?>