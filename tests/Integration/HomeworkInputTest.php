<?php

namespace Tests\Integration;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class HomeworkInputTest extends TestCase
{
    private string $inputFile;

    protected function setUp(): void
    {
        // Az input fájl elérési útját beállítja
        $this->inputFile = __DIR__ . '/../../src/data/homework_input.php';
    }

    #[Test] public function testAzAllomanyLetezik(): void
    {
        // Ellenőrzi, hogy a homework_input.php fájl létezik
        $this->assertFileExists($this->inputFile, "A homework_input.php fájl nem található.");
    }

    #[Test] public function testAzAllomanyTombotTartalmaz(): void
    {
        // Ellenőrzi, hogy a homework_input.php fájl tömböt ad vissza
        $data = require $this->inputFile;
        $this->assertIsArray($data, "A homework_input.php nem ad vissza tömböt.");
    }

    #[Test] public function testMindenKulcsLetezik(): void
    {
        // Ellenőrzi, hogy minden hallgatói adat tartalmazza a szükséges kulcsokat
        $data = require $this->inputFile;

        foreach ($data as $entry) {
            $this->assertArrayHasKey('azonositok', $entry, "Hiányzik az 'azonositok' kulcs.");
            $this->assertArrayHasKey('valasztott-szak', $entry, "Hiányzik a 'valasztott-szak' kulcs.");
            $this->assertArrayHasKey('erettsegi-eredmenyek', $entry, "Hiányzik az 'erettsegi-eredmenyek' kulcs.");
            $this->assertArrayHasKey('tobbletpontok', $entry, "Hiányzik a 'tobbletpontok' kulcs.");
        }
    }
}
