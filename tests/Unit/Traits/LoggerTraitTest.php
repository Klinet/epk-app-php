<?php

namespace Tests\Unit\Traits;

use PHPUnit\Framework\TestCase;
use Akali\EpkAppPhp\Traits\LoggerTrait;

class LoggerTraitTest extends TestCase
{
    use LoggerTrait;

    private string $logFilePath;

    protected function setUp(): void
    {
        parent::setUp();
        $this->logFilePath = __DIR__ . '/../../../logs/app_' . date('Y-m-d') . '.log';

        // Ha már létezik a fájl, töröljük, hogy tiszta teszt legyen
        if (file_exists($this->logFilePath)) {
            unlink($this->logFilePath);
        }
    }

    #[Test] public function testLogCreatesFile()
    {
        $this->log("Teszt log üzenet");

        // Ellenőrzi, hogy a fájl valóban létrejött
        $this->assertFileExists($this->logFilePath);
    }

    #[Test] public function testLogWritesToFile()
    {
        $testMessage = "Ez egy teszt log üzenet.";
        $this->log($testMessage);

        $logContent = file_get_contents($this->logFilePath);
        $this->assertStringContainsString($testMessage, $logContent);
    }

    #[Test] public function testLogErrorWritesToFile()
    {
        $errorMessage = "Ez egy teszt hibaüzenet.";
        $this->logError($errorMessage);

        $errorLogFilePath = __DIR__ . '/../../../logs/errors_' . date('Y-m-d') . '.log';

        // Ellenőrzi, hogy a hiba naplófájl létrejött
        $this->assertFileExists($errorLogFilePath);

        // Ellenőrzi, hogy az üzenet szerepel a fájlban
        $logContent = file_get_contents($errorLogFilePath);
        $this->assertStringContainsString($errorMessage, $logContent);
    }
}
