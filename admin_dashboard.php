<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role']!= 'administrator') {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "rehanais2cool";
$dbname = "recipes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

$query = "SELECT * FROM tbl_users";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: ". $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
       .button-container {
            margin-top: 20px;
        }
       .button-container button {
            margin-right: 10px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
       .welcome-message {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="welcome-message">Welcome, <?php echo htmlspecialchars($_SESSION['username']);?>!</div>
    <h1>Admin Dashboard</h1>
  
    <div class="button-container">
        <button onclick="location.href='update.php'">Update User Details</button>
        <button onclick="location.href='users.php'">See User Details</button>
    </div>
</body>
</html>

<?php
$conn->close();
?>