<?php
require_once 'config/database.php';
include 'includes/header.php';
?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h3>ລາຍການຜູ້ໃຊ້</h3>
        <a href="templates/add_user.php" class="btn btn-primary">ເພີ່ມຜູ້ໃຊ້ໃໝ່</a>
    </div>

    <input type="text" id="search" class="form-control" placeholder="ພິມຊື່ຫຼືອີເມວເພື່ອຄົ້ນຫາ...">

    <div id="userTable" class="mt-3">
        
    </div>
</div>

<script>

document.getElementById('search').addEventListener('keyup', function () {
    const keyword = this.value;

    const xhr = new XMLHttpRequest();
    xhr.open("GET", "search_users.php?search=" + encodeURIComponent(keyword), true);
    xhr.onload = function () {
        if (this.status === 200) {
            document.getElementById('userTable').innerHTML = this.responseText;
        }
    };
    xhr.send();
});


window.onload = () => {
    document.getElementById('search').dispatchEvent(new Event('keyup'));
};
</script>

<?php include 'includes/footer.php'; ?>
