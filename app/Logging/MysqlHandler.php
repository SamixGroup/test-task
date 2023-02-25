<?php

namespace App\Logging;

use Illuminate\Support\Facades\DB;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class MysqlHandler extends AbstractProcessingHandler
{
    private string $table;

    public function __construct($level = Logger::INFO, $bubble = true)
    {
        $this->table = 'custom_logs';
        parent::__construct($level, $bubble);
    }

    protected function write(array $record): void
    {
        // dd($record);
        $data = array(
            'message' => $record['message'],
            'level' => $record['level'],
            'level_name' => $record['level_name'],
            'channel' => $record['channel'],
            'remote_addr' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        );
        DB::connection()->table($this->table)->insert($data);
    }
}
