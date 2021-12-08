<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library(array('form_validation'));
        $this->load->model('User');
        $this->user = new User();

        //user login status
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
    }
    public function register(){
        $this->load->view('layouts/header');
        $this->load->view('auth/register');
        $this->load->view('layouts/footer');
    }
    public function store(){
        $config = [
            [
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required|min_length[3]|max_length[5]',
                'errors' => [
                    'required' => 'Name field is required',
                    'min_length' => 'Your password must be at least 3 character',
                    'max_length' => 'Name must be at most 50 characters'
                ]
            ],[
                'field' => 'email',
                'label' => 'user email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email field is required',
                    // 'is_unique' => 'This %s already exists',
                    'valid_email' => 'Your email is invalid',
                ]
            ],[
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|min_length[8]|max_length[15]',
                'errors' => [
                    'required' => 'Password field is required',
                    'min_length' => 'Your password must be at least 8 character',
                    'max_length' => 'Yout password must be at most 15 character',
                ]
            ],[
                'field' => 'cpassword',
                'label' => 'Confirm password',
                'rules' => 'required|matches[password]|min_length[8]|max_length[15]',
                'errors' => [
                    'required' => 'Confirmation password field is required',
                    'matches' => 'Password does not match',
                    'min_length' => 'Your password must be at least 8 character',
                    'max_length' => 'Yout password must be at most 15 character',
                ]
            ],
        ];
        $this->form_validation->set_rules($config);

        if($this->form_validation->run() == FALSE){
            $this->load->view('auth/register');
        }else{
            $this->user->save_user();
            redirect(site_url('login'));    
        }
        
    }
    public function check_login(){
        $config = [
            [
                'field' => 'email',
                'label' => 'user email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email field is required',
                    // 'is_unique' => 'This %s already exists',
                    'valid_email' => 'Your email is invalid',
                ]
            ],[
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|min_length[8]|max_length[15]',
                'errors' => [
                    'required' => 'Passsword field is required',
                    'min_length' => 'Your password must be at least 8 character',
                    'max_length' => 'Yout password must be at most 15 character',
                ]
            ]

        ];
        $this->form_validation->set_rules($config);

        if($this->form_validation->run() == FALSE){
            $this->load->view('auth/login');
        }else{
            $this->user->login();
            redirect('categories');    
        }
    }
    public function login(){
        $this->load->view('layouts/header');
        $this->load->view('auth/login');
        $this->load->view('layouts/footer');
    }

    public function logout(){
        $this->user->clear_userdata();
        redirect(site_url('login'));
    }

}
?>