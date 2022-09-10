
<?php
include_once(__DIR__.'/../BaseController.php');

// link file chức năng thêm sửa xóa của người dùng vào 
include_once(__DIR__.'/../../models/Category.php');
include_once(__DIR__.'/../../models/Product.php');


class MProductController extends BaseController{

    public function index(){
        $data = [];

        // lấy ra danh mục chức sản phẩm 
        $categoryModel = new Category();
        $categories = $categoryModel->getAllData();
        // print_r($categories);die();
        foreach($categories as $category){
            if($category['type'] == 'product'){
                $data['category'][$category['id']] = $category['name'];
                // print_r($category['name']);die() ;
            }else{
                $data['category'][$category['id']] = "Khác";
            }
        }
        // print_r($data);die();
        // print_r($data['category']);die();

        $modelProduct = new Product();
        $data['products'] = $modelProduct->getAllData();
        // var_dump($data);

        // trỏ đến đưuòng dẫn file index.php view 
        // của chỉnh sửa product

        // this trỏ về basecontroller của file trước 
        return $this->renderView('manager/product/index',$data);
        // var_dump($this);die();
    }

    public function create(){
        $data = [];
        $category = new Category();
        $modelProduct = new Product();

        // mục đích đưa câu lệnh kia lên là 
        // để hiển thị tất cả vào select box danh mục cha 

        $parents = $category->getAllData();
        $array = [];

        // print_r($parent); die();
        foreach($parents as $p){
            if($p['type'] == "product"){
                $array[$p['id']] = $p['name'];
            }
        }

        $data['categories'] = $array;

        // print_r($array); die();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $request = (object)$_POST;
            
            $error = [];

            if($request->name == ''){
                $error[] = 'Tên không được để trống';
            }

            if($request->category_id == ''){
                $error[] = 'Vui lòng chọn danh mục';
            }

            if($request->price == ''){
                $error[] = 'Vui lòng chọn giá tiền gốc';
            }

            if($request->price_sale == ''){
                $error[] = 'Vui lòng nhập giá tiền gốc bán';
            }
            // var_dump($request); die();

            if(count($error) == 0){

                // xử lý upload ảnh

                $pathImage = '';
                if(!empty($_FILES['images']) && $_FILES['images']['size'] > 0 ){
                    $filename = time().'_' . $_FILES['images']['name'];
                    $temp_file = $_FILES['images']['tmp_name'];
                    $pathImage = "assets/upload/{$filename}";
                    move_uploaded_file($temp_file, $pathImage);
                }
                $request->images = $pathImage;

                // call database lên server
                // cheeck trạng thái : nếu gọi thành công thì nlà true còn thất bại là false
                // khi call db
                $status = $modelProduct->create($request);
                if($status){
                    $_SESSION['alertSuccess'] = "Tạo mới thành công";
                    header('Location: /admin/product');
                }else{
                    $_SESSION['alertDanger'] = "Tạo mới không thành công";

                }
            }
            
            $data['error'] = $error;
            $data['oldValue'] = $_POST;

        }
        // var_dump($data['error']);die() ;
        // var_dump($data['oldValue']);die() ;

        return $this->renderView('manager/product/create', $data);
    }
    

    public function edit(){
        $id = $_GET['id'];
        $category = new Category();
        $modelProduct = new Product();

        // mục đích đưa câu lệnh kia lên là 
        // để hiển thị tất cả vào select box danh mục cha 

        $parents = $category->getAllData();
        $array = [];

        // print_r($parent); die();
        foreach($parents as $p){
            if($p['type'] == "product"){
                $array[$p['id']] = $p['name'];
            }
        }

        $data['categories'] = $array;
        $data['default'] = $modelProduct->find($id);

        if(empty($data['default'])){
            $_SESSION['alertDanger'] = "Sản phẩm không tồn tại";
            header("Location: /admin/product");   
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $request = (object)$_POST;
            
            $error = [];

            if($request->name == ''){
                $error[] = 'Tên không được để trống';
            }

            if($request->category_id == ''){
                $error[] = 'Vui lòng chọn danh mục';
            }

            if($request->price == ''){
                $error[] = 'Vui lòng chọn giá tiền gốc';
            }

            if($request->price_sale == ''){
                $error[] = 'Vui lòng nhập giá tiền gốc bán';
            }
            // var_dump($request); die();

            if(count($error) == 0){

                // xử lý upload ảnh

                $pathImage = '';
                if(!empty($_FILES['images']) && $_FILES['images']['size'] > 0 ){
                    $filename = time().'_' . $_FILES['images']['name'];
                    $temp_file = $_FILES['images']['tmp_name'];
                    $pathImage = "assets/upload/{$filename}";
                    move_uploaded_file($temp_file, $pathImage);
                
                    if(!empty($request->old_images)){
                        unlink($request->old_images);
                    }

                    // if(!empty($data['default']['images'])){
                    //     unlink($data['default']['images']);
                    // }
                }
                $request->images = ($pathImage != '') ? $pathImage : $request->old_images ;

                // call database lên server
                // cheeck trạng thái : nếu gọi thành công thì nlà true còn thất bại là false
                // khi call db
                $status = $modelProduct->update($id, $request);
                if($status){
                    $_SESSION['alertSuccess'] = "Tạo mới thành công";
                    header('Location: /admin/product');
                }else{
                    $_SESSION['alertDanger'] = "Tạo mới không thành công";

                }
            }

            // var_dump($request); die();

            if(count($error) == 0){
                // call database lên server
                // cheeck trạng thái : nếu gọi thành công thì nlà true còn thất bại là false
                // khi call db
                $status = $modelProduct->update($id, $request);
                if($status){
                    $_SESSION['alertSuccess'] = "Cập nhật thành công";
                    header('Location: /admin/product');
                }else{
                    $_SESSION['alertDanger'] = "Cập nhật không thành công";
                }
            }
            
            $data['error'] = $error;
            $data['oldValue'] = $_POST;
        }

        return $this->renderView('manager/product/edit', $data);
    }
    
    
    
    public function delete(){
        $id = $_GET['id'];
        $modelProduct = new Product();

        $data = $modelProduct->find($id);

        if(empty($data)) {
            $_SESSION['alertDanger'] = "Sản phẩm không tồn tại vui lòng thử lại";
            header('Location: /admin/product');
        }

        //xoa image cua data
        if(!empty($data['images'])) {
            try {
                unlink($data['images']);
            }catch(Exception $e) {
                // var_dump($e);
            }
        }

        $status = $modelProduct->delete($id);
        if($status) {
            $_SESSION['alertSuccess'] = "Xoá thành công";
            header('Location: /admin/product');
        } else {
            $_SESSION['alertDanger'] = "Xoá không thành công";
            header('Location: /admin/product');
        }
    }

    public function show() {
        $id = $_GET['id'];
        $data=[];
        $category = new Category(); 
        $modelProduct = new Product();

        //lay ra tat ca cac danh muc da co de hien thi vao select box danh muc cha
        $parents = $category->getAllData();
        $array = [];
        foreach($parents as $p) {
            if($p['type'] == "product") {
                $array[$p['id']] = $p['name'];
            }
        }
        $data['categories'] = $array;
        $data['default'] = $modelProduct->find($id);

        if(empty($data['default'])) {
            $_SESSION['alertDanger'] = "Sản phẩm không tồn tại vui lòng thử lại";
            header('Location: /admin/product');
        }

        return $this->renderView('manager/product/show', $data);
    }

    // tìm kiếm sản phẩm cho admin 
    public function search()
    {
        $data = [];
        $productModel = new Product();

        $categoryModel = new Category();
        $categories = $categoryModel->getAllData();

        foreach($categories as $category){
            if($category['type'] == 'product'){
                $data['category'][$category['id']] = $category['name'];
                // print_r($category['name']);die() ;
            }
        }
        
        if(isset($_GET['keyword'])){
            $data['products'] = $productModel->searchProduct($_GET['keyword']);

            // đoạn này e đã lấy được các sản phẩm tìm kiếm theo keyword 
            // echo '<pre>';
            // var_dump($data);die();
            
            if(!empty($data)){
                // echo "<h1> ĐI ĐÚNG ĐƯỜNG DẪN  </h1>";
                // echo $_GET['keyword'];
                return $this->renderView('manager/product/index', $data);
            }else{
                $_SESSION['alertDanger'] = 'Không tìm thấy sản phẩm bạn yêu cầu';
                // header('Location: /admin/product/index');
            }
        }
    }

    public function exportExcel(){
        header('Content-Type: application/vnd-ms-excel');
        $filename = "Products_Data.xls";
        header("Content-Disposition:attachment;filename=\"$filename\"");

        // echo "Phan Thăng";
        $modelProduct = new Product();
        $data['products'] = $modelProduct->getAllData();

        $categoryModel = new Category();
        $categories = $categoryModel->getAllData();

        foreach($categories as $category){
            if($category['type'] == 'product'){
                $data['category'][$category['id']] = $category['name'];
                // print_r($category['name']);die() ;
            }
        }

        $outPut .= 
        '
            <table class="table table">
                <thead>
                    <tr style="background-color: #448aff;color:#fff">
                        <th scope="col">ID</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Giá bán</th>
                        <th scope="col">Giá gốc</th>
                    </tr>
                </thead>
                <tbody>
        ';

    foreach ($data['products'] as $row)
    {
        $row = (object)$row;
        $outPut .= 
        '
            <tr>
                <td> '.$row->id.' </td>
                <td> '.$row->name.' </td>
                <td> '.$row->slug.' </td>
                <td> '.$data['category'][$row->category_id].' </td>
                <td> '.currency_format($row->price_sale).' </td>
                <td> '.currency_format($row->price).' </td>
            </tr>    
        ';
    }

        $outPut .= 
        '                   
                </tbody>
            </table>
        ';
        echo $outPut;
        // var_dump($outPut);
    }

    public function exportPDF(){

        $html = "phan thăng";


        // câu lệnh truy vấn pdf 
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $file = time().'.pdf';
        $mpdf->output($file,'D');
    }
    
}