<?php

    // Manager 
    include_once(__DIR__.'/controllers/Manager/ManagerController.php');
    include_once(__DIR__.'/controllers/Manager/MUserController.php');


    include_once(__DIR__.'/controllers/Manager/MCategoryController.php');

    include_once(__DIR__.'/controllers/Manager/MProductController.php');
    // quản lý đơn hàng 
    include_once(__DIR__.'/controllers/Manager/MOrderController.php');



    // User / Client 
    include_once(__DIR__.'/controllers/User/UserController.php');
    include_once(__DIR__.'/controllers/User/CartController.php');

// echo $_SERVER['REQUEST_URI'];

// $uri = $_SERVER['REQUEST_URI'];
// $subfolders = '/shop_manager';
// $path = str_replace($subfolders, '', $uri);
// $path = strtok($path, '?');

$managerController = new ManagerController();

$mUserController = new MUserController(); 
$mCategoryController = new MCategoryController();
$mProductController = new MProductController();
$mOrderController = new MOrderController();


$userController = new UserController(); 
$cartController = new CartController();


// $path = get_uri('/shop_manager');
$path = get_uri();
// echo $path;

$checkAdmin = strpos('/admin', $path);

if(str_contains($path, '/admin')){
    $path = str_replace('/admin', '', $path);
    //admin
    $path = $path ? $path: '/';

    // đăng nhập tài khoản admin
    switch($path){
        case '/login': return $managerController->login(); break;
        case '/logout': return $managerController->logout(); break;
    }
    // check tài khoản đăng nhập và bo điều hướng người dùng k phải là tài khoản admin 
    // var_dump($_SESSION['userAdmin']); die();
    if( empty($_SESSION['userAdmin'])) {
        header('Location: /admin/login');
    }
    if(!empty($_SESSION['userAdmin'])){
        switch($path){
            case '/': return $managerController->index(); break;
            
            // route của phần quản lý người dùng / customers
            case '/customers': return $mUserController->index(); break;
            case '/customers/create': return $mUserController->create(); break;
            case '/customers/delete': return $mUserController->delete(); break;
            case '/customers/edit': return $mUserController->edit(); break;
            case '/customers/search': return $mUserController->search(); break;
            
            // route của phần category
            case '/category': return $mCategoryController->index(); break;
            case '/category/create': return $mCategoryController->create(); break;
            case '/category/delete': return $mCategoryController->delete(); break;
            case '/category/edit': return $mCategoryController->edit(); break;
            case '/category/search': return $mCategoryController->search(); break;
    
            // router của phần products
            case '/product': return $mProductController->index(); break;
            case '/product/create': return $mProductController->create(); break;
            case '/product/delete': return $mProductController->delete(); break;
            case '/product/show': return $mProductController->show(); break;
            case '/product/edit': return $mProductController->edit(); break;
            // tìm kiếm của phần admin 
            case '/product/search': return $mProductController->search(); break;
            case '/product/exportExcel': return $mProductController->exportExcel(); break;
            case '/product/exportPDF': return $mProductController->exportPDF(); break;
    
            // điều hướng quán lý đơn hàng của admin 
            case '/orders': return $mOrderController->index(); break;
            case '/orders/show': return $mOrderController->show(); break;
            case '/orders/update': return $mOrderController->updateStatus(); break;
            case '/orders/exportBill': return $mOrderController->exportBill(); break;
        }    
    }else{
        header('Location: /admin/login');
    }
}


// đây là phần điều hướng của user 
// danh sách modul k cần đăng ký
$path = $path ? $path: '/';

// nếu đã đăng nhập thì login , register tự vào index , không cho vào trang login nữa

if(in_array($path, [
    '/login', '/register'
]) && !empty($_SESSION['user'])) {
    header('Location: /');
}

switch ($path) {
    // điều hướng đế trang chủ sản phẩm khi người dùng vào web 
    case '/': return $userController->index(); break; 
    // đăng nhập đang kí và đăng xuất người dùng 
    case '/login': return $userController->login(); break;
    case '/register': return $userController->register(); break;

    // điều hướng trang danh mục sản phẩm 
    // case '/products': return $userController->products(); break;
    // điều hướng trang chi tiết sản phẩm 
    case '/product': return $userController->product(); break;
    case '/search': return $userController->search(); break;
}

// chưa đăng nhập thì điều huwosg đến login     

if(in_array($path,[
    '/logout',

    // sử dùng sesssion để lưu trữ giỏ hàng người dùng 
    '/addToCart',
    '/carts',
    '/deleteItemCart',
    '/deleteCarts',
    '/createOrder',
    '/myOrder'
])){
    if( empty($_SESSION['user'])) {
        header('Location: /login');
    }

    // trang cần login
    switch($path){
        case '/logout': return $userController->logout(); break;    
        case '/addToCart': return $cartController->addToCart(); break;
        case '/carts': return $cartController->carts(); break;
        case '/deleteItemCart': return $cartController->deleteItemCart(); break;
        case '/deleteCarts': return $cartController->deleteCarts(); break;
        case '/createOrder': return $cartController->createOrder(); break;
        case '/myOrder': return $cartController->myOrder(); break;
    }
}


return $userController->error();

