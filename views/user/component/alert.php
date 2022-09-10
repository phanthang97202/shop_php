<?php
// thống báo cho người dùng thông báo cập nhật 1 trạng thía gì đó thành công ví dụ như tạo người 
// dùng thành công 
    // ví dụ 
//  $_SESSION['alertSuccess'] = 'thành công tạo tài khoản';

if(!empty($_SESSION['userAlertSuccess'])) {
    ?>
    <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['userAlertSuccess']; ?>
    </div>
<?php 
    $_SESSION['userAlertSuccess'] = null;
}


if(!empty($_SESSION['userAlertDanger'])) {
    ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['userAlertDanger']; ?>
    </div>
<?php 
    $_SESSION['userAlertDanger'] = null;
}


if(!empty($_SESSION['userAlertWarning'])) {
    ?>
    <div class="alert alert-warning" role="alert">
        <?php echo $_SESSION['userAlertWarning']; ?>
    </div>
<?php 
    $_SESSION['userAlertWarning'] = null;
}