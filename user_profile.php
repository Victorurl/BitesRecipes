<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>User Profile</title>
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
<div class="welcome-message">Welcome, !</div>
    <h1>User Profile</h1>
  
    <div class="button-container">
        <button onclick="location.href='../Recipe Management/addRecipes.html'">Add Recipes</button>
        <button onclick="location.href='recipes.php'">Edit My Recipes</button>
        <button onclick="location.href='users.php'">View my Profile</button>
    </div>
</body>
</html>