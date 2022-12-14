<?php
include_once(__DIR__ . '/../component/header.php')
?>

<?php
include_once(__DIR__ . '/../component/menu.php')
?>

<div class="pcoded-inner-content">
  <div class="main-body">
    <div class="page-wrapper">
      <div class="page-body">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Orders Detail</h1>
        </div>

        <?php
        include_once(__DIR__ . '/../component/alert.php')
        ?>

        <style type="text/css">
          .receipt-content .logo a:hover {
            text-decoration: none;
            color: #7793C4;
          }

          .receipt-content .invoice-wrapper {
            background: #FFF;
            border: 1px solid #CDD3E2;
            box-shadow: 0px 0px 1px #CCC;
            padding: 40px 40px 60px;
            margin-top: 40px;
            border-radius: 4px;
          }

          .receipt-content .invoice-wrapper .payment-details span {
            color: #A9B0BB;
            display: block;
          }

          .receipt-content .invoice-wrapper .payment-details a {
            display: inline-block;
            margin-top: 5px;
          }

          .receipt-content .invoice-wrapper .line-items .print a {
            display: inline-block;
            border: 1px solid #9CB5D6;
            padding: 13px 13px;
            border-radius: 5px;
            color: #708DC0;
            font-size: 13px;
            -webkit-transition: all 0.2s linear;
            -moz-transition: all 0.2s linear;
            -ms-transition: all 0.2s linear;
            -o-transition: all 0.2s linear;
            transition: all 0.2s linear;
          }

          .receipt-content .invoice-wrapper .line-items .print a:hover {
            text-decoration: none;
            border-color: #333;
            color: #333;
          }

          .receipt-content {
            background: #ECEEF4;
          }

          @media (min-width: 1200px) {
            .receipt-content .container {
              width: 900px;
            }
          }

          .receipt-content .logo {
            text-align: center;
            margin-top: 50px;
          }

          .receipt-content .logo a {
            font-family: Myriad Pro, Lato, Helvetica Neue, Arial;
            font-size: 36px;
            letter-spacing: .1px;
            color: #555;
            font-weight: 300;
            -webkit-transition: all 0.2s linear;
            -moz-transition: all 0.2s linear;
            -ms-transition: all 0.2s linear;
            -o-transition: all 0.2s linear;
            transition: all 0.2s linear;
          }

          .receipt-content .invoice-wrapper .intro {
            line-height: 25px;
            color: #444;
          }

          .receipt-content .invoice-wrapper .payment-info {
            margin-top: 25px;
            padding-top: 15px;
          }

          .receipt-content .invoice-wrapper .payment-info span {
            color: #A9B0BB;
          }

          .receipt-content .invoice-wrapper .payment-info strong {
            display: block;
            color: #444;
            margin-top: 3px;
          }

          @media (max-width: 767px) {
            .receipt-content .invoice-wrapper .payment-info .text-right {
              text-align: left;
              margin-top: 20px;
            }
          }

          .receipt-content .invoice-wrapper .payment-details {
            border-top: 2px solid #EBECEE;
            margin-top: 30px;
            padding-top: 20px;
            line-height: 22px;
          }


          @media (max-width: 767px) {
            .receipt-content .invoice-wrapper .payment-details .text-right {
              text-align: left;
              margin-top: 20px;
            }
          }

          .receipt-content .invoice-wrapper .line-items {
            margin-top: 40px;
          }

          .receipt-content .invoice-wrapper .line-items .headers {
            color: #A9B0BB;
            font-size: 13px;
            letter-spacing: .3px;
            border-bottom: 2px solid #EBECEE;
            padding-bottom: 4px;
          }

          .receipt-content .invoice-wrapper .line-items .items {
            margin-top: 8px;
            border-bottom: 2px solid #EBECEE;
            padding-bottom: 8px;
          }

          .receipt-content .invoice-wrapper .line-items .items .item {
            padding: 10px 0;
            color: #696969;
            font-size: 15px;
          }

          @media (max-width: 767px) {
            .receipt-content .invoice-wrapper .line-items .items .item {
              font-size: 13px;
            }
          }

          .receipt-content .invoice-wrapper .line-items .items .item .amount {
            letter-spacing: 0.1px;
            color: #84868A;
            font-size: 16px;
          }

          @media (max-width: 767px) {
            .receipt-content .invoice-wrapper .line-items .items .item .amount {
              font-size: 13px;
            }
          }

          .receipt-content .invoice-wrapper .line-items .total {
            margin-top: 30px;
          }

          .receipt-content .invoice-wrapper .line-items .total .extra-notes {
            float: left;
            width: 40%;
            text-align: left;
            font-size: 13px;
            color: #7A7A7A;
            line-height: 20px;
          }

          @media (max-width: 767px) {
            .receipt-content .invoice-wrapper .line-items .total .extra-notes {
              width: 100%;
              margin-bottom: 30px;
              float: none;
            }
          }

          .receipt-content .invoice-wrapper .line-items .total .extra-notes strong {
            display: block;
            margin-bottom: 5px;
            color: #454545;
          }

          .receipt-content .invoice-wrapper .line-items .total .field {
            margin-bottom: 7px;
            font-size: 14px;
            color: #555;
          }

          .receipt-content .invoice-wrapper .line-items .total .field.grand-total {
            margin-top: 10px;
            font-size: 16px;
            font-weight: 500;
          }

          .receipt-content .invoice-wrapper .line-items .total .field.grand-total span {
            color: #20A720;
            font-size: 16px;
          }

          .receipt-content .invoice-wrapper .line-items .total .field span {
            display: inline-block;
            margin-left: 20px;
            min-width: 85px;
            color: #84868A;
            font-size: 15px;
          }

          .receipt-content .invoice-wrapper .line-items .print {
            margin-top: 50px;
            text-align: center;
          }



          .receipt-content .invoice-wrapper .line-items .print a i {
            margin-right: 3px;
            font-size: 14px;
          }

          .receipt-content .footer {
            margin-top: 40px;
            margin-bottom: 110px;
            text-align: center;
            font-size: 12px;
            color: #969CAD;
          }
        </style>

        <p>
          (*) B???n ??ang c??
          <b>
            <?php echo count($data['orders']); ?>
          </b>
          ????n h??ng ???? ???????c mua
        </p>

        <div class="receipt-content">
          <div class="container bootstrap snippets bootdey">
            <div class="row">
              <div class="col-md-12">
                <?php
                foreach ($data['orders'] as $key => $row) {
                  // var_dump($data['orders']);die();
                ?>
                  <div class="invoice-wrapper">
                    <div class="payment-info">
                      <a style="float:right;border: 1px solid #fff; padding:5px; background-color: #448aff;color:#fff" class=" ti-download" href="/admin/orders/exportBill?id=<?php echo $row->id; ?>"></a>

                      <div class="row">
                        <div class="col-sm-6">
                          <strong>
                            #<?php echo $row->id; ?>
                          </strong>

                        </div>
                      </div>

                    </div>

                    <div class="payment-details">
                      <div class="row">
                        <div class="col-sm-6">
                          <p>
                            <b>T??n kh??ch h??ng:</b> <?php echo $row->username; ?>
                          </p>
                          <p>
                            <b>S??? ??i???n tho???i:</b> <?php echo $row->phone; ?><br>
                          <p>
                            <b>Email:</b> <a style="color:violet;" href=""><?php echo $row->useremail; ?></a>
                          </p>
                          </p>
                        </div>
                        <div class="col-sm-6 text-right">
                          <p>
                            <b>?????a ch???:</b> <?php echo $row->address; ?>
                          </p>
                          <p>
                            <b>Th???i gian mua h??ng:</b> <?php echo (date("D-d-m-Y H:i:s", ($row->created_at + 18000))); ?>
                          </p>
                          <p>
                            <b>Ghi ch??:</b> <?php echo $row->note; ?> <br>
                          </p>
                        </div>
                        <form style="width:24%;margin-left:15px;" action="/admin/orders/update" method="post">
                          <input type="hidden" name="id" value="<?php echo $row->id; ?>">
                          <select name="status" class="form-control">
                            <option value="1" <?php echo ($row->status == 1) ? "selected" : '' ?>>Ch??? x??c nh???n</option>
                            <option value="2" <?php echo ($row->status == 2) ? "selected" : '' ?>>X??c nh???n ????n h??ng</option>
                            <option value="3" <?php echo ($row->status == 3) ? "selected" : '' ?>>??ang v???n chuy???n</option>
                            <option value="4" <?php echo ($row->status == 4) ? "selected" : '' ?>>Giao h??ng th??nh c??ng</option>
                            <option value="5" <?php echo ($row->status == 5) ? "selected" : '' ?>>T??? ch???i ????n h??ng</option>
                          </select>
                          <button type="submit" class="btn btn-primary mt-2">C???p nh???t tr???ng th??i</button>
                        </form>
                      </div>
                    </div>
                    <div class="line-items">
                      <hr>
                      <?php
                      if (!empty($row->details)) {
                        foreach ($row->details as $orderDetail) {
                      ?>
                          <div class="items">
                            <div style="display:block;margin:0;" class="row item">
                              <div class="col-xs-4 desc">
                                T??n s???n ph???m: <?php echo $orderDetail['product_name'] ?>
                              </div>
                              <div class="col-xs-3 qty">
                                S??? l?????ng: <?php echo $orderDetail['quantity'] ?>
                              </div>
                              <div style="float:left;" class="col-xs-5 amount text-right">
                                T???ng ti???n: <?php echo currency_format($orderDetail['price_buy']) ?>

                              </div> <br>
                            </div>
                          </div>
                      <?php
                        }
                      }
                      ?>
                      <div class="total text-right">
                        <div class="field grand-total">
                          T???ng ti???n h??a ????n: <span style="font-size:20px;"><?php echo currency_format($row->total_money); ?></span>
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
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include_once(__DIR__ . '/../component/footer.php')
?>