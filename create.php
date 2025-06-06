<?php
require_once 'config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Basic input validation
    if (!empty($username) && !empty($email) && !empty($password)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            exit();
        }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $pdo->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);

            // Execute the statement
            if ($stmt->execute()) {
                header("Location: index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        } catch(PDOException $e) {
            if ($e->getCode() == 23000) {
                echo "This email or username is already registered.";
            } else {
                echo "ERROR: " . $e->getMessage();
            }
        }
    } else {
        echo "Please fill in all fields.";
    }

    // Close connection
    unset($pdo);
}
?>
