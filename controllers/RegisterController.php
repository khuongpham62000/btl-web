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
        $newAccount = new Account(
            $_POST['name'],
            $_POST['email'],
            $_POST['password'],
            $_POST['phone']
        );
        $newAccount->role = "USER";
        $newAccount->create();
        echo json_encode(array("status" => 200));
        return;
        // echo json_encode(array("status" => 401));
    }
}
