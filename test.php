<?php

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

// $order = OrderList::findById(1);

// $order->total_price = 110;
// $order->save();

$order = new OrderList(7, 1, 1, 1, '2021-11-02 16:27:45');

var_pre($order);

$order->delete();
