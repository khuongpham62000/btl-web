<?php
require_once('BaseModel.php');

class OrderItem extends BaseModel
{
    public $id;
    public $order_id;
    public $product_id;
    public $quantity;

    static function findOrderItemsById($order_id)
    {
        $list = [];
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM ' . self::get_db_name() . ' WHERE order_id=:order_id');
        $req->execute(array('order_id' => $order_id));

        foreach ($req->fetchAll() as $item) {
            $list[] = new OrderItem($item);
        }
        return $list;
    }
}
