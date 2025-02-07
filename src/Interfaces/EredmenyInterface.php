<?php

namespace Akali\EpkAppPhp\Interfaces;

interface EredmenyInterface
{
    public function getTargyNeve(): string;

    public function getErettsegiTipus(): string;

    public function getEredmenySzazalek(): int;
}
