<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Model{
    protected $table_name;
    protected $primary_key;
    protected $key_prefix;
    
    // construct data for category
    function __construct(){
        $this->load->database();
        $this->table_name = 'categories';
        $this->primary_key = 'cat_id';
        $this->key_prefix = 'cat';
    }
    
    //generate unique id
    private function generate_unique_id(){
        return $this->key_prefix . md5($this->key_prefix . microtime() . uniqid() . 'yhht' );
    }
    //insert record to table
    public function save_catgeory(){
        $data = [
            'cat_id' => $this->generate_unique_id(),
            'cat_name' => $this->input->post('cat_name'),
            'cat_image' => $this->input->post('cat_image'),
            'cat_publish' => $this->input->post('cat_publish'),
        ];
        $this->db->insert($this->table_name,$data);
    }
    //get all data from table
    public function get_all_data(){
        if(!empty($this->input->get('search_data'))){
            $this->db->like('cat_name',$this->input->get('search_data'));
        }
        $query = $this->db->get($this->table_name);
        return $query->result();
    }
    //get one record from data filter by id
    public function get_data_by_id($id){
        $query = $this->db->get_where($this->table_name,array($this->primary_key=>$id))->row();
        return $query;
    }
    //update category
    public function update_category($id){
        $data = [
            'cat_name' => $this->input->post('cat_name'),
            'cat_image' => $this->input->post('cat_image'),
            'cat_publish' => $this->input->post('cat_publish'),
        ];
        $this->db->where($this->primary_key,$id);
        $this->db->update($this->table_name,$data);
    }
    public function delete_category($id){
        $this->db->delete($this->table_name,[$this->primary_key=>$id]);
    }
    public function change_publish($id){
        $data = $this->get_data_by_id($id);
        $this->db->where($this->primary_key,$id);
        if($data->cat_publish == 1){
            $this->db->update($this->table_name,['cat_publish'=>2]);
        }else{
             $this->db->update($this->table_name,['cat_publish'=>1]);
        }
    }
}
?>