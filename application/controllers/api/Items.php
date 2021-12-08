<?php

require APPPATH . 'libraries/REST_Controller.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends REST_Controller{
    /**
     * Get all data from this methid
     * @return Response
     */
    function __construct(){
        parent::__construct();
    }

    function index_get($id = 0){
        if(!empty($id)){
            $data = $this->db->get_where('items',['id'=>$id])->row_array();
        }else{
            $data = $this->db->get("items")->result();
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    function index_post(){
        $input = $this->input->post();
        $this->db->insert('items',$input);

        $this->response(['Item created successfully.'], REST_Controller::HTTP_OK);
    }

    function index_put($id){
        $input = $this->put();
        $this->db->update("items",$input, ['id'=>$id]);

        $this->response(['Item updated successfully.'], REST_Controller::HTTP_OK);
    }

    function index_delete($id){
        $this->db->delete('items', ['id'=>$id]);

        $this->response(['Item delete successfully.'], REST_Controller::HTTP_OK);
    }


    
}