<?php

namespace Akali\EpkAppPhp\Traits;

trait LoggerTrait
{
    private function getLogDirectory(): string
    {
        $logDir = __DIR__ . '/../../logs'; // Módosított log elérési útvonal
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true); // Mappa létrehozása, ha nem létezik
        }
        return $logDir;
    }

    private function getLogFilePath(string $type = 'app'): string
    {
        $logDir = $this->getLogDirectory();
        return $logDir . "/{$type}_" . date('Y-m-d') . ".log";
    }

    public function log(string $message): void
    {
        $filePath = $this->getLogFilePath('app');
        file_put_contents($filePath, date('Y-m-d H:i:s') . " - " . $message . PHP_EOL, FILE_APPEND);
    }

    public function logError(string $message): void
    {
        $filePath = $this->getLogFilePath('errors');
        file_put_contents($filePath, date('Y-m-d H:i:s') . " - ERROR: " . $message . PHP_EOL, FILE_APPEND);
    }
}
