<?php

namespace App\Models\Registry\ParseConfig;

class ParseConfig
{
    const EXP = '.ini';

    const SL = '/';

    private static $dir;

    private static $configName;


        public static function parse($configName)
    {
      static::$configName =  substr(basename($configName),0,-4);

      static::$dir = __DIR__.static::SL.static::$configName.static::SL.static::$configName.static::EXP;

      return parse_ini_file(static::$dir);
    }

}

