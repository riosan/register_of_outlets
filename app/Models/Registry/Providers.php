<?php



namespace App\Models\Registry;
use App\Models\Registry\Functions\Functions;

//ini_set("max_execution_time", "120");


abstract class Providers  {

        protected $resource, $table, $config = [];
        private $ip, $status = [];
        /*protected*/ const ENCODING = "CP1251";



    public function __construct()
    {
        $this->connectFtp();
        $this->login();
        $this->getDir();
        $this->setIp();
    }

    private function connectFtp()
    {
        $this->resource = @ftp_connect($this->config['url'], $this->config['port']);
    }

    private function login()
    {
        return @ftp_login($this->resource, $this->config['login'], $this->config['pass']);
    }

    private function getDir()
    {
        return ftp_chdir($this->resource, $this->config['remote_dir']);
    }

    private function setIp()
    {
        $this->ip = $_SERVER['SERVER_ADDR'];

    }


    protected function passiveMode()
    {
        /**
         * If ip is local, then switch ftp passive mode "ON"
         */
        if(!filter_var($this->ip,FILTER_VALIDATE_IP,FILTER_FLAG_NO_PRIV_RANGE))
        {
            ftp_pasv($this->resource,true);
        }

    }

    protected function getLastDate($file, $time_offset) : string
    {
        return (new \DateTime(date("Y-m-d H:i:s",ftp_mdtm($this->resource, $file))))
                ->modify("-{$time_offset} hour")->format("Y-m-d H:i:s");
    }

    protected function getDateDiff($date) : int
    {

        $lastDate = new \DateTime($date);

        $now = new \DateTime();

        $hCount = $now->diff($lastDate);

        return $hCount->h+($hCount->d*24);

       /* $diff = strtotime ( date("Y-m-d H:i:s") ) - strtotime ( $date );

        return sprintf ( '%02d', $diff / 3600 );*/

    }


    protected function sortBy(&$file_name, $key, $sort_prefix = 0)
    {
        usort($file_name,function($a,$b) use ($sort_prefix, $key)  {

            switch ($sort_prefix)
            {
                    case 0 :
                        return $a[$key] <=> $b[$key];
                    break;

                    case 1 :
                        return $b[$key] <=> $a[$key];
                    break;

                    default:
                        return $a[$key] <=> $b[$key];
            }


        });
    }

    public function downloadFile($filename) : array
    {

        foreach ($filename as $file)
        {

            if(!@ftp_get($this->resource, $this->config['dir'].$file, $file, FTP_BINARY))

                $this->status[] = "File $file not downloading... Try again later";
             else
                $this->status[] = "File $file  downloading.";
        }

        return $this->status;
    }

    protected function openFile($file)
    {
        if($fp = fopen($file,"r"))
        return $fp;
    }


     protected function  sendMail($array_points,$set_of_words)
     {

          $emails =  (new Functions())->getConfirmMailAddress();

          if(empty($emails))  return;

          $body = '';

           foreach ( $emails as $num => $to){

               if(!(new Functions())->validateEmail($to['address'])) continue;


                foreach ($array_points as $name => $data){
                  $hours =  $data['hour'] > $this->config['hours_limit'] ? " <font color='red'>{$data['hour']}</font>" : $data['hour'];
                  $body .= strtr($this->config['body'],["{TEXT}" => "$name    {$data['date']}    {$hours} {$this->declensionOfWords($hours,$set_of_words)}"]).PHP_EOL;
                }

               if(!mail($to['address'],$this->config['subject'],$body,str_replace('|',PHP_EOL,$this->config['headers']))){
                   var_dump("Mail not send $to") ;
               }
               $body = '';

           }

     }

     protected function declensionOfWords($h, $option)
     {
         if($h < 0 || count($option) !== 3) return '';
         $h = abs($h) % 100;
         $h1 = $h % 10;
         if ($h > 10 && $h < 20) return $option['2'];
         if ($h1 > 1 && $h1 < 5) return $option['1'];
         if ($h1 == 1) return $option['0'];
         return $option['2'];
     }


    abstract protected function getFileList($sendMail);

    abstract public function parsingRegistry($filename);

}




