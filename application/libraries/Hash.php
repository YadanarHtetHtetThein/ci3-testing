<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hash{
    function make($password){
        return password_hash($password,PASSWORD_BCRYPT);
    }
    
    function check($password, $db_password){
        if(password_verify($password,$db_password)){
            return true;
        }else{
            return false;
        }
    }
}
?>