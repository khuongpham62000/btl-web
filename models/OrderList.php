<?php
require_once('BaseModel.php');

use Carbon\Carbon;

class OrderList extends BaseModel
{
    public $id;
    public $account_id;
    public $total_price;
    public $address;
    public $customer_name;
    public $customer_phone;
    public $order_time;
    public $finished_time;

    static function getOrderByTime($start, $end = null)
    {
        if (is_null($end)) $end = Carbon::now();

        $list = [];
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM ' . self::get_db_name() . ' WHERE finished_time BETWEEN :start AND :end');
        $req->execute(array('start' => $start, 'end' => $end));

        foreach ($req->fetchAll() as $item) {
            $list[] = new OrderList($item);
        }
        return $list;
    }

    static function getUnfinishedOrder()
    {
        $list = [];
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM ' . self::get_db_name() . ' WHERE finished_time IS NULL OR finished_time="0000-00-00 00:00:00"');
        $req->execute();

        foreach ($req->fetchAll() as $item) {
            $list[] = new OrderList($item);
        }
        return $list;
    }
}
