<?php

namespace App\Models\Registry\DB;
use App\Models\Registry\ParseConfig\ParseConfig;


class DB
{
    private $config;


    public function __construct()
    {
        $config = ParseConfig::parse(__FILE__);
        $this->config = $config;
    }


    protected function connect()
    {
        $pdo = new \PDO($this->config['pdo'],$this->config['login'],$this->config['pass']);

        if($this->config['debug']) $this->debug($pdo);

        return $pdo;
    }

    private function debug($pdo)
    {
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
}