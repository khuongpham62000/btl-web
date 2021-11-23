<?php

require_once('controllers/BaseAdminController.php');
require_once('models/Account.php');

class AdminUserController extends BaseAdminController
{
    function __construct()
    {
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
                require_once('controllers/Utils.php');
                resizeImage($uploadfile);
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

    public function addUser()
    {
        if (!isset($_GET['new'])) {
            $this->render('user_new');
            return;
        } else {
            // require_once('./test.php');
            // var_pre($_POST);
            $mailRegex = '/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i';
            $phoneRegex = '/^0[0-9]{9,10}+$/';
            if (
                isset($_POST['name']) && isset($_POST['email']) &&
                isset($_POST['password']) && isset($_POST['phone']) &&
                $_POST['name'] != '' && $_POST['email'] != '' &&
                $_POST['password'] != '' && $_POST['phone'] != '' &&
                is_numeric($_POST['phone']) &&
                preg_match($mailRegex, $_POST['email']) == 1 &&
                preg_match($phoneRegex, $_POST['phone']) == 1
            ) {
                $role = (strcmp($_POST['role'], "USER") != 0 || strcmp($_POST['role'], "ADMIN") != 0) ? "USER" : $_POST['role'];
                $new_account_id = Account::getNewId();
                $uploaddir = 'assets/img/account/';
                $uploadfile = $uploaddir . "account_img_" . $new_account_id . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                    require_once('controllers/Utils.php');
                    resizeImage($uploadfile);
                    $_SESSION['user']->image == $uploadfile;
                    $newAccount = new Account(
                        $new_account_id,
                        $_POST['name'],
                        $_POST['email'],
                        $_POST['password'],
                        $_POST['phone'],
                        $_POST['address'],
                        $uploadfile,
                        $role,
                    );
                    $newAccount->role = "USER";
                    $newAccount->create();
                    echo json_encode(array("status" => 200, 'id' => $new_account_id));
                } else {
                    echo json_encode(array("status" => 401, "message" => "Possible file upload attack!\n"));
                }
            } else {
                echo json_encode(array("status" => 401));
            }
        }
    }
}
