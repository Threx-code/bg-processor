<?php declare(strict_types=1);

namespace Domains\Adp\ValueObjects;

final readonly class TitleObject
{
    public function __construct(
        public string $title
    ){}

    public function __toString(): string
    {
        return $this->title ?? '';
    }

}
