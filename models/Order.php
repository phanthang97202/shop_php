<?php

include_once(__DIR__.'/BaseModel.php');

class Order extends BaseModel {

    public function create($request) {
        try {
            $connect = new PDO('mysql:host=localhost;dbname=mobile_store', 'root', '');

            $sql = "Insert into orders (user_id, total_money, created_at, status, note, address, phone) 
                values (?,?,?,?,?,?,?)";
            $sth = $connect->prepare($sql);
            $status = 1;
            
            $sth->execute([
                $request->user_id,
                $request->total_money,
                time(),
                $status,
                $request->note,
                $request->address,
                $request->phone
            ]);

            return true;
        } catch (PDOException $e) {
            return false; 
        }
    }

    public function findFirstOrderByUser($id) {
        $connect = new PDO('mysql:host=localhost;dbname=mobile_store', 'root', '');
        $sql = "select * from orders where user_id = {$id} order by id desc";
        $row = $connect->query($sql);
        $data =  $row->fetchAll(PDO::FETCH_ASSOC);

        return (!empty($data)) ? $data[0] : [];   
    }

    public function getAllOrderForUser($id) {
        $sql = "SELECT * from orders where orders.user_id = {$id}";
        $connect = new PDO('mysql:host=localhost;dbname=mobile_store', 'root', '');
        
        $rowOrder = $connect->query($sql);
        $orders =  $rowOrder->fetchAll(PDO::FETCH_ASSOC);
        $data = [];

        if(count($orders)> 0) {
            foreach($orders as $order) {
                $sql_detail = "SELECT order_details.*, products.name as product_name, products.images as product_image  
                    from order_details 
                    join products on products.id = order_details.product_id
                    WHERE order_id = {$order['id']}";
                $rowOrderDetail = $connect->query($sql_detail);
                $orderDetail = $rowOrderDetail->fetchAll(PDO::FETCH_ASSOC);

                $order = (object)$order;
                $order->details = $orderDetail;
                $data[] = $order;
            }
        }
        
        return $data;
    }
    
    
    public function getAllOrderAdmin() {
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
                    WHERE order_id = {$order['id']}";
                $rowOrderDetail = $connect->query($sql_detail);
                $orderDetail = $rowOrderDetail->fetchAll(PDO::FETCH_ASSOC);

                $order = (object)$order;
                $order->details = $orderDetail;
                $data[] = $order;
            }
        }
        
        return $data;
    }

    public function updateStatus($id, $status){
        try{
            $connect = new PDO('mysql:host=localhost;dbname=mobile_store', 'root', '');
            $sql = "UPDATE orders SET status=? WHERE id=?";
            $stmt= $connect->prepare($sql);
            
            $stmt->execute([
                $status,
                $id
            ]);

            return true;
        }catch (PDOException $e) {
            return false;
        }
    }

}