<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Languages extends CI_Controller {

  public function __construct(){
    parent::__construct();
  }

  public function index()
  {
    $this->session->set_userdata('site_lang',  "english");
    $this->load->view('language');
  }

  public function switchLang($language = "") {
    $this->session->set_userdata('site_lang', $language);
    header('Location: http://localhost:8000/languages/');
  }
}