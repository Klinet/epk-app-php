<?php

namespace Akali\EpkAppPhp\Models;

use Akali\EpkAppPhp\Interfaces\TobbletpontInterface;

class TobbletpontModel implements TobbletpontInterface
{
    private string $kategoria;
    private string $tipus;
    private ?string $nyelv;

    public function __construct(string $kategoria, string $tipus, ?string $nyelv = null)
    {
        $this->kategoria = $kategoria;
        $this->tipus = $tipus;
        $this->nyelv = $nyelv;
    }

    public function getCategory(): string
    {
        return $this->kategoria;
    }

    public function getType(): string
    {
        return $this->tipus;
    }

    public function getLanguage(): ?string
    {
        return $this->nyelv;
    }
}

