<?php
require_once('controllers/BaseController.php');

class TestController extends BaseController
{
    function __construct()
    {
    }

    public function index()
    {
        require_once('test.php');
    }
}
