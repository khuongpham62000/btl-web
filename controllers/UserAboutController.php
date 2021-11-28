<?php
require_once('controllers/BaseUserController.php');

class UserAboutController extends BaseUserController
{
    function __construct()
    {
        $this->page = "About Us";
    }

    public function index()
    {
        $this->render('about');
    }
}
