
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
              <h1 class="h2">Categories</h1>
              <a href="/admin/category/create" class="btn btn-primary btn-sm" >Thêm mới</a>
            </div>


            <?php
              include_once(__DIR__.'/../component/alert.php')
            ?>

            <form style="width:500px; height:40px;margin-bottom:20px" class="d-flex" action="/admin/category/search" method="get">
                <a class=" btn btn-primary ti-home" style="font-size:inherit; margin:auto 6px;" href="/admin/category"><span data-feather="arrow-left"></span></a>
                <input class="form-control me-2"
                    type="search"
                    name="keyword"
                    placeholder="Nhập tên danh mục..."
                    value="<?php echo (!empty($_GET['keyword'])) ? $_GET['keyword'] : '' ?>"
                    aria-label="Search">
                <button style="width:66px  " class="ti-search btn btn-primary" type="submit"></button>
            </form>
            <table class="table table">
              <thead>
                <tr style="background-color:#448aff;color:#fff">
                  <th scope="col">ID</th>
                  <th scope="col">Tên sản phẩm</th>
                  <th scope="col">Slug</th>
                  <!-- <th scope="col">Parent ID</th> -->
                  <th scope="col">Loại</th>
                  <th scope="col">Tùy chọn</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach ($data as $row){
                    $row = (object)$row;
                    // print_r($row);
                ?>
                <tr>
                  <td> <?php echo $row->id ?> </td>
                  <td> <?php echo $row->name ?> </td>
                  <td> <?php echo $row->slug ?> </td>
                  <!-- <td>  -->
                    <?php
                      // echo $row->parent_id 
                    ?> 
                  <!-- </td> -->
                  <td> <?php echo $row->type ?> </td>

                  <td>
                    <a style="text-decoration:none;" href="/admin/category/edit?id=<?php echo $row->id ?>">
                      <button class="btn btn-warning">Edit</button>
                    </a>
                    <a style="text-decoration:none;" href="/admin/category/delete?id=<?php echo $row->id ?>">
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

   