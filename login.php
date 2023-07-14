<?php
// Connection variables
$host = 'localhost'; // MySQL host
$username = 'root'; // MySQL username
$password = 'root123'; // MySQL password
$dbname = 'users'; // Database name

// Start a session
session_start();

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $email = $_POST['email'];
    $password = $_POST['pass'];

    // Prepare and execute the query
    $stmt = $pdo->prepare("SELECT * FROM usertb WHERE email = ?");
    $stmt->execute([$email]);

    // Check if the email exists in the database
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // Verify the password
        if ($password === $user['password']) {
            // Password is correct, redirect to main.html
            header("Location: Main.html");
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "User not found.";
    }
}
?>
