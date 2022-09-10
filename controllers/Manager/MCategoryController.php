
<?php
include_once(__DIR__.'/../BaseController.php');

// link file chức năng thêm sửa xóa của người dùng vào 
include_once(__DIR__.'/../../models/Category.php');

class MCategoryController extends BaseController{

    public function index(){
        $data = [];

        $category = new Category();
        
        $data = $category->getAllData();

        // var_dump($data);

        // trỏ đến đưuòng dẫn file index.php view 
        // của chỉnh sửa category

        // this trỏ về basecontroller của file trước 
        return $this->renderView('manager/category/index',$data);
        // var_dump($this);die();
    }

    public function create(){
        $data = [];
        $category = new Category();
        // mục đích đưa câu lệnh kia lên là 
        // để hiển thị tất cả vào select box danh mục cha 

        $parents = $category->getAllData();
        $array = [];

        // print_r($parent); die();
        // foreach($parents as $p){
        //     $array[$p['id']] = $p['name'];
        // }

        $data['categories'] = $array;

        // print_r($array); die();



        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $request = (object)$_POST;
            
            $error = [];

            if($request->name == ''){
                $error[] = 'Tên không được để trống';
            }

            // var_dump($request); die();

            if(count($error) == 0){
                // call database lên server
                // cheeck trạng thái : nếu gọi thành công thì nlà true còn thất bại là false
                // khi call db
                $status = $category->create($request);
                if($status){
                    $_SESSION['alertSuccess'] = "Tạo mới thành công";
                    header('Location: /admin/category');
                }else{
                    $_SESSION['alertDanger'] = "Tạo mới không thành công";

                }
            }
            
            $data['error'] = $error;
            $data['oldValue'] = $_POST;

        }
        // var_dump($data['error']);die() ;
        // var_dump($data['oldValue']);die() ;

        return $this->renderView('manager/category/create', $data);
    }

    public function edit(){
        $id = $_GET['id'];
        $data=[];
        $category = new Category(); 

        //lay ra tat ca cac danh muc da co de hien thi vao select box danh muc cha
        $parents = $category->getAllData();
        $array = [];
        // foreach($parents as $p) {
        //     $array[$p['id']] = $p['name'];
        // }
        $data['categories'] = $array;
        $data['default'] = $category->find($id);

        // if(empty($data['default'])){
        //     $_SESSION['alertDanger'] = "Danh mục không tồn tại";
        //     header("Location: /admin/category");   
        // }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $request = (object)$_POST;
            
            $error = [];

            if($request->name == ''){
                $error[] = 'Tên không được để trống';
            }

            // var_dump($request); die();

            if(count($error) == 0){
                // call database lên server
                // cheeck trạng thái : nếu gọi thành công thì nlà true còn thất bại là false
                // khi call db
                $status = $category->update($id, $request);
                if($status){
                    $_SESSION['alertSuccess'] = "Cập nhật thành công";
                    header('Location: /admin/category');
                }else{
                    $_SESSION['alertDanger'] = "Cập nhật không thành công";
                }
            }
            
            $data['error'] = $error;
            $data['oldValue'] = $_POST;
        }

        return $this->renderView('manager/category/edit', $data);
    }

    public function delete(){
        $id = $_GET['id'];

        $category = new Category();
        $status = $category->delete($id);

        if($status){
            $_SESSION['alertSuccess'] = "Xóa thành công";
            header("Location: /admin/category");
        }else{
            $_SESSION['alertDanger'] = "Xóa không thành công";
            header("Location: /admin/category");
        }
    }


    public function search()
    {
        $data = [];
        $category = new Category();
          if(isset($_GET['keyword'])){
                $data= $category->searchCategory($_GET['keyword']);
              
                if(!empty($data)){
                     return $this->renderView('manager/category/index',$data);
                }
                else{
                    $_SESSION['alertDanger'] = "Không tìm thấy danh mục sản phẩm";
                    header("Location: /admin/category");
                }
               
          }
    }
}