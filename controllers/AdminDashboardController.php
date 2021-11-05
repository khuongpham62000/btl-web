<?php
require_once('controllers/BaseAdminController.php');
require_once('models/OrderList.php');

class AdminDashboardController extends BaseAdminController
{
    function __construct()
    {
        $this->folder = 'admin';
        $this->page = 'Dashboard';
    }

    public function index()
    {
        $orders = OrderList::all();
        $data = array('orders' => $orders);
        $this->render('dashboard', $data);
    }
}
