<?php


namespace App\Models\Registry\ConnectDB;

use App\Models\Registry\DB\DB;


trait Log {
    private $logFileName;
    private function writeLog($message)
    {
        $this->logFileName =  __DIR__.'/'.date("Y-m-d").'.log';
        file_put_contents($this->logFileName,date("Y-m-d H:i:s")." :". $message .PHP_EOL,FILE_APPEND);
    }
}


class ConnectDB extends DB {

    private $pdo;
    use Log;

    public function __construct()
    {
        parent::__construct();
        $this->pdo = parent::connect();


    }

    private function verify($query)
    {
        $condition = false;

        try {
            $condition = $query->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            $this->writeLog($e->getMessage());
        }
        return $condition?:[];
    }


    public function query($query)
    {
        return $this->verify($query);
    }

    public function prepare($query,$param,$prefix)
    {
        $resp = $this->pdo->prepare($query);

           if($prefix)
           {
               $resp->execute($param);
               return $resp->rowCount();
           }


        $resp->execute($param);

        return $this->verify($resp);
    }

    public function lastId()
    {
        return $this->pdo->lastInsertId();
    }

}