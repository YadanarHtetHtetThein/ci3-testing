<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Core_Model{
    protected $table_name = 'categories';
    protected $primary_key = 'cat_id';
    protected $key_prefix = 'cat';
  
    // construct data for category
    function __construct(){
        parent::__construct($this->table_name, $this->primary_key, $this->key_prefix);
    }
    
    //insert record to table
    public function save_catgeory(){
        $this->image_configuration();
        if($this->upload->do_upload('cat_image')){
            $file_name = $this->upload->data('file_name');
            $data = [
                'cat_id' => $this->generate_key(),
                'cat_name' => $this->input->post('cat_name'),
                'cat_image' => $file_name,
                'cat_publish' => $this->input->post('cat_publish'),
            ];
        }else{
            $this->session->set_flashdata('error','something went wrong');
            redirect('categories/create');
        }
        $this->db->insert($this->table_name,$data);
    }
    //get all data from table
    // public function get_all_by($limit = FALSE, $offset = FALSE){
    //     if(!empty($this->input->get('search_data'))){
    //         $this->db->like('cat_name',$this->input->get('search_data'));
    //     }
    //     $this->get_all_by($limit = FALSE, $offset = FALSE);
    // }
    // get one record from data filter by id
    public function get_data_by_id($id){
        $query = $this->db->get_where($this->table_name,array($this->primary_key=>$id))->row();
        return $query;
    }
    //update category
    public function update_category($id){
        $this->image_configuration();
        $data = array();
            if($this->upload->do_upload('cat_image')){
                $file_name = $this->upload->data('file_name');
                $data = [
                    'cat_image' => $file_name,
                    'cat_name' => $this->input->post('cat_name'),
                    'cat_publish' => $this->input->post('cat_publish'),
                ];
            }else{
                $this->session->set_flashdata('error','something went wrong, choose another image');
                $data = [
                    'cat_name' => $this->input->post('cat_name'),
                    'cat_publish' => $this->input->post('cat_publish'),
                ];
            }
        $this->db->where($this->primary_key,$id);
        $this->db->update($this->table_name,$data);
    }
    public function delete_category($id){
        $data = $this->get_one($id);

        $filename = 'images/' . $data->cat_image;
        // print_r($filename) ;
        if (file_exists($filename))
        {
            unlink($filename);
        }
        $this->db->delete($this->table_name,[$this->primary_key=>$id]);
    }
    
    public function change_publish($id){
        $data = $this->get_one($id);
        $this->db->where($this->primary_key,$id);
        if($data->cat_publish == 1){
            $this->db->update($this->table_name,['cat_publish'=>2]);
        }else{
             $this->db->update($this->table_name,['cat_publish'=>1]);
        }
    }

    private function image_configuration(){
        $config['upload_path'] = 'images/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '1000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $config['overwrite'] = FALSE;
        $this->load->library('upload',$config);
    }

      //search
    // function search($conds, $limit = false, $offset = false){
    //     $this->db->like('cat_name',$conds['search_data'));
    //     return $this->get_all_by($limit, $offset);
    // }
}
?>