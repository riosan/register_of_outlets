<?php

namespace App\Models\Registry\Providers;

use App\Models\Registry\Providers;
use App\Models\Registry\ParseConfig\ParseConfig;
use App\Models\Registry\Functions\Functions;

class ProviderVega extends Providers
{

    public function __construct()
    {
        $config = ParseConfig::parse(__FILE__);

        $this->config = $config;
        parent::__construct();
    }


    public function getFileList($sendMail): array
    {
        $this->passiveMode();

        $list = ftp_nlist($this->resource, $this->config['remote_dir']);

        $file_name = [];

        $hours_limit = $this->config['hours_limit'];

        $func = new Functions();

        $head = $func->getHeadPoint();

        $status_list = $func->getStatusInternetPoints();

        $point = $func->getPoint();

        $status = $func->getMessageStatus();

        $time_offset = (int)trim(date("O"),0);

        foreach ($list as $path_file) {

            $fName = basename($path_file);

            $file = mb_convert_encoding($fName, mb_detect_encoding($fName), static::ENCODING);

            $status_point =  $func->getStatusPoints($file,$head,$status_list);

            $file = $func->replacePointName('_', mb_substr($file, 7, 5), $point);

            $attr = $func->setAttr($file);

            $fSize = ftp_size($this->resource, $fName);

            $date = $this->getLastDate($fName,$time_offset);

            $diff = $this->getDateDiff($date);



            $file_name[] = [
                'file' => $file,
                'lastdate' => $date,
                'diff' => $diff,
                'fsize' => ($fSize / 1000000) >= 1 ? ($fSize / 1000000) . " Mb" : ($fSize / 1000) . " Kb",
                'fsort' => $fSize,
                'attr' => $attr,
                'status_point' => $status_point,
                'status' => $status
            ];

            if ($diff >= $hours_limit) {

                $array_points[$file]['hour'] = $diff;
                $array_points[$file]['date'] = $date;
            }
        }

        $this->sortBy($file_name, 'fsort', 1);

        if (isset($array_points) && $sendMail) {
            $this->sendMail($array_points, explode(',', $this->config['words']));
        }


        return $file_name;
    }


    public function parsingRegistry($filename): array
    {
        $result = [];


        $pattern = '/^[\d]+;[\d]{4}-[\d]{2}-[\d]{2};([\d]{1,4}|[\d]{1,4}\.[\d]{1,2});[-0-9A-Za-z_]+$/';


        foreach ($filename as $file) {

            $fp = $this->openFile($this->config['dir'] . $file);
            while (!feof($fp)) {
                $string = fgets($fp);
                if (preg_match($pattern, $string)) {
                    $result[] = $string;
                }
            }
            fclose($fp);
        }


        return $result;
    }


}

