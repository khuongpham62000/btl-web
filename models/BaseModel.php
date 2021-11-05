<?php
// For testing
// require_once('env.php');
// require_once('connection.php');
class BaseModel
{
    static function get_db_name()
    {
        return get_called_class() . 's';
    }

    function __construct(...$params)
    {
        $class_vars = get_class_vars(get_called_class());
        $class_vars_len = count($class_vars);

        switch (count($params)) {
            case 1:
                $param = $params[0];
                foreach ($class_vars as $name => $value) {
                    $this->$name = $param[$name];
                }
                break;
            case 2:
                for ($i = 0; $i < $class_vars_len; $i++) {
                    $this->$class_vars[$i] = $params[$i];
                }
                break;
        }
    }

    static function all()
    {
        $className = get_called_class();

        $list = [];
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM ' . $className::get_db_name());
        $req->execute();

        foreach ($req->fetchAll() as $item) {
            $list[] = new $className($item);
        }

        return $list;
    }

    static function findById($id)
    {
        $className = get_called_class();

        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM ' . $className::get_db_name() . ' WHERE id = :id');
        $req->execute(array('id' => $id));

        $item = $req->fetch();
        if (isset($item['id'])) {
            return new $className($item);
        }
        return null;
    }
}
