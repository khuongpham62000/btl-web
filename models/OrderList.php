<?php
require_once('BaseModel.php');
class OrderList extends BaseModel
{
    public $id;
    public $account_id;
    public $total_price;
    public $address;
    public $finished_time;
}
