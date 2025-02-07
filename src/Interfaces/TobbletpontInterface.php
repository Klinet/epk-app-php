<?php

namespace Akali\EpkAppPhp\Interfaces;

interface TobbletpontInterface
{
    public function getCategory(): string;

    public function getType(): string;

    public function getLanguage(): ?string;
}
