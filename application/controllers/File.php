<?php

class File extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('files_model');
        $this->load->library('pagination');
    }

    function category()
    {
        // lấy ID của danh mục
        $id = intval($this->uri->rsegment(3));
        // lay ra thông tin của thể loại
        $this->load->model('category_model');
        $category = $this->category_model->get_info($id);
        if (! $category) {
            redirect();
        }
        
        $this->data['category'] = $category;
        $input = array();
        
        // kiêm tra xem đây là danh con hay danh mục cha
        if ($category->parent_id == 0) { // dm cha
            $input_category = array();
            $input_category['where'] = array(
                'parent_id' => $id
            );
            $category_subs = $this->category_model->get_list($input_category);
            if (! empty($category_subs)) // neu danh muc hien tai co danh muc con
            {
                $category_subs_id = array();
                foreach ($category_subs as $sub) {
                    $category_subs_id[] = $sub->id;
                }
                // lay tat ca file thuoc cac danh mục con do
                $this->db->where_in('catid', $category_subs_id);
            } else {
                $input['where'] = array(
                    'catid' => $id
                );
            }
        } else { // dm con
            $input['where'] = array(
                'catid' => $id
            );
        }
        
        // lấy ra danh sách file thuộc danh mục đó
        // lay tong so luong ta ca cac san pham trong website
        $total_rows = $this->files_model->get_total($input);
        $this->data['total_rows'] = $total_rows;
        
        // load ra thu vien phan trang
//         $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows; // tong tat ca cac san pham tren website
        $config['base_url'] = base_url('file/category/' . $id); // link hien thi ra danh sach san pham
        $config['per_page'] = 9; // so luong san pham hien thi tren 1 trang
        $config['uri_segment'] = 4; // phan doan hien thi ra so trang tren url
        $config['num_link'] = 3;
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        // khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);
        
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input['limit'] = array(
            $config['per_page'],
            $segment
        );
        
        // lay danh sach file
        if (isset($category_subs_id)) {
            $this->db->where_in('catid', $category_subs_id);
        }
        $list = $this->files_model->get_list($input); // list file
        $this->data['list'] = $list;
        
        // hiển thị ra view
        $this->data['temp'] = 'site/files/category';
        $this->load->view('site/layout', $this->data);
    }
    
    function myfile()
    {
        // lấy ID của user
        $uid = $this->session->userdata('user_id_login');
        if (! $uid) {
            redirect();
        }
    
        // lay danh sach file
        $this->db->select('*');
        if (isset($uid)) {
            $this->db->where('userid', $uid);
        }
        $list = $this->db->get($this->table); // list file
        $this->data['list'] = $list;
        
        $total_rows = $list->num_row();
        $this->data['total_rows'] = $total_rows;
    
        // hiển thị ra view
        $this->data['temp'] = 'site/files/myfile';
        $this->load->view('site/layout', $this->data);
    }
    
    /*
     * Xem chi tiết sản phẩm
     */
    function view()
    {
        // lay id san pham muon xem
        $id = $this->uri->rsegment(3);
        $files = $this->files_model->get_info($id);
        if (! $files)
            redirect();
        $this->data['files'] = $files;
        
        // lấy danh sách ảnh sản phẩm kèm theo
        $image = $files->image;
        $this->data['image'] = $image;
        
        // cap nhat lai luot xem cua san pham
        $data = array();
        $data['luotxem'] = $files->luotxem + 1;
        $this->files_model->update($files->id, $data);
        
        // lay thong tin cua danh mục san pham
        $category = $this->category_model->get_info($files->catid);
        $this->data['category'] = $category;
        
        // hiển thị ra view
        $this->data['temp'] = 'site/files/view';
        $this->load->view('site/layout', $this->data);
    }

    /*
     * Tim kiem theo ten san pham
     */
    function search()
    {
        if ($this->uri->rsegment('3') == 1) {
            // lay du lieu tu autocomplete
            $key = $this->input->get('term');
        } else {
            $key = $this->input->get('key-search');
        }
        
        $this->data['key'] = trim($key);
        $input = array();
        $input['like'] = array(
            'filename', $key
        );
        $list = $this->files_model->get_list($input);
        $this->data['list'] = $list;
        
        // phan trang
        // lấy ra danh sách file thuộc danh mục đó
        // lay tong so luong ta ca cac san pham trong websit
        $total_rows = count($list);
        $this->data['total_rows'] = $total_rows;
        
//         // load ra thu vien phan trang
//         $this->load->library('pagination');
//         $config = array();
//         $config['total_rows'] = $total_rows; // tong tat ca cac san pham tren website
//         $config['base_url'] = base_url('file/search/'); // link hien thi ra danh sach san pham
//         $config['per_page'] = 9; // so luong san pham hien thi tren 1 trang
//         $config['uri_segment'] = 4; // phan doan hien thi ra so trang tren url
//         $config['num_link'] = 3;
//         $config['next_link'] = 'Next';
//         $config['prev_link'] = 'Prev';
//         // khoi tao cac cau hinh phan trang
//         $this->pagination->initialize($config);
        
//         $segment = $this->uri->segment(4);
//         $segment = intval($segment);
//         $input['limit'] = array(
//             $config['per_page'],
//             $segment
//         );
        
        if ($this->uri->rsegment('3') == 1) {
            // xu ly autocomplete
            $result = array();
            foreach ($list as $row) {
                $item = array();
                $item['id'] = $row->id;
                $item['label'] = $row->filename;
                $item['value'] = $row->filename;
                $result[] = $item;
            }
            // du lieu tra ve duoi dang json
            die(json_encode($result));
        } else {
            
            // load view
            $this->data['temp'] = 'site/files/search';
            $this->load->view('site/layout', $this->data);
        }
    }
}