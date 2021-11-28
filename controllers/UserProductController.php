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
        $products = Product::all();
        $this->render('products', array("products" => $products));
    }

    public function cart()
    {
        $products = Product::all();
        $this->render('cart', array("products" => $products));
    }
}
