<?php
include_once(__DIR__.'/../models/Category.php');

class BaseController {
    
    function renderView($view, $data = null) {

        ob_start();

        require_once(__DIR__."/../views/{$view}.php");

        $content = ob_get_contents();
        ob_end_clean();

        echo $content;
    }

    // render view cho người dùng mua hàng 
    function renderViewFrontend($view, $data = null) {
        ob_start();

        $categoryModel = new Category();
        $categories = $categoryModel->getAllData();

        foreach($categories as $category){
            if($category['type'] == 'product'){
                $data['menuCategoriesProduct'][$category['slug']] = $category['name'];
            }
        }

        require_once(__DIR__."/../views/{$view}.php");

        $content = ob_get_contents();
        ob_end_clean();

        echo $content;
    }
}