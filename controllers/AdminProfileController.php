<?php

use Carbon\Carbon;

require_once('controllers/BaseAdminController.php');
require_once('models/Account.php');

class AdminProfileController extends BaseAdminController
{
    function __construct()
    {
        $this->folder = 'admin';
        $this->page = 'Profile';
    }

    public function index()
    {
        $account = Account::findById(1);
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
            $account->address = $_POST['address'];
            $account->save();
        }
    }
}
