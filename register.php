<?php

//include 'inc/config.php';
$servername = "localhost";
$username = "root";
$password = "rehanais2cool";
$dbname = "recipes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//include $_SERVER['DOCUMENT_ROOT']. '/Database Folder/HomePage Website 10709(Victor Musembi) Database/inc/config.php';
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST["role"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $image = $_FILES["image"];
   

    // Validate form data
    if (empty($role) || empty($name) || empty($email) || empty($password) || empty($image)) {
        echo "Please fill in all fields.";
        exit;
    }
  // Check if the image is valid
  if (!isset($image["tmp_name"]) || !is_uploaded_file($image["tmp_name"])) {
    echo "Invalid image upload.";
    exit;
}
  // Upload the image to a directory
  $uploadDir = "../upload/";
  $imageName = basename($image["name"]);
  $imagePath = $uploadDir . $imageName;
  if (!move_uploaded_file($image["tmp_name"], $imagePath)) {
      echo "Failed to upload image.";
      exit;
  }
    // Insert data into database
    $query = "INSERT INTO tbl_users (role, name, email, password, image) VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die("Prepare failed: ". $conn->error);
    }

    $stmt->bind_param("sssss", $role, $name, $email, $password, $imagePath);
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Execute failed: ". $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request method.";
}

// Close connection
$conn->close();
?>