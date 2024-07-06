<?php
include '../inc/config.php';
/*
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
*/
// Get the form data
$recipe_name = $_POST['recipe_name'];
$recipe_owner = $_POST['recipe_owner'];
$ingredients = $_POST['ingredients'];
$description = $_POST['description'];
$instructions = $_POST['instructions'];
$category = $_POST['category'];
$image = $_FILES["recipe_image"];

// Validate form data
if (empty($recipe_name) || empty($recipe_owner) || empty($ingredients) || empty($description) || empty($instructions) || empty($category) || empty($image)) {
    echo "Please fill in all fields.";
    exit;
}

// Check if the image is valid
if (!isset($image["tmp_name"]) || !is_uploaded_file($image["tmp_name"])) {
    echo "Invalid image upload.";
    exit;
}

// Validate image type and size
$allowedTypes = array("image/jpeg", "image/png", "image/gif");
$maxFileSize = 1024 * 1024; // 1MB
if (!in_array($image["type"], $allowedTypes) || $image["size"] > $maxFileSize) {
    echo "Invalid image type or size.";
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
$query = "INSERT INTO tbl_recipe (recipe_name, recipe_owner, ingredients, description, instructions, category, recipe_image) VALUES (?,?,?,?,?,?,?)";
$stmt = $conn->prepare($query);
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("sssssss", $recipe_name, $recipe_owner, $ingredients, $description, $instructions, $category, $imageName);
if ($stmt->execute()) {
    echo "Recipe added successfully!";
} else {
    echo "Execute failed: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
