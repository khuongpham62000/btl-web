<?php
require_once('controllers/BaseUserController.php');
require_once('models/Product.php');

class UserProductController extends BaseUserController
{
    function __construct()
    {
        $this->page = "Nut Milks";
    }

    public function index()
    {
        $id = "-1";
        $products = Product::all();
        if (isset($_GET["id"])) {
            if (!is_null(Product::findById($_GET["id"])))
                $id = $_GET["id"];
        }
        $this->render('products', array("products" => $products, "id" => $id));
    }
}
