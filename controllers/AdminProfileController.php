<?php

use Carbon\Carbon;

require_once('controllers/BaseAdminController.php');
require_once('models/Account.php');

class AdminProfileController extends BaseAdminController
{
    function __construct()
    {
        $this->page = 'Profile';
    }

    public function index()
    {
        $account = Account::findById($_SESSION['user']->id);
        $data = array('account' => $account);
        $this->render('profile', $data);
    }

    public function viewDetail()
    {
        if (isset($_GET['id'])) {
            $product = Product::findByIdOrFail($_GET['id']);
            $data = array('product' => $product,);
            $this->render('product_detail', $data);
        }
    }

    public function updateImage()
    {
        if (isset($_GET['id'])) {
            $product = Account::findByIdOrFail($_GET['id']);
            $uploaddir = 'assets/img/account/';
            $uploadfile = $uploaddir . "account_img_" . $product->id . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $product->image = $uploadfile;
            $product->save();
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                $_SESSION['user']->image == $uploadfile;
                require_once('controllers/Utils.php');
                resizeImage($uploadfile);
            } else {
                echo "Possible file upload attack!\n";
            }
        }
    }

    public function save()
    {
        if (isset($_GET['id'])) {
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
                $account = Account::findByIdOrFail($_GET['id']);
                $account->name = $_POST['name'];
                $account->email = $_POST['email'];
                $account->phone = $_POST['phone'];
                $account->address = $_POST['address'];
                $account->save();
                $_SESSION['user'] = $account;
                echo json_encode(array("status" => 200));
            } else {
                echo json_encode(array("status" => 401));
            }
        }
    }
}
