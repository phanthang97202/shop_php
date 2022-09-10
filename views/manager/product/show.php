<?php
include_once(__DIR__ . '/../component/header.php');
?>


<?php
    include_once(__DIR__ . '/../component/menu.php');
?>

<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <h2 class="mt-3">Thông tin sản phẩm</h2>
                <?php 
                    if(!empty($data['error'])) {
                        ?>
                        <div class="alert alert-warning" role="alert">
                            <?php
                                foreach($data['error'] as $error) {
                                    echo "<p>{$error}</p>";
                                }
                            ?>
                        </div>
                        <?php
                    }
                ?>

                <?php 
                    include_once(__DIR__.'/../component/alert.php');
                ?>
                
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                            <th scope="col">Tên cột</th>
                            <th scope="col">Nội dung</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tên sản phẩm</td>
                                <td><?php echo $data['default']['name']; ?></td>
                            </tr>
                            <tr>
                                <td>Danh mục</td>
                                <td><?php echo $data['categories'][$data['default']['category_id']]; ?></td>
                            </tr>
                            <tr>
                                <td>Giá gốc</td>
                                <td><?php echo currency_format($data['default']['price']); ?></td>
                            </tr>
                            <tr>
                                <td>Giá bán</td>
                                <td><?php echo currency_format($data['default']['price_sale']) ?></td>
                            </tr>
                            <tr>
                                <td>Mô tả ngắn</td>
                                <td>
                                    <?php echo $data['default']['description']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Ảnh đại diện</td>
                                <td><?php 
                                        if(!empty($data['default']['images'])) {
                                            ?>
                                            <img src="<?php echo '/' . $data['default']['images']; ?>" width="200px" height="200px">
                                            <?php
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Mô tả chi tiết</td>
                                <td>
                                    <textarea readonly style="width:100%" name="" id="" cols="30" rows="10">
                                        <?php echo $data['default']['content']; ?>
                                    </textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once(__DIR__ . '/../component/footer.php');
?>