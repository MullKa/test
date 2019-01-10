<?php

namespace vendor\core;


class Db
{
    protected $pdo;
    protected static $instance;

    protected function __construct()
    {
        $db_config = require_once ROOT . "\\config\\db_config.php";
        $this->pdo = new \PDO($db_config['dsn'], $db_config['user'], $db_config['pass']);
    }

    public static function instance()
    {
        if(self::$instance === null)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function execute($sql)
    {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute();
    }

    public function query($sql)
    {
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute();
        if($res !== false)
            return $stmt->fetchAll(SQLSRV_FETCH_ASSOC);
        return [];
    }
}