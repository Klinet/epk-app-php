<?php
namespace Akali\EpkAppPhp\Traits;

trait NyelvvizsgaTrait {
    private ?string $nyelv = null;
    private ?string $tipus = null;

    public function setNyelv(string $nyelv): void {
        $this->nyelv = $nyelv;
    }

    public function getNyelv(): ?string {
        return $this->nyelv;
    }

    public function setTipus(string $tipus): void {
        $this->tipus = $tipus;
    }

    public function getTipus(): ?string {
        return $this->tipus;
    }

    public function pontszamNyelvvizsga(): int {
        return match ($this->tipus) {
            'B2' => 28,
            'C1' => 40,
            default => 0,
        };
    }
}