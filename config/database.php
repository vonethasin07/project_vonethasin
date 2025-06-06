<?php
$host = 'localhost';
$dbname = 'user_db';
$username = 'root'; // ປ່ຽນເປັນຊື່ຜູ້ໃຊ້ຂອງທ່ານ
$password = ''; // ປ່ຽນເປັນລະຫັດຜ່ານຂອງທ່ານ

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>