<?php

include_once(__DIR__.'/../BaseController.php');

include_once(__DIR__.'/../../models/Category.php');
include_once(__DIR__.'/../../models/Product.php');
include_once(__DIR__.'/../../models/User.php');
include_once(__DIR__.'/../../models/Order.php');
include_once(__DIR__.'/../../models/OrderDetail.php');

class CartController extends BaseController{

    public function addToCart(){
        $data = [];

        // nếu thành công lấy post thì sẽ thực hiện công việc trong hàn 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $request = (object)$_POST;
            // echo '<pre>';
            // var_dump($request);die();
            $error = [];

            if(empty($_SESSION['carts'])){
                $_SESSION['carts'] = [];
            }

            // check sản phẩm đã tồn tại trong giỏ hàng 

            $check = false;
            foreach($_SESSION['carts'] as $key => $cart){
                if($cart->productId == $request->productId){
                    $check = true;
                    $_SESSION['carts'][$key]->quantity = $_SESSION['carts'][$key]->quantity + $request->quantity;
                }
            }

            if(!$check){
                $productModel = new Product();
                $product = $productModel->find($request->productId);
    
                if($product){
                    $_SESSION['carts'][] = (object)[
                        "productId" => $product['id'],
                        "productName" => $product['name'],
                        "productSlug" => $product['slug'],
                        "productImages" => $product['images'],
                        "productPrice" => $product['price'],
                        "productPriceSales" => $product['price_sale'],
                        "productCategoryId" => $product['category_id'],
                        "quantity" => $request->quantity
                    ];
                    
                    // echo '<pre>';
                    // var_dump($_SESSION['carts']);die();
    
                    $_SESSION['userAlertSuccess'] = "Thêm vào giỏ hàng thành công!";
                }else{
                    $_SESSION['userAlertDanger'] = "Thêm vào giỏ hàng thất bại!";
                }
                // var_dump($request);die();
            }else{
                    $_SESSION['userAlertSuccess'] = "Cập nhật số lượng đơn hàng thành công!";
            }

        }

        // nếu không có thì ở lại chính trang đó 
        if(isset($_SERVER['HTTP_REFERER'])){
            header("Location: ". $_SERVER['HTTP_REFERER']);
        }

        header('Location: /');
    }

    // render giỏ hàng  
    public function carts(){

        return $this->renderViewFrontend('user/carts');
    }


    // xóa item trong giỏ hàng 
    public function deleteItemCart()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $request = (object)$_POST;
            if(isset($request->id))
            {
                unset($_SESSION['carts'][$request->id]);
            }
        }
        header('Location: /carts');
        // echo "đã xóa";
    }

    // cập nhật giỏ hàng 

    // xóa toàn bộ giỏ hàng 
    public function deleteCarts(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            unset($_SESSION['carts']);
        }
        header('Location: /carts');
    }



    // ---------------------------------------------------------------------------
    // chức năng đặt hàng 
    public function createOrder()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $user = $_SESSION['user'];
            $carts = $_SESSION['carts'];
            $request = (object)$_POST;
            // tạo bản ghi đặt hàng order 
            $orderModel = new Order();
            $orderDetailModel = new OrderDetail();
            // lấy ra id người đặt hàng 
            $request->user_id = $user['id'];
            // tính tổng tiền thanh toán 
            $request->total_money = $this->countTotalMoney($carts);
            // tạo bản ghi đặt hàng vào db 
            $order = $orderModel->create($request);

            // var_dump($order);die();
            // nếu true thì thực hiện : .....
            if($order)
            {
                // tạo dữ liệu order detail cho admin xử lý 
                $row = $orderModel->findFirstOrderByUser($request->user_id);
                // var_dump($row);die();

                    if(count($row))
                    {
                        foreach($carts as $cart)
                        {
                            $requestOrderDetail = (object)[
                                'order_id' => $row['id'],
                                'product_id' => $cart->productId,
                                'price_buy' => $cart->productPriceSales,
                                'quantity' => $cart->quantity
                            ];

                            $st = $orderDetailModel->create($requestOrderDetail);
                        }
                        // đặt hàng thnahf công thì => 
                        unset($_SESSION['carts']);
                        $_SESSION['userAlertSuccess'] = 'Đặt hàng thành công !';
                        return header('Location: /');
                    }
                
            }
            $_SESSION['userAlertDanger'] = 'Đặt hàng thất bại! Thử lại sau !';
        }
        // thành công thì trả về trang chủ 
        return header('Location: /carts');
    }

    public function countTotalMoney($carts){
        $total = 0;
        foreach($carts as $cart){
            $total = $total + ($cart->productPriceSales * $cart->quantity);
        }
        return $total;
    }

    public function myOrder(){
        $user = $_SESSION['user'];
        $orderModel = new Order();

        $data['myorder'] = $orderModel->getAllOrderForUser($user['id']);
        // echo "<pre/>";
        // var_dump($data['myorder']);die();
        return $this->renderViewFrontend('user/myOrder', $data);
    }
}