<?php


namespace App\Models\Registry\Connect;

use App\Models\Registry\Setting\Settings;
class Connect
{

    private $connect;

    public function __construct()
    {
        if (!($this->connect instanceof self)) {
            $this->getConnect();
            $this->setAuth();
            $this->setDir();
        }
        return $this;
    }


    private function getConnect()
    {
        $this->connect = ftp_connect(Settings::$url, Settings::$port);
    }

    private function setAuth()
    {
        ftp_login($this->connect, Settings::$login, Settings::$password);
    }

    private function setDir()
    {
        ftp_chdir($this->connect, Settings::$remote_dir);
    }

    public function getFile($local_file, $remote_file)
    {
        ftp_get($this->connect, $local_file, $remote_file, FTP_BINARY);
    }

    public function getFileList()
    {
        return ftp_nlist($this->connect, Settings::$remote_dir);
    }
}
