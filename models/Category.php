<?php

include_once(__DIR__.'/BaseModel.php');

class Category extends BaseModel {


    public function getAllData(){
        $connect = new PDO('mysql:host=localhost;dbname=mobile_store', 'root', '');
        $sql = "select * from categories";
        $row = $connect->query($sql);
        $data =  $row->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    // public function create($request) {
    //     try {
    //         $connect = new PDO('mysql:host=localhost;dbname=mobile_store', 'root', '');

    //         $sql = "Insert into categories (name, slug, parent_id, type) 
    //             values (?,?,?,?)";
    //         $sth = $connect->prepare($sql);

    //         $sth->execute([
    //             $request->name,
    //             create_slug($request->name),
    //             $request->parent_id,
    //             $request->type
    //         ]);

    //         return true;
    //     } catch (PDOException $e) {
    //         return false; 
    //     }
    // }

    public function create($request) {
        try {
            $connect = new PDO('mysql:host=localhost;dbname=mobile_store', 'root', '');

            $sql = "Insert into categories (name, slug, type) 
                values (?,?,?)";
            $sth = $connect->prepare($sql);

            $sth->execute([
                $request->name,
                create_slug($request->name),
                // $request->parent_id,
                $request->type
            ]);

            return true;
        } catch (PDOException $e) {
            return false; 
        }
    }

    public function delete($id) {
        try {
            $connect = new PDO('mysql:host=localhost;dbname=mobile_store', 'root', '');
            $sql = "delete from categories where id = :id";
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
        $sql = "select * from categories where id = {$id}";
        $row = $connect->query($sql);
        $data =  $row->fetchAll(PDO::FETCH_ASSOC);

        return (!empty($data)) ? $data[0] : [];
    }

    // public function update($id, $request) {
    //     try{
    //         $connect = new PDO('mysql:host=localhost;dbname=mobile_store', 'root', '');
    //         $sql = "UPDATE categories SET name=?, slug=?, parent_id=?, type=? WHERE id=?";
    //         $stmt= $connect->prepare($sql);
            
    //         $stmt->execute([
    //             $request->name,
    //             create_slug($request->name),
    //             $request->parent_id,
    //             $request->type,
    //             $id
    //         ]);

    //         return true;
    //     }catch (PDOException $e) {
    //         return false;
    //     }
    // }

    public function update($id, $request) {
        try{
            $connect = new PDO('mysql:host=localhost;dbname=mobile_store', 'root', '');
            $sql = "UPDATE categories SET name=?, slug=?, type=? WHERE id=?";
            $stmt= $connect->prepare($sql);
            
            $stmt->execute([
                $request->name,
                create_slug($request->name),
                // $request->parent_id,
                $request->type,
                $id
            ]);

            return true;
        }catch (PDOException $e) {
            return false;
        }
    }

    public function findBySlug($slug) {
        $connect = new PDO('mysql:host=localhost;dbname=mobile_store', 'root', '');
        $sql = "select * from categories where slug = '{$slug}'";
        $row = $connect->query($sql);
        $data =  $row->fetchAll(PDO::FETCH_ASSOC);

        return (!empty($data)) ? $data[0] : [];
    }

    public function searchCategory($name){
        $connect = new PDO('mysql:host=localhost;dbname=mobile_store','root','');
        $sql = "select * from categories where name like '%{$name}%'";
        $row = $connect->query($sql);
        $data = $row->fetchAll(PDO::FETCH_ASSOC);
        
        return  $data;
    }
}