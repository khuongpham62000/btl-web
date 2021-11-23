<?php
require_once('BaseModel.php');

class Product extends BaseModel
{
    public $id;
    public $name;
    public $image;
    public $stock;
    public $price;
    public $volume;
    public $description;

    public static function getNewId()
    {
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM products ORDER BY id DESC LIMIT 1');
        $req->execute();

        $item = $req->fetch();
        if (isset($item['id'])) {
            return $item['id'] + 1;
        }
        return 0;
    }
}
