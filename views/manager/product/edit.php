
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
                <h2 class="mt-3">Chỉnh sửa sản phẩm</h2> 

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

                <form action="/admin/product/edit?id=<?php echo $data['default']['id']; ?>" method="post"" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="input-name" class="form-label">Tên sản phẩm</label>
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
                    
                    <div class="mb-3 form-check">
                        <label class="form-label" for="input-parent">Danh mục sản phẩm</label>
                        <select class="form-select"  id="input-parent" name="category_id">
                            <?php
                                foreach($data['categories'] as $key => $category) {
                                    if($key != $data['default']['id']) {
                                        ?>
                                        <option 
                                            value="<?php echo $key; ?>"
                                            <?php 
                                                if(!empty($data['oldValue']['category_id']) 
                                                    && $data['oldValue']['category_id'] == $key) {
                                                    echo 'selected';
                                                } else if(!empty($data['default']['category_id']) && $data['default']['category_id'] == $key) {
                                                    echo 'selected';
                                                } else {
                                                    echo "";
                                                }
                                            ?>
                                            ><?php echo $category; ?></option>
                                        <?php
                                    }
                                }
                            ?>

                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="input-price" class="form-label">Giá gốc</label>
                        <input
                            value="<?php 
                                if(!empty($data['oldValue']['price'])){
                                    echo $data['oldValue']['price'];
                                }else if(!empty($data['default']['price'])){
                                    echo $data['default']['price'];
                                }else{
                                    echo "";
                                }
                            ?>"
                            
                            name="price" type="number" class="form-control" id="input-price">
                    </div>

                    <div class="mb-3">
                        <label for="input-price_sale" class="form-label">Giá bán</label>
                        <input
                            value="<?php 
                                if(!empty($data['oldValue']['price_sale'])){
                                    echo $data['oldValue']['price_sale'];
                                }else if(!empty($data['default']['price_sale'])){
                                    echo $data['default']['price_sale'];
                                }else{
                                    echo "";
                                }
                            ?>"
                            name="price_sale" type="number" class="form-control" id="input-price_sale">
                    </div>
                    
                    <div class="mb-3">
                        <label for="input-description" class="form-label">Mô tả</label>
                        <textarea 
                            class="form-control"
                            name="description" id="input-description" cols="30" rows="10"
                        >
                            <?php
                            if(!empty($data['oldValue']['description'])){
                                echo $data['oldValue']['description'];
                            }else if(!empty($data['default']['description'])){
                                echo $data['default']['description'];
                            }else{
                                echo "";
                            }
                            ?>
                        </textarea>
                    </div>

                    <div class="mb-3">
                        <label for="input-images" class="form-label">Ảnh đại diện</label>
                        <input name="images" type="file" class="form-control" id="input-images">
                        
                        <input type="hidden" name="old_images" value="<?php echo  $data['default']['images'] ?>">
                        <div>
                            <?php
                                if(!empty($data['default']['images'])){
                                    ?>
                                        <img  src="<?php echo '/' . $data['default']['images']; ?>" width="150px" height="150px" alt="">
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="input-content" class="form-label">Thông tin chi tiết</label>
                        <textarea 
                            class="form-control"
                            name="content" id="input-content" cols="30" rows="10"
                        >
                            <?php 
                                if(!empty($data['oldValue']['content'])){
                                    echo $data['oldValue']['content'];
                                }else if(!empty($data['default']['content'])){
                                    echo $data['default']['content'];
                                }else{
                                    echo "";
                                }
                            ?>
                        </textarea>
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

   