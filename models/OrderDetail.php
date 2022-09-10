<?php

include_once(__DIR__.'/BaseModel.php');

class OrderDetail extends BaseModel {

    public function create($request) {
        try {
            $connect = new PDO('mysql:host=localhost;dbname=mobile_store', 'root', '');

            $sql = "Insert into order_details (order_id, product_id, price_buy, quantity, created_at) 
                values (?,?,?,?,?)";
            $sth = $connect->prepare($sql);

            $sth->execute([
                $request->order_id,
                $request->product_id,
                $request->price_buy,
                $request->quantity,
                time()
            ]);

            return true;
        } catch (PDOException $e) {
            return false; 
        }
    }

    public function findOrder($id){
        // $connect = new PDO('mysql:host=localhost;dbname=mobile_store', 'root', '');
        // // $sql = "select * from order_details where order_id = {$id}";
        // $sql = "SELECT order_details.*, products.name as product_name, products.images as product_image  
        //         from order_details 
        //         join products on products.id = order_details.product_id
        //         WHERE order_id = {$id}";
        // $row = $connect->query($sql);
        // $data =  $row->fetchAll(PDO::FETCH_ASSOC);

        // echo '<pre>';
        // var_dump($data);die();

        // var_dump(count($data));

        // return (!empty($data)) ? $data[0] : [];

        $sql = "SELECT orders.*, users.name as username, users.email as useremail from orders 
        join users on users.id = orders.user_id";
        $connect = new PDO('mysql:host=localhost;dbname=mobile_store', 'root', '');
        
        $rowOrder = $connect->query($sql);
        $orders =  $rowOrder->fetchAll(PDO::FETCH_ASSOC);
        $data = [];

        if(count($orders)> 0) {
            foreach($orders as $order) {
                $sql_detail = "SELECT order_details.*, products.name as product_name, products.images as product_image  
                    from order_details 
                    join products on products.id = order_details.product_id
                    WHERE order_id = {$id}";
                $rowOrderDetail = $connect->query($sql_detail);
                $orderDetail = $rowOrderDetail->fetchAll(PDO::FETCH_ASSOC);

                $order = (object)$order;
                $order->details = $orderDetail;
                $data[] = $order;
            }
        }
        

        // return $data;
        return (!empty($data)) ? $data[0] : [];
    }
}