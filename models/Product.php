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
}
