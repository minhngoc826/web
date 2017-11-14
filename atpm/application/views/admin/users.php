<?php 
//    if (!defined('IN_SITE')) die ('The request not found');
// 
//    // Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
//    if (!is_admin()){
//        redirect(base_url('admin'), array('m' => 'common', 'a' => 'logout'));
//    }
    
    // VỊ TRÍ 01: CODE XỬ LÝ PHÂN TRANG 
    // Tìm tổng số records
//    $sql = db_create_sql('SELECT count(id) as counter from users {where}');
//    $result = db_get_row($sql);
//    $total_records = $result['counter'];
// 
//    // Lấy trang hiện tại
//    $current_page = input_get('page');
// 
//    // Lấy limit
//    $limit = 10;
// 
//    // Lấy link
//    $link = create_link(base_url('admin'), array(
//        'm' => 'user',
//        'a' => 'list',
//        'page' => '{page}'
//    ));
// 
//    // Thực hiện phân trang
//    $paging = paging($link, $total_records, $current_page, $limit);
// 
//    // Lấy danh sách User
//    $sql = db_create_sql("SELECT * FROM tb_user {where} LIMIT {$paging['start']}, {$paging['limit']}");

//    $sql = db_create_sql('SELECT * FROME users');
//    $users = db_get_list($sql);
?>
 
<h1>Danh sách thành viên</h1>
<div class="controls">
    <a class="btn btn-primary" href="#">Thêm</a>
</div>
<table cellspacing="1" cellpadding="1" class="form" border="1">
    <thead>
        <tr>
            <td>ID</td>
            <td>Username</td>
            <td>Password</td>
            <td>Fullname</td>
            <td>RoleId</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>admin</td>
            <td>admin123</td>
            <td>Nguyen Minh Ngoc</td>
            <td>1</td>
            <td>
                <form method="POST" class="form-delete" action="#">
                    <a href="#">Edit</a>
                    <input type="hidden" name="user_id" value="id"/>
                    <input type="hidden" name="request_name" value="delete_user"/>
                    <a href="#" class="btn-submit">Delete</a>
                </form>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>user1</td>
            <td>user1123</td>
            <td>bui Van Cong</td>
            <td>2</td>
            <td>
                <form method="POST" class="form-delete" action="#">
                    <a href="#">Edit</a>
                    <input type="hidden" name="user_id" value="id"/>
                    <input type="hidden" name="request_name" value="delete_user"/>
                    <a href="#" class="btn-submit">Delete</a>
                </form>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>user2</td>
            <td>user2123</td>
            <td>Nguyen Van Thang</td>
            <td>3</td>
            <td>
                <form method="POST" class="form-delete" action="#">
                    <a href="#">Edit</a>
                    <input type="hidden" name="user_id" value="id"/>
                    <input type="hidden" name="request_name" value="delete_user"/>
                    <a href="#" class="btn-submit">Delete</a>
                </form>
            </td>
        </tr>
        <tr>
            <td>4</td>
            <td>user3</td>
            <td>user3123</td>
            <td>Phan Trong Tue</td>
            <td>3</td>
            <td>
                <form method="POST" class="form-delete" action="#">
                    <a href="#">Edit</a>
                    <input type="hidden" name="user_id" value="id"/>
                    <input type="hidden" name="request_name" value="delete_user"/>
                    <a href="#" class="btn-submit">Delete</a>
                </form>
            </td>
        </tr>
    </tbody>
</table>
 
<div class="pagination">
    <?php 
    // VỊ TRÍ 03: CODE HIỂN THỊ CÁC NÚT PHÂN TRANG
//    echo $paging['html']; 
    ?>
</div>