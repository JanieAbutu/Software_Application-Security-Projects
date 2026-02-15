<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection parameters
    $host   = "127.0.0.1";
    $dbname = "zap_test";
    $dbuser = "janie";      
    $dbpass = "passer";

    try {
        // Create PDO connection
        $conn = new PDO("mysql:host=127.0.0.1;port=3309;dbname=$dbname", $dbuser, $dbpass);
        #$conn = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fixed Query (for SQL Injection testing)
        $query = "SELECT * FROM zap_users 
          WHERE username = :username 
          AND password = :password";
        $stmt = $conn->prepare($query);
        $stmt->execute([
            ':username' => $username, 
            ':password' => $password
        ]);

        // Fetch results
        if ($stmt->rowCount() > 0) {
            echo "Welcome, " . htmlspecialchars($username) . "!";
        } else {
            echo "Incorrect username or password.";
        }



    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>
