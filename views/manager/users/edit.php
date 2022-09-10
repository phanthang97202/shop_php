
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
                <h2 class="mt-3">Chỉnh sửa người dùng</h2> 

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

                <form action="/admin/customers/edit?id=<?php echo $data['default']['id'] ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="input-name" class="form-label">Họ và tên</label>
                        <input
                            value="<?php 
                                if(!empty($data['oldValue']['name'])){
                                    echo $data['oldValue']['name'];
                                }else if(!empty($data['default']['name'])){
                                    echo $data['default']['name'];
                                }else{
                                    echo "";
                                }
                            ?>"
                            name="name" type="text" class="form-control" id="input-name">
                    </div>
                    <div class="mb-3">
                        <label for="input-email" class="form-label">Email</label>
                        <input
                            value="<?php 
                                if(!empty($data['oldValue']['email'])){
                                    echo $data['oldValue']['email'];
                                }else if(!empty($data['default']['email'])){
                                    echo $data['default']['email'];
                                }else{
                                    echo "";
                                } 
                            ?>"
                            readonly="true"
                            name="email" type="email" class="form-control" id="input-email" >
                    </div>
                    <div class="mb-3">
                        <label for="input-address" class="form-label">Địa chỉ</label>
                        <input
                            value="<?php 
                                if(!empty($data['oldValue']['address'])){
                                    echo $data['oldValue']['address'];
                                }else if(!empty($data['default']['address'])){
                                    echo $data['default']['address'];
                                }else{
                                    echo "";
                                }
                            ?>"
                            name="address" type="text" class="form-control" id="input-address" >
                    </div>
                    <div class="mb-3">
                        <label for="input-phone" class="form-label">Số điện thoại</label>
                        <input
                            value="<?php 
                                if(!empty($data['oldValue']['phone'])){
                                    echo $data['oldValue']['phone'];
                                }else if(!empty($data['default']['phone'])){
                                    echo $data['default']['phone'];
                                }else{
                                    echo "";
                                }
                            ?>"
                            readonly="true"
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
                            <?php 
                                if(!empty($data['oldValue']['permission']) && $data['oldValue']['permission'] == 1){
                                    echo 'selected';
                                }else if(!empty($data['default']['permission']) && $data['default']['permission'] == 1){
                                    echo 'selected';
                                }else{
                                    echo '';
                                }
                            ?>
                                value="1">Người dùng thường</option>
                            <option 
                            <?php 
                                if(!empty($data['oldValue']['permission']) && $data['oldValue']['permission'] == 2){
                                    echo 'selected';
                                }else if(!empty($data['default']['permission']) && $data['default']['permission'] == 2){
                                    echo 'selected';
                                }else{
                                    echo '';
                                }
                            ?>
                                value="2">Nhân viên</option>
                            <option 
                            <?php 
                                if(!empty($data['oldValue']['permission']) && $data['oldValue']['permission'] == 3){
                                    echo 'selected';
                                }else if(!empty($data['default']['permission']) && $data['default']['permission'] == 3){
                                    echo 'selected';
                                }else{
                                    echo '';
                                }
                            ?>
                                value="3">Quản trị viên</option>
                        </select>
                    </div>

                    
                    <div class="mb-3">
                        <label for="input-avatar" class="form-label">Ảnh đại diện</label>
                        <input name="avatar" type="file" class="form-control" id="input-avatar">
                        
                        <input type="hidden" name="old_avatar" value="<?php echo  $data['default']['avatar'] ?>">
                        <div>
                            <?php
                                if(!empty($data['default']['avatar'])){
                                    ?>
                                        <img style="object-fit: cover;" src="<?php echo '/' . $data['default']['avatar']; ?>" width="150px" height="150px" alt="">
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                    
                    
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    include_once(__DIR__.'/../component/footer.php')
?>

   