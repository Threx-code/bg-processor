<?php

declare(strict_types=1);

namespace Domains\Helpers\ValueObjects;

class JsonObject
{
    public function __construct(public $data) {}

    public function __string(): string
    {
        return json_encode($this->data);
    }

}
