<?php
class User extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('ages_model');
    }
    
    function check_email()
    {
        $email = $this->input->post('email');
        $where = array('username' => $email);
        //kiêm tra xem email đã tồn tại chưa
        if($this->users_model->check_exists($where))
        {
            //trả về thông báo lỗi
            $this->form_validation->set_message(__FUNCTION__, 'Username đã tồn tại');
            return false;
        }
        return true;
    }
    
    /*
     * Đăng ký thành viên
     */
    function register()
    {
        //neu dang dang nhap thi chuyen ve trang thong tin thanh vien
        if($this->session->userdata('user_id_login'))
        {
            redirect(site_url('user'));
        }
    
        $this->load->library('form_validation');
        $this->load->helper('form');
    
        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('email', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('re_password', 'Repeat Password', 'matches[password]');
            $this->form_validation->set_rules('age', 'Age', 'required');
    
            //nhập liệu chính xác
            if($this->form_validation->run())
            {
                //them vao csdl
                $ages = $this->input->post('age');
                $ages = intval($ages);
                $ageid = 4;
                // xác định ageid
                $list_age = $this->db->get('ages')->result_array();
                $max = 0;
                foreach ($list_age as $ag) {
                    if ($ages >= $ag['age'] && $ag['age'] >= $max) {
                        $max = $ag['age'];
                        $ageid = $ag['id'];
                    }
                }
    
                $data = array(
                    'username'    => $this->input->post('email'),
                    'password' => $this->input->post('password'),
                    'age'    => $ages,
                    'ageid' => $ageid,
                    'partid'  => 4,
                    'roleid' => 3
                );
                if($this->users_model->create($data))
                {
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Đăng ký thành viên thành công');
                } else {
                    $this->session->set_flashdata('message', 'Đăng ký không thành công');
                }
                
                //chuyen tới trang danh sách quản trị viên
                redirect(site_url('user/index'));
            }
        }
    
        //hiển thị ra view
        $this->data['temp'] = 'site/user/register';
        $this->load->view('site/layout', $this->data);
    }
    
    /*
     * Kiem tra đăng nhập
     */
    function login()
    {
        //neu dang dang nhap thi chuyen ve trang thong tin thanh vien
        if($this->session->userdata('user_id_login'))
        {
            redirect(site_url('user/index'));
        }
    
        $this->load->library('form_validation');
        $this->load->helper('form');
    
        if($this->input->post())
        {
            $this->form_validation->set_rules('email', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('login' ,'login', 'callback_check_login');
            if($this->form_validation->run())
            {
                //lay thong tin thanh vien
                $user = $this->_get_user_info();
                
                if ($user) {
                    //gắn session id của thành viên đã đăng nhập
                    $this->session->set_userdata('user_id_login', $user->id);
                    $this->session->set_flashdata('message', 'Đăng nhập thành công');
                    redirect(base_url('user/ages'));
                } else {
                    redirect(base_url('user/login'));
                }
            }
        }
    
        //hiển thị ra view
        $this->data['temp'] = 'site/user/login';
        $this->load->view('site/layout', $this->data);
    }
    
    /*
     * Lay thong tin cua thanh vien
     */
    
    function _get_user_info()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
    
        //         $where = array('username' => $email , 'password' => $password);
    
        $email = 'admin';
        $password = 'admin123';
    
        $this->db->where('username', $email);
        $this->db->where('password', $password);
        $query = $this->db->get('users');
        $user = null;
        if ($query->num_rows() > 0) {
            $user = $query->row();
        }
        //         $user = $this->users_model->get_info_rule($where);
        return $user;
    }
    
    function ages() {
        $list_age = $this->db->get('ages')->result_array();
        $this->data['agess'] = $list_age;
    
        $user_id = $this->session->userdata('user_id_login');
        //         $user_id = 1;
    
    
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            $user = $query->row();
            $this->data['user'] = $user;
            $this->data['users_id'] = $user->id;
        }
    
        //         $email = 'admin';
        //         $password = 'admin123';
    
        //         $this->db->where('username', $email);
        //         $this->db->where('password', $password);
        //         $query = $this->db->get('users');
        //         if ($query->num_rows() > 0) {
        //             $user = $query->row();
        //             $this->data['user'] = $user;
        //             $this->data['users_id'] = $user->id;
        //         }
    
        //hiển thị ra view
        $this->data['temp'] = 'site/user/ages';
        $this->load->view('site/layout', $this->data);
    }
    
    /*
     * Kiem tra email va password co chinh xac khong
     */
    function check_login()
    {
        $user = $this->_get_user_info();
        if($user)
        {
            return true;
        }
        $this->form_validation->set_message(__FUNCTION__, 'Đăng nhập không thành công');
        return false;
    }
    
    /*
     * Chinh sua thong tin thanh vien
     */
    function edit()
    {
        if(!$this->session->userdata('user_id_login'))
        {
            $this->session->set_flashdata('message', 'Bạn phải đăng nhập mới xem được chức năng này');
            redirect(site_url('user/login'));
        }
        //lay thong tin cua thanh vien
        $user_id = $this->session->userdata('user_id_login');
        $user = $this->users_model->get_info($user_id);
        if(!$user)
        {
            redirect();
        }
        $this->data['user']  = $user;
    
    
        $this->load->library('form_validation');
        $this->load->helper('form');
    
        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $password = $this->input->post('password');
    
            if($password)
            {
                $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
                $this->form_validation->set_rules('re_password', 'Repeat Password', 'matches[password]');
            }
    
            $this->form_validation->set_rules('age', 'Age', 'required');
    
            //nhập liệu chính xác
            if($this->form_validation->run())
            {
                //them vao csdl
                $age = $this->input->post('age');
                // xác định ageid
                $this->load->model('ages_model');
                $list_age = $this->ages_model->get_all();
                $max = 0;
                foreach ($list_age as $ag) {
                    if ($ages >= $ag['age'] && $ag['age'] >= $max) {
                        $max = $ag['age'];
                        $ageid = $ag['id'];
                    }
                }
                
                $data = array(
                    'username'     => $this->input->post('email'),
                    'age'    => $age,
                    'ageid' => $ageid
                );
                
                if($password)
                {
                    $data['password'] = $password;
                }
                if($this->users_model->update($user_id, $data))
                {
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Chỉnh sửa thông tin thành công');
                }else{
                    $this->session->set_flashdata('message', 'Chỉnh sửa thông tin không thành công');
                }
                //chuyen tới trang danh sách quản trị viên
                redirect(site_url('user'));
            }
        }
    
        //hiển thị ra view
        $this->data['temp'] = 'site/user/edit';
        $this->load->view('site/layout', $this->data);
    }
    
    /*
     * Thong tin cua thanh vien
     */
    function index()
    {
        if(!$this->session->userdata('user_id_login'))
        {
            redirect();
        }
        $user_id = $this->session->userdata('user_id_login');
//         $this->db->where('id', $user_id);
//         $user = $this->db->get($this->table);
        $user = $this->users_model->get_info($user_id);
        if(!$user)
        {
            redirect();
        }
        $this->data['user']  = $user;
    
        //hiển thị ra view
        $this->data['temp'] = 'site/user/index';
        $this->load->view('site/layout', $this->data);
    }
    
    /*
     * Thuc hien dang xuat
     */
    function logout()
    {
        if($this->session->userdata('user_id_login'))
        {
            $this->session->unset_userdata('user_id_login');
        }
        $this->session->set_flashdata('message', 'Đăng xuất thành công');
        redirect();
    }
    
   
    
   
    
}