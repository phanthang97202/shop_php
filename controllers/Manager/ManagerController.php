<?php

include_once(__DIR__.'/../BaseController.php');

class ManagerController extends BaseController{
    public function index(){
        return $this->renderView('manager/index');
    }

    public function login()
    {
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
                    // var_dump($user); die();
                    if($user['supperAdmin'] == 1 || $user['staff'] == 1) {
                        $_SESSION['userAdmin'] = [
                            'id' => $user['id'],
                            'name' => $user['name'],
                            'email' => $user['email'],
                            'address' => $user['address'],
                            'phone' => $user['phone'],
                            'supperAdmin' => $user['supperAdmin'],
                            'staff' => $user['staff'],
                            'avatar' => $user['avatar']
                        ];
                        header('Location: /admin');
                    }
                }
                $error[] = "Có lỗi xảy ra ";
                // var_dump($user);die();
            }
            $data['error'] = $error;
        }

        return $this->renderView('manager/login', $data);
    }

    public function logout(){
        if(!empty($_SESSION['userAdmin'])){
            unset($_SESSION['userAdmin']);
        }
        header('Location: /admin/login');
    }

}