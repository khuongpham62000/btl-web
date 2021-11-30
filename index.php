<?php
require_once('env.php');
require_once('connection.php');
require_once('auth.php');
require_once('vendor/autoload.php');

if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'index';
    }
} else {
    $controller = 'UserFronks';
    $action = 'index';
}

// Verify admin
if (strncmp($controller, "Admin", 5) == 0 && strcmp($controller, "AdminProfile") != 0) {
    if (!Auth::isLogin() || !Auth::isAdmin()) {
        header('Location: ../index.php?controller=Login');
    }
    // Verify User
} else if (strcmp($controller, "UserProfile") == 0 || strcmp($controller, "AdminProfile") == 0) {
    if (!Auth::isLogin()) {
        header('Location: ../index.php?controller=Login');
    }
}

require_once('routes.php');
