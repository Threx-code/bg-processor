<?php declare(strict_types=1);

namespace Domains\Cve\ValueObjects;

final readonly class ShortNameObject
{
    public function __construct(
        public string $shortName
    ){}

    public function __toString(): string
    {
        return $this->shortName ?? '';
    }

}
