<?php

use Carbon\Carbon;

require_once('controllers/BaseAdminController.php');
require_once('models/OrderList.php');
require_once('models/OrderItem.php');
require_once('models/Product.php');
require_once('models/Account.php');

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
        $this->render('orders', $data, 'table_js');
    }

    public function viewDetail()
    {
        if (isset($_GET['id'])) {
            $order = OrderList::findByIdOrFail($_GET['id']);
            $user = Account::findByIdOrFail($order->account_id);
            $order_items = OrderItem::findOrderItemsById($_GET['id']);
            $order_items_detail = array_map(function ($order_item) {
                $product = Product::findByIdOrFail($order_item->product_id);
                return array(
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $order_item->quantity,
                    'total_price' => $product->price * $order_item->quantity
                );
            }, $order_items);
            $data = array(
                'order' => $order, 'user' => $user,
                'order_items' => $order_items_detail,
            );
            $this->render('order_detail', $data);
        }
    }

    public function finishedOrder()
    {
        if (isset($_GET['id'])) {
            $order = OrderList::findByIdOrFail($_GET['id']);
            $date = new Carbon();
            $order->finished_time = $date->format('y-m-d H:i:s');
            $order->save();
            if (isset($_GET['detail']) && strcmp($_GET['detail'], "True") == 0) {
                header('Location: index.php?controller=AdminOrder&action=viewDetail&id=' . $_GET['id']);
            } else header('Location: index.php?controller=AdminOrder');
        }
    }

    public static function convertDate($date)
    {
        if (is_null($date)) return null;
        $date = new Carbon($date);
        return $date->format('H:i, d/m/Y');
    }
}
