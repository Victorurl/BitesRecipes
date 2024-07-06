<?php
// Database configuration
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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $role = $_POST["role"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare SQL query to check if user exists
    $query = "SELECT * FROM tbl_users WHERE role=? AND name =? AND email =? AND password =?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $role, $name, $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User exists, set session variables and redirect to next page
        $user_data = $result->fetch_assoc();
        session_start();
        $_SESSION["username"] = $user_data["username"];
        $_SESSION["role"] = $user_data["role"];
        switch ($user_data["role"]) {
            case "administrator":
                header("Location: ./admin_dashboard.php");
                break;
            case "Normal user":
                header("Location: ./user_profile.php");
                break;
            case "chef":
                header("Location: ./chef_dashboard.php");
                break;
            default:
                echo "Invalid role";
        }
        exit();
    } else {
        // User does not exist or credentials are incorrect
        echo "Invalid email or password. Please try again.";
    }

    $stmt->close();
}

// Close connection
$conn->close();
?>