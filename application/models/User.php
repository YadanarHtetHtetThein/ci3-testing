<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Model{

    protected $table_name;
    protected $primary_key;
    protected $key_prefix;

    public function __construct(){
        parent::__construct();
        $this->table_name = 'users';
        $this->primary_key = 'users_id';
        $this->key_prefix = 'user';

        $this->load->library('Hash');
    }

    //generate unique id
    private function generate_unique_id(){
        return $this->key_prefix . md5($this->key_prefix . microtime() . uniqid() . 'yhht' );
    }
    //save user
    public function save_user(){
        $data = [
            'users_id' => $this->generate_unique_id(),
            'user_name' => $this->input->post('name'),
            'user_email' => $this->input->post('email'),
            'user_password' => $this->hash->make($this->input->post('password')),
        ];
        $this->db->insert($this->table_name,$data);
    }
    //login user
    public function login(){
        $conds = [
            'user_email' => $this->input->post('email'),
            'user_password' => $this->input->post('password')
        ];

        $user = $this->get_one_user_data($conds);
        if(empty($user)){
            $this->session->set_flashdata('error','This email has no registered.');
            redirect(site_url('login'));
        }else{
            if($this->hash->check($conds['user_password'],$user['user_password'])){
                $this->session->set_userdata('user_id',$user['users_id']);
                $this->session->set_userdata('user_role',$user['user_role']);
                $this->session->set_userdata('isUserLoggedIn',true);
            }else{
                $this->session->set_flashdata('error','Your password is wrong');
                $this->session->unset_userdata('isUserLoggedIn');
                redirect(site_url('login'));
            }
        }
        
    }

    public function is_admin($id){
        $this->db->from($this->table_name);
        $this->db->where($this->primary_key,$id);
        $this->db->where('user_role','admin');
        $query = $this->db->get();
        if($query->num_rows() == 1){
            return true;
        }
        return false;
    }

    public function get_one_user_data($data){
        $this->db->where('user_email',$data['user_email']);
        $data = $this->db->get($this->table_name);
        return $data->row_array();
    }
    public function clear_userdata(){
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_role');
        $this->session->unset_userdata('isUserLoggedIn');
    }

    public function get_one($id){
        $query = $this->db->get_where($this->table_name,[$this->primary_key=>$id]);
        return $query->row();
    }
}
?>