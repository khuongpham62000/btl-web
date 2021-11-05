<?php
class DB
{
    private static $instance = NULl;
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            try {
                self::$instance = new PDO(
                    $_ENV["DB_URL"] . ';dbname=' . $_ENV["DB_NAME"],
                    $_ENV["DB_USERNAME"],
                    $_ENV["DB_PASSWORD"]
                );
                self::$instance->exec("SET NAMES 'utf8'");
            } catch (PDOException $ex) {
                die($ex->getMessage());
            }
        }
        return self::$instance;
    }
}
