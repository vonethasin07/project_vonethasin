<?php
require_once 'config/database.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($search !== '') {
    $sql = "SELECT * FROM users WHERE username LIKE :search OR email LIKE :search ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['search' => '%' . $search . '%']);
} else {
    $sql = "SELECT * FROM users ORDER BY id DESC";
    $stmt = $pdo->query($sql);
}

if ($stmt->rowCount() > 0): ?>
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>ຊື່ຜູ້ໃຊ້</th>
                <th>ອີເມວ</th>
                <th>ການກະທຳ</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td>
                    <a href="templates/edit_user.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">ແກ້ໄຂ</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('ທ່ານແນ່ໃຈບໍ່ວ່າຕ້ອງການລົບ?');">ລົບ</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="alert alert-warning">ບໍ່ພົບຜູ້ໃຊ້</div>
<?php endif; ?>
