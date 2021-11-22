<?php

use Carbon\Carbon;

require_once('controllers/BaseAdminController.php');
require_once('models/Product.php');

class AdminProductController extends BaseAdminController
{
    function __construct()
    {
        $this->page = 'Product Management';
    }

    public function index()
    {
        $products = Product::all();
        $data = array('products' => $products);
        $this->render('products', $data, 'table_js');
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
            $product = Product::findByIdOrFail($_GET['id']);
            $uploaddir = 'assets/img/product/';
            $uploadfile = $uploaddir . "product_img_" . $product->id . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
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
            $product = Product::findByIdOrFail($_GET['id']);
            $product->name = $_POST['name'];
            $product->stock = $_POST['stock'];
            $product->price = $_POST['price'];
            $product->volume = $_POST['volume'];
            $product->description = $_POST['description'];
            $product->save();
        }
    }

    public function deleteProduct()
    {
        if (isset($_GET['id'])) {
            $product = Product::findByIdOrFail($_GET['id']);
            $product->delete();
        }
    }
}
