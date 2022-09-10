<?php
include_once(__DIR__ . '/component/header.php');
include_once(__DIR__ . '/component/menu.php');
// include_once(__DIR__ . '/component/welcome.php');
?>


<!-- Section-->
<section class="py-5">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Mukta&display=swap');
        *{
            /* font-family: 'Mukta', sans-serif; */
            /* font-family: inherit; */
            margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-webkit-text-shadow: rgba(0,0,0,.01) 0 0 1px;text-shadow: rgba(0,0,0,.01) 0 0 1px
        }
        body{font-family: 'Rubik', sans-serif;font-size: 14px;font-weight: 400;background: #E0E0E0;color: #000000}ul{list-style: none;margin-bottom: 0px}.button{display: inline-block;background: #0e8ce4;border-radius: 5px;height: 48px;-webkit-transition: all 200ms ease;-moz-transition: all 200ms ease;-ms-transition: all 200ms ease;-o-transition: all 200ms ease;transition: all 200ms ease}.button a{display: block;font-size: 18px;font-weight: 400;line-height: 48px;color: #FFFFFF;padding-left: 35px;padding-right: 35px}.button:hover{opacity: 0.8}.cart_section{width: 100%;padding-top: 93px;padding-bottom: 111px}.cart_title{font-size: 30px;font-weight: 500}.cart_items{margin-top: 8px}.cart_list{border: solid 1px #e8e8e8;box-shadow: 0px 1px 5px rgba(0,0,0,0.1);background-color: #fff}.cart_item{width: 100%;padding: 15px;padding-right: 46px}.cart_item_image{width: 133px;height: 133px;float: left}.cart_item_image img{max-width: 100%}.cart_item_info{width: calc(100% - 133px);float: left;padding-top: 18px}.cart_item_name{margin-left: 7.53%}.cart_item_title{font-size: 14px;font-weight: 400;color: rgba(0,0,0,0.5)}.cart_item_text{font-size: 18px;margin-top: 35px}.cart_item_text span{display: inline-block;width: 20px;height: 20px;border-radius: 50%;margin-right: 11px;-webkit-transform: translateY(4px);-moz-transform: translateY(4px);-ms-transform: translateY(4px);-o-transform: translateY(4px);transform: translateY(4px)}.cart_item_price{text-align: right}.cart_item_total{text-align: right}.order_total{width: 100%;height: 60px;margin-top: 30px;border: solid 1px #e8e8e8;box-shadow: 0px 1px 5px rgba(0,0,0,0.1);padding-right: 46px;padding-left: 15px;background-color: #fff}.order_total_title{display: inline-block;font-size: 14px;color: rgba(0,0,0,0.5);line-height: 60px}.order_total_amount{display: inline-block;font-size: 18px;font-weight: 500;margin-left: 26px;line-height: 60px}.cart_buttons{margin-top: 60px;text-align: right}.cart_button_clear{display: inline-block;border: none;font-size: 18px;font-weight: 400;line-height: 48px;color: rgba(0,0,0,0.5);background: #FFFFFF;border: solid 1px #b2b2b2;padding-left: 35px;padding-right: 35px;outline: none;cursor: pointer;margin-right: 26px}.cart_button_clear:hover{border-color: #0e8ce4;color: #0e8ce4}.cart_button_checkout{display: inline-block;border: none;font-size: 18px;font-weight: 400;line-height: 48px;color: #FFFFFF;padding-left: 35px;padding-right: 35px;outline: none;cursor: pointer;vertical-align: top}
    </style>
    <h2 style="text-align: center;font-family: Arial, Helvetica, sans-serif;">ĐƠN HÀNG CỦA BẠN</h2>
    <div style="padding-top:24px;" class="cart_section">
        <div class="container-fluid">
            <hr>
            <?php 
                if(!empty($data['myorder'])) {
                    foreach($data['myorder'] as $order) {
            ?>
                <!-- đơn thứ  -->
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="cart_container">
                            <div style="color:blue;" class="cart_title">
                                <p>
                                    #<?php echo $order->id?>
                                    <span >
                                        <!-- <div class="cart_buttons">  -->
                                            <button style="float:right;background-color:#f41429;" type="button" class="button cart_button_checkout">
                                                <?php 
                                                    switch($order->status) {
                                                        case 1: echo "Chờ xác nhận"; break;
                                                        case 2: echo "Xác nhận đơn hàng"; break;
                                                        case 3: echo "Đang vận chuyển"; break;
                                                        case 4: echo "Giao hàng thành công"; break;
                                                        case 5: echo "Từ chối đơn hàng"; break;
                                                    }
                                                ?>
                                            </button> 
                                        <!-- </div> -->
                                    </span>
                                </p>
                            </div>
                            <div  style="
                                font-size:18px;
                                margin-top:10px;
                                
                                /* box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px; */
                                ">
                                <p>Địa chỉ nhận: <b><?php echo $order->address?></b> </p>
                                <p>SĐT nhận hàng: <b><?php echo $order->phone?></b> </p>
                                <p >Thời gian đặt hàng :<b> <?php echo(date("D-d-m-Y H:i:s",($order->created_at + 18000)));?> </b></p>
                                <p >Ghi chú :<b> <?php echo $order->note?> </b></p> 
                            </div>

                            <i style="font-size:16px;">(*) Bạn có <b><?php  echo count($order->details); ?></b> đơn hàng:</i>
                            <?php 
                                if(!empty($order->details)){
                                    foreach($order->details as $orderDetail) {
                                        // var_dump($orderDetail);die();
                            ?>
                                <div class="cart_items">
                                    <ul class="cart_list">
                                        <li class="cart_item clearfix">
                                            <div class="cart_item_image"><img src="<?php echo $orderDetail['product_image']; ?>" alt=""></div>
                                            <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                                <div class="cart_item_name cart_info_col">
                                                    <div class="cart_item_title">Tên sản phẩm</div>
                                                    <div class="cart_item_text"><?php echo $orderDetail['product_name'] ?></div>
                                                </div>
                                                <div class="cart_item_quantity cart_info_col">
                                                    <div class="cart_item_title">Số lượng</div>
                                                    <div class="cart_item_text"><?php echo $orderDetail['quantity'] ?></div>
                                                </div>
                                                <div class="cart_item_price cart_info_col">
                                                    <div class="cart_item_title">Giá / sản phẩm</div>
                                                    <div class="cart_item_text"><?php echo currency_format($orderDetail['price_buy']) ?></div>
                                                </div>
                                                <div class="cart_item_total cart_info_col">
                                                    <div class="cart_item_title">Tổng tiền</div>
                                                    <div class="cart_item_text"><?php echo currency_format($orderDetail['price_buy'] * $orderDetail['quantity']); ?></div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            <?php
                                    }
                                }
                            ?>
                            <div class="order_total">
                                <div class="order_total_content text-md-right">
                                    <div style="color:#000;font-weight:bold;" class="order_total_title">TỔNG TIỀN HÓA ĐƠN: </div>                                
                                    <div style="float:right ;font-weight:bolder;" class="order_total_amount"><?php echo currency_format($order->total_money) ?></div>
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div> <hr>

            <?php
                    }
                }else{
                    ?>  
                        <h3 style="text-align: center;" >Bạn chưa <a style="text-decoration:none;" href="/">mua sản phẩm</a> nào </h3>
                        <img style="display:block;margin:auto;" src="/assets/upload/noitem.png" alt="">
                    <?php
                }
            ?>
        </div>
    </div>

    
</section>

<?php

include_once(__DIR__ . '/component/footer.php');
?>
