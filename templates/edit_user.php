<?php
require_once '../config/database.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: ../index.php');
    exit();
}

$sql = "SELECT * FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

include '../includes/header.php';
?>

<h2>ແກ້ໄຂຂໍ້ມູນຜູ້ໃຊ້</h2>
<form action="../update.php" method="post">
    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

    <label for="username">ຊື່ຜູ້ໃຊ້:</label>
    <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

    <label for="email">ອີເມວ:</label>
    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
    
    <label for="password">ລະຫັດຜ່ານໃໝ່ (ປະວ່າງໄວ້ຖ້າບໍ່ຕ້ອງການປ່ຽນ):</label>
    <input type="password" name="password" id="password">

    <input type="submit" value="ອັບເດດ" class="btn">
    <a href="../index.php">ກັບຄືນ</a>
</form>

<?php include '../includes/footer.php'; ?>