<?php

namespace Akali\EpkAppPhp\Models;

class SzakModel
{
    private string $egyetem;
    private string $kar;
    private string $szak;

    public function __construct(string $egyetem, string $kar, string $szak)
    {
        $this->egyetem = $egyetem;
        $this->kar = $kar;
        $this->szak = $szak;
    }

    public function getUniversity(): string
    {
        return $this->egyetem;
    }

    public function getFaculty(): string
    {
        return $this->kar;
    }

    public function getProgram(): string
    {
        return $this->szak;
    }
}
