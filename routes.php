<?php
// Các controllers trong hệ thống và các action có thể gọi ra từ controller đó.
$controllers = array(
    'AdminDashboard' => ['index', 'error'],
    'AdminOrder' => ['index', 'finishedOrder', 'viewDetail', 'deleteOrder'],
    'AdminUser' => ['index', 'viewDetail', 'save', 'deleteUser', 'updateImage', 'addUser'],
    'AdminProduct' => ['index', 'viewDetail', 'save', 'updateImage', 'addProduct', 'deleteProduct'],
    'AdminProfile' => ['index', 'save', 'updateImage'],
    'Login' => ['index', 'verify', 'logout'],
    'Register' => ['index', 'register'],
    'UserProduct' => ['index',],
    'UserCart' => ['index', 'order'],
    'UserProfile' => ['index',],
    'UserAbout' => ['index',],
    'Test' => ['index'],
);

// Nếu các tham số nhận được từ URL không hợp lệ (không thuộc list controller và action có thể gọi
// thì trang báo lỗi sẽ được gọi ra.
if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
    $controller = 'AdminDashboard';
    $action = 'error';
}

// Nhúng file định nghĩa controller vào để có thể dùng được class định nghĩa trong file đó
include_once('controllers/' . $controller . 'Controller.php');
// Tạo ra tên controller class từ các giá trị lấy được từ URL sau đó gọi ra để hiển thị trả về cho người dùng.
$klass = $controller . 'Controller';
$controller = new $klass;
$controller->$action(); // magic method
