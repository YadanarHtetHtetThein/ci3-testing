<?php
/** Home Page Config */
/* 1) if both frontend and backend folder exist */
// $config['homepage'] = "home";
// $config['reset_url'] = "reset";

/* 2) if only backend folder */
$config['homepage'] = "admin";
$config['reset_url'] = "reset_email";

/** FrontEnd Template Path */
$config['fe_view_path'] = 'frontend';
$config['fe_url'] = '';

/** Backend Teamplate Path */
$config['be_view_path'] = 'backend';
$config['be_url'] = 'admin';

/** Upload folder path */
$config['upload_path'] = 'images/';
$config['upload_thumbnail_path'] = 'images/thumbnail/';
$config['image_type'] = 'jpg|jpeg|png|csv|gif';
$config['max_size'] = '102400';

/** Pagination */
$config['pagination']['per_page'] = 2;
$config['pagination']['uri_segment'] = 2;
$config['pagination']['attributes'] = array('class' => 'page-link');
$config['pagination']['full_tag_open'] =  '<ul class="pagination">';
$config['pagination']['full_tag_close'] = '</ul>';
$config['pagination']['num_tag_open'] = '<li class="page-item">';
$config['pagination']['num_tag_close'] = '</li>';
$config['pagination']['first_link'] = 'First';
$config['pagination']['first_tag_open'] = '<li class="page-item">';
$config['pagination']['first_tag_close'] = '</li>';
$config['pagination']['last_link'] = 'Last';
$config['pagination']['last_tag_open'] = '<li class="page-item">';
$config['pagination']['last_tag_close'] = '</li>';
$config['pagination']['next_link'] = 'Next';
$config['pagination']['next_tag_open'] = '<li class="page-item">';
$config['pagination']['next_tag_close'] = '</li>';
$config['pagination']['prev_link'] = 'Prev';
$config['pagination']['prev_tag_open'] = '<li class="page-item">';
$config['pagination']['prev_tag_close'] = '</li>';
$config['pagination']['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
$config['pagination']['cur_tag_close'] = '</a></li>';
?>