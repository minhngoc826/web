<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Home extends MY_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
//        echo 'HomePage Ngoc <br>';
//        $conn = new mysqli('localhost', 'root', '', 'atpm');
//        if ($conn->connect_error) {
//            die("Ket noi khong thanh cong: " . $conn->connect_error);
//        }
//        $this->load->database();
        
        // insert du lieu
//        $sql_new = "INSERT INTO users (username, email, password, fullname) "
//                . "VALUE (";
//        $a = 100;
//        for ($i = 1; $i <= 100; $i++) {
//            $user = 'user'. $i;
//            $pass = 'pass' . $i;
//            $fullname = 'Nguyen Van A' . $i;
//            $email = $user . '@gmail.com';
//            $sql = $sql_new . "'" . $user . "','" . $email . "','" . $pass . "','" . $fullname . "')";
//            if (mysqli_query($conn, $sql)) {
//                echo 'Inser thanh cong <br>';
//            } else {
//                echo 'Insert that bai <br>';
//            }
//        }
        
        $data = array();
        $data['content'] = 'site/home/index';
        
        $this->load->view('site/layout', $data);
    }
    
    function upload() {
        $data = array();
        $data['content'] = 'site/home/upload';
        
        $this->load->view('site/layout', $data);
    }
    
    function profile() {
        $data = array();
        $data['content'] = 'site/home/profile';
        
        $this->load->view('site/layout', $data);
    }
    
    function admin() {
        $data = array();
        $data['content'] = 'site/home/admin';
        
        $this->load->view('site/layout', $data);
    }
    
    function showfile() {
        $data = array();
        $data['content'] = 'site/home/showfile';
        $this->load->view('site/layout', $data);
    }
}
