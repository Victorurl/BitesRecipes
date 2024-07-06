<?php
// ... (same connection and query code as before)
include 'inc/config.php';
// Check if there are any users
if ($result->num_rows > 0) {
    // Display users on an HTML table
    echo "<table style='border-collapse: collapse;'>";
    echo "<tr><th>Role</th><th>Email</th><th>Password</th><th>Image</th><th>Name</th><th>Edit</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><input type='text' name='role' value='" . $row["role"] . "'></td>";
        echo "<td><input type='email' name='email' value='" . $row["email"] . "'></td>";
        echo "<td><input type='password' name='password' value='" . $row["password"] . "'></td>";
        echo "<td><input type='file' name='image' value='" . $row["image"] . "'></td>";
        echo "<td><input type='text' name='name' value='" . $row["name"] . "'></td>";
        echo "<td><button type='submit' name='edit' value='" . $row["id"] . "'>Edit</button></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No users found";
}

// Check if the edit button was clicked
if (isset($_POST["edit"])) {
    $id = $_POST["edit"];
    $role = $_POST["role"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $image = $_FILES["image"]["name"];
    $name = $_POST["name"];

    // Update the user's information in the database
    $sql = "UPDATE tbl_users SET role='$role', email='$email', password='$password', image='$image', name='$name' WHERE id=$id";
    $conn->query($sql);

    // Upload the new image
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Redirect to the same page to display the updated user list
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}

$conn->close();
?>