<?php
require_once('controllers/BaseUserController.php');

class UserFronksController extends BaseUserController
{
    function __construct()
    {
        $this->page = "FRONKS";
    }

    public function index()
    {
        $this->render('fronks');
    }

    public function error()
    {
        $this->render('error');
    }
}
