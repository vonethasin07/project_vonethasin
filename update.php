<?php
require_once 'config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (!empty($id) && !empty($username) && !empty($email)) {
        try {
            // Check if password needs to be updated
            if (!empty($password)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET username = :username, email = :email, password = :password WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':password', $hashed_password);
            } else {
                $sql = "UPDATE users SET username = :username, email = :email WHERE id = :id";
                $stmt = $pdo->prepare($sql);
            }

            // Bind common parameters
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);

            if ($stmt->execute()) {
                header("location: index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
    }
    unset($pdo);
}
?>