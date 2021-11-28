<?php
require_once('controllers/BaseUserController.php');
require_once('models/Account.php');

class UserProfileController extends BaseUserController
{
    function __construct()
    {
        $this->page = "Profile";
    }

    public function index()
    {
        $account = Account::findById($_SESSION['user']->id);
        $data = array('account' => $account);
        $this->render('profile', $data);
    }
}
