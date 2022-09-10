<?php

include_once(__DIR__.'/BaseModel.php');

class Product extends BaseModel {

    public function getAllData(){
        $connect = new PDO('mysql:host=localhost;dbname=mobile_store', 'root', '');
        $sql = "select * from products";
        $row = $connect->query($sql);
        $data =  $row->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function getAllDataByCategoryId($id) {
        $connect = new PDO('mysql:host=localhost;dbname=mobile_store', 'root', '');
        $sql = "select * from products where category_id = {$id}";
        $row = $connect->query($sql);
        $data =  $row->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function create($request) {
        try {
            $connect = new PDO('mysql:host=localhost;dbname=mobile_store', 'root', '');

            $sql = "Insert into products (name, slug, description, content, price, price_sale, category_id, images) 
                values (?,?,?,?,?,?,?,?)";
            $sth = $connect->prepare($sql);

            $sth->execute([
                $request->name,
                create_slug($request->name),
                $request->description,
                $request->content,
                $request->price,
                $request->price_sale,
                $request->category_id,
                $request->images
            ]);

            return true;
        } catch (PDOException $e) {
            return false; 
        }
    }

    public function delete($id) {
        try {
            $connect = new PDO('mysql:host=localhost;dbname=mobile_store', 'root', '');
            $sql = "delete from products where id = :id";
            $sth = $connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute([
                'id' => $id
            ]);

            return true;
        }catch (PDOException $e) {
            return false;
        }
    }    

    public function find($id) {
        $connect = new PDO('mysql:host=localhost;dbname=mobile_store', 'root', '');
        $sql = "select * from products where id = {$id}";
        $row = $connect->query($sql);
        $data =  $row->fetchAll(PDO::FETCH_ASSOC);

        return (!empty($data)) ? $data[0] : [];
    }

    public function update($id, $request) {
        try{
            $connect = new PDO('mysql:host=localhost;dbname=mobile_store', 'root', '');
            $sql = "UPDATE products SET name=?, slug=?, description=?, content=?, price=?, price_sale=?,category_id=?, images=?  WHERE id=?";
            $stmt= $connect->prepare($sql);
            
            $stmt->execute([
                $request->name,
                create_slug($request->name),
                $request->description,
                $request->content,
                $request->price,
                $request->price_sale,
                $request->category_id,
                $request->images,
                $id
            ]);

            return true;
        }catch (PDOException $e) {
            // var_dump($e); die();
            return false;
        }
    }

    public function getProductBySlug($slug) {
        try {
            $connect = new PDO('mysql:host=localhost;dbname=mobile_store', 'root', '');
            $sql = "select * from products where slug = '{$slug}'";
            $row = $connect->query($sql);
            $data =  $row->fetchAll(PDO::FETCH_ASSOC);

            return (!empty($data)) ? $data[0] : [];
        }catch (PDOException $e) {
            return [];
        }
    }

    // tìm kiếm sản phẩm cho người dùng
    public function searchProduct($name){
        $connect = new PDO('mysql:host=localhost;dbname=mobile_store','root','');
        $sql = "select * from products where name like '%{$name}%'";
        $row = $connect->query($sql);
        $data = $row->fetchAll(PDO::FETCH_ASSOC);
        
        return  $data;
    }
}