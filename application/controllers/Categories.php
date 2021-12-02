<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller{
    public $category;

    public function __construct(){
        parent::__construct();
        
        $this->load->helper(array('form','url'));
        $this->load->library(array('form_validation','session'));
        $this->load->model('Category');
        $this->category = new Category();
    }
    //category list page
    public function index(){
        $data['data'] = $this->category->get_all_data();
        $this->load->view('layouts/header');
        $this->load->view('category/index',$data);
        $this->load->view('layouts/footer');
    }
    //category detail page
    public function detail($category_id){
        $data['data'] = $this->category->get_data_by_id($category_id);
        $this->load->view('layouts/header');
        $this->load->view('category/detail',$data);
        $this->load->view('layouts/footer');
    }
    //category create form page
    public function create(){
        $this->load->view('layouts/header');
        $this->load->view('category/create');
        $this->load->view('layouts/footer');
    }
    //save category record to table
    public function store(){
        $this->form_validation->set_rules('cat_name','Category name','required');
        $this->form_validation->set_rules('cat_image','Category image','required');
        $this->form_validation->set_rules('cat_publish','Category publish','required');
        if($this->form_validation->run() == FALSE){
            $this->load->view('category/create');
        }else{
            $this->category->save_catgeory();
            $this->session->set_flashdata('success','Category data created');
            redirect('categories');
        }
    }
    //category edit  form page
    public function edit($category_id){
        $data['data']= $this->category->get_data_by_id($category_id);
        $this->load->view('layouts/header');
        $this->load->view('category/edit',$data);
        $this->load->view('layouts/footer');
    }
    //category update record to table
    public function update($category_id){
        $this->form_validation->set_rules('cat_name','Category name','required');
        $this->form_validation->set_rules('cat_image','Category image','required');
        $this->form_validation->set_rules('cat_publish','Category publish','required');
        if($this->form_validation->run() == FALSE){
            $data['data']= $this->category->get_data_by_id($category_id);
            $this->load->view('category/edit',$data);
        }else{
            $this->category->update_category($category_id);
            $this->session->set_flashdata('success','Category data updated');
            redirect('categories');
        }
    }
    //delete category record
    public function delete($category_id){
        $this->category->delete_category($category_id);
        redirect('categories');
    }

    //category publish or unpulish
    public function publish($category_id){
        $this->category->change_publish($category_id);
        redirect('categories');
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