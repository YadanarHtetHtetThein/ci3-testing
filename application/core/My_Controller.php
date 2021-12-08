<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Controller{}

class Core_Controller extends CI_Controller{

    //pagination config
    protected $pag;

    //data to load in the view
    protected $data;

    //module folder path
    protected $module_path;
    protected $module_url;

    //template folder path
    protected $template_path;

    /** construct CI Controller construction */
    function __construct(){
        parent::__construct();

        //load libraries
        $this->load->library(array('Hash' , 'Auth'));

        //template path
        $this->template_path = "";
        
        //load pagination config
        $this->pag = $this->config->item('pagination');

        //base_url and site_url
        $this->module_url = strtolower( get_class( $this ));
		$this->module_path = $this->module_url;
        // $this->module_path = 'categories';
    }

    /**
	 * Determines if post.
	 *
	 * @return     boolean  True if post, False otherwise.
	 */
	function is_POST()
	{
		return ( $this->input->method( TRUE ) == 'POST' );
	}

    /**
     * Load a view
     */
    function load_view($view, $data = false){
        if(!empty($this->template_path)){
            $this->load->view($this->template_path.'/'.$view, $data);
        }
        $this->load->view($view);
    }

    /**
     * Load a template
     */
    function load_template($view = false){
        $this->load_view('layouts/header');

        if(!empty($view)){
            $this->load_view($view);
        }

        $this->load_view('layouts/footer');
    }

    /**
     * Load a list view
     */
    function load_list($data){
        //load header
        $this->load->view('layouts/header');
        //load list view
        $this->load->view($this->module_path.'/index',$data);
        //load footer
        $this->load->view('layouts/footer');
    }

    /**
     * Load create form view
     */
    function load_form($data = false){
        //load header
        $this->load->view('layouts/header');

        if($data){
            //load edit form view 
            $this->load->view($this->module_path.'/edit',$data);
        }else{
            //load create form view
            $this->load->view($this->module_path.'/create');
        }
        
        //load footer
        $this->load->view('layouts/footer');
    }

    /**
     * Load a detail view by id
     */
    function load_detail($data){
        //load header
        $this->load->view('layouts/header');
        //load list view
        $this->load->view($this->module_path.'/detail',$data);
        //load footer
        $this->load->view('layouts/footer');
    }

    /**
     * Provide pagination config
     */
    function load_pag($base_url, $rows_count){
        $this->pag['base_url'] = $base_url;
        $this->pag['total_rows'] = $rows_count;
        $this->pagination->initialize($this->pag);
    }

    /**
     * return site url for controller
     */
    function module_site_url($path = false){
        if($path){
            return site_url($this->module_url.'/'.$path);
        }
        return site_url($this->module_url);
    }

}

require_once(APPPATH . 'core/BE_Controller.php');
require_once(APPPATH . 'core/FE_Controller.php');
?>