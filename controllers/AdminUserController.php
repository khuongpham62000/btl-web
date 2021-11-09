<?php

use Carbon\Carbon;

require_once('controllers/BaseAdminController.php');
require_once('models/Account.php');

class AdminUserController extends BaseAdminController
{
    function __construct()
    {
        $this->folder = 'admin';
        $this->page = 'User Management';
    }

    public function index()
    {
        $this->render(
            'users',
            array('accounts' => Account::all()),
            'table_js'
        );
    }

    public function viewDetail()
    {
        if (isset($_GET['id'])) {
            $this->render(
                'user_detail',
                array('account' => Account::findByIdOrFail($_GET['id']))
            );
        } else header('Location: index.php?controller=AdminDashboard&action=error');
    }

    public function updateImage()
    {
        if (isset($_GET['id'])) {
            $product = Account::findByIdOrFail($_GET['id']);
            $uploaddir = 'assets/img/account/';
            $uploadfile = $uploaddir . "account_img_" . $product->id . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $product->image = $uploadfile;
            $product->save();
            echo '<pre>';
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                echo "File is valid, and was successfully uploaded.\n";
            } else {
                echo "Possible file upload attack!\n";
            }
        }
    }

    public function save()
    {
        if (isset($_GET['id'])) {
            $account = Account::findByIdOrFail($_GET['id']);
            $account->name = $_POST['name'];
            $account->email = $_POST['email'];
            $account->phone = $_POST['phone'];
            $account->address = $_POST['address'];
            $account->role = $_POST['role'];
            $account->save();
        }
    }

    public function deleteUser()
    {
        if (isset($_GET['id'])) {
            $account = Account::findByIdOrFail($_GET['id']);
            $account->delete();
        }
    }
}
