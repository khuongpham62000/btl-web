<?php

use Carbon\Carbon;

require_once('controllers/BaseAdminController.php');
require_once('models/OrderList.php');

class AdminOrderController extends BaseAdminController
{
    function __construct()
    {
        $this->folder = 'admin';
        $this->page = 'Order Management';
    }

    public function index()
    {
        $orders = OrderList::all();
        $data = array('orders' => $orders);
        $this->render('order', $data);
    }

    public function finishedOrder()
    {
        if (isset($_GET['id'])) {
            $order = OrderList::findById($_GET['id']);
            $date = new Carbon();
            $order->finished_time = $date->format('y-m-d H:i:s');
            $order->save();
        }
        header('Location: index.php?controller=AdminOrder');
    }

    public static function convertDate($date)
    {
        if (is_null($date)) return null;
        $date = new Carbon($date);
        return $date->format('H:i, d/m/Y');
    }
}
