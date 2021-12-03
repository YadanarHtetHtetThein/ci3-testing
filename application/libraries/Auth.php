<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth{
    protected $CI;
    function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->model('User');
    }

    function has_access($action){
        if($action == 'delete'){
            if($this->is_admin()){
                return true;
            }
        }
        if($action == 'edit'){
            if($this->is_admin()){
                return true;
            }
        }
        return false;
    }

    function is_admin(){
        return $this->CI->User->is_admin($this->CI->session->userdata('user_id'));
    }

    function login_required($page) {
        if (!$this->CI->session->has_userdata('isUserLoggedIn')) {
            $this->CI->session->set_flashdata('error', "You need to be logged in to access the $page page.");
            redirect(site_url('login'));
        }
    }

}