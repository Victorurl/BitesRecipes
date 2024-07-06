<?php
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

$sql = "SELECT recipe_name, recipe_owner, Description, recipe_image FROM tbl_recipe";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Recipe Cards</title>
    <link rel="stylesheet" href="style.css" />
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

.recipe-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.recipe-card {
    display: flex;
    flex-direction: row;
    align-items: center;
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    overflow: hidden;
    width: 3000px;
    margin: 10px;
    transition: transform 0.2s;
}

.recipe-card:hover {
    transform: scale(1.05);
}

.recipe-image-container {
    width: 100px;
    height: 100px;
    overflow: hidden;
    margin: 10px;
}

.recipe-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px 0 0 10px;
}

.recipe-details {
    padding: 15px;
}

.recipe-details h2 {
    font-size: 1.5em;
    margin: 0 0 10px;
}

.recipe-details .owner {
    font-size: 0.9em;
    color: #666;
    margin: 0 0 10px;
}

.recipe-details .description {
    font-size: 1em;
    color: #333;
}
.recipe-info {
    flex: 1;
    padding: 10px;
}

.recipe-info h2 {
    font-size: 1.5em;
    margin: 0 0 10px;
}

.recipe-info.owner {
    font-size: 0.9em;
    color: #666;
    margin: 0 0 10px;
}

.recipe-info.description {
    font-size: 1em;
    color: #333;
}
</style>
</head>


<body>
    <div class="recipe-container">
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<div class="recipe-card">';
                echo '<div class="recipe-image-container">';
                if (!empty($row["recipe_image"])) {
                    echo '<img src="upload/' . $row["recipe_image"] . '" alt="' . $row["recipe_name"] . '" class="recipe-image">';
                } else {
                    echo '<img src="upload/default_image.jpg" alt="Default Image" class="recipe-image">';
                }
                echo '</div>';
                echo '<div class="recipe-details">';
                echo '<h2>' . $row["recipe_name"] . '</h2>';
                echo '<p class="owner">By: ' . $row["recipe_owner"] . '</p>';
                echo '<p class="description">' . $row["Description"] . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
