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

    // //determined if logged in
    // function is_logged_in(){
    //     return $this->CI->session->userdata('user_id') != false;
    // }

    // /**
    //  * validate the user and requested action
    //  * @return [type][description]
    //  */
    // function validate($module_name = false){
    //     if(!$this->is_logged_in()){
    //         //if there is no logged in user, return false
    //         return false;
    //     }

    //     // if($module_name && $this->has_permission($module_name)){
    //     //     //if no permission for requested module , return false
    //     //     return false;
    //     // }
    //     return true;
    // }

    // function has_permission(){}

    // function is_system_user(){}

    // function get_user_info(){
    //     if($this->is_logged_in()){
    //         //if there is logged in user
    //         return $this->CI->User->get_one($this->CI->session->userdata('user_id'));
    //     }
    //     return false;
    // }

}