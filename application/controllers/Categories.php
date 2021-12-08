<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends BE_Controller{
    

    function __construct(){
        parent::__construct();   
       
    }
    //category list page
    public function index(){
        $this->data['rows_count'] = $this->Category->count_all();
        $this->data['data'] = $this->Category->get_all_by($this->pag['per_page'],$this->uri->segment(2));        
        parent::index();
    }
    //category detail page
    public function detail($category_id){
        $this->auth->login_required('detail');
        $this->data['data'] = $this->Category->get_one($category_id);
        parent::detail($category_id);
    }
    //category create form page
    public function create(){
        parent::add();
    }
    //save category record to table
    public function store(){
        $this->form_validation->set_rules('cat_name','Category name','required');
        // $this->form_validation->set_rules('cat_image','Category image','required');
        $this->form_validation->set_rules('cat_publish','Category publish','required');
        if($this->form_validation->run() == FALSE){
            $this->load->view('categories/create');
        }else{
            $this->Category->save_catgeory();
            $this->session->set_flashdata('success','Category data created');
            redirect('categories');
        }
    }
    //category edit  form page
    public function edit($category_id){
        $this->data['data']= $this->Category->get_one($category_id);
        parent::edit($category_id);
    }
    //category update record to table
    public function update($category_id){
        $this->form_validation->set_rules('cat_name','Category name','required');
        // $this->form_validation->set_rules('cat_image','Category image','required');
        $this->form_validation->set_rules('cat_publish','Category publish','required');
        if($this->form_validation->run() == FALSE){
            $data['data']= $this->Category->get_data_by_id($category_id);
            $this->load->view('categories/edit',$data);
        }else{
            $this->Category->update_category($category_id);
            $this->session->set_flashdata('success','Category data updated');
            redirect('categories');
        }
    }
    //delete category record
    public function delete($category_id){
        $this->Category->delete_category($category_id);
        redirect('categories');
    }

    //category publish or unpulish
    public function publish($category_id){
        $this->Category->change_publish($category_id);
        redirect('categories');
    }    
}
?>