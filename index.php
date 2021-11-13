<?php
require_once('env.php');
require_once('connection.php');
require_once('auth.php');
require_once('vendor/autoload.php');

require_once('test.php');
// var_pre(Auth::isLogin());
// var_pre($_SESSION);

if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'index';
    }
} else {
    $controller = 'Test';
    $action = 'index';
}

// Verify admin
if (strncmp($controller, "Admin", 5) == 0) {
    if (!Auth::isLogin() || !Auth::isAdmin()) {
        header('Location: ../index.php?controller=Login');
    }
}

require_once('routes.php');
