<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admin extends MY_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $data = array();
        $data['content'] = 'admin/index';
        
        $this->load->view('admin/layout', $data);
    }
    
    function users() {
        $data = array();
        $data['content'] = 'admin/users';
        
        $this->load->view('admin/layout', $data);
    }
    
    function permission() {
        $data = array();
        $data['content'] = 'admin/permission';
        
        $this->load->view('admin/layout', $data);
    }
    
    function files() {
        $data = array();
        $data['content'] = 'admin/files';
        
        $this->load->view('admin/layout', $data);
    }
}
