<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: auth.html');
	exit();
}


$content = array();

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

$sql = "SELECT * FROM " . $_SESSION['calendar'];
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // add data to $content array
  while($row = $result->fetch_assoc()) {
    $content[$row["id"]] = htmlspecialchars($row["content"]);
  }
}

$conn->close();

$jsonContent = json_encode($content);
?>

<script>
// Embedding data in JavaScript, to be used in script.js
var content = <?php echo $jsonContent; ?>;
</script>

<?php
include "home.html";
?>