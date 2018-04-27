<?php
/**

 */

namespace App\Models\Registry\Providers;
use App\Models\Registry\ParseConfig\ParseConfig;


class Exchange
{
    /**
     * @var string
     */
    private $filename = '/var/log/vsftpd.log' , $cmd = 'tail -n 30 ', $connect, $config;

    /**
     * Exchange constructor.
     */
    public function __construct()
    {
        $this->config = ParseConfig::parse(__FILE__);
    }

    /**
     * @return string
     */
    public function setConnectSSH()
    {
        $this->connect = ssh2_connect($this->config['host'], $this->config['port']);
        if(!is_resource($this->connect)) return 'Not connect';

        if (!ssh2_auth_password($this->connect, $this->config['login'], $this->config['pass']))
            return 'Authentication Failed...';

    }


    /**
     * @return bool|string
     */
    public function getLog()
    {
        $outStream = ssh2_exec($this->connect, $this->cmd.$this->filename);
        stream_set_blocking($outStream, true);
        $out = stream_get_contents($outStream);
        fclose($outStream);
        return $out;
    }

}