<?php
require_once('controllers/BaseAuthController.php');
require_once('models/Account.php');

class LoginController extends BaseAuthController
{
    function __construct()
    {
        $this->page = "Login";
    }

    public function index()
    {
        $this->render('login');
    }

    public function verify()
    {
        if (isset($_POST['email']) && isset($_POST['password']) && $_POST['email'] != '' && $_POST['password'] != '') {
            $findAccount = Account::findAccountByEmail($_POST['email']);
            if (is_null($findAccount) || $findAccount->password != $_POST['password']) {
                echo json_encode(array("status" => 401));
                return;
            }
            Auth::login($findAccount);
            echo json_encode(array("status" => 200, "type" => $findAccount->role));
            return;
        }
        echo json_encode(array("status" => 401));
    }

    public function logout()
    {
        Auth::logout();
        $this->render('login');
    }
}
