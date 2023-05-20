<?php
// Database connection details
$host = "localhost";
$username = "your_username";
$password = "your_password";
$database = "your_database";

// Connect to MySQL database
$connection = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Validate and sanitize the form data
$full_name = mysqli_real_escape_string($connection, $_POST['full_name']);
$email = mysqli_real_escape_string($connection, $_POST['email']);
$gender = mysqli_real_escape_string($connection, $_POST['gender']);

// Perform server-side validation
$errors = array();

if (empty($full_name)) {
    $errors[] = "Full Name is required.";
}

if (empty($email)) {
    $errors[] = "Email Address is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid Email Address.";
}

if (empty($gender)) {
    $errors[] = "Gender is required.";
// Retrieve registered students' information from the database
$query = "SELECT * FROM students";
$result = mysqli_query($connection, $query);}

// Display the registered students' information
if (mysqli_num_rows($result) > 0) {
    echo "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>Name: " . $row['full_name'] . ", Email: " . $row['email'] . ", Gender: " . $row['gender'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No students registered yet.";
}

// Close the database connection
mysqli_close($connection);
 ?>