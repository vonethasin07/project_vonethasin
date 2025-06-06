<?php include '../includes/header.php'; ?>

<h2>ເພີ່ມຜູ້ໃຊ້ໃໝ່</h2>
<form action="../create.php" method="post">
    <label for="username">ຊື່ຜູ້ໃຊ້:</label>
    <input type="text" name="username" id="username" required>

    <label for="email">ອີເມວ:</label>
    <input type="email" name="email" id="email" required>

    <label for="password">ລະຫັດຜ່ານ:</label>
    <input type="password" name="password" id="password" required>

    <input type="submit" value="ບັນທຶກ" class="btn">
    <a href="../index.php">ກັບຄືນ</a>
</form>

<?php include '../includes/footer.php'; ?>