<?php
// ເຊື່ອມຕໍ່ຖານຂໍ້ມູນ, ເນື່ອງຈາກໄຟລ໌ນີ້ຢູ່ໃນ templates, ຈຶ່ງຕ້ອງອ້າງອີງໄປທີ່ root folder ດ້ວຍ ../
require_once '../config/database.php';

// ລວມສ່ວນຫົວຂອງເວັບໄຊ (Header)
include '../includes/header.php';
?>

<div class="page-header">
    <h2>ລາຍຊື່ຜູ້ໃຊ້ທັງໝົດ</h2>
</div>

<p>
    <a href="add_user.php" class="btn btn-success">ເພີ່ມຜູ້ໃຊ້ໃໝ່</a>
</p>

<?php
// ກຽມຄຳສັ່ງ SQL ເພື່ອດຶງຂໍ້ມູນຜູ້ໃຊ້ທັງໝົດ, ຮຽງຕາມ ID ຈາກໃໝ່ໄປເກົ່າ
$sql = "SELECT id, username, email, created_at FROM users ORDER BY id DESC";

// ດຳເນີນການ query
$stmt = $pdo->query($sql);

if ($stmt->rowCount() > 0) {
    // ຖ້າມີຂໍ້ມູນ, ໃຫ້ສະແດງໃນຕາຕະລາງ
    echo '<table>';
        echo '<thead>';
            echo '<tr>';
                echo '<th>#</th>';
                echo '<th>ຊື່ຜູ້ໃຊ້</th>';
                echo '<th>ອີເມວ</th>';
                echo '<th>ວັນທີສ້າງ</th>';
                echo '<th>ການກະທຳ</th>';
            echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        // ດຶງຂໍ້ມູນອອກມາເທື່ອລະແຖວ
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
                echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                echo '<td>' . htmlspecialchars($row['username']) . '</td>';
                echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                echo '<td>' . htmlspecialchars($row['created_at']) . '</td>';
                echo '<td>';
                    // ລິ້ງສຳລັບແກ້ໄຂ, ສົ່ງ id ໄປນຳ
                    echo '<a href="edit_user.php?id=' . $row['id'] . '" class="btn-action btn-edit">ແກ້ໄຂ</a>';
                    // ລິ້ງສຳລັບລົບ, ສົ່ງ id ໄປທີ່ delete.php ທີ່ຢູ່ root folder
                    // script.js ຈະເພີ່ມການຢືນຢັນການລົບໃຫ້ກັບລິ້ງນີ້
                    echo '<a href="../delete.php?id=' . $row['id'] . '" class="btn-action btn-delete">ລົບ</a>';
                echo '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
    echo '</table>';

    // Free result set
    unset($stmt);
} else {
    // ຖ້າບໍ່ມີຂໍ້ມູນໃນຕາຕະລາງ
    echo '<div class="alert alert-info">ບໍ່ມີຂໍ້ມູນຜູ້ໃຊ້ໃນລະບົບ.</div>';
}

// Close connection
unset($pdo);

// ລວມສ່ວນທ້າຍຂອງເວັບໄຊ (Footer)
include '../includes/footer.php';
?>