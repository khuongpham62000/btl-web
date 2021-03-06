<?php

use Carbon\Carbon;

function var_pre($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

// class myclass
// {

//     var $var1; // this has no default value...
//     public $var2 = "xyz";
//     protected $var3 = 100;
//     private $var4;

//     public function __call($name, $args)
//     {
//         switch ($name) {
//             case '__construct':
//                 switch (count($args)) {
//                     case 0:
//                         return call_user_func_array(array($this, 'a'), $args);
//                         break;
//                     case 1:
//                         return call_user_func_array(array($this, 'b'), $args);
//                         break;
//                 }
//                 break;
//         }
//     }

//     // constructor
//     function __construct()
//     {
//         // change some properties
//         $this->var1 = "foo";
//         $this->var2 = "bar";
//         echo "__construct<br>";
//         return true;
//     }

//     function a()
//     {
//         $class_vars = get_class_vars(get_class($this));
//         echo "a<br>";

//         foreach ($class_vars as $name => $value) {
//             echo "$name : $value<br>";
//         }
//     }

//     function b()
//     {
//         echo
//         __CLASS__ . '<br>';
//     }
// }

// class thisClass extends myclass
// {
//     var $var5; // this has no default value...
//     public $var6 = "xyz";
//     protected $var7 = 100;
//     private $var8;
//     function b()
//     {
//         echo __CLASS__ . '<br>';
//     }
// }

// $my_class = new myclass();
// $my_class->b();


require_once('models/OrderList.php');

// $order = OrderList::getOrderByTime(new Carbon('16:27:33 01-09-2021'));
// $order = OrderList::getUnfinishedOrder();
// var_pre($order);
// $order = new OrderList(1, 1, 1);
// $order->create();
// $order->delete();

// $order = OrderList::findById(6);
// $date = new Carbon();
// $order->finished_time = $date->format('y-m-d H:i:s');
// $order->save();

// $str = "012345678911";
// $pattern = '/^0[0-9]{9,10}+$/';
// echo preg_match($pattern, $str);

// var_pre(is_numeric("123"));
// var_pre(is_numeric("12.121"));
// var_pre(is_numeric("12,121"));
// var_pre(is_numeric("12e21"));

// require_once('models/Product.php');
// var_pre(Product::getNewId());

// echo intval("5");
