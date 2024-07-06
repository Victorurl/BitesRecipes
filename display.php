
<style>
    table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f0f0f0;
}

img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}
</style>

<?php

// Connect to the database
include 'inc/config.php';

// Select all users from the database
$sql = "SELECT * FROM tbl_users";
$result = $conn->query($sql);

// Check if there are any users
if ($result->num_rows > 0) {
    // Display users on an HTML table
    echo "<table style='border-collapse: collapse;'>";
    echo "<tr><th>Role</th><th>Email</th><th>Password</th><th>Image</th><th>Name</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["role"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["password"] . "</td>";
        echo "<td><img src='" . $row["image"] . "' alt='User Image'></td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No users found";
}

$conn->close();
?>