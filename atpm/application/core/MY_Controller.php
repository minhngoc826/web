<?php 
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller {
    function __construct() {
        parent::__construct();
//        $this->check_login();
    }
    
    function check_login() {
        //lay ra gia tri cua controller
        $controller = $this->uri->segment(2);
        $action = $this->uri->segment(3);
        $controller = strtolower($controller);
        $action = strtolower($action);
        $login = $this->session->userdata('login');

        // neu admin chua dang nhap thi chi cho vao trang login
        // neu chua ton tai session login va controller khong phai login
        if (!$login) {
            if ($controller != 'login')
                redirect('Home/index');
            else
                redirect('Login/index');
        } else {
            if ($controller == 'login') {
//                $permission = $this->session->userdata('permission');
//                $this->load->model('Permission_model');
//                $input = array();
//                $input['where'] = array (
//                    'controller' => $controller,
//                    'action' => $action
//                    );
                
                redirect('Home/index');
            }
                
        }
        
        
    }
}