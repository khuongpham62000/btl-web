<?php
require_once('controllers/BaseUserController.php');

class TestController extends BaseUserController
{
    function __construct()
    {
    }

    public function index()
    {
        require_once('test.php');
    }
}
