<?php
require_once('env.php');
require_once('connection.php');

if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'index';
    }
} else {
    $controller = 'AdminDashboard';
    $action = 'index';
}
require_once('routes.php');
