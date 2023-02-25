<?php

namespace App\Logging;

use Monolog\Logger;

class MysqlLogger
{
    public function __invoke(array $config): Logger
    {
        $logger = new Logger('MysqlLogger');
        return $logger->pushHandler(new MysqlHandler());
    }
}
