<?php
// Connection variables
$host = 'localhost'; // MySQL host
$username = 'root'; // MySQL username
$password = 'root123'; // MySQL password
$dbname = 'users'; // Database name

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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    // Prepare and execute the query
    $stmt = $pdo->prepare("INSERT INTO usertb (name, email, password, phonenumber) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $password, $phone]);

    // Check if the insertion was successful
    if ($stmt->rowCount() > 0) {
        // Data inserted successfully
        echo "Data inserted successfully!";
        // Redirect to login.html
        header("Location: login.html");
        exit();
    } else {
        echo "Error inserting data.";
    }
}
?>
