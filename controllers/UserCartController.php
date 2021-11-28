<?php
require_once('controllers/BaseUserController.php');
require_once('models/Product.php');

class UserCartController extends BaseUserController
{
    function __construct()
    {
        $this->page = "Cart";
    }

    public function index()
    {
        $products = Product::all();
        $this->render('cart', array("products" => $products));
    }

    public function order()
    {
        # code...
    }
}
