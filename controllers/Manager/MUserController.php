<?php

include_once(__DIR__.'/../BaseController.php');

// link file chức năng thêm sửa xóa của người dùng vào 
include_once(__DIR__.'/../../models/User.php');

class MUserController extends BaseController{
    public function index(){
        $user = new User();
        $data = $user->getData();

        // var_dump($data);

        // trỏ đến đưuòng dẫn file index.php view 
        // của chỉnh sửa tài khoản người dùng 
        return $this->renderView('manager/users/index',$data);
    }


    // thêm tài khoản người dùng 
    public function create(){
        $data = [];
        $user = new User();
        

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $request = (object)$_POST;
            
            $error = [];

            if($request->name == ''){
                $error[] = 'Tên không được để trống';
            }

            if($request->email == ''){
                $error[] = 'Email không được để trống';
            }

            if($request->password == ''){
                $error[] = 'Password không được để trống';
            }

            if($request->password != $request->repassword){
                $error[] = 'Mật khẩu không khớp';
            }

            // if($request->avatar == ''){
            //     $error[] = 'Avatar không được để trống';
            // }

            // var_dump($request); die();

            if(count($error) == 0){
                // $user = new User();
                $pathAvatar = '';
                if(!empty($_FILES['avatar']) && $_FILES['avatar']['size'] > 0 ){
                    $filename = time().'_' . $_FILES['avatar']['name'];
                    $temp_file = $_FILES['avatar']['tmp_name'];
                    $pathAvatar = "assets/upload/{$filename}";
                    move_uploaded_file($temp_file, $pathAvatar);
                }
                $request->avatar = $pathAvatar;

                // call database lên server
                // cheeck trạng thái : nếu gọi thành công thì nlà true còn thất bại là false
                // khi call db
                $status = $user->create($request);
                if($status){
                    $_SESSION['alertSuccess'] = "Tạo mới thành công";
                    header('Location: /admin/customers');
                }else{
                    $_SESSION['alertDanger'] = "Tạo mới không thành công";
                    var_dump($error);

                }
            }
            
            $data['error'] = $error;
            $data['oldValue'] = $_POST;
        }
        return $this->renderView('manager/users/create', $data);
    }

    // thực hiện công việc xóa người dùng 
    public function delete(){
        $id = $_GET['id'];

        $user = new User();
        
        //xoa avatar cua user khỏi folder
        $data = $user->find($id);
        if(!empty($data['avatar'])) {
            try {
                unlink($data['avatar']);
            }catch(Exception $e) {
                var_dump($e);
            }
        }
        
        $status = $user->delete($id);
        
        if($status){
            $_SESSION['alertSuccess'] = "Xóa thành công";
            header("Location: /admin/customers");
        }else{
             $_SESSION['alertDanger'] = "Xóa không thành công";
            header("Location: /admin/customers");
        }
    }

    // thực hiện công việc chỉnh sửa thông tin người dùng
    public function edit(){
        $id = $_GET['id'];
        $user = new User();
        $data = [];

        $data['default'] = $user->find($id);
        

        // check giữ lại thông tin đã nhập cũ của quyền hạn của
        //  nhân viên khi cập nhật thông tin người dùng  
        $data['default']['permission'] = 1;

        if($data['default']['staff'] == 1){
            $data['default']['permission'] = 2;
        }
        if($data['default']['supperAdmin'] == 1){
            $data['default']['permission'] = 3;
        }

        // print_r($data);die();

        // thực hiện hành động GET thông tin người dùng 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

           $request = (object)$_POST;

           
           $error = [];

           if($request->name == ''){
               $error[] = 'Tên không được để trống';
           }

           if(!empty($request->password)){
               if($request->password == ''){
                   $error[] = 'Password xác nhận không khớp';
               }
           }


           // var_dump($request); die();

           if(count($error) == 0){
               $pathAvatar = '';
                if(!empty($_FILES['avatar']) && $_FILES['avatar']['size'] > 0 ){
                    $filename = time().'_' . $_FILES['avatar']['name'];
                    $temp_file = $_FILES['avatar']['tmp_name'];
                    $pathAvatar = "assets/upload/{$filename}";
                    move_uploaded_file($temp_file, $pathAvatar);
                
                    if(!empty($request->old_avatar)){
                        unlink($request->old_avatar);
                    }

                    // if(!empty($data['default']['images'])){
                    //     unlink($data['default']['images']);
                    // }
                }
                $request->avatar = ($pathAvatar != '') ? $pathAvatar : $request->old_avatar;
               // cheeck trạng thái : nếu gọi thành công thì nlà true còn thất bại là false
               // khi call db
               $status = $user->update($id, $request);
               if($status){
                   $_SESSION['alertSuccess'] = "Chỉnh sửa thành công";
                   header('Location: /admin/customers');
               }else{
                   $_SESSION['alertDanger'] = "Chỉnh sửa không thành công";

               }
           }
           
           $data['error'] = $error;
           $data['oldValue'] = $_POST;
        }
        return $this->renderView('manager/users/edit', $data);
    }

    public function search()
    {

        // echo "test";
        // die();
        $data = [];
        $user = new User();
          if(isset($_GET['keyword'])){
                $data= $user->searchUser($_GET['keyword']);
              
                if(!empty($data)){
                     return $this->renderView('manager/users/index',$data);
                }
                else{
                    $_SESSION['alertDanger'] = "Không tìm thấy user";
                    header("Location: /admin/customers");
                }
               
          }
        //loc du lieu theo category
        // $keyword = (!empty($_GET['keyword'])) ? $_GET['keyword'] : null;

        // if($keyword) {
        // $data['results'] = $this->productModel->searchProduct($keyword);

        // return $this->viewRenderFrontend('products', $data);
        // } else {
        // header('Location: /');
        // exit;
        // }
    }

}