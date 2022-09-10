
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
                <h2 class="mt-3">Thêm mới danh mục</h2> 

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

                <form action="/admin/category/create" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="input-name" class="form-label">Tên danh mục</label>
                        <input
                            value="<?php echo (!empty($data['oldValue']['name'])) ? $data['oldValue']['name'] : ''; ?>"
                            name="name" type="text" class="form-control" id="input-name">
                    </div>
                    
                    <!-- <div class="mb-3 form-check">
                        <label class="form-label" for="input-parent">Thư mục gốc</label>
                        <select class="form-select"  id="input-parent" name="parent_id">
                            <option 
                                value="0">
                                <?php
                                    if(!empty($data['oldValue']['parent_id']) && $data['oldValue']['parent_id']==0){
                                        echo 'selected';
                                    }
                                ?>
                                Root
                            </option>
                            <?php
                                foreach($data['categories'] as $key => $category ){
                                    ?>
                                        <option 
                                            value="<?php echo $key; ?>"
                                            <?php
                                                if(!empty($data['oldValue']['parent_id']) 
                                                    && $data['oldValue']['parent_id'] == $key){
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
                    </div> -->

                    <div class="mb-3 form-check">
                        <label class="form-label" for="input-type">Type</label>
                        <select class="form-select"  id="input-type" name="type">
                            <option 
                                value="product"
                                <?php
                                    if(!empty($data['oldValue']['type']) && $data['oldValue']['type']=="product"){
                                        echo 'selected';
                                    }
                                ?>
                            >
                                Sản phẩm
                            </option>
                            <option 
                                value="news"
                                <?php
                                    if(!empty($data['oldValue']['type']) && $data['oldValue']['type']== "news"){
                                        echo 'selected';
                                    }
                                ?>
                            >
                                Tin tức
                            </option>
                        </select>
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

   