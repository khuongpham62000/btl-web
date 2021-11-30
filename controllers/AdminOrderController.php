<?php

use Carbon\Carbon;

require_once('controllers/BaseAdminController.php');
require_once('models/OrderList.php');
require_once('models/OrderItem.php');
require_once('models/Product.php');

class AdminOrderController extends BaseAdminController
{
    function __construct()
    {
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
                'order' => $order,
                'order_items' => $order_items_detail,
            );
            $this->render('order_detail', $data);
        }
    }

    public function finishedOrder()
    {
        if (isset($_GET['id'])) {
            $order = OrderList::findByIdOrFail($_GET['id']);
            $orderItems = OrderItem::findOrderItemsById($order->id);
            foreach ($orderItems as $orderItem) {
                $product = Product::findById($orderItem->product_id);
                $product->stock -= $orderItem->quantity;
                $product->save();
            }
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
        if (is_null($date) || strcmp($date, "0000-00-00 00:00:00") == 0) return null;
        $date = new Carbon($date);
        return $date->format('H:i, d/m/Y');
    }

    public function deleteOrder()
    {
        if (isset($_GET['id'])) {
            $order = OrderList::findByIdOrFail($_GET['id']);
            $order_items = OrderItem::findOrderItemsById($_GET['id']);
            foreach ($order_items as $item) {
                $item->delete();
            }
            $order->delete();
        }
    }
}
