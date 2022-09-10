
<?php
    include_once(__DIR__.'/../component/header.php')
?>

<?php
    include_once(__DIR__.'/../component/menu.php')
?>

<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <h2 class="mt-3">Thêm mới người dùng</h2> 

                <?php
                    if(!empty($data['error'])){
                        ?>
                        <div class="alert alert-warning" role="alert">
                            <?php
                                foreach($data['error'] as $error){
                                    echo "<p>{$error}</p>";
                                }
                            ?>
                        </div>
                        <?php
                    }
                ?>

                <?php
                    include_once(__DIR__.'/../component/alert.php')
                ?>

                <form action="/admin/customers/create" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="input-name" class="form-label">Họ và tên</label>
                        <input
                            value="<?php echo (!empty($data['oldValue']['name'])) ? $data['oldValue']['name'] : ''; ?>"
                            name="name" type="text" class="form-control" id="input-name">
                    </div>
                    <div class="mb-3">
                        <label for="input-email" class="form-label">Email</label>
                        <input
                            value="<?php echo (!empty($data['oldValue']['email'])) ? $data['oldValue']['email'] : ''; ?>"
                            name="email" type="email" class="form-control" id="input-email" >
                    </div>
                    <div class="mb-3">
                        <label for="input-address" class="form-label">Địa chỉ</label>
                        <input
                            value="<?php echo (!empty($data['oldValue']['address'])) ? $data['oldValue']['address'] : ''; ?>"
                            name="address" type="text" class="form-control" id="input-address" >
                    </div>
                    <div class="mb-3">
                        <label for="input-phone" class="form-label">Số điện thoại</label>
                        <input
                            value="<?php echo (!empty($data['oldValue']['phone'])) ? $data['oldValue']['phone'] : ''; ?>"
                            name="phone" type="text" class="form-control" id="input-phone" >
                    </div>
                    <div class="mb-3">
                        <label for="input-password" class="form-label">Mật khẩu</label>
                        <input
                            name="password" type="password" class="form-control" id="input-password">
                    </div>
                    <div class="mb-3">
                        <label for="input-repassword" class="form-label">Xác nhận mật khẩu</label>
                        <input
                            name="repassword" type="password" class="form-control" id="input-repassword">
                    </div>
                    <div class="mb-3 form-check">
                        <label class="form-label" for="input-permission">Quyền hạn</label>
                        <select class="form-select"  id="input-permission" name="permission">
                            <option 
                            <?php echo (!empty($data['oldValue']['permission']) && $data['oldValue']['permission'] == 1) ? 'selected' : ''; ?>
                                value="1">Người dùng thường</option>
                            <option 
                            <?php echo (!empty($data['oldValue']['permission']) && $data['oldValue']['permission'] == 2) ? 'selected' : ''; ?>
                                value="2">Nhân viên</option>
                            <option 
                            <?php echo (!empty($data['oldValue']['permission']) && $data['oldValue']['permission'] == 3) ? 'selected' : ''; ?>
                                value="3">Quản trị viên</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="input-avatar" class="form-label">Địa chỉ</label>
                        <input
                            value="<?php echo (!empty($data['oldValue']['avatar'])) ? $data['oldValue']['avatar'] : ''; ?>"
                            name="avatar" type="file" class="form-control" id="input-avatar" >
                    </div>
                    
                    
                    <button type="submit" class="btn btn-primary">Tạo mới</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    include_once(__DIR__.'/../component/footer.php')
?>

   