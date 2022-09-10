
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
                <h2 class="mt-3">Thêm mới sản phẩm</h2> 

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

                <form action="/admin/product/create" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="input-name" class="form-label">Tên sản phẩm</label>
                        <input
                            value="<?php echo (!empty($data['oldValue']['name'])) ? $data['oldValue']['name'] : ''; ?>"
                            name="name" type="text" class="form-control" id="input-name">
                    </div>
                    
                    <div class="mb-3 form-check">
                        <label class="form-label" for="input-parent">Danh mục</label>
                        <select class="form-select"  id="input-parent" name="category_id">
                            
                            <?php
                                // lặp từng mảng trong data lấy hết các giá trị fetch trong db truyền key tương ứng với 
                                // value của nó => so sánh bằng thì hiển thị danh mục đã có trong db 
                                foreach($data['categories'] as $key => $category ){
                                    ?>
                                        <option 
                                            value="<?php echo $key; ?>"
                                            <?php
                                            // var_dump($key); die();
                                                if(!empty($data['oldValue']['category_id']) 
                                                    && $data['oldValue']['category_id'] == $key){
                                                    echo 'selected';
                                                }
                                            ?>
                                        >
                                        
                                        <?php echo $category ?>
                                        </option>
                                    <?php
                                }
                            ?>

                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="input-price" class="form-label">Giá gốc</label>
                        <input
                            value="<?php echo (!empty($data['oldValue']['price'])) ? $data['oldValue']['price'] : ''; ?>"
                            name="price" type="number" class="form-control" id="input-price">
                    </div>

                    <div class="mb-3">
                        <label for="input-price_sale" class="form-label">Giá bán</label>
                        <input
                            value="<?php echo (!empty($data['oldValue']['price_sale'])) ? $data['oldValue']['price_sale'] : ''; ?>"
                            name="price_sale" type="number" class="form-control" id="input-price_sale">
                    </div>
                    
                    <div class="mb-3">
                        <label for="input-description" class="form-label">Mô tả</label>
                        <textarea 
                            class="form-control"
                            name="description" id="input-description" cols="30" rows="10"
                            value="<?php echo (!empty($data['oldValue']['description'])) ? $data['oldValue']['description'] : ''; ?>"
                        >
                        </textarea>
                    </div>

                    <div class="mb-3">
                        <label for="input-images" class="form-label">Ảnh đại diện</label>
                        <input
                            value="<?php echo (!empty($data['oldValue']['images'])) ? $data['oldValue']['images'] : ''; ?>"
                            name="images" type="file" class="form-control" id="input-images">
                    </div>
                    
                    <div class="mb-3">
                        <label for="input-content" class="form-label">Thông tin chi tiết</label>
                        <textarea 
                            class="form-control"
                            name="content" id="input-content" cols="30" rows="10"
                            value="<?php echo (!empty($data['oldValue']['content'])) ? $data['oldValue']['content'] : ''; ?>"
                        >
                        </textarea>
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

   