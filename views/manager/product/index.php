
<?php
    include_once(__DIR__.'/../component/header.php')
?>

<?php
    include_once(__DIR__.'/../component/menu.php')
?>


  <style>
    .table-responsive .table tr:nth-child(even){
      background-color: #e7e7e7;
    }
  </style>
<div class="pcoded-inner-content">
  <div class="main-body">
    <div class="page-wrapper">
      <div class="page-body">
        <div class="card-block table-border-style">
          <div class="table-responsive">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <h1 class="h2">Products</h1>
              <a href="/admin/product/create" class="btn btn-primary btn-sm" >Thêm mới</a>
            </div>

            <form style="width:631px; height:40px;margin-bottom:20px;" class="d-flex" action="/admin/product/search" method="get">
                <a class="btn btn-primary ti-home" style="font-size:inherit; margin:auto 6px;" href="/admin/product"><span data-feather="arrow-left"></span></a>
                <input class="form-control me-2"
                    type="search"
                    name="keyword"
                    placeholder="Nhập tên sản phẩm..."
                    value="<?php echo (!empty($_GET['keyword'])) ? $_GET['keyword'] : '' ?>"
                    aria-label="Search">
                <button style="width:72px  " class=" ti-search btn btn-primary" type="submit"></button>  &nbsp; &nbsp; &nbsp;
                <a class="btn btn-primary" href="/admin/product/exportExcel">Export Excel</a>
                <!-- <button onclick = "return window.print();" class="btn btn-primary" >Export PDF</button> -->
            </form>


            <?php
              include_once(__DIR__.'/../component/alert.php')
            ?>
            <table class="table table">
              <thead>
                <tr style="background-color:#448aff;color:#fff" >
                  <th  scope="col">ID</th>
                  <th  scope="col">Tên sản phẩm</th>
                  <th  scope="col">Slug</th>
                  <th  scope="col">Danh mục</th>
                  <th  scope="col">Giá tiền</th>
                  <th  scope="col">Tùy chọn</th>
                </tr>
              </thead>
              <tbody>
                <?php


                  foreach ($data['products'] as $row){
                    $row = (object)$row;

                    // print_r($row);
                ?>
                <tr >
                  <td > <?php echo $row->id ?> </td>
                  <td > <?php echo $row->name ?> </td>
                  <td > <?php echo $row->slug ?> </td>
                  <td >
                    <?php 
                      if(!empty($data['category'][$row->category_id])){
                        echo $data['category'][$row->category_id]; 
                      }else{
                        echo "Chưa có...";
                      }
                    ?>
                  </td>
                  <td > 
                    <?php echo currency_format($row->price_sale) ?>  
                    -
                    <?php echo currency_format($row->price) ?> 
                  </td>

                  <td >
                    <a style="text-decoration:none;" href="/admin/product/show?id=<?php echo $row->id ?>">
                      <button class="btn btn-info">Detail</button>
                    </a>
                    <a style="text-decoration:none;" href="/admin/product/edit?id=<?php echo $row->id ?>">
                      <button class="btn btn-warning">Edit</button>
                    </a>
                    <a style="text-decoration:none;" href="/admin/product/delete?id=<?php echo $row->id ?>">
                      <button class="btn btn-danger">Delete</button>
                    </a>
                  </td>
                </tr>
                <?php
                    }
                ?>  
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php
    include_once(__DIR__.'/../component/footer.php')
?>

   