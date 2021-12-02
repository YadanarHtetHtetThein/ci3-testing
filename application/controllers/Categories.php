<?php
class Categories extends CI_Controller{
    //category list page
    public function index(){
        echo 'Category index';
    }
    //category detail page
    public function detail($category_id){
        echo 'Category detail';
    }
    //category create form page
    public function create(){
        echo 'Category create';
    }
    //save category record to table
    public function store(){
        echo 'Category store';
    }
    //category edit  form page
    public function edit($category_id){
        echo 'Category edit';
    }
    //category update record to table
    public function update($category_id){
        echo 'Category update';
    }
    //delete category record
    public function delete($category_id){
        echo 'Category delete';
    }
    //searching category
    public function search(){
        echo 'Category search';
    }
    //category publish or unpulish
    public function publish($category_id){
        echo 'Category publish';
    }
    
    //upload image to local file
    private function upload_image(){
        echo 'upload image';
    }
    //delete image to loacal file
    private function delete_image(){
        echo 'delete image';
    }

}
?>