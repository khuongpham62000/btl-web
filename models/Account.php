<?php
require_once('BaseModel.php');

class Account extends BaseModel
{
    public $id;
    public $name;
    public $email;
    public $phone;
    public $address;
    public $image;
    public $role;

    static function findAccountByEmail($email)
    {
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM ' . self::get_db_name() . ' WHERE email=:email');
        $req->execute(array('email', $email));

        $item = $req->fetch();
        if (isset($item['id'])) {
            return new Account($item);
        }
        return null;
    }
}
