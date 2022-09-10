
<?php

    include_once(__DIR__.'/../component/header.php');
    // var_dump($data);
   
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
              <h1 class="h2">Users</h1>
              <a href="/admin/customers/create" class="btn btn-primary btn-sm" >Thêm mới</a>
            </div>


            <?php
              include_once(__DIR__.'/../component/alert.php')
            ?>

            <form style="width:500px; height:40px;margin-bottom:20px;" class="d-flex" action="/admin/customers/search" method="get">
              <a class="btn btn-primary ti-home" style="font-size:inherit; margin:auto 6px;" href="/admin/customers"><span data-feather="arrow-left"></span></a>
              <input class="form-control me-2"
                type="search"
                name="keyword"
                placeholder="Nhập tên người dùng..."
                value="<?php echo (!empty($_GET['keyword'])) ? $_GET['keyword'] : '' ?>"
                aria-label="Search">
              <button style="width:66px" class="ti-search btn btn-primary" type="submit"></button>
            </form>
            <table class="table table">
              <thead>
                <tr style="background-color:#448aff;color:#fff">
                  <th scope="col">ID</th>
                  <th scope="col">Email</th>
                  <th scope="col">Họ tên</th>
                  <th scope="col">Địa chỉ</th>
                  <th scope="col">Số điện thoại</th>
                  <th scope="col">Chức danh</th>
                  <th scope="col">Avatar</th>
                  <th scope="col">
                    Tùy chọn
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                  // var_dump(count($data));
                  foreach ($data as $row){
                    $row = (object)$row;
                ?>
                <tr>
                  <td> <?php echo $row->id ?> </td>
                  <td> <?php echo $row->email ?> </td>
                  <td> <?php echo $row->name ?> </td>
                  <td> <?php echo $row->address ?> </td>
                  <td> <?php echo $row->phone ?> </td>
                  <td> 
                    <?php 
                      if($row->supperAdmin){
                        echo "Quản trị viên";
                      }else if($row->staff){
                        echo "Nhân viên";
                      }else{
                        echo "Người dùng";
                      }
                    ?>
                  </td>
                  
                  <td>
                    <?php 
                      if(!empty($row->avatar)) {
                          ?>
                          <img style="object-fit:cover; border-radius:50%;" src="<?php echo '/' . $row->avatar; ?>" width="60px" height="60px">
                          <?php
                      }
                    ?>
                  </td>

                  <td>
                    <a style="text-decoration:none;" href="/admin/customers/edit?id=<?php echo $row->id ?>">
                      <button class="btn btn-warning">Edit</button>
                    </a>
                    <a style="text-decoration:none;" href="/admin/customers/delete?id=<?php echo $row->id ?>">
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

   