<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BE_Controller extends Core_Controller{

    function __construct(){
        parent::__construct();

        //template path
        $this->template_path = '';
    }

    /**
     * Load template
     */
    function load_templates($view = false, $data = false){
        //load header
        $this->load_view('layouts/header');

        //load view
        if(!empty($view)){
            $this->load_view('layouts/structure', array('view'=>$view, 'data' => $data));
        }

        //load footer
        $this->load_view('layouts/footer');
    }

    /**
     * Index list page
     */
    function index(){
        $this->list_view($this->module_site_url());
    }

    /**
     * Add a new record
     */
    function add(){
        //login in required
        $this->auth->login_required('create');

        // if($this->is_POST()){
                //save data record
        // }

        //load entry form
        $this->load_form();
    }

    /**
     * Edit a new record 
     */
    function edit($id){
        //login in required
        $this->auth->login_required('create');

        // if($this->is_POST()){
                //edit data record
        // }

        //load entry form 
        $this->load_form($this->data);
    }

    function detail($id){
        //login in required
        $this->auth->login_required('create');

        //load detail view
        $this->load_detail($this->data);
    }

    function list_view($base_url){
        $rows_count = $this->data['rows_count'];
        $this->load_pag($base_url, $rows_count);
        $this->load_list($this->data);
    }

}
?>