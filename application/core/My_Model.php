<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Model{}

class Core_Model extends CI_Model{

    //name of the database table
    protected $table_name;
    //name of the ID field
    protected $primary_key;
    //name of the key prefix
    protected $key_prefix;

    //constructs the required data
    function __construct($table_name,$primary_key = false ,$key_prefix = false){
        parent::__construct();

        $this->table_name = $table_name;
        $this->primary_key = $primary_key;
        $this->key_prefix = $key_prefix;
    }

    //generate the unique id key
    function generate_key(){
        return $this->key_prefix . md5($this->key_prefix . microtime() . uniqid() . 'yhht' );
    }

    //save the data if id is not existed
    // function save(&$data, $id = false){
    //     if(!$id){

    //         //if id is not false and id is not yet existed
    //         if(!empty($this->primary_key && !empty($this->key_prefix))){
    //             //if primary_key and key_prefix is existed

    //             //generate unique id
    //             $data[$this->primary_key] = $this->generate_key();
    //         }

    //         //insert table 
    //         return $this->db->insert($this->$table_name, $data);
    //     }else{
    //         //update data if id is existed
    //         $this->db->where($this->primary_key,$id);
    //         return $this->db->update($this->$table_name, $data);
    //     }
    // }

    //get all record from table
    function get_all_by( $limit = false, $offset = false){
        $this->db->from($this->table_name);
        
        // if(!empty($this->input->get('search_data'))){
        //     $this->db->like('cat_name',$this->input->get('search_data'));
        // }
        if($limit && $limit != 0){
            $this->db->limit($limit);
        }
        if($offset){
            $this->db->offset($offset);
        }
        $query =  $this->db->get();
        return $query->result();
    }

    //get one record by id from table
    function get_one($id){
        $query = $this->db->get_where($this->table_name, [$this->primary_key => $id]);

        if($this->db->count_all_results() == 1){
            //if there is one row, return the record 
            return $query->row();
        }
        // else{
        //     //if there is no record or more than one record, return empty object
        //     return $this->get_empty_object($this->table_name);
        // }
    }

    //count all record from a table
    function count_all(){
    
        $this->db->from($this->table_name);
        return $this->db->count_all_results();
    }

    //delete the record by id
    function delete($id){
        $this->db->where($this->primary_key,$id);
        return $this->db->delete($this->table_name);
    }   
}
?>