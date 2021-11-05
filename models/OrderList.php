<?php
// For testing
// require_once('BaseModel.php');
class OrderList extends BaseModel
{
    public $id;
    public $account_id;
    public $total_price;
    public $address;
    public $finished_time;

    static function get_db_name()
    {
        return 'order_list';
    }
}
