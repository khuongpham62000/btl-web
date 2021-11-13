<?php
require_once('models/Account.php');

session_start();
class Auth
{
    public static function isLogin()
    {
        return isset($_SESSION['user']);
    }

    public static function isAdmin()
    {
        return $_SESSION['user']->role == "ADMIN";
    }

    public static function login($account)
    {
        $_SESSION['user'] = $account;
        $_SESSION['cart'] = [];
    }

    public static function logout()
    {
        session_destroy();
    }
}
