<?php

include '../inc/config.php';

$category = $_GET['category'] ?? 'category';


$sql = "SELECT recipe_name, recipe_owner, Description, recipe_image FROM tbl_recipe WHERE category = '$category'";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Recipe Cards</title>
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
            width: 1000px;
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
/*Navigation Bar stylying */
        .navBar{
            display:flex ;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .navBar ul li{
            display: inline-block;
            list-style: none;
            margin:10px 20px;
        }
        .navBar ul li a{  /*styles the a tags in the list*/
            /*color:white;*/
            text-decoration: none;
            font-size: 18px;
            position: relative;
        }
        
        .navBar ul li a::after{
            content: '';
            width: 0;
            height: 3px;
            background: #ff004f;
            position: absolute;
            left: 0;
            bottom:-6px;
            transition: 0.5s;
        }
        .navBar ul li a:hover::after{
            width: 100%;
        }

       
        nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    background-color: #333; /* add a background color to the navbar */
    padding: 0px; /* add some padding to the navbar */
        }
.logo {
    width: 140px; /* set the width of the logo */
}

nav ul {
    display: flex;
    justify-content: space-between;
    list-style: none;
    margin: 0;
    padding: 0;
}

nav ul li {
    margin-right: 20px; /* add some margin to the right of each list item */
}

nav ul li a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    position: relative;
}

nav ul li a::after {
    content: '';
    width: 0;
    height: 3px;
    background: #ff004f;
    position: absolute;
    left: 0;
    bottom: -6px;
    transition: 0.5s;
}

nav ul li a:hover::after {
    width: 100%;
}
    </style>
</head>

<body>
<div id="Head">
    <nav>
        <div class="logo">
            <h1>My Food</h1>
        </div>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../index.php #Recipes">Recipes</a></li>
            <li><a href="../index.php #testimonials">Testimonials</a></li>
            <li><a href="../index.php #contact">Contact us</a></li>
            <li><a href="../index.php #about ">About</a></li>
        </ul>
    </nav>
</div>
    <div class="recipe-container">
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<div class="recipe-card">';
                echo '<div class="recipe-image-container">';
                if (!empty($row["recipe_image"])) {
                    echo '<img src="../upload/' . $row["recipe_image"] . '" alt="' . $row["recipe_name"] . '" class="recipe-image">';
                } else {
                    echo '<img src="../upload/default_image.jpg" alt="Default Image" class="recipe-image">';
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
    <?php include '../inc/footer.php';?>
</body>
</html>