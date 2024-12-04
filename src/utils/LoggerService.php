<?php

namespace App\Utils;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LoggerService
{
    private $logger;

    public function __construct(string $logName, string $pathLog)
    {

        // 'RequestLogger'
        try {
            $this->logger = new Logger($logName);
            $this->logger->pushHandler(new StreamHandler(__DIR__ . "/../../logs/$pathLog.log", Logger::DEBUG));
            $this->logger->info($pathLog . ' instance created');
        } catch (\Exception $e) {
            $fallbackLogger = new Logger('FallbackLogger');
            $fallbackLogger->pushHandler(new StreamHandler(__DIR__ . "/../../logs/$pathLog.log", Logger::ERROR));
            $this->logger->error('An error ' . $pathLog . ' occurred', ['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);
        }
    }
}
