<?php
    include_once(__DIR__.'./component/header.php');
    include_once(__DIR__.'./component/menu.php');
    // include_once(__DIR__.'./component/welcome.php');
    // var_dump($_SESSION['user']);
    // var_dump($_SESSION['carts']);die();
?>

<style>
    .payment-info {
    background: blue;
    padding: 10px;
    border-radius: 6px;
    color: #fff;
    font-weight: bold;
    }

    .product-details {
    padding: 10px;
    }

    body {
    background: #eee;
    }

    .cart {
    background: #fff;
    }

    .p-about {
    font-size: 12px;
    }

    .table-shadow {
    -webkit-box-shadow: 5px 5px 15px -2px rgba(0,0,0,0.42);
    box-shadow: 5px 5px 15px -2px rgba(0,0,0,0.42);
    }

    .type {
    font-weight: 400;
    font-size: 10px;
    }

    label.radio {
    cursor: pointer;
    }

    label.radio input {
    position: absolute;
    top: 0;
    left: 0;
    visibility: hidden;
    pointer-events: none;
    }

    label.radio span {
    padding: 1px 12px;
    border: 2px solid #ada9a9;
    display: inline-block;
    color: #8f37aa;
    border-radius: 3px;
    text-transform: uppercase;
    font-size: 11px;
    font-weight: 300;
    }

    label.radio input:checked + span {
    border-color: #fff;
    background-color: blue;
    color: #fff;
    }

    .credit-inputs {
    background: rgb(102,102,221);
    color: #fff !important;
    border-color: rgb(102,102,221);
    }

    .credit-inputs::placeholder {
    color: #fff;
    font-size: 13px;
    }

    .credit-card-label {
    font-size: 9px;
    font-weight: 300;
    }

    .form-control.credit-inputs:focus {
    background: rgb(102,102,221);
    border: rgb(102,102,221);
    }

    .line {
    border-bottom: 1px solid rgb(102,102,221);
    }

    .information span {
    font-size: 12px;
    font-weight: 500;
    }

    .information {
    margin-bottom: 5px;
    }

    .items {
    -webkit-box-shadow: 5px 5px 4px -1px rgba(0,0,0,0.25);
    box-shadow: 5px 5px 4px -1px rgba(0, 0, 0, 0.08);
    }

    .spec {
    font-size: 11px;
    }
</style>

<h2 style="text-align: center;margin-top:40px;" >GIỎ HÀNG CỦA BẠN</h2>
<div class="container mt-5 p-3 rounded cart">
    <div class="row no-gutters">
        <div class="col-md-8">
            <?php
               if(empty($_SESSION['carts']) || count($_SESSION['carts']) == 0) {
                    ?>  
                        <img style="display:block;margin:auto;"  src="/assets/upload/noitem.png" alt="">
                        <h4 style="text-align: center;">Vui lòng <span> <a style="text-decoration: none" href="/">thêm sản phẩm</a> </span> vào giỏ hàng ^^ </h4>
                    <?php
                }else{
                ?>

                    <div class="product-details mr-2">
                        <div class="d-flex flex-row align-items-center">
                            <a style="text-decoration: none" href="/"><i class="fa fa-long-arrow-left"></i>Tiếp tục mua sắm</a>
                        </div>
                        <hr>
                        <h6 class="mb-0">Số lượng sản phẩm : </h6>
                        <div class="d-flex justify-content-between"><span>Bạn có <span><b><?php echo count(($_SESSION['carts'])) ?></b></span> sản phẩm trong giỏ hàng</span>
                            <div class="d-flex flex-row align-items-center">
                                <span class="text-black-50">
                                    <form action="/deleteCarts" method="post" enctype="multipart/form-data">
                                        <button onclick="return confirm('Bạn có chắc chắn xóa không?')" type="submit" class="btn btn-secondary">Xóa tất cả</button>
                                    </form>
                                </span>
                            </div>
                        </div>

                        <?php
                            $total_money = 0;
                            foreach($_SESSION['carts'] as $key => $cart)
                            {
                        ?>

                            <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                                <div class="d-flex flex-row">
                                    <span style="text-align: center;">
                                        #<?php echo $key+1; ?>
                                    </span>
                                    <img class="rounded" src="<?php echo $cart->productImages; ?>" width="40">
                                    <div class="ml-2">
                                        <span style="margin-left:10px;" class="font-weight-bold d-block">Tên : 
                                            <?php echo $cart->productName; ?>
                                        </span>
                                        <span style="margin-left:10px;font-size:14px;" class="spec">
                                            <b>Giá : <?php echo currency_format($cart->productPriceSales) ?></b>
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center">
                                    <span class="d-block">Số lượng : <?php echo ($cart->quantity) ?></span>
                                    <span class="d-block ml-5 font-weight-bold"></span>
                                    <!-- <i class="fa fa-trash-o ml-3 text-black-50"></i> -->
                                    
                                </div>
                                <span>Tổng tiền : <?php echo currency_format($cart->productPriceSales * $cart->quantity); ?></span>
                                <form action="/deleteItemCart" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $key; ?>">
                                    <button onclick="return confirm('Bạn có chắc chắn xóa không?')" type="submit" class="btn btn-secondary">Xóa</button>
                                </form>
                                <?php $total_money += ($cart->productPriceSales * $cart->quantity) ?>
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                <?php
                    }
                ?>
           
        </div>

        <div class="col-md-4">
            <?php
               if(!empty($_SESSION['carts']) ) {
            ?> 
                <form action="/createOrder" method="post">
                    <div class="payment-info">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>HÓA ĐƠN ĐẶT HÀNG</span>
                            <img style="border-radius:50%;" class="rounded" src="<?php echo $_SESSION['user']['avatar']; ?>" width="50px" height="50px">
                        </div>

                        <!-- <span class="type d-block mt-3 mb-1">Phương thức thanh toán qua ngân hàng</span> -->
                        <label class="radio"> 
                            <input type="radio" name="card" value="payment" checked> 
                            <span><img width="30" src="https://img.icons8.com/color/48/000000/mastercard.png"/></span> 
                        </label>

                        <label class="radio"> <input type="radio" name="card" value="payment"> 
                        <span><img width="30" src="https://img.icons8.com/officel/48/000000/visa.png"/></span> </label>

                        <label class="radio"> <input type="radio" name="card" value="payment"> 
                        <span><img width="30" src="https://img.icons8.com/ultraviolet/48/000000/amex.png"/></span> </label>


                        <label class="radio"> <input type="radio" name="card" value="payment"> 
                        <span><img width="30" src="https://img.icons8.com/officel/48/000000/paypal.png"/></span> </label>

                        <div><label class="credit-card-label">Tên người mua hàng</label>
                        <input type="text" value="<?php echo $_SESSION['user']['name'] ?>"  class="form-control credit-inputs" placeholder="Name"></div>
                        
                        <div><label class="credit-card-label">Địa chỉ nhận hàng</label>
                        <input type="text" name="address" value="<?php echo $_SESSION['user']['address'] ?>" class="form-control credit-inputs" placeholder="Địa chỉ nhận hàng"></div>
                        
                        <div><label class="credit-card-label">Số điện thoại nhận hàng</label>
                        <input type="number" name="phone" value="<?php echo $_SESSION['user']['phone'] ?>"  class="form-control credit-inputs" placeholder="Số điện thoại"></div>

                        <div><label class="credit-card-label">Ghi chú đơn hàng</label>
                        <input  type="text" name="note" value=""  class="form-control credit-inputs" placeholder="Nhập ghi chú của bạn..."></div>
                        
                        <hr class="line">
                        <div class="d-flex justify-content-between information"></div>
                        <button class="btn btn-primary btn-block d-flex justify-content-between mt-3" type="button">
                            <span>TỔNG TIỀN : 
                                <?php
                                    if(empty($_SESSION['carts']) || count($_SESSION['carts']) == 0) {
                                        echo 0;
                                    }else{
                                        echo currency_format($total_money);
                                    }
                                ?>
                            </span>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">ĐẶT HÀNG</button>
                    </div>
                </form>
            <?php
               }
            ?>


            <?php
               if(empty($_SESSION['carts']) || count($_SESSION['carts']) == 0) {
            ?> 
                <form action="" method="">
                    <div class="payment-info">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>HÓA ĐƠN ĐẶT HÀNG</span>
                            <img style="border-radius:50%;" class="rounded" src="<?php echo $_SESSION['user']['avatar']; ?>" width="50px" height="50px">
                        </div>

                        <!-- <span class="type d-block mt-3 mb-1">Phương thức thanh toán qua ngân hàng</span> -->
                        <label class="radio"> 
                            <input type="radio" name="card" value="payment" checked> 
                            <span><img width="30" src="https://img.icons8.com/color/48/000000/mastercard.png"/></span> 
                        </label>

                        <label class="radio"> <input type="radio" name="card" value="payment"> 
                        <span><img width="30" src="https://img.icons8.com/officel/48/000000/visa.png"/></span> </label>

                        <label class="radio"> <input type="radio" name="card" value="payment"> 
                        <span><img width="30" src="https://img.icons8.com/ultraviolet/48/000000/amex.png"/></span> </label>


                        <label class="radio"> <input type="radio" name="card" value="payment"> 
                        <span><img width="30" src="https://img.icons8.com/officel/48/000000/paypal.png"/></span> </label>

                        <div><label class="credit-card-label">Tên người mua hàng</label>
                        <input type="text" value=""  class="form-control credit-inputs" placeholder="Name"></div>
                        
                        <div><label class="credit-card-label">Địa chỉ nhận hàng</label>
                        <input type="text" name="address" value="" class="form-control credit-inputs" placeholder="Địa chỉ nhận hàng"></div>
                        
                        <div><label class="credit-card-label">Số điện thoại nhận hàng</label>
                        <input type="number" name="phone" value=""  class="form-control credit-inputs" placeholder="Số điện thoại"></div>

                        <div><label class="credit-card-label">Ghi chú đơn hàng</label>
                        <input  type="text" name="note" value=""  class="form-control credit-inputs" placeholder="Nhập ghi chú của bạn..."></div>
                        
                        <hr class="line">
                        <div class="d-flex justify-content-between information"></div>
                        <button class="btn btn-primary btn-block d-flex justify-content-between mt-3" type="button">
                            <span>TỔNG TIỀN : 
                                0
                            </span>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">GIỎ HÀNG ĐANG TRỐNG</button>
                    </div>
                </form>
            <?php
               }
            ?>
        </div>
    </div>
</div>

<?php
    include_once(__DIR__.'./component/footer.php');
?>