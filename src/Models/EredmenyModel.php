<?php

namespace Akali\EpkAppPhp\Models;

class EredmenyModel
{
    private string $nev;
    private string $tipus;
    private int $eredmeny;

    public function __construct(string $nev, string $tipus, int $eredmeny)
    {
        $this->nev = $nev;
        $this->tipus = $tipus;
        $this->eredmeny = $eredmeny;
    }

    public function getSubjectName(): string
    {
        return $this->nev;
    }

    public function getExamType(): string
    {
        return $this->tipus;
    }

    public function getPercentage(): int
    {
        return $this->eredmeny;
    }
}