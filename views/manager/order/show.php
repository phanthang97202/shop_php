<div class="receipt-content">
    <div class="container bootstrap snippets bootdey">
    <div class="row">
        <div class="col-md-12">
        <?php 
            foreach ($data['orders'] as $key => $row) {
        ?>
            <div class="invoice-wrapper">
            <div class="payment-info">
                <div class="row">
                <div class="col-sm-6">
                    <strong>
                    #<?php echo $row->id; ?>
                    <span><a href="/admin/orders/exportBill?id=<?php echo $row->id; ?>" class="btn btn-danger ti-download" ></a></span>
                    </strong>
                    
                </div>
                </div>
                
            </div>

            <div class="payment-details">
                <div class="row">
                <div class="col-sm-6">
                    <p>
                    <b>Tên khách hàng:</b> <?php echo $row->username; ?>
                    </p>
                    <p>
                    <b>Số điện thoại:</b> <?php echo $row->phone; ?><br>
                    <p >
                        <b>Email:</b> <a style="color:violet;" href=""><?php echo $row->useremail; ?></a>
                    </p>
                    </p>
                </div>
                <div class="col-sm-6 text-right">
                    <p>
                    <b>Địa chỉ:</b> <?php echo $row->address; ?>
                    </p>
                    <p>
                    <b>Thời gian mua hàng:</b> <?php echo(date("d-m-Y",$row->created_at)); ?>
                    </p>
                    <p>
                    <b>Ghi chú:</b> <?php echo $row->note; ?> <br>
                    </p>
                </div>
                <form style="width:24%;margin-left:15px;" action="/admin/orders/update" method="post">
                    <input type="hidden" name="id" value="<?php echo $row->id; ?>">
                    <select name="status" class="form-control">
                        <option value="1" <?php echo ($row->status == 1) ? "selected" : '' ?>>Chờ xác nhận</option>
                        <option value="2" <?php echo ($row->status == 2) ? "selected" : '' ?>>Xác nhận đơn hàng</option>
                        <option value="3" <?php echo ($row->status == 3) ? "selected" : '' ?>>Đang vận chuyển</option>
                        <option value="4" <?php echo ($row->status == 4) ? "selected" : '' ?>>Giao hàng thành công</option>
                        <option value="5" <?php echo ($row->status == 5) ? "selected" : '' ?>>Từ chối đơn hàng</option>
                    </select>
                    <button type="submit" class="btn btn-primary mt-2">Cập nhật trạng thái</button>
                </form>
                </div>
            </div>
            <div class="line-items">
                <hr>
                <?php 
                    if(!empty($row->details)){
                        foreach($row->details as $orderDetail) {
                ?>
                <div class="items">
                    <div style="display:block;margin:0;"  class="row item">
                    <div class="col-xs-4 desc">
                        Tên sản phẩm: <?php echo $orderDetail['product_name'] ?>
                    </div> 
                    <div class="col-xs-3 qty">
                        Số lượng: <?php echo $orderDetail['quantity'] ?>
                    </div> 
                    <div style="float:left;" class="col-xs-5 amount text-right">
                        Tổng tiền: <?php echo currency_format($orderDetail['price_buy']) ?>
                        
                    </div> <br>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
                <div class="total text-right">
                <div class="field grand-total">
                    Tổng tiền hóa đơn: <span style="font-size:20px;" ><?php echo currency_format($row->total_money); ?></span>
                </div>
                </div>
                
            </div>
            </div>
        <?php
            }
        ?>
        </div>
    </div>
</div>