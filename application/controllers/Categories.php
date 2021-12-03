<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller{
    public $category;

    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library(array('form_validation','pagination','Auth'));
        $this->load->model('Category');
        $this->category = new Category();
    }
    //category list page
    public function index(){

        $config['base_url'] = 'http://localhost:8000/categories';
        $config['total_rows'] = $this->category->get_count_all();
        $config['per_page'] = 2;
        $config['uri_segment'] = 2;
        $config['full_tag_open'] = '<ul class = "pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['prev_link'] = '&laquo';
        $config['last_link'] = 'Last';
        $config['next_link'] = '&raquo';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active">';
        $config['cur_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $page = $this->uri->segment(2);

        $data['data'] = $this->category->get_all_data($config['per_page'],$page);
        $this->load->view('layouts/header');
        $this->load->view('category/index',$data);
        $this->load->view('layouts/footer');
    }
    //category detail page
    public function detail($category_id){
        $this->auth->login_required('detail');
        $data['data'] = $this->category->get_data_by_id($category_id);
        $this->load->view('layouts/header');
        $this->load->view('category/detail',$data);
        $this->load->view('layouts/footer');
    }
    //category create form page
    public function create(){
        $this->auth->login_required('create');
        $this->load->view('layouts/header');
        $this->load->view('category/create');
        $this->load->view('layouts/footer');
    }
    //save category record to table
    public function store(){
        $this->form_validation->set_rules('cat_name','Category name','required');
        // $this->form_validation->set_rules('cat_image','Category image','required');
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
        // $this->form_validation->set_rules('cat_image','Category image','required');
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

    
}
?>