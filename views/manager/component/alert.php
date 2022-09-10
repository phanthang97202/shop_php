<?php
// thống báo cho người dùng thông báo cập nhật 1 trạng thía gì đó thành công ví dụ như tạo người 
// dùng thành công 
    // ví dụ 
//  $_SESSION['alertSuccess'] = 'thành công tạo tài khoản';

if(!empty($_SESSION['alertSuccess'])) {
    ?>
    <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['alertSuccess']; ?>
    </div>
<?php 
    $_SESSION['alertSuccess'] = null;
}


if(!empty($_SESSION['alertDanger'])) {
    ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['alertDanger']; ?>
    </div>
<?php 
    $_SESSION['alertDanger'] = null;
}


if(!empty($_SESSION['alertWarning'])) {
    ?>
    <div class="alert alert-warning" role="alert">
        <?php echo $_SESSION['alertWarning']; ?>
    </div>
<?php 
    $_SESSION['alertWarning'] = null;
}