<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Login extends MY_Controller {
    function __construct() {
        parent::__construct();
//        $this->load->model('Users_model');
    }
    
    function index() {
        $data = array();
        $data['content'] = 'site/home/login';
        $this->load->view('site/layout', $data);
    }
    
    function register() {
        $data = array();
        $data['content'] = 'site/home/register';
        $this->load->view('site/layout', $data);
    }
            
    function check_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $where = array('username'=>$username, 'password'=>$password);
        if ($this->Users_model->check_exists($where)) return true;
        else {
            $this->form_validation->set_message(__FUNCTION__, "Không đăng nhập thành công");
            return false;
        }
    }
    
    function login() {
        $data = array();
        if ($this->input->post()) {
            $this->form_validation->set_rules('login', 'login', 'calback_check_login');
            if ($this->form_validation->run()) {
                $user = $this->input->post('username');
                $this->session->set_userdata('login', $user);
                redirect();
            }
        }
        else $this->load->view('site/home/login', $data);
    }
}