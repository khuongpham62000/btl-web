<?php
require_once('controllers/BaseAuthController.php');
require_once('models/Account.php');

class RegisterController extends BaseAuthController
{
    function __construct()
    {
        $this->page = "Register";
    }

    public function index()
    {
        $this->render('register');
    }

    public function register()
    {
        $mailRegex = '/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i';
        $phoneRegex = '/^0[0-9]{9,10}+$/';
        if (
            isset($_POST['name']) && isset($_POST['phone']) &&
            isset($_POST['email']) && isset($_POST['password']) &&
            $_POST['name'] != '' && $_POST['phone'] != '' &&
            $_POST['email'] != '' && $_POST['password'] != '' &&
            preg_match($mailRegex, $_POST['email']) == 1 &&
            preg_match($phoneRegex, $_POST['phone']) == 1
        ) {
            $newAccount = new Account(
                $_POST['name'],
                $_POST['email'],
                $_POST['password'],
                $_POST['phone'],
                '',
                'assets/img/account/account_default.jpg'
            );
            $newAccount->role = "USER";
            $newAccount->create();
            echo json_encode(array("status" => 200));
        } else {
            echo json_encode(array("status" => 401));
        }
    }
}
