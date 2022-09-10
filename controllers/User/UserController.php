<?php

include_once(__DIR__.'/../BaseController.php');

include_once(__DIR__.'/../../models/Category.php');
include_once(__DIR__.'/../../models/Product.php');
include_once(__DIR__.'/../../models/User.php');


class UserController extends BaseController{
    public function index(){
        $productModel = new Product();
        $categoryModel = new Category();

        $data = [];
        $data['products'] = $productModel->getAllData();
        $categories = $categoryModel->getAllData();

        foreach($categories as $category){
            $data['categories'][$category['id']] = $category['name'];
        }

        return $this->renderViewFrontend('user/index', $data);
    }


    public function error(){
        return $this->renderView('user/404');
    }

    // chi tiết sản phẩm 
    public function product(){
        $slug = (!empty($_GET['slug'])) ? $_GET['slug'] : null;
        $productModel = new Product();
        $categoryModel = new Category();
        $data = [];

        if(!$slug){
            header('Location: /404');
        }

        // $productModel = new Product();
        // $categoryModel = new Category();

        $data = [];
        $data['product'] = $productModel->getProductBySlug($slug);

        // if(!count($data['product']) == 0){
        //     header('Location: /404');
        // }

        $categories = $categoryModel->getAllData();

        foreach($categories as $category){
            $data['categories'][$category['id']] = $category['name'];
        }


        return $this->renderViewFrontend('user/product', $data);
    }

    public function login(){
        $data = [];
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $request = (object)$_POST;
            $error = [];

            if($request->email == '') {
                $error[] = "Vui lòng nhập email";
            }

            if($request->password == '') {
                $error[] = "Vui lòng nhập mật khẩu";
            }

            if(count($error) == 0) {
                $userModel = new User(); 
                $user = $userModel->login($request->email, $request->password);

                if(count($user)) {

                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'address' => $user['address'],
                        'phone' => $user['phone'],
                        'avatar' => $user['avatar']
                    ];

                    header('Location: /');
                }

                $error[] = "Có lỗi xảy ra vui lòng thử lại";
            }

            $data['error'] = $error;
        }

        return $this->renderViewFrontend('user/login', $data);
    }

    public function register(){
        $data = [];
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $request = (object)$_POST;
            $error = [];
            $userModel = new User(); 

            if($request->name == '') {
                $error[] = "Vui lòng nhập tên";
            }

            if($request->email == '') {
                $error[] = "Vui lòng nhập email";
            }

            if($request->password == '') {
                $error[] = "Vui lòng nhập mật khẩu";
            }

            if($request->password != $request->repassword) {
                $error[] = "Xác nhận mật khẩu không đúng, vui lòng thử lại";
            }

            if(!empty($request->email)) {
                $check = $userModel->findUserByEmail($request->email);
                if(count($check) > 0) {
                    $error[] = "Email đã tồn tại, vui lòng thử lại";
                }
            }

            if(count($error) == 0) {
                // xử lý upload ảnh

                $pathImage = '';
                if(!empty($_FILES['avatar']) && $_FILES['avatar']['size'] > 0 ){
                    $filename = time().'_' . $_FILES['avatar']['name'];
                    $temp_file = $_FILES['avatar']['tmp_name'];
                    $pathImage = "assets/upload/{$filename}";
                    move_uploaded_file($temp_file, $pathImage);
                }
                $request->avatar = $pathImage;
                //create data
                $createUser = $userModel->create($request);
                if($createUser) {
                    $user = $userModel->login($request->email, $request->password);

                    if(count($user)) {
                        $_SESSION['user'] = [
                            'id' => $user['id'],
                            'name' => $user['name'],
                            'email' => $user['email'],
                            'address' => $user['address'],
                            'phone' => $user['phone']
                        ];

                        header('Location: /');
                    }
                }

                $error[] = "Có lỗi xảy ra vui lòng thử lại";
            }

            $data['error'] = $error;
        }

        return $this->renderViewFrontend('user/register', $data);
    }

    public function logout(){
        try{
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                unset($_SESSION['user']);
            }
        }catch(Exception $e){
            var_dump($e);
        }
        header('Location: /');
    }


    // public function index(){
    //     $productModel = new Product();
    //     $categoryModel = new Category();

    //     $data = [];
    //     $data['products'] = $productModel->getAllData();
    //     $categories = $categoryModel->getAllData();

    //     foreach($categories as $category){
    //         $data['categories'][$category['id']] = $category['name'];
    //     }

    //     return $this->renderViewFrontend('user/index', $data);
    // }

    public function search()
    {
        $data = [];
        $productModel = new Product();
        
        if(isset($_GET['keyword'])){
            $data['products'] = $productModel->searchProduct($_GET['keyword']);

            // đoạn này e đã lấy được các sản phẩm tìm kiếm theo keyword 
            // echo '<pre>';
            // var_dump($data);die();
            
            if(!empty($data)){
                // echo "<h1> ĐI ĐÚNG ĐƯỜNG DẪN  </h1>";
                // echo $_GET['keyword'];
                return $this->renderViewFrontend('user/index', $data);
            }else{
                $_SESSION['alertDanger'] = 'Không tìm thấy sản phẩm bạn yêu cầu';
            }
        }
    }
}