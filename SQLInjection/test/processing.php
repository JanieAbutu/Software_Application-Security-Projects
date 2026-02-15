<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection parameters
    $host   = "127.0.0.1";
    $dbname = "zap_test";
    $dbuser = "janie";       // or izolo (whichever user you created)
    $dbpass = "passer";

    try {
        // Create PDO connection
        $conn = new PDO("mysql:host=127.0.0.1;port=3309;dbname=$dbname", $dbuser, $dbpass);
        #$conn = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Intentionally Vulnerable Query (for SQL Injection testing)
        $query = "SELECT * FROM zap_users 
                  WHERE username = '$username' 
                  AND password = '$password'";

        // Execute query
        $result = $conn->query($query);

        // Check results
        if ($result && $result->rowCount() > 0) {
            echo "Welcome, " . htmlspecialchars($username) . "!";
        } else {
            echo "Incorrect username or password.";
        }

        // Close connection
        $conn = null;

    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>
