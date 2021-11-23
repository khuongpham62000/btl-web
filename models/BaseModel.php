<?php
// For testing
require_once('env.php');
require_once('connection.php');
class BaseModel
{
    static function get_db_name()
    {
        return get_called_class() . 's';
    }

    function __construct(...$params)
    {
        $class_vars = get_class_vars(get_called_class());

        switch (count($params)) {
            case 1:
                $param = $params[0];
                foreach ($class_vars as $name => $value) {
                    $this->$name = $param[$name];
                }
                break;
            default:
                $class_vars = array_keys($class_vars);
                if (count($class_vars) != count($params)) {
                    array_shift($class_vars); // Remove id
                }
                array_map(function ($class_var, $param) {
                    $this->$class_var = $param;
                }, $class_vars, $params);
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

    static function findByIdOrFail($id)
    {
        $className = get_called_class();
        $item = $className::findById($id);
        if (is_null($item)) {
            header('Location: index.php?controller=AdminDashboard&action=error');
        }
        return $item;
    }

    function create()
    {
        // Prepare keys for query stmt
        $className = get_called_class();
        $class_vars = array_keys(get_class_vars($className));
        $temp = array_filter( // Remove null field
            $class_vars,
            function ($class_var, $key) {
                return !is_null($this->$class_var);
            },
            ARRAY_FILTER_USE_BOTH
        );
        $class_vars = $temp;
        // Prepare values for query stmt
        $vars_value = array_map(function ($var) {
            return $this->$var;
        }, $class_vars);
        // Prepare stmt
        $stmt = 'INSERT INTO ' . $className::get_db_name() . ' (';
        foreach ($class_vars as $name) {
            $stmt .= $name . ', ';
        }
        $stmt = substr($stmt, 0, -2); // Remove last comma
        $stmt .= ') VALUES (';
        foreach ($class_vars as $name) {
            $stmt .= ':' . $name . ', ';
        }
        $stmt = substr($stmt, 0, -2); // Remove last comma
        $stmt .= ')';
        $db = DB::getInstance();
        $req = $db->prepare($stmt);
        // Combine keys, values and excute
        $req->execute(array_combine(array_values($class_vars), $vars_value));
    }

    function save()
    {
        // Prepare keys for query stmt
        $className = get_called_class();
        $class_vars = array_keys(get_class_vars($className));
        $class_vars[] = "id"; // Append id for WHERE
        // Prepare values for query stmt
        $vars_value = array_map(function ($var) {
            return $this->$var;
        }, $class_vars);
        // Prepare stmt
        $stmt = 'UPDATE ' . $className::get_db_name() . ' SET ';
        foreach ($class_vars as $name) {
            $stmt .= $name . '=:' . $name . ', ';
        }
        $stmt = substr($stmt, 0, -2); // Remove last comma
        $stmt .= ' WHERE id=:id';
        $db = DB::getInstance();
        $req = $db->prepare($stmt);
        // Combine keys, values and excute
        $req->execute(array_combine(array_values($class_vars), $vars_value));
    }

    function delete()
    {
        $className = get_called_class();
        $db = DB::getInstance();
        $req = $db->prepare('DELETE FROM ' . $className::get_db_name() . ' WHERE id = :id');
        $req->execute(array('id' => $this->id));
    }

    public static function getNewId()
    {
        $className = get_called_class();
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM ' . $className::get_db_name() . ' ORDER BY id DESC LIMIT 1');
        $req->execute();

        $item = $req->fetch();
        if (isset($item['id'])) {
            return $item['id'] + 1;
        }
        return 0;
    }
}
