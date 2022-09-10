<?php

include_once(__DIR__.'/BaseModel.php');

class User extends BaseModel{
    public $id;
    public $fullName;
    protected $_email;
    protected $_password;
    public $address;
    public $phone;
    protected $_supperAdmin = 0;
    protected $_staff = 0;
    public $avatar;
    // table name 
    private $__tableName = "users";

    // get data 
    public function getData(){
        $connect = new PDO('mysql:host=localhost;dbname=mobile_store','root','');
        $sql = "select * from users ";
        $row = $connect->query($sql);
        $data = $row->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    // create 
    public function create($request) {
        
        try {
            $connect = new PDO('mysql:host=localhost;dbname=mobile_store', 'root', '');

            $sql = "Insert into users (name, email, password, address, phone, supperAdmin, staff, avatar) 
                values (:name, :email, :password, :address, :phone, :supperAdmin, :staff, :avatar)";
            $sth = $connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

            if(!empty($request->permission)) {
                $supperAdmin = ($request->permission == 3) ? 1 : 0;
                $staff = ($request->permission == 2) ? 1 : 0;
            } else {
                $supperAdmin = 0;
                $staff = 0;
            }

            $sth->execute([
                "name" => $request->name,
                "email" => $request->email,
                "password" => md5($request->password),
                "phone" => $request->phone,
                "address" => $request->address,       
                "supperAdmin" => $supperAdmin,
                "staff" => $staff,
                "avatar" => $request->avatar    
            ]);

            return true;
        } catch (PDOException $e) {
            return false; 
        }
    }
    /**
     // thực hiện công việc call db trên sql 
     // find id để update 
     **/
    public function find($id){
        $connect = new PDO('mysql:host=localhost;dbname=mobile_store','root','');
        $sql = "select * from users where id = {$id}";
        $row = $connect->query($sql);
        $data = $row->fetchAll(PDO::FETCH_ASSOC);
        
        return (!empty($data[0])) ? $data[0] : [];
    }

    // kiểm tra email tồn tại trong hệ thống hay chưa 
    public function findUserByEmail($email){
        $connect = new PDO('mysql:host=localhost;dbname=mobile_store','root','');
        $sql = "select * from users where email = '{$email}'";
        $row = $connect->query($sql);
        $data = $row->fetchAll(PDO::FETCH_ASSOC);
        
        return (!empty($data[0])) ? $data[0] : [];
    }
    // update 
    // clean ý tưởng là cập nật những bản ghi nào thì phải có id 
    // nắm bắt thông tin đã chỉn sửa trên bản ghi thông qua các request 
    public function update($id, $request){
        try{
            $connect = new PDO('mysql:host=localhost;dbname=mobile_store','root','');
            if(!empty($request->password)){
                $sql = "update users set name=?, address=?, password=?, supperAdmin=?, staff=?, avatar=? where id=?";
                
                $stmt = $connect->prepare($sql);

                $supperAdmin = ($request->permission == 3) ? 1 : 0;
                $staff = ($request->permission == 2) ? 1 : 0;;

                $stmt->execute([
                    $request->name,
                    $request->address,
                    md5($request->password),
                    $supperAdmin,
                    $staff,
                    $request->avatar,
                    $id
                ]);

                return true;
            }else{
                $sql = "update users set name=?, address=?, supperAdmin=?, staff=?, avatar=? where id=?";
                $stmt = $connect->prepare($sql);

                $supperAdmin = ($request->permission == 3) ? 1 : 0;
                $staff = ($request->permission == 2) ? 1 : 0;;

                $stmt->execute([
                    $request->name,
                    $request->address,
                    $supperAdmin,
                    $staff,
                    $request->avatar,
                    $id
                ]);

                return true;
            }
        }catch(PDOException $e){
            return false;
        }
    }


    // delete
    public function delete($id){
        try{
            $connect = new PDO('mysql:host=localhost;dbname=mobile_store','root','');
            $sql = "delete from users where id = :id";
            $sth = $connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute([
                'id' => $id
            ]);
            
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function login($email, $password) {
        $password = md5($password);

        $connect = new PDO('mysql:host=localhost;dbname=mobile_store', 'root', '');
        $sql = "select * from users where email = '{$email}' and password = '{$password}'";
        $row = $connect->query($sql);
        $data =  $row->fetchAll(PDO::FETCH_ASSOC);

        // đã lấy được avatar => cần sửa lại chỗ này 
        // var_dump($data);die();


        return (!empty($data[0])) ?  $data[0] : [];
    }

    // timf kieems thoong tin nguoiwf dungf 
    public function searchUser($name){
        $connect = new PDO('mysql:host=localhost;dbname=mobile_store','root','');
        $sql = "select * from users where name like '%{$name}%'";
        $row = $connect->query($sql);
        $data = $row->fetchAll(PDO::FETCH_ASSOC);
        
        return  $data;
    }
}