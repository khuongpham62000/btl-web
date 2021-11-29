<?php
require_once('controllers/BaseUserController.php');
require_once('models/Account.php');
require_once('models/Product.php');
require_once('models/OrderList.php');
require_once('models/OrderItem.php');

use Carbon\Carbon;

class UserCartController extends BaseUserController
{
    function __construct()
    {
        $this->page = "Cart";
    }

    public function index()
    {
        $products = Product::all();
        $this->render('cart', array("products" => $products));
    }

    public function order()
    {
        if (isset($_POST["data"])) {
            try {
                if (intval($_POST["user_id"]) > 0) {
                    $user = Account::findByIdOrFail($_POST["user_id"]);
                }
                $newOrderId = OrderList::getNewId();
                $total_value = 0;
                foreach ($_POST["data"] as $product_id => $value) {
                    $product = Product::findByIdOrFail($product_id);
                    if (intval($value) == 0) {
                        echo json_encode(array("status" => 401, "message" => "Invalid quantity\n"));
                    }
                    $newOrderItem = new OrderItem($newOrderId, $product_id, intval($value));
                    $newOrderItem->create();
                    $total_value += intval($value) * $product->price;
                }

                $newOrder = new OrderList(
                    $newOrderId, //id
                    intval($_POST["user_id"]), // account_id
                    $total_value, // total_price
                    $_POST["address"], //address
                    isset($_POST["name"]) ? $_POST["name"] : $user->name, // customer_name,
                    isset($_POST["phone"]) ? $_POST["phone"] : $user->phone, // customer_phone,
                    Carbon::now(), //order_time
                    "NULL"
                );
                $newOrder->create();
                echo json_encode(array("status" => 200, "message" => "Success\n"));
            } catch (\Throwable $th) {
                echo json_encode(array("status" => 401, "message" => "Invalid\n"));
            }
        } else echo json_encode(array("status" => 401, "message" => "Invalid\n"));
    }
}
